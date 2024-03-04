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



    public function sale_order_by_qdc_get()
    {
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
        $data = curl_exec($ch);

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
                    "store_name" => $orderInfo->StoreCode,
                    //"store_code" => $orderInfo->StoreCode,
                    "taxable_amount" => (($orderInfo->GrossAmount - $orderInfo->Discount - $orderInfo->Adjustment) / 1.18),
                    "net_amount" => $orderInfo->NetAmount,
                    "service_code" => $service_code,
                    "mobile_no" => $orderInfo->CustomerMobile,
                    "status" => $orderInfo->OrderStatus,
                    "customer_id" => $orderInfo->CustomerCode
                );


                $this->Voucher_model->add_model("storesales_qdc", $data);


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
                'licence_renewal_date' => date('Y-m-d', strtotime($res->RenewalDate))
            );

            // print_r($params);

            $this->store_model->add_update_store($params);

        }

    }



}