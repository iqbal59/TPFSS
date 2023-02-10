<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Dashboard Controller
 *
 * @author Shahzaib
 */
class Dashboard extends MY_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
    }

    
    /**
     * Dashboard Page
     *
     * @param  string $type
     * @return void
     */
    
    public function index( $type = 'user' )
    {
      //  if ( ! $this->zuser->is_logged_in ) env_redirect( 'login' );
        
       // $this->load->model( 'Support_model' );
        
        $this->area = 'admin/kbm';
        $method = 'load_public_template';
        $view = 'user_dashboard';
        
        if ( $type === 'admin' )
        {
            //if ( ! $this->zuser->is_team_member() ) env_redirect( 'dashboard' );
            
            $method = 'load_panel_template';
            $recent_tickets_stats = [];
            $stats = [];
            $view = 'dashboard';
            $to_count = ['count' => true];
        
            // if ( $this->zuser->has_permission( 'users' ) )
            // {
            //     $this->load->model( 'User_model' );
            //     $data['data']['users'] = $this->User_model->limited_users( 7 );
            //     $stats['total_users'] = $this->User_model->get_of_total_count();
            // }

            // if ( ! $this->zuser->has_permission( 'all_tickets' ) )
            // {
            //     $to_count['assigned'] = true;
            // }
            
            // $stats['all_tickets'] = $this->Support_model->tickets( $to_count );
            
            // $to_count['status'] = 1;
            // $stats['opened_tickets'] = $this->Support_model->tickets( $to_count );
            
            // $to_count['status'] = 0;
            // $stats['closed_tickets'] = $this->Support_model->tickets( $to_count );
            
            for ( $i = 6; $i >= 0; $i-- )
            {
                $month = date( 'n' ) - $i;
                $year = date( 'Y' );
                
                if ( $month < 1 )
                {
                    $month = $month + 12;
                    $year = $year - 1;
                }
                
                $time = mktime( 0, 0, 0, $month, 1, $year );
                //$recent_tickets_count = $this->Support_model->get_tickets_count_by_month_year( "{$month}-{$year}" );
                //$month_name = get_cf_date_by_user_timezone( 'F', $time );
                //$recent_tickets_stats[$month_name] = $recent_tickets_count;
            }
            
            $stats['recent_tickets_stats'] = json_encode( $recent_tickets_stats );
            $data['data']['dashboard'] = $stats;
            
            $data['data']['scripts'] = [
                admin_lte_asset( 'plugins/chart.js/Chart.min.js', true ),
                get_assets_path( 'panel/js/chartjs_script.js' )
            ];
        }
        else if ( $type === 'user' )
        {
            $to_count = ['user_id' => $this->zuser->get( 'id' ), 'count' => true];
            $data['data']['all'] = $this->Support_model->tickets( $to_count );
            
            $to_count['status'] = 1;
            $data['data']['opened'] = $this->Support_model->tickets( $to_count );
            
            $to_count['status'] = 0;
            $data['data']['closed'] = $this->Support_model->tickets( $to_count );
            
            $data['data']['tickets'] = $this->Support_model->tickets([
                'user_id' => $this->zuser->get( 'id' ),
                'limit' => 5
            ]);
        }
        else
        {
            redirect();
        }
        
        $data['title'] = lang( 'dashboard' );
        $data['view'] = $view;
        
        $this->{$method}( $data, false );
    }
    
    /**
     * Team Members Dashboard Page
     *
     * @return void
     */
    public function admin()
    {
        $this->index( 'admin' );
    }


    public function login()
    {
        $this->area = 'admin/kbm';
        $data['title'] = lang( 'login' );
        $data['view'] = 'login';
        $this->load_public_template( $data , false);
        
    }


    public function dologin(){

        if ( $this->form_validation->run( 'login' ) ){
            $query = $this->login_model->validate_user();
            
            //-- if valid
            if($query){
                $data = array();
                foreach($query as $row){
                    $data = array(
                        'id' => $row->id,
                        'name' => $row->first_name,
                        'email' =>$row->email,
                        'role' =>$row->role,
                        'is_klogin' => TRUE
                    );
                    $this->session->set_userdata($data);
                    
                }
                r_s_jump( 'admin/knowledge_base/dashboard', 'success' );   //--Sucess
            }else{
                r_error( 'went_wrong' ); //-- error
            }
            
        }else{
            d_r_error( validation_errors() );
        }
    }


    public function logout(){
        $this->session->sess_destroy();
        $data = array();
        echo "sfdsfdsf";
        env_redirect( 'admin/knowledge_base/login' );
        
    }
}