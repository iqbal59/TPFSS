<?php
require APPPATH . 'libraries/REST_Controller.php';



class Api extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
        $this->load->model('Voucher_model');
        $this->load->model('store_model');
        $this->load->model('storenew_model');
        $this->load->model('common_model');
        $this->load->library('form_validation');
        header('Content-Type: application/json');
    }


    //Start Paytm Payment

    public function paytm_payment_post()
    {
        try {
            //$_POST = json_decode(file_get_contents('php://input'), true);
            //$data = file_get_contents('php://input');
            // $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required');
            // $this->form_validation->set_rules('amount', 'Amount', 'trim|required');


            // if (!$this->form_validation->run()) {
            //     throw new Exception(validation_errors());
            // }


            // $storeCode = current(explode("_", $this->input->post('order_id')));

            // $storeInfo = $this->store_model->get_store_by_code($storeCode);


            $data = array(

                'order_id' => $_POST['ORDERID'],
                'transaction_no' => $_POST['TXNID'],
                'mid_no' => $_POST['MID'],
                'amount' => $_POST['TXNAMOUNT'],
                'transaction_date' => $_POST['TXNDATETIME'],
                'status' => $_POST['STATUS'],
                'payment_mode' => $_POST['PAYMENTMODE']
            );



            if ($this->Voucher_model->add_paytm_raw($data) > 0) {
                $this->set_response([
                    'status' => true,
                    'message' => $data,
                ], REST_Controller::HTTP_OK);
            } else {
                // echo $this->db->last_query();
                throw new Exception('Insert fail');
            }
        } catch (Throwable $e) {
            $this->set_response([
                'status' => false,
                'message' => $e->getMessage(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    //END Paytm Payment


    public function add_store_holiday_post()
    {
        try {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $this->form_validation->set_rules('StoreCode', 'Store Code', 'trim|required');
            $this->form_validation->set_rules('HolidayDate', 'Holiday Date', 'trim|required');


            if (!$this->form_validation->run()) {
                throw new Exception(validation_errors());
            }

            $data = array(

                'store_code' => $_POST['StoreCode'],
                'holiday_date' => $_POST['HolidayDate'],
                'holiday_name' => $_POST['HolidayName'],

            );

            if ($this->common_model->insert($data, 'tbl_holidays') > 0) {
                $this->set_response([
                    'status' => true,
                    'message' => $data,
                ], REST_Controller::HTTP_OK);
            } else {
                // echo $this->db->last_query();
                throw new Exception('Insert fail');
            }
        } catch (Throwable $e) {
            $this->set_response([
                'status' => false,
                'message' => $e->getMessage(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function delete_store_holiday_post()
    {
        try {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $this->form_validation->set_rules('StoreCode', 'Store Code', 'trim|required');
            $this->form_validation->set_rules('HolidayDate', 'Holiday Date', 'trim|required');


            if (!$this->form_validation->run()) {
                throw new Exception(validation_errors());
            }



            if ($this->common_model->delete_holiday($_POST['StoreCode'], $_POST['HolidayDate']) > 0) {
                $this->set_response([
                    'status' => true,
                    'message' => "Delete Success",
                ], REST_Controller::HTTP_OK);
            } else {
                // echo $this->db->last_query();
                throw new Exception('Delete fail');
            }
        } catch (Throwable $e) {
            $this->set_response([
                'status' => false,
                'message' => $e->getMessage(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function sale_order_by_qdc_get()
    {
        date_default_timezone_set("Asia/Kolkata");
        $headers = ['Content-Type: application/json', 'token:  EXDHXUXobI5WmIwVSoIPb4JnmLSVTT92OjbLIymOQSzCfs2HIzkjMaaaOPVLBB5R9DID6kMUBuzS5GItjLMT8pQdJAxsdbMOnh2ckZaXn0iSbRFHH11qoLijm4u6nUhZhk5nd5JUbo6IHyCrvpkLJWZbyjpP4Ea3jSbqmR3bRHPzeabo1Cax95PUVtpugup7ODYpXMFdWJuCHZxXHA', 'ClientID: 2469'];
        $url = "https://api.quickdrycleaning.com/QDCV1/OrderReportData";
        $post_fields = json_encode(array('ClientID' => '2469', "ReportDate" => date('d M Y', strtotime('-1 days', time()))));
        //$post_fields = json_encode(array('ClientID' => '2469', "ReportDate" => '31 Dec 2023'));

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);

        if (!empty($post_fields)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        echo $data = curl_exec($ch);

        $orderInfo = json_decode($data);
        $orderCreatedInfos = $orderInfo->OrderCreated;
        $orderEditedInfos = $orderInfo->OrderEdited;
        $orderCancelledInfos = $orderInfo->OrderCancelled;
        $orderAdjusmentInfos = $orderInfo->OrderAdjustment;
        $responseStatus = $orderInfo->Status;

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);


        if ($responseStatus == 'True') {

            //Insert
            foreach ($orderCreatedInfos as $orderInfo) {

                $service_list = array_map("trim", explode(",", $orderInfo->PrimaryServices));
                if (in_array('CL', $service_list)) {
                    $service_code = 'CL';
                } else {
                    list($service_code) = $service_list;
                }

                $data = array(
                    "order_date" => date('Y-m-d H:i:s', strtotime($orderInfo->OrderDateTime)),
                    "order_no" => $orderInfo->OrderNumber,
                    "store_name" => $orderInfo->StoreName,
                    "store_code" => $orderInfo->StoreCode,
                    "taxable_amount" => (($orderInfo->GrossAmount - $orderInfo->Discount - $orderInfo->Adjustment) / 1.18),
                    "net_amount" => $orderInfo->NetAmount,
                    "service_code" => $service_code,
                    "mobile_no" => $orderInfo->CustomerMobile,
                    "status" => $orderInfo->OrderStatus,
                    "customer_id" => $orderInfo->CustomerCode
                );


                $this->Voucher_model->add_model("storesales_qdc", $data);
                // echo $this->db->last_query();


            }

            //Update
            foreach ($orderEditedInfos as $orderInfo) {

                $service_list = array_map("trim", explode(",", $orderInfo->PrimaryServices));
                if (in_array('DC', $service_list)) {
                    $service_code = 'DC';
                } else {
                    list($service_code) = $service_list;
                }

                $data = array(
                    "order_date" => date('Y-m-d H:i:s', strtotime($orderInfo->OrderDateTime)),
                    //"order_no" => $orderInfo->OrderNumber,
                    //"store_name" => $orderInfo->StoreName,
                    "taxable_amount" => (($orderInfo->GrossAmount - $orderInfo->Discount - $orderInfo->Adjustment) / 1.18),
                    "net_amount" => $orderInfo->NetAmount,
                    "service_code" => $service_code,
                    "mobile_no" => $orderInfo->CustomerMobile,
                    "status" => $orderInfo->OrderStatus,
                    "customer_id" => $orderInfo->CustomerCode
                );


                $this->Voucher_model->update_sale_order($orderInfo->OrderNumber, $orderInfo->StoreName, $data);

            }

            //Adjusment

            foreach ($orderAdjusmentInfos as $orderInfo) {

                $service_list = array_map("trim", explode(",", $orderInfo->PrimaryServices));
                if (in_array('DC', $service_list)) {
                    $service_code = 'DC';
                } else {
                    list($service_code) = $service_list;
                }

                $data = array(
                    "order_date" => date('Y-m-d H:i:s', strtotime($orderInfo->OrderDateTime)),
                    //"order_no" => $orderInfo->OrderNumber,
                    //"store_name" => $orderInfo->StoreName,
                    "taxable_amount" => (($orderInfo->GrossAmount - $orderInfo->Discount - $orderInfo->Adjustment) / 1.18),
                    "net_amount" => $orderInfo->NetAmount,
                    "service_code" => $service_code,
                    "mobile_no" => $orderInfo->CustomerMobile,
                    "status" => $orderInfo->OrderStatus,
                    "customer_id" => $orderInfo->CustomerCode
                );


                $this->Voucher_model->update_sale_order($orderInfo->OrderNumber, $orderInfo->StoreName, $data);

            }


            //Delete

            foreach ($orderCancelledInfos as $orderInfo) {




                $this->Voucher_model->delete_sale_order($orderInfo->OrderNumber, $orderInfo->StoreName);


            }
        }

    }


    //Get Customer INfo

    public function customer_info_by_mobile_get($mobile_no)
    {
        date_default_timezone_set("Asia/Kolkata");
        $headers = ['Content-Type: application/json', 'token:  EXDHXUXobI5WmIwVSoIPb4JnmLSVTT92OjbLIymOQSzCfs2HIzkjMaaaOPVLBB5R9DID6kMUBuzS5GItjLMT8pQdJAxsdbMOnh2ckZaXn0iSbRFHH11qoLijm4u6nUhZhk5nd5JUbo6IHyCrvpkLJWZbyjpP4Ea3jSbqmR3bRHPzeabo1Cax95PUVtpugup7ODYpXMFdWJuCHZxXHA', 'ClientID: 2469'];
        $url = "https://api.quickdrycleaning.com/QDCV1/CustomerInfoDetails?ClientID=2469&CustomerMobile=" . $mobile_no;
        //$post_fields = json_encode(array('ClientID' => '2469', "ReportDate" => date('d M Y', strtotime('-1 days', time()))));
        //$post_fields = json_encode(array('ClientID' => '2469', "ReportDate" => '31 Dec 2023'));

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);

        if (!empty($post_fields)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        echo $data = curl_exec($ch);

        //$cusinof = json_decode($data);


        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);
    }

    public function customer_update_status_get($id, $status)
    {
        date_default_timezone_set('Asia/Kolkata');
        $time = date('Y-m-d H:i:s');
        $params = array(
            'curtain_status' => $status,
            'curtain_status_time' => $time
        );
        $this->store_model->update_customers_by_id($id, $params);
        $res['status_update'] = date('d/m/Y H:i:s', strtotime($time));
        echo json_encode($res);
    }


    public function customer_update_jacket_status_get($id, $status)
    {
        date_default_timezone_set('Asia/Kolkata');
        $time = date('Y-m-d H:i:s');
        $params = array(
            'jacket_status' => $status,
            'jacket_status_time' => $time
        );
        $this->store_model->update_customers_by_id($id, $params);
        $res['status_update'] = date('d/m/Y H:i:s', strtotime($time));
        echo json_encode($res);
    }


    public function customer_update_blanket_status_get($id, $status)
    {
        date_default_timezone_set('Asia/Kolkata');
        $time = date('Y-m-d H:i:s');
        $params = array(
            'blanket_status' => $status,
            'blanket_status_time' => $time
        );
        $this->store_model->update_customers_by_id($id, $params);
        $res['status_update'] = date('d/m/Y H:i:s', strtotime($time));
        echo json_encode($res);
    }


    public function customer_update_shoe_status_get($id, $status)
    {
        date_default_timezone_set('Asia/Kolkata');
        $time = date('Y-m-d H:i:s');
        $params = array(
            'shoe_status' => $status,
            'shoe_status_time' => $time
        );
        $this->store_model->update_customers_by_id($id, $params);
        $res['status_update'] = date('d/m/Y H:i:s', strtotime($time));
        echo json_encode($res);
    }
    public function all_garments_get()
    {

        date_default_timezone_set("Asia/Kolkata");
        $s_from_date = $this->input->get('s_from_date') ? $this->input->get('s_from_date') : date('Y-m-d', strtotime('-1 days'));
        $s_to_date = $this->input->get('s_to_date') ? $this->input->get('s_to_date') : date('Y-m-d');

        if ($s_from_date && $s_to_date) {

            //$stores = array('TS13', 'TS90', 'B004', 'T181', 'TS36');

            $stores = array('T281');
            // print_r($stores);

            $headers = ['Content-Type: application/json', 'token:  EXDHXUXobI5WmIwVSoIPb4JnmLSVTT92OjbLIymOQSzCfs2HIzkjMaaaOPVLBB5R9DID6kMUBuzS5GItjLMT8pQdJAxsdbMOnh2ckZaXn0iSbRFHH11qoLijm4u6nUhZhk5nd5JUbo6IHyCrvpkLJWZbyjpP4Ea3jSbqmR3bRHPzeabo1Cax95PUVtpugup7ODYpXMFdWJuCHZxXHA', 'ClientID: 2469'];
            $url = "https://api.quickdrycleaning.com/QDCV1/GarmentDetailsData";
            //$post_fields = json_encode(array('ClientID' => '2469', "FromDate" => date('d M Y', strtotime($s_from_date)), "ToDate" => date('d M Y', strtotime($s_to_date)), 'StoreCodeList' => $stores));
            $post_fields = json_encode(array('ClientID' => '2469', "FromDate" => date('d M Y', strtotime($s_from_date)), "ToDate" => date('d M Y', strtotime($s_to_date))));
            $garmentInfo = $this->cUrlGetData($url, $post_fields, $headers);
            //print_r($garmentInfo);

            $garmentInfo = json_decode($garmentInfo);
            //echo $garmentInfo;

            foreach ($garmentInfo as $g) {



                if ($g->PrimaryService == 'CL' || $g->PrimaryService == 'SHC' || $g->PrimaryService == 'SHDC') {

                    $mobile_no = $this->store_model->get_customer_mobile_no($g->StoreName, $g->OrderNumber);

                    if ($g->PrimaryService == 'SHC' || $g->PrimaryService == 'SHDC') {

                        //echo $this->db->last_query();
                        $params = array('last_order_date' => date('Y-m-d', strtotime($g->OrderDate)), 'shoe_order' => date('Y-m-d', strtotime($g->OrderDate)));
                        $this->store_model->update_customers($mobile_no, $params);
                    }

                    //Cleaning
                    $curtains = array(
                        'Curtain Door',
                        'Curtain Door With Lining',
                        'Curtain Window',
                        'Curtain Window With Lining',
                        'Curtain Belt',
                        'Blind Door',
                        'Blind Window'
                    );
                    $blankets = array(
                        'Baby Blanket',
                        'Blanket Double',
                        'Blanket Single',
                        'Blanket Double 2 Ply',
                        'Blanket Single 2 Ply',
                        'Blanket Double',
                        'Blanket Single',
                        'Quilt Double',
                        'Quilt Single',
                        'Quilt Cover Single',
                        'Quilt Cover Double',
                        'Quilt Double',
                        'Duvet',
                        'Duvet Double'
                    );
                    $jackets = array(
                        'Jacket',
                        'Leather Jacket',
                        'Jacket with Hood',
                        'Jacket Full Sleeves',
                        'Jacket Half Sleeves',
                        'Jacket',
                        'Jacket Full Sleeves',
                        'Jacket Half Sleeves',
                        'Jacket with Hood',
                        'Jacket Full Sleeves',
                        'Jacket with Hood',
                        'Jacket Half Sleeves',
                        'Leather Jacket',
                        'Leather Jacket Large'
                    );


                    if ($g->PrimaryService == 'CL') {
                        if (in_array($g->Subgarment, $curtains)) {
                            $params = array('last_order_date' => date('Y-m-d', strtotime($g->OrderDate)), 'curtain_order' => date('Y-m-d', strtotime($g->OrderDate)));
                            $this->store_model->update_customers($mobile_no, $params);
                        }

                        if (in_array($g->Subgarment, $jackets)) {
                            $params = array('last_order_date' => date('Y-m-d', strtotime($g->OrderDate)), 'jacket_order' => date('Y-m-d', strtotime($g->OrderDate)));
                            $this->store_model->update_customers($mobile_no, $params);
                        }

                        if (in_array($g->Subgarment, $blankets)) {
                            $params = array('last_order_date' => date('Y-m-d', strtotime($g->OrderDate)), 'blanket_order' => date('Y-m-d', strtotime($g->OrderDate)));
                            $this->store_model->update_customers($mobile_no, $params);
                        }

                    }
                }
            }

        }

    }


    private function cUrlGetData($url, $post_fields = null, $headers = null)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);

        if (!empty($post_fields)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);
        return $data;
    }

    public function get_machine_details_by_storecode_get($store_code)
    {
        //echo "sdfd";


        $data = $this->storenew_model->getDetailsByStoreCode($store_code);

        echo "Store Code: " . $data->store_crm_code . "\n";

        echo "Machine Details\n";

        $machineInfo = json_decode($data->machine_info);

        foreach ($machineInfo as $m) {

            echo "Model No. " . $m->model . " Supplier: " . $m->supplier . " Brand: " . $m->brand . " Machine: " . $m->machine . " Serial No.:" . $m->serial . "\n";
        }
        return;

        // return $response = json_decode($response);
    }
    private function get_license_by_qdc($store_code = null)
    {
        $this->load->library('tumbledryqdc');
        $params["ClientID"] = "2469";

        if ($store_code != null)
            $params["StoreCode"] = trim($store_code);

        $response = $this->tumbledryqdc->QDCLiveApi('StoreRenewalData', $params);
        return $response = json_decode($response);
    }


    public function get_license_renewal_date_get()
    {
        //echo "dsfds";
        $response = $this->get_license_by_qdc();

        //print_r($response);
        foreach ($response as $res) {
            $params = array(
                'store_crm_code' => $res->StoreCode,
                'licence_renewal_date' => date('Y-m-d', strtotime('-7 days', strtotime($res->RenewalDate)))
            );

            // print_r($params);

            $this->store_model->add_update_store($params);

        }

    }

    public function video_call_post()
    {
        try {
            //$_POST = json_decode(file_get_contents('php://input'), true);
            //$data = file_get_contents('php://input');
            // $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required');
            // $this->form_validation->set_rules('amount', 'Amount', 'trim|required');


            // if (!$this->form_validation->run()) {
            //     throw new Exception(validation_errors());
            // }

            $input = file_get_contents('php://input');
            $data = json_decode($input, true);

            // Ensure data is available
            if (isset($data['row'])) {
                $row = $data['row'];

                //print_r($row);
                $data = array(
                    'zsm_tsm_name' => $row[0],
                    'store_code' => $row[1],
                    'video_link' => $row[2],
                    'discussion_date' => date('Y-m-d', strtotime($row[3]))

                );

                //print_r($data);

                if ($this->common_model->insert($data, 'tbl_video_call') > 0) {
                    echo $this->db->last_query();
                    $this->set_response([
                        'status' => true,
                        'message' => $data,
                    ], REST_Controller::HTTP_OK);
                } else {
                    // echo $this->db->last_query();
                    throw new Exception('Insert fail');
                }
            }
        } catch (Throwable $e) {
            $this->set_response([
                'status' => false,
                'message' => $e->getMessage(),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}