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

    public function saleimportdata()
    {
        // $data['users'] = $this->common_model->get_all_user();
       // $data['stores'] = $this->common_model->select('stores');
        // $data['count'] = $this->common_model->get_user_total();
       // $data='';
        $data['main_content'] = $this->load->view('admin/import/addsale', null, TRUE);
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
                        $s_from_date=$this->input->post('s_from_date');
                        $s_to_date=$this->input->post('s_to_date');
                
                        $this->common_model->saleRefund($s_from_date, $s_to_date);
                        $row=0;
                        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                        {

                            $odate=date('Y-m-d', strtotime($filesop[2]));
                           if($row++ < 3 || $filesop[3]=='' || !(strtotime($odate)>=strtotime($s_from_date) && strtotime($odate)<=strtotime($s_to_date))) 
                           continue;
                          $data['store_name'] = $filesop[1];
                          $data['order_date'] = date('Y-m-d H:i:s', strtotime($filesop[2]));
                          $data['order_no'] = $filesop[3];
                          $data['taxable_amount'] = ($filesop[12]-$filesop[13]);
                          $data['net_amount'] = $filesop[15];
                          list($service_code)=explode(",", $filesop[34]);
                          $data['service_code'] = $service_code;
                          $data['status'] = $filesop[36];
                          
                        $this->common_model->add_import_sale($data);
                            
                        //print_r($data);
                        }
                        $this->common_model->refundAdjust($s_from_date, $s_to_date);
                        $this->session->set_flashdata('msg', "data upload success");
                       redirect('admin/import/saleimportdata');
                break;
             
                case '3':
                    $row=0;
                  //  echo "AA";
                        while(($filesop = fgetcsv($handle, 10000, ",")) !== false)
                        {
                          // if($row++ < 1 || $filesop[6] != 'SUCCESS\'' || !isset($filesop[19]) || !isset($filesop[20])  )
                           //echo trim($filesop[6], "'");
                           if($row++ < 1 || trim($filesop[6], "'") != 'SUCCESS' || !$filesop[19] || !$filesop[20]  )
                          continue;
                           
                           $data['transaction_no'] = trim($filesop[0], "'");
                           $data['mid_no'] = trim($filesop[7], "'");
                          $data['amount'] = trim($filesop[13], "'");
                          $data['commission'] = trim($filesop[14], "'");
                          $data['utr_no'] = trim($filesop[19], "'");
                          $data['transaction_date'] = trim($filesop[3], "'");
                         // $data['settled_date'] = trim($filesop[20], "'");
                          $data['settled_date'] = date('Y-m-d H:i:s', strtotime(trim($filesop[20], "'")));
                          $data['store_name'] = trim($filesop[8], "'");
                          $data['gst'] = trim($filesop[15], "'");
                         $this->common_model->insert($data,'paytm');
                            
                            //print_r($data);
                        }
                        $paytmbankdata=$this->common_model->matchPaytmWithBank();
                        foreach($paytmbankdata as $p)
                        {
                            if($p['ba']==$p['bta'])
                            $this->common_model->paytmReconcile($p['utr_no']);
                        }
                         $this->session->set_flashdata('msg', "data upload success");
                        redirect('admin/import/storesales');
                break;

                case '4':
                    $row=0;
                        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                        {
                           if($row++ < 1 || trim($filesop[6], "'") != 'SUCCESS') 
                           continue;
                          $data['transaction_no'] = trim($filesop[1], "'");
                          $data['utr_no'] = trim($filesop[8], "'");
                          $data['amount'] = trim($filesop[3], "'");
                          $data['store_name'] = trim($filesop[10], "'");
                          $data['transaction_date'] = date('Y-m-d H:i:s', strtotime($filesop[2]));
                          $data['settled_date'] = date('Y-m-d H:i:s', strtotime($filesop[9]));
                         
                         $this->common_model->insert($data,'bharatpe');
                            
                            //print_r($data);
                        }

                        $bharatpebankdata=$this->common_model->matchBharatpeithBank();
                            foreach($bharatpebankdata as $b)
                            {
                                //if($p['ba']==$p['bta'])
                                $this->common_model->bharatpeReconcile($b['utr_no']);
                            }
                         $this->session->set_flashdata('msg', "data upload success");
                         redirect('admin/import/storesales');
                break;

                case '5':
                    $row=0;
                        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                        {
                           if($row++ < 22 ||  $filesop[0] == '' ) 
                           continue;

                           if(strpos($filesop[1], 'BHARATPE') !== false || strpos($filesop[1], 'RESILIENT INNOVATIONS PRIVATE LIMITED') !== false  || strpos($filesop[1], 'UPI RB') !== false)  
                            {
                          $data['ref_no'] = trim($filesop[2], "'");
                          $data['amount'] = trim($filesop[5], "'");
                          $data['narration'] = trim($filesop[1], "'");
                          $data['date'] = date('Y-m-d H:i:s', strtotime($filesop[0]));
                          $this->common_model->insert($data,'bank_bharatpe');
                            }
                        $data=array();
                        if(strpos($filesop[1], 'ONE97') !== false  ||  strpos($filesop[1], 'ONE 97') !== false  )  
                            {
                          $data['ref_no'] = trim($filesop[2], "'");
                          $data['amount'] = trim($filesop[5], "'");
                          $data['narration'] = trim($filesop[1], "'");
                          $data['date'] = date('Y-m-d H:i:s', strtotime($filesop[0]));
                          $this->common_model->insert($data,'bank_paytm');



                            }  
                        
                            $paytmbankdata=$this->common_model->matchPaytmWithBank();
                            foreach($paytmbankdata as $p)
                            {
                                if($p['ba']==$p['bta'])
                                $this->common_model->paytmReconcile($p['utr_no']);
                            }


                            $bharatpebankdata=$this->common_model->matchBharatpeithBank();
                            foreach($bharatpebankdata as $b)
                            {
                                //if($p['ba']==$p['bta'])
                                $this->common_model->bharatpeReconcile($b['utr_no']);
                            }

                        //  $this->common_model->insert($data,'bank_bharatpe');
                          //$this->common_model->insert($datap,'bank_paytm');
                            
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
                          $data['store_crm_code'] = trim($filesop[60], "'");
                          
                         
                        $this->common_model->insert_ignore($data,'material_invoices');
                            
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

    // $params['limit'] = 100; 
    // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
    // $config = $this->config->item('pagination');
    // $config['base_url'] = site_url('admin/import/saledata/page');
    // $config['total_rows'] = $this->common_model->get_all_count_by_table('storesales');
    // $this->pagination->initialize($config);

    $data['salesdata'] = $this->common_model->getSaleOrderData();
    
    $data['main_content'] = $this->load->view('admin/import/saledata', $data, TRUE);
    $this->load->view('admin/index',$data);
}



public function paytmdata(){

    // $params['limit'] = 100; 
    // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
    // $config = $this->config->item('pagination');
    // $config['base_url'] = site_url('admin/import/paytmdata/page');
    // $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
    // $this->pagination->initialize($config);

    $data['paytmdata'] = $this->common_model->getPaytmData();
    $data['main_content'] = $this->load->view('admin/import/paytmdata', $data, TRUE);
    $this->load->view('admin/index',$data);
}


public function bharatpedata(){

    // $params['limit'] = 100; 
    // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
    // $config = $this->config->item('pagination');
    // $config['base_url'] = site_url('admin/import/paytmdata/page');
    // $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
    // $this->pagination->initialize($config);

    $data['bharatpedata'] = $this->common_model->getBharatPeData();
    
    $data['main_content'] = $this->load->view('admin/import/bharatpe', $data, TRUE);
    $this->load->view('admin/index',$data);
}

public function mbdata(){

    // $params['limit'] = 100; 
    // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
    // $config = $this->config->item('pagination');
    // $config['base_url'] = site_url('admin/import/paytmdata/page');
    // $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
    // $this->pagination->initialize($config);

    $data['mbdata'] = $this->common_model->getMbData();
    
    $data['main_content'] = $this->load->view('admin/import/mbdata', $data, TRUE);
    $this->load->view('admin/index',$data);
}


}
?>