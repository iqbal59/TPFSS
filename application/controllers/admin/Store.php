<?php
class Store extends CI_Controller{

    public function __construct(){
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        $this->load->model("store_model");
    }

    public function index()
    {
        // $data['users'] = $this->common_model->get_all_user();
        $data['stores'] = $this->common_model->select('stores');
        // $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/store/stores', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

}
?>