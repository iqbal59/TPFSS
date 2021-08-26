<?php
class Import extends CI_Controller
{
    public function __construct()
    {
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
        $data['main_content'] = $this->load->view('admin/import/add', null, true);
        $this->load->view('admin/index', $data);
    }

    public function saleimportdata()
    {
        // $data['users'] = $this->common_model->get_all_user();
        // $data['stores'] = $this->common_model->select('stores');
        // $data['count'] = $this->common_model->get_user_total();
        // $data='';
        $data['main_content'] = $this->load->view('admin/import/addsale', null, true);
        $this->load->view('admin/index', $data);
    }

   

    public function addstoresale()
    {
        $dataType=$this->input->post('data_type');
      
        if ($_FILES) {
            $file=$_FILES['excel_file']['tmp_name'];
            if ($file == null) {
                error(_('Please select a file to import'));
                $this->session->set_flashdata('error_msg', "Please select file");
                redirect('admin/import/storesales');
            } else {
                $handle = fopen($file, "r") or die("err");
                switch ($dataType) {
                case '1':
                        $s_from_date=$this->input->post('s_from_date');
                        $s_to_date=$this->input->post('s_to_date');
                
                        $this->common_model->saleRefund($s_from_date, $s_to_date);
                        $row=0;
                        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                            $odate=date('Y-m-d', strtotime($filesop[2]));
                            if ($row++ < 3 || $filesop[3]=='' || !(strtotime($odate)>=strtotime($s_from_date) && strtotime($odate)<=strtotime($s_to_date))) {
                                continue;
                            }
                            $data['store_name'] = $filesop[1];
                            $data['order_date'] = date('Y-m-d H:i:s', strtotime($filesop[2]));
                            $data['order_no'] = $filesop[3];
                            $data['mobile_no'] = $filesop[6];
                            $data['taxable_amount'] = (($filesop[12]-$filesop[13]-$filesop[18])/1.18);
                            $data['net_amount'] = $filesop[15];
                            //list($service_code)=explode(",", $filesop[34]);
                            $service_list=array_map("trim", explode(",", $filesop[34]));
                            if (in_array('DC', $service_list)) {
                                $service_code='DC';
                            } else {
                                list($service_code)=$service_list;
                            }

                            //print_r($service_list);
                            $data['service_code'] = $service_code;
                            $data['status'] = $filesop[36];
                            $data['customer_id'] = $filesop[37];
                            //print_r($data);
                            // echo "<br>";

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
                        while (($filesop = fgetcsv($handle, 10000, ",")) !== false) {
                            // if($row++ < 1 || $filesop[6] != 'SUCCESS\'' || !isset($filesop[19]) || !isset($filesop[20])  )
                            //echo trim($filesop[6], "'");
                            if ($row++ < 1 || trim($filesop[6], "'") != 'SUCCESS' || !$filesop[19] || !$filesop[20]) {
                                continue;
                            }
                           
                            $data['transaction_no'] = trim($filesop[0], "'");
                            $data['mid_no'] = trim($filesop[7], "'");
                            $data['amount'] = trim($filesop[13], "'");
                            $data['commission'] = trim($filesop[14], "'");
                            $utr_no=trim($filesop[19], "'");
                            if (is_numeric($utr_no)) {
                                $utr_no = ltrim($utr_no, "0");
                            }
                            $data['utr_no'] = $utr_no;
                            //$data['utr_no'] = trim($filesop[19], "'");
                            $data['transaction_date'] = trim($filesop[3], "'");
                            // $data['settled_date'] = trim($filesop[20], "'");
                            $data['settled_date'] = date('Y-m-d H:i:s', strtotime(trim($filesop[20], "'")));
                            $data['store_name'] = trim($filesop[8], "'");
                            $data['gst'] = trim($filesop[15], "'");
                            $this->common_model->insert_ignore($data, 'paytm');
                            
                            //print_r($data);
                        }
                        $paytmbankdata=$this->common_model->matchPaytmWithBank();
                        foreach ($paytmbankdata as $p) {
                            if ($p['ba']==$p['bta'] or  ($p['bta'] > 0 && $p['ba'] > $p['bta']) or ($p['bta'] > 0 && $p['ba'] < $p['bta'])) {
                                $this->common_model->paytmReconcile($p['utr_no']);
                            }
                        }
                         $this->session->set_flashdata('msg', "data upload success");
                        redirect('admin/import/storesales');
                break;

                case '4':
                    $row=0;
                        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                            if ($row++ < 1 || trim($filesop[6], "'") != 'SUCCESS') {
                                continue;
                            }
                            $data['transaction_no'] = trim($filesop[1], "'");
                            // $data['utr_no'] = trim($filesop[8], "'");
                            $utr_no=trim($filesop[8], "'");
                            if (is_numeric($utr_no)) {
                                $utr_no = ltrim($utr_no, "0");
                            }
                            $data['utr_no'] = $utr_no;

                            $data['amount'] = trim($filesop[3], "'");
                            $data['store_name'] = trim($filesop[10], "'");
                            $data['transaction_date'] = date('Y-m-d H:i:s', strtotime($filesop[2]));
                            $data['settled_date'] = date('Y-m-d H:i:s', strtotime($filesop[9]));
                         
                            $this->common_model->insert_ignore($data, 'bharatpe');
                            
                            //print_r($data);
                        }

                        $bharatpebankdata=$this->common_model->matchBharatpeithBank();
                            foreach ($bharatpebankdata as $b) {
                                //if($p['ba']==$p['bta'])
                                $this->common_model->bharatpeReconcile($b['utr_no']);
                            }
                         $this->session->set_flashdata('msg', "data upload success");
                         redirect('admin/import/storesales');
                break;

                case '5':
                    $row=0;
                        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                            if ($row++ < 22 ||  $filesop[0] == '') {
                                continue;
                            }

                            if (strpos($filesop[1], 'BHARATPE') !== false || strpos($filesop[1], 'RESILIENT INNOVATION') !== false  || strpos($filesop[1], 'UPI RB') !== false) {
                                $data['ref_no'] = trim($filesop[2], "'");
                                if (is_numeric($data['ref_no'])) {
                                    $data['ref_no'] = ltrim($filesop[2], "0");
                                }
                                $data['amount'] = trim($filesop[5], "'");
                                $data['narration'] = trim($filesop[1], "'");
                                //$data['date'] = date('Y-m-d H:i:s', strtotime($filesop[0]));
                                $data['date'] = DateTime::createFromFormat('d/m/y', $filesop[0])->format('Y-m-d');
                                $this->common_model->insert_ignore($data, 'bank_bharatpe');
                            }
                            $data=array();
                            if (strpos($filesop[1], 'ONE97') !== false  ||  strpos($filesop[1], 'ONE 97') !== false ||  strpos($filesop[1], 'PAYTM') !== false) {
                                $data['ref_no'] = trim($filesop[2], "'");
                                if (is_numeric($data['ref_no'])) {
                                    $data['ref_no'] = ltrim($filesop[2], "0");
                                }
                                $data['amount'] = trim($filesop[5], "'");
                                $data['narration'] = trim($filesop[1], "'");
                                $data['date'] = date('Y-m-d H:i:s', strtotime($filesop[0]));
                                $this->common_model->insert_ignore($data, 'bank_paytm');
                            }
                        
                            $paytmbankdata=$this->common_model->matchPaytmWithBank();
                            foreach ($paytmbankdata as $p) {
                                if ($p['ba']==$p['bta']) {
                                    $this->common_model->paytmReconcile($p['utr_no']);
                                }
                            }


                            $bharatpebankdata=$this->common_model->matchBharatpeithBank();
                            foreach ($bharatpebankdata as $b) {
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
                        while (($filesop = fgetcsv($handle, 10000, ",")) !== false) {
                            if ($row++ < 1) {
                                continue;
                            }
                            //print_r($filesop);
                            $data['amount'] = trim($filesop[5], "'");
                            $data['invoice_no'] = trim($filesop[3], "'");
                            $data['invoice_date'] = date('Y-m-d', strtotime($filesop[0]));
                            $data['store_crm_code'] = trim($filesop[6], "'");
                            $data['material_description'] = trim($filesop[7], "'");
                          
                         
                            $this->common_model->insert_ignore($data, 'material_invoices');
                            
                            // print_r($data);
                        }
                         $this->session->set_flashdata('msg', "data upload success");
                         redirect('admin/import/storesales');
                break;

                case '6':
                    $row=0;
                  //  echo "AA";
                        while (($filesop = fgetcsv($handle, 10000, ",")) !== false) {
                            // if($row++ < 1 || $filesop[6] != 'SUCCESS\'' || !isset($filesop[19]) || !isset($filesop[20])  )
                            //echo trim($filesop[6], "'");
                            if ($row++ < 1 || trim($filesop[6], "'") != 'SUCCESS' || !$filesop[19] || !$filesop[20]) {
                                continue;
                            }
                           
                            $data['transaction_no'] = trim($filesop[0], "'");
                         
                            $order_no = trim($filesop[1], "'");
                            $order_no=substr($order_no, strpos($order_no, 'T'));
                            if (strpos($order_no, '_')!==false) {
                                $order_no=substr($order_no, 0, (strpos($order_no, '_')));
                            }
                           
                            if (strpos($order_no, '@') !== false) {
                                $order_no=substr($order_no, 0, (strpos($order_no, '@')));
                            }
                            if (strpos($order_no, '.') !== false) {
                                $order_no=substr($order_no, 0, (strpos($order_no, '.')));
                            }
                         
                            //  echo $order_no;
                            $customer_mobile_no = trim($filesop[11], "'");
                            $customer_id = trim($filesop[9], "'");

                            $data['mid_no'] = $this->common_model->getMidNo($order_no, $customer_mobile_no, $customer_id);
                            //$data['mid_no'] = $this->common_model->getMidNo('T1515', '111');
                            $data['amount'] = trim($filesop[13], "'");
                            $data['commission'] = trim($filesop[14], "'");
                            $utr_no=trim($filesop[19], "'");
                            if (is_numeric($utr_no)) {
                                $utr_no = ltrim($utr_no, "0");
                            }
                            $data['utr_no'] = $utr_no;
                            $data['transaction_date'] = trim($filesop[3], "'");
                            // $data['settled_date'] = trim($filesop[20], "'");
                            $data['settled_date'] = date('Y-m-d H:i:s', strtotime(trim($filesop[20], "'")));
                            $data['store_name'] = trim($filesop[8], "'");
                            $data['gst'] = trim($filesop[15], "'");
                            $this->common_model->insert_ignore($data, 'paytm');
                            
                            //  print_r($data);
                        }
                        $paytmbankdata=$this->common_model->matchPaytmWithBank();
                        foreach ($paytmbankdata as $p) {
                            //if($p['ba']==$p['bta'])
                            if ($p['ba']==$p['bta'] or  ($p['bta'] > 0 && $p['ba'] > $p['bta']) or ($p['bta'] > 0 && $p['ba'] < $p['bta'])) {
                                $this->common_model->paytmReconcile($p['utr_no']);
                            }
                        }
                         $this->session->set_flashdata('msg', "data upload success");
                        redirect('admin/import/storesales');
                break;

                case '7':
                    $row=0;
                    while (($filesop = fgetcsv($handle, 10000, ",")) !== false) {
                        if ($row++ < 1) {
                            continue;
                        }
                        //print_r($filesop);
                     
                        $data['store_id'] = $this->common_model->getStoreId(trim($filesop[0], "'"));
                        if (!$data['store_id']) {
                            continue;
                        }
                        $data['amount'] = trim($filesop[2], "'");
                        $data['create_date'] = date('Y-m-d', strtotime($filesop[1]));
                        $data['descriptions'] = trim($filesop[4], "'");
                        $data['voucher_type'] = trim($filesop[3], "'");
                      
                     
                        $this->common_model->insert($data, 'vouchers');
                        
                        // print_r($data);
                    }
                    $this->session->set_flashdata('msg', "data upload success");
                    redirect('admin/voucher');
            break;

            case '8':
                $row=0;
                while (($filesop = fgetcsv($handle, 10000, ",")) !== false) {
                    if ($row++ < 1) {
                        continue;
                    }
                    //print_r($filesop);
                 
                  
                    $store_id = trim($filesop[0], "'");
                    $open_bal = trim($filesop[1], "'");
                  
                  
                 
                    $this->common_model->updateStoreOpenBalance($store_id, $open_bal);
                    
                    // print_r($data);
                }
                $this->session->set_flashdata('msg', "data upload success");
                redirect('admin/store');
        break;


            }
            }
        }
    }

    public function saledata()
    {

    // $params['limit'] = 100;
        // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
        // $config = $this->config->item('pagination');
        // $config['base_url'] = site_url('admin/import/saledata/page');
        // $config['total_rows'] = $this->common_model->get_all_count_by_table('storesales');
        // $this->pagination->initialize($config);

        $data=array();
        $condition_array=array('from_dt'=>$this->input->get('from_date'), 'to_dt'=>$this->input->get('to_date'));
   
        if (!empty($condition_array['from_dt']) && !empty($condition_array['to_dt'])) {
            $data['salesdata'] = $this->common_model->getSaleOrderData($condition_array);
            $data['search_query']=$condition_array;
        }

   
        $data['main_content'] = $this->load->view('admin/import/saledata', $data, true);
        $this->load->view('admin/index', $data);
    }



    public function saledatabill()
    {
        $data=array();
        $condition_array=array('from_dt'=>$this->input->get('from_date'), 'to_dt'=>$this->input->get('to_date'));
   
        if (!empty($condition_array['from_dt']) && !empty($condition_array['to_dt'])) {
            $ordersData= $this->common_model->getSaleBillOrderData($condition_array);
            $data['search_query']=$condition_array;
            if (!empty($ordersData)) {
                foreach ($ordersData as $sale) {
                    $data['salesdata'][]=$this->common_model->getBillOrderData($sale['order_nos'], $sale['store_name']);
                }
            }
        }

        
   
        $data['main_content'] = $this->load->view('admin/import/saledatabill', $data, true);
        $this->load->view('admin/index', $data);
    }


    public function creditdata()
    {
        $data=array();
        $condition_array=array('from_dt'=>$this->input->get('from_date'), 'to_dt'=>$this->input->get('to_date'));
   
        if (!empty($condition_array['from_dt']) && !empty($condition_array['to_dt'])) {
            $data['salesdata'] = $this->common_model->getCreditOrderData($condition_array);
            $data['search_query']=$condition_array;
        }

   
        $data['main_content'] = $this->load->view('admin/import/creditdata', $data, true);
        $this->load->view('admin/index', $data);
    }


    public function paytmdata()
    {

    // $params['limit'] = 100;
        // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
        // $config = $this->config->item('pagination');
        // $config['base_url'] = site_url('admin/import/paytmdata/page');
        // $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
        // $this->pagination->initialize($config);


        if ($this->input->post('from_date')) {
            $data['from_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['from_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        $data['paytmdata'] = $this->common_model->getPaytmData($data['from_date'], $data['to_date']);
        $data['main_content'] = $this->load->view('admin/import/paytmdata', $data, true);
        $this->load->view('admin/index', $data);
    }


    public function bharatpedata()
    {

    // $params['limit'] = 100;
        // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
        // $config = $this->config->item('pagination');
        // $config['base_url'] = site_url('admin/import/paytmdata/page');
        // $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
        // $this->pagination->initialize($config);

        if ($this->input->post('from_date')) {
            $data['from_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['from_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        $data['bharatpedata'] = $this->common_model->getBharatPeData($data['from_date'], $data['to_date']);
    
        $data['main_content'] = $this->load->view('admin/import/bharatpe', $data, true);
        $this->load->view('admin/index', $data);
    }

    public function mbdata()
    {

    // $params['limit'] = 100;
        // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
    
        // $config = $this->config->item('pagination');
        // $config['base_url'] = site_url('admin/import/paytmdata/page');
        // $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
        // $this->pagination->initialize($config);

        $data['mbdata'] = $this->common_model->getMbData();
    
        $data['main_content'] = $this->load->view('admin/import/mbdata', $data, true);
        $this->load->view('admin/index', $data);
    }


    public function editmb($id)
    {
        // check if the store exists before trying to edit it
        $data['store'] = $this->common_model->get_material_by_id($id);
      
        
        if (isset($data['store']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('invoice_no', 'Invoice No.', 'required|edit_unique[material_invoices.invoice_no.'.$data['store']['id'].']');
            $this->form_validation->set_rules('store_crm_code', 'Store CRM Code', 'required');
            $this->form_validation->set_rules('invoice_date', 'Invoice Date (YYYY-MM-DD)', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
       
    
            if ($this->form_validation->run()) {
                $params = array(
                    'invoice_no' => $this->input->post('invoice_no'),
                    'store_crm_code' => $this->input->post('store_crm_code'),
                    'invoice_date' => $this->input->post('invoice_date'),
                    'amount' => $this->input->post('amount'),
                    'material_description' => $this->input->post('material_description'),
                );

                $this->common_model->update_material($id, $params);
                $this->session->set_flashdata('msg', 'Material Invoice updated Successfully');
                redirect('admin/import/mbdata');
            } else {
                $data['main_content'] = $this->load->view('admin/import/editmb', $data, true);
                $this->load->view('admin/index', $data);
            }
        } else {
            show_error('The Material Invoice you are trying to edit does not exist.');
        }
    }
}
