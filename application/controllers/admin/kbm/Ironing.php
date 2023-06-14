<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );


class Ironing extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        check_login_kuser();
        
        $this->sub_area = 'kbm';
        $this->area = 'admin';
        
       $this->load->model( 'Support_model');
       $this->load->model( 'washing_model');
       $this->load->library('form_validation');
        $this->load->library( 'pagination' );
    }


    public  function articles_ironing()
    {

        $this->load->model('Ironing_model');
        $data['fabric']=$this->Ironing_model->getiron();

        // $this->input->post('search');

        // if ($this->input->post('search')) {
            
        //     $id=$this->input->post('search');
        //     $this->load->model('Ironing_model');
        //     $data['fabric']=$this->Ironing_model->fbsearch($id);   
        // }

        $this->load->view('common/panel/header');        
        $this->load->view('admin/kbm/knowledge_base/ironing',$data);
        $this->load->view('common/panel/footer');
    }

    public function new_ironing()
    {
        
        $this->load->view('common/panel/header');
        $this->load->view('admin/kbm/knowledge_base/new_ironing');
        $this->load->view('common/panel/footer');
    }

    public function add_ironing()
    {
        
         

        //echo " done";
        
        
        $new=[
        'fabric' => $this->input->post('fabname'),
        'heat' => $this->input->post('htmode'),
        'steam' => $this->input->post('steam'),
        'ccof' => $this->input->post('ccof'),
        'insideout' => $this->input->post('Inside_out'),
        'waterspray' => $this->input->post('water_spray'),
        'starchspray' => $this->input->post('starch_spray'),
        'handpressure' => $this->input->post('hand_pressure'),
    ];
        if ($new) {
            redirect(base_url('admin/knowledge_base/ironing'));
        }
    // echo "<pre>";
    // var_dump($new);

        // // $fabimg=$this->input->post('fab_img');

        // if ($fabric && $heat && $steam && $ccof && $insideout && $waterspray && $starchspray && $handpressure) 
        // {
        //     echo "<pre>";
        //     var_dump($fabric);

        // }else{
        //     echo "somthing wrong";
        // }

        // return $this->load->view('common/panel/header');        
        // return $this->load->view('admin/kbm/knowledge_base/ironing');
        // return $this->load->view('common/panel/footer');
    }
       
}