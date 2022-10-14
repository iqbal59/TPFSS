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
        $this->load->model('store_model');
        $this->load->library('form_validation');
    }


    public function index()
    {
        check_login_partner();
        $data = array();
        $data['page'] = 'simplify tumbledry';
        $this->load->view('home', $data);
    }


    public function login()
    {
        $data = array();
        $data['page'] = 'simplify tumbledry';
        $this->load->view('home_new', $data);
    }

    public function profile()
    {
        check_login_partner();
        $id=$this->session->userdata('id');
        $data = array();
        $data['page'] = 'Profile';
        $data['storeData']=$this->store_model->get_store($id);


        if (isset($data['storeData']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('cur_password', 'Current Password', 'required');

            $this->form_validation->set_rules('new_password', 'Password', 'required|min_length[6]|callback_check_strong_password');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

            if ($this->form_validation->run()) {
                $params = array(

                    'password' => md5($this->input->post('new_password')),
                    'is_first_login' => 0


                );

                if ($this->store_model->change_password($id, $params, $this->input->post('cur_password'))) {
                    $this->session->set_flashdata('msg', 'Password updated Successfully');
                    redirect('home');
                } else {
                    $this->session->set_flashdata('error_msg', 'Current Passoword is Wrong');
                    redirect('home/profile');
                }
            //echo $this->db->last_query();
            } else {
                // $data['main_content'] = $this->load->view('partner/profile', $data, true);
                $this->load->view('profile', $data);
            }
        } else {
            show_error('The store you are trying to edit does not exist.');
        }
    }

    public function check_strong_password($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return true;
        }
        $this->form_validation->set_message('check_strong_password', 'The password field must be contains at least one letter and one digit.');
        return false;
    }

    public function log()
    {
        $data = array();

        $this->form_validation->set_rules('user_name', 'Store Code', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run()) {
            $query = $this->login_model->validate_partner();


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


                    // if ($this->input->post('l_type')=='fss') {
                    //     $url = base_url('partner/dashboard');
                    // } elseif ($this->input->post('l_type')=='order') {
                    //     $url = "https://orderattumbledry.in/partner/log/".$this->session->userdata('code')."/".$this->session->userdata('psw');
                    // }

                    // if ($row->is_first_login) {
                    //     $url = base_url('partner/profile');
                    // }
                }
                //$this->session->set_flashdata('msg', 'Login Success');

                if ($row->is_first_login) {
                    redirect('home/profile');
                }

                redirect('home');
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid User and Password. Please try again');
                redirect('home/login');
            }
        } else {
            $this->login();
        }
    }



    // public function log()
    // {
    //     $data = array();
    //     $this->load->library('form_validation');
    //     $this->form_validation->set_rules('email_id', 'Email ID', 'trim|required|valid_email');
    //     if ($this->form_validation->run()) {
    //         $query = $this->login_model->validate_partner();


    //         if ($query) {
    //             foreach ($query as $row) {
    //                 $data = array(
    //                     'id' => $row->id,
    //                     'name' => $row->firm_name,
    //                     'email' =>$row->email_id,
    //                     'code' =>$row->store_crm_code,
    //                     'psw' => base64_encode($this->input->post('password')),
    //                     'role' =>'user',
    //                     'is_partner_login' => true
    //                 );
    //                 $this->session->set_userdata($data);


    //                 if ($this->input->post('l_type')=='fss') {
    //                     $url = base_url('partner/dashboard');
    //                 } elseif ($this->input->post('l_type')=='order') {
    //                     $url = "https://orderattumbledry.in/partner/log/".$this->session->userdata('code')."/".$this->session->userdata('psw');
    //                 }

    //                 if ($row->is_first_login) {
    //                     $url = base_url('partner/profile');
    //                 }
    //             }
    //             echo json_encode(array('st'=>1,'url'=> $url)); //--success
    //         } else {
    //             echo json_encode(array('st'=>0)); //-- error
    //         }
    //     } else {
    //         $this->load->view('auth', $data);
    //     }
    // }



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