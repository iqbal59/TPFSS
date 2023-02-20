<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Support Controller ( Admin )
 *
 * @author Shahzaib
 */
class Washing extends MY_Controller {

    /**
     * Class Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        // if ( ! $this->zuser->is_logged_in )
        // {
        //     env_redirect( 'login' );
        // }
        check_login_kuser();
        
        $this->sub_area = 'kbm';
        $this->area = 'admin';
        
       $this->load->model( 'Support_model');
       $this->load->model( 'washing_model');
       $this->load->library('form_validation');
        $this->load->library( 'pagination' );
    }


    public  function articles_washing( $type = 'list', $id = 0 ){
        $this->set_admin_reference( 'others' );
        
        $page_title = sub_title( lang( 'knowledge_base' ), 'Washing' );
        
        if ( $type === 'list' )
        {
            $options = [];
            $options['searched'] = do_secure( get( 'search' ) );
            $options['visibility'] = do_secure_l( get( 'visibility' ) );
            
            $config['base_url'] = env_url( 'admin/knowledge_base/washing/list' );
            $config['total_rows'] = $this->washing_model->articles( true, 0, 0, $options );
            $config['per_page'] = PER_PAGE_RESULTS_PANEL;
            $offset = get_offset( $config['per_page'], 5 );
            
            $this->pagination->initialize( $config );
            $data['data']['pagination'] = $this->pagination->create_links();
            
            $data['data']['articles'] = $this->washing_model->articles(
                false,
                $config['per_page'],
                $offset,
                $options
            );
            
            $data['data']['main_controller'] = 'kbm/washing';
            $data['delete_method'] = 'delete_washing';
            $data['view'] = 'knowledge_base/washing';
        }
        else if ( $type === 'new' )
        {
            $page_title = sub_title( $page_title, 'New Washing' );
            $data['data']['machines']=$this->washing_model->getModel('tbl_machine');
            $data['data']['garments']=$this->washing_model->getModel('tbl_garments');
            $data['data']['fabrics']=$this->washing_model->getModel('tbl_fabrics');
            $data['data']['embellishments']=$this->washing_model->getModel('tbl_embellishments');
            $data['data']['colors']=$this->washing_model->getModel('tbl_colors');
            $data['data']['waters']=$this->washing_model->getModel('tbl_water_temp');
            $data['view'] = 'knowledge_base/new_washing';
        }
        else
        {
            $article = $this->washing_model->article( $id );
            $articleMachine = $this->washing_model->articleMachine( $article->id, "washing_article_id");

            if ( empty( $article ) ) env_redirect( 'admin/knowledge_base/washing' );
        
            $page_title = sub_title( $page_title, lang( 'edit_washing' ) );
            $data['data']['machines']=$this->washing_model->getModel('tbl_machine');
            $data['data']['garments']=$this->washing_model->getModel('tbl_garments');
            $data['data']['fabrics']=$this->washing_model->getModel('tbl_fabrics');
            $data['data']['embellishments']=$this->washing_model->getModel('tbl_embellishments');
            $data['data']['colors']=$this->washing_model->getModel('tbl_colors');
            $data['data']['waters']=$this->washing_model->getModel('tbl_water_temp');
            $data['data']['article'] = $article;
            $data['data']['articleMachine'] = $articleMachine;
            $data['view'] = 'knowledge_base/edit_washing';
        }
        
        $data['title'] = $page_title;
        $this->load_panel_template( $data );
    }


        public function get_allprogram()
            {
            $data['data']['wash']=$this->washing_model->getDataById("machine_id='".$this->input->post('id')."'", "tbl_wash_program");
            $data['data']['dry']=$this->washing_model->getDataById("machine_id='".$this->input->post('id')."'", "tbl_drying_program");
            $data['data']['chemicals']=$this->washing_model->getAllChemicals();
            echo json_encode($data);
            }


            public function get_allmachine()
            {
            $data['data']['machines']=$this->washing_model->getModel('tbl_machine');
            
            echo json_encode($data);
            }


    public function add_washing()
    {
        //check_action_authorization('knowledge_base');
        
        if ( $this->form_validation->run( 'article_washing' ) )
        {
            $data = [
                'title' => do_secure( post( 'title' ) ),
                'slug' => do_secure(post('slug')),
                'special_instruction' => do_secure( post( 'special_instruction' ) ),
                'content' => do_secure( post( 'content' ), true ),
                'drying_description' => do_secure( post( 'drying_description' ), true ),
                'garment_id' => implode(",",$this->input->post('garment' )) ,
                'fabric_id' => implode(",",$this->input->post('fabric' )) ,
                'embellishment_id' => do_secure( post( 'embellishment' ) ),
                'color_id' => implode(",", $this->input->post('color' )) ,
                'water_id' => do_secure( post( 'water' ) ),
                'video_url' => do_secure( post( 'video_url' ) ),
                'created_at' => time()
            ];
            

            //Chemicals

            // $chemicals=array();
            // foreach()
            // $chemical[]=''
            //print_r($this->request->post('chemical'));

            
            // $result = array_search( $data['category_id'], array_column( get_articles_categories( 'all' ), 'id' ) );
                
            // if ( $result === false ) r_error( 'invalid_req' );
            
            // if ( empty( $data['slug'] ) )
            // {
            //     $data['slug'] = $this->washing_model->washing_article_slug( $data['title'] );
            // }
            
            // if ( $this->washing_model->washing( $data['slug'], 'slug' ) )
            // {
            //     r_error( 'slug_exists' );
            // }
            
            $id = $this->washing_model->add_washing( $data );
            
            //washing chemical model
                $washPrograms=$this->input->post('wash');
            foreach($washPrograms as $c){
                $dataWash=array(
                    'machine_id'=>$c['machine_id'],
                    'wash_program_id'=>$c['wash_program_id'],
                    'dry_program_id'=>$c['dry_program_id'],
                    'wash_chemical_ids'=>implode(",", $c['wash_chemical_ids']),
                    'washing_article_id'=>$id
                );

                $this->washing_model->add($dataWash, 'article_washing_machine' );

            }
            
            if ( ! empty( $id ) )
            {
                r_s_jump( 'admin/knowledge_base/washing', 'added' );
            }
            
            r_error( 'went_wrong' );
        }
        
        d_r_error( validation_errors() );
    }





    public function update_washing()
    {
        //check_action_authorization( 'knowledge_base' );
        
        if ( $this->form_validation->run( 'article_washing' ) )
        {
            $id = intval( post( 'id' ) );
            
            $data = [
                'title' => do_secure( post( 'title' ) ),
                //'slug' => do_secure(post('slug')),
                'special_instruction' => do_secure( post( 'special_instruction' ) ),
                'content' => do_secure( post( 'content' ), true ),
                'drying_description' => do_secure( post( 'drying_description' ), true ),
                'garment_id' => implode(",",$this->input->post('garment' )) ,
                'fabric_id' => implode(",",$this->input->post('fabric' )) ,
                'embellishment_id' => do_secure( post( 'embellishment' ) ),
                'color_id' => implode(",",$this->input->post('color' )) ,
                'water_id' => do_secure( post( 'water' ) ),
                'video_url' => do_secure( post( 'video_url' ) )
                
            ];
            
            //$result = array_search( $data['category_id'], array_column( get_articles_categories( 'all' ), 'id' ) );
                
            //if ( $result === false ) r_error( 'invalid_req' );
            
            // if ( empty( $data['slug'] ) )
            // {
            //     $data['slug'] = $this->Support_model->article_slug( $data['title'] );
            // }
            
            // if ( $this->Support_model->is_article_exists_by( $data['slug'], $id ) )
            // {
            //     r_error( 'slug_exists' );
            // }
            
            if ( $this->washing_model->update_washing( $data, $id ) )
            {
                $this->washing_model->delete_article_wahsing_machine($id);
                $washPrograms=$this->input->post('wash');
                foreach($washPrograms as $c){
                    $dataWash=array(
                        'machine_id'=>$c['machine_id'],
                        'wash_program_id'=>$c['wash_program_id'],
                        'dry_program_id'=>$c['dry_program_id'],
                        'wash_chemical_ids'=>implode(",", $c['wash_chemical_ids']),
                        'washing_article_id'=>$id
                    );
    
                    $this->washing_model->add($dataWash, 'article_washing_machine' );}
               r_s_jump( "admin/knowledge_base/edit_washing/{$id}", 'updated' );
            }
            
            r_error( 'not_updated' );
        }
        
        d_r_error( validation_errors() );
    }
   

    


    public function delete_washing()
    {
        //check_action_authorization( 'knowledge_base' );
        
        $id = intval( post( 'id' ) );
        
        if ( $this->washing_model->delete_washing( $id ) )
        {
            $this->washing_model->delete_article_wahsing_machine( $id );
            
            r_success_remove( $id );
        }
        
        r_error( 'invalid_req' );
    }
}