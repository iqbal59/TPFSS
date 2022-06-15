<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('accounts_model');
        $this->load->model('common_model');
    }


    
    public function index()
    {
        $data = array();
        $data['page'] = 'simplify tumbledry';
        $this->load->view('home', $data);
    }



    
    public function log()
    {
        $data = array();
        if ($_POST) {
            $query = $this->login_model->validate_partner();
            
            //-- if valid
            if ($query) {
                foreach ($query as $row) {
                    $data = array(
                        'id' => $row->id,
                        'name' => $row->firm_name,
                        'email' =>$row->email_id,
                        'code' =>$row->store_crm_code,
                        'psw' => base64_encode($this->input->post('password')),
                        'role' =>'user',
                        'is_partner_login' => true
                    );
                    $this->session->set_userdata($data);
                    if ($this->input->post('l_type')=='fss') {
                        $url = base_url('partner/dashboard');
                    } elseif ($this->input->post('l_type')=='order') {
                        $url = "https://orderattumbledry.in/partner/log/".$this->session->userdata('code')."/".$this->session->userdata('psw');
                    }
                }
                echo json_encode(array('st'=>1,'url'=> $url)); //--success
            } else {
                echo json_encode(array('st'=>0)); //-- error
            }
        } else {
            $this->load->view('auth', $data);
        }
    }



    
    public function check_login()
    {
        $url='';
        if ($this->session->userdata('is_partner_login') == true) {
            if ($this->input->post('url')=='fss') {
                $url = base_url('partner/dashboard');
            } elseif ($this->input->post('url')=='order') {
                $url = "https://orderattumbledry.in/partner/log/".$this->session->userdata('code')."/".$this->session->userdata('psw');
            }
            echo json_encode(array('st'=>1, 'url'=>$url));
        } //--success
        else {
            echo json_encode(array('st'=>0));
        } //-- error
    }
}