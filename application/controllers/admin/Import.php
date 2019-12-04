<?php
class Import extends CI_Controller{

    public function __construct(){
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
        //$this->load->model("store_model");
    }

   
   
    public function storesales()
    {
        // $data['users'] = $this->common_model->get_all_user();
       // $data['stores'] = $this->common_model->select('stores');
        // $data['count'] = $this->common_model->get_user_total();
       // $data='';
        $data['main_content'] = $this->load->view('admin/import/add', null, TRUE);
        $this->load->view('admin/index', $data);
    }


   

    public function addstoresale(){

        $dataType=$this->input->post('data_type');

        if($_FILES){
            $file=$_FILES['excel_file']['tmp_name'];
            if ($file == NULL) {
             error(_('Please select a file to import'));
            $this->session->set_flashdata('error_msg', "Please select file");
            redirect('admin/import/storesales');
            }
         else{ 
                $handle = fopen($file, "r") or die("err");
            switch($dataType)
            {
                case '1':
                        $row=0;
                        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                        {
                           if($row++ < 3) 
                           continue;
                          $data['store_name'] = $filesop[1];
                          $data['order_date'] = date('Y-m-d H:i:s', strtotime($filesop[2]));
                          $data['order_no'] = $filesop[3];
                          $data['net_amount'] = $filesop[15];
                          $data['service_code'] = $filesop[34];
                          
                        $this->common_model->insert($data,'storesales');
                            
                        //print_r($data);
                        }
                        $this->session->set_flashdata('msg', "data upload success");
                       redirect('admin/import/storesales');
                break;
             
                case '3':
                    $row=0;
                        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                        {
                           if($row++ < 1 || $filesop[6] != 'SUCCESS\'' || $filesop[19] == '') 
                           continue;
                          $data['mid_no'] = trim($filesop[7], "'");
                          $data['amount'] = trim($filesop[13], "'");
                          $data['commission'] = trim($filesop[14], "'");
                          $data['utr_no'] = trim($filesop[19], "'");
                          $data['transaction_date'] = trim($filesop[3], "'");
                          $data['settled_date'] = trim($filesop[20], "'");
                          $data['store_name'] = trim($filesop[8], "'");
                          $data['gst'] = trim($filesop[15], "'");
                          $this->common_model->insert($data,'paytm');
                            
                            //print_r($data);
                        }
                         $this->session->set_flashdata('msg', "data upload success");
                        redirect('admin/import/storesales');
                break;

                case '4':
                    $row=0;
                        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                        {
                           if($row++ < 1 || $filesop[6] != 'SUCCESS') 
                           continue;
                          $data['utr_no'] = trim($filesop[1], "'");
                          $data['amount'] = trim($filesop[3], "'");
                          $data['store_name'] = trim($filesop[10], "'");
                          $data['transaction_date'] = date('Y-m-d H:i:s', strtotime($filesop[2]));
                          $data['settled_date'] = date('Y-m-d H:i:s', strtotime($filesop[9]));
                         
                         $this->common_model->insert($data,'bharatpe');
                            
                            //print_r($data);
                        }
                         $this->session->set_flashdata('msg', "data upload success");
                         redirect('admin/import/storesales');
                break;

                case '2':
                        $row=0;
                        while(($filesop = fgetcsv($handle, 10000, ",")) !== false)
                        {
                           if($row++ < 1 ) 
                           continue;
                         //print_r($filesop);
                          $data['amount'] = trim($filesop[55], "'");
                          $data['invoice_no'] = trim($filesop[1], "'");
                          $data['invoice_date'] = date('Y-m-d', strtotime($filesop[0]));
                          
                         
                        $this->common_model->insert($data,'material_invoices');
                            
                           // print_r($data);
                        }
                         $this->session->set_flashdata('msg', "data upload success");
                         redirect('admin/import/storesales');
                break;

            }
                
            }   

       
        
        

        }

    }

public function saledata(){

    $params['limit'] = 100; 
    $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('admin/import/saledata/page');
    $config['total_rows'] = $this->common_model->get_all_count_by_table('storesales');
    $this->pagination->initialize($config);

    $data['salesdata'] = $this->common_model->get_all_by_table('storesales', $params);
    
    $data['main_content'] = $this->load->view('admin/import/saledata', $data, TRUE);
    $this->load->view('admin/index',$data);
}



public function paytmdata(){

    $params['limit'] = 100; 
    $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('admin/import/paytmdata/page');
    $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
    $this->pagination->initialize($config);

    $data['paytmdata'] = $this->common_model->get_all_by_table('paytm', $params);
    
    $data['main_content'] = $this->load->view('admin/import/paytmdata', $data, TRUE);
    $this->load->view('admin/index',$data);
}



}
?>