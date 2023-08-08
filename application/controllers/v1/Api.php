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



    public function invoices_get()
    {
        $invoices = array();
        $items = $this->api_model->get_all_invoice();

        foreach ($items as $item) {
            $invoiceItem['id'] = $item->id;
            $invoiceItem['voucher_type'] = 'Sales';
            $invoiceItem['voucher_no'] = $item->invoice_no;
            $invoiceItem['voucher_date'] = date('d/m/Y', strtotime($item->invoice_date));
            $invoiceItem['party_name'] = $item->firm_name;
            $invoiceItem['address1'] = $item->store_address;
            $invoiceItem['address2'] = "";
            $invoiceItem['address3'] = $item->store_city;
            $invoiceItem['address4'] = $item->store_city;
            $invoiceItem['state'] = $item->store_state;
            $invoiceItem['state_code'] = $item->gst_st_code; //State Code
            $invoiceItem['pin_code'] = $item->pin_code;
            $invoiceItem['gst_no'] = $item->gstin_no;
            $invoiceItem['ship_to_party_name'] = $item->firm_name;
            $invoiceItem['ship_to_address1'] = $item->store_address;
            $invoiceItem['ship_to_address2'] = "";
            $invoiceItem['ship_to_address3'] = $item->store_city;
            $invoiceItem['ship_to_address4'] = $item->store_city;
            $invoiceItem['ship_to_state'] = $item->store_state;
            $invoiceItem['ship_to_state_code'] = $item->gst_st_code; //State Code
            $invoiceItem['ship_to_pin_code'] = $item->pin_code;
            $invoiceItem['ship_to_gst_no'] = $item->gstin_no;
            $invoiceItem['transporter_name'] = "";
            $invoiceItem['vehicle_no'] = "";
            $invoiceItem['country'] = 'India';
            $invoiceItem['pan_no'] = $item->pan_no;
            $invoiceItem['seller_pin_code'] = '201306';
            $invoiceItem['email_id'] = $item->email_id;
            $invoiceItem['reg_type'] = $item->gstin_no != '' ? "Regular" : "Non Regsitered";
            $invoiceItem['contact_person'] = '';
            $invoiceItem['mobile_No'] = $item->contact_number;
            $invoiceItem['narration'] = $item->descriptions;
            $ledgerDetails = array();
            $ld['ledger_name'] = $item->firm_name;
            $ld['ledger_perc'] = "";
            $ld['ledger_amt'] = $item->net_amount;
            $ld['dr_cr'] = "DR";
            array_push($ledgerDetails, $ld);

            $ld['ledger_name'] = "Royalty on Laundry";
            $ld['ledger_perc'] = "";
            $ld['ledger_amt'] = $item->amount;
            $ld['dr_cr'] = "CR";
            array_push($ledgerDetails, $ld);

            if ($item->gst_st_code == '09' || $item->gst_st_code == '9') {
                $cgstRate = $item->tax_rate / 2;
                $sgstRate = $item->tax_rate / 2;
                $igstRate = '0.00';
                $cgstAmount = $item->tax_amount / 2;
                $sgstAmount = $item->tax_amount / 2;
                $igstAmount = '0.00';
            } else {
                $cgstRate = '0.00';
                $sgstRate = '0.00';
                $igstRate = $item->tax_rate;
                $cgstAmount = '0.00';
                $sgstAmount = '0.00';
                $igstAmount = $item->tax_amount;
            }


            $ld['ledger_name'] = "CGST";
            $ld['ledger_perc'] = $cgstRate;
            $ld['ledger_amt'] = $cgstAmount;
            $ld['dr_cr'] = "CR";
            array_push($ledgerDetails, $ld);

            $ld['ledger_name'] = "SGST";
            $ld['ledger_perc'] = $sgstRate;
            $ld['ledger_amt'] = $sgstAmount;
            $ld['dr_cr'] = "CR";
            array_push($ledgerDetails, $ld);

            $ld['ledger_name'] = "IGST";
            $ld['ledger_perc'] = $igstRate;
            $ld['ledger_amt'] = $igstAmount;
            $ld['dr_cr'] = "CR";
            array_push($ledgerDetails, $ld);


            $invoiceItem['ledger_details'] = $ledgerDetails;
            array_push($invoices, $invoiceItem);
        }

        //    echo $this->db->last_query();

        $response['result'] = $invoices;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


    public function sync_with_tally_post()
    {
        $tallyResposne = json_decode(file_get_contents('php://input'));

        //print_r($tallyResposne['result']);
        $synInvoices = array();
        foreach ($tallyResposne->result as $item) {
            if ($item->Status == 'Success') {
                if ($this->api_model->sync_with_tally($item->id)) {
                    $inv['syncstatus'] = true;
                } else {
                    $inv['syncstatus'] = false;
                }
                $inv['id'] = $item->id;
                array_push($synInvoices, $inv);
            }
        }

        $response['result'] = $synInvoices;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }



    //CREDIT NOTE

    public function creditnote_get()
    {
        $invoices = array();
        $items = $this->api_model->get_all_creditnote();
        // echo $this->db->last_query();
        foreach ($items as $item) {
            $invoiceItem['id'] = $item->id;
            $invoiceItem['voucher_type'] = 'Credit Note';
            $invoiceItem['voucher_no'] = $item->invoice_no;
            $invoiceItem['voucher_date'] = date('d/m/Y', strtotime($item->invoice_date));
            $invoiceItem['original_inv_no'] = "11111";
            $invoiceItem['original_inv_dt'] = date('d/m/Y', strtotime($item->invoice_date));
            $invoiceItem['reason_for_rej'] = "avv";
            $invoiceItem['party_name'] = $item->firm_name;
            $invoiceItem['address1'] = $item->store_address;
            $invoiceItem['address2'] = "";
            $invoiceItem['address3'] = $item->store_city;
            $invoiceItem['address4'] = $item->store_city;
            $invoiceItem['state'] = $item->store_state;
            $invoiceItem['state_code'] = $item->gst_st_code; //State Code
            $invoiceItem['pin_code'] = $item->pin_code;
            $invoiceItem['gst_no'] = $item->gstin_no;
            $invoiceItem['ship_to_party_name'] = $item->firm_name;
            $invoiceItem['ship_to_address1'] = $item->store_address;
            $invoiceItem['ship_to_address2'] = "";
            $invoiceItem['ship_to_address3'] = $item->store_city;
            $invoiceItem['ship_to_address4'] = $item->store_city;
            $invoiceItem['ship_to_state'] = $item->store_state;
            $invoiceItem['ship_to_state_code'] = $item->gst_st_code; //State Code
            $invoiceItem['ship_to_pin_code'] = $item->pin_code;
            $invoiceItem['ship_to_gst_no'] = $item->gstin_no;
            $invoiceItem['transporter_name'] = "";
            $invoiceItem['vehicle_no'] = "";
            $invoiceItem['country'] = 'India';
            $invoiceItem['pan_no'] = $item->pan_no;
            $invoiceItem['seller_pin_code'] = '201306';
            $invoiceItem['email_id'] = $item->email_id;
            $invoiceItem['reg_type'] = $item->gstin_no != '' ? "Regular" : "Non Regsitered";
            $invoiceItem['contact_person'] = '';
            $invoiceItem['mobile_No'] = $item->contact_number;
            $invoiceItem['narration'] = $item->descriptions;
            $ledgerDetails = array();

            $ld['ledger_name'] = $item->firm_name;
            $ld['ledger_perc'] = "";
            $ld['ledger_amt'] = $item->taxable_amount;
            $ld['dr_cr'] = "DR";
            array_push($ledgerDetails, $ld);

            $ld['ledger_name'] = "Royalty on Laundry";
            $ld['ledger_perc'] = "";
            $ld['ledger_amt'] = $item->taxable_amount;
            $ld['dr_cr'] = "CR";
            array_push($ledgerDetails, $ld);

            if ($item->gst_st_code == '09' || $item->gst_st_code == '9') {
                $cgstRate = $item->tax_rate / 2;
                $sgstRate = $item->tax_rate / 2;
                $igstRate = '0.00';
                $cgstAmount = round(($item->tax_amount / 2), 2);
                $sgstAmount = round(($item->tax_amount / 2), 2);
                $igstAmount = '0.00';
            } else {
                $cgstRate = '0.00';
                $sgstRate = '0.00';
                $igstRate = $item->tax_rate;
                $cgstAmount = '0.00';
                $sgstAmount = '0.00';
                $igstAmount = $item->tax_amount;
            }


            $ld['ledger_name'] = "CGST";
            $ld['ledger_perc'] = $cgstRate;
            $ld['ledger_amt'] = $cgstAmount;
            $ld['dr_cr'] = "CR";
            array_push($ledgerDetails, $ld);

            $ld['ledger_name'] = "SGST";
            $ld['ledger_perc'] = $sgstRate;
            $ld['ledger_amt'] = $sgstAmount;
            $ld['dr_cr'] = "CR";
            array_push($ledgerDetails, $ld);

            $ld['ledger_name'] = "IGST";
            $ld['ledger_perc'] = $igstRate;
            $ld['ledger_amt'] = $igstAmount;
            $ld['dr_cr'] = "CR";
            array_push($ledgerDetails, $ld);


            $invoiceItem['ledger_details'] = $ledgerDetails;
            array_push($invoices, $invoiceItem);
        }

        //    echo $this->db->last_query();

        $response['result'] = $invoices;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


    public function sync_with_tally_creditnote_post()
    {
        $tallyResposne = json_decode(file_get_contents('php://input'));

        //print_r($tallyResposne['result']);
        $synInvoices = array();
        foreach ($tallyResposne->result as $item) {
            if ($item->Status == 'Success') {
                if ($this->api_model->sync_with_tally_credit_note_or_payment($item->id)) {
                    $inv['syncstatus'] = true;
                } else {
                    $inv['syncstatus'] = false;
                }
                $inv['id'] = $item->id;
                array_push($synInvoices, $inv);
            }
        }

        $response['result'] = $synInvoices;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }
    //END CREDIT



    //Payment

    public function payments_get()
    {
        $payments = array();
        $items = $this->api_model->get_all_payment();

        foreach ($items as $item) {
            $paymentItem['id'] = $item->id;
            $paymentItem['voucher_type'] = 'Receipt';
            $paymentItem['voucher_no'] = $item->voucher_no;
            $paymentItem['voucher_date'] = date('d/m/Y', strtotime($item->voucher_date));
            $paymentItem['narration'] = $item->descriptions;

            $ledgerDetails = array();
            $ld['ledger_name'] = $item->firm_name;
            $ld['ledger_amt'] = $item->amount;
            $ld['dr_cr'] = "CR";
            $bill_details = array();
            $bill_detail['type'] = 'Agst Ref';

            if (current(explode(' ', $item->descriptions)) == 'HDFC')
                $bill_detail['ref'] = end(explode(' ', $item->descriptions));
            else
                $bill_detail['ref'] = '';
            $bill_detail['amount'] = $item->amount;
            $bill_detail['dr_cr'] = 'CR';
            array_push($bill_details, $bill_detail);
            $ld['bill_details'] = $bill_details;


            //BAnk Details
            $bank_details = array();
            $bank_detail['payment_type'] = '';
            $bank_detail['bank_amount'] = '';
            $bank_detail['instrument_no'] = '';
            $bank_detail['instrument_date'] = '';
            $bank_detail['bank_name'] = '';
            array_push($bank_details, $bank_detail);

            $ld['bank_details'] = $bank_details;

            array_push($ledgerDetails, $ld);




            $ld['ledger_name'] = current(explode(' ', $item->descriptions));
            $ld['ledger_amt'] = $item->amount;
            $ld['dr_cr'] = "DR";
            $bill_details = array();
            $bill_detail['type'] = 'New Ref';
            if (current(explode(' ', $item->descriptions)) == 'HDFC')
                $bill_detail['ref'] = end(explode(' ', $item->descriptions));
            else
                $bill_detail['ref'] = '';

            $bill_detail['amount'] = $item->amount;
            $bill_detail['dr_cr'] = 'DR';
            array_push($bill_details, $bill_detail);

            $ld['bill_details'] = $bill_details;

            //BAnk Details
            $bank_details = array();
            $bank_detail['payment_type'] = '';
            $bank_detail['bank_amount'] = $item->amount;
            if (current(explode(' ', $item->descriptions)) == 'HDFC')
                $bank_detail['instrument_no'] = end(explode(' ', $item->descriptions));
            else
                $bank_detail['instrument_no'] = '';
            $bank_detail['instrument_date'] = '';
            $bank_detail['bank_name'] = '';
            array_push($bank_details, $bank_detail);

            $ld['bank_details'] = $bank_details;

            array_push($ledgerDetails, $ld);



            $paymentItem['ledger_entries'] = $ledgerDetails;
            array_push($payments, $paymentItem);
        }

        $response['result'] = $payments;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


    public function sync_with_tally_payment_post()
    {
        $tallyResposne = json_decode(file_get_contents('php://input'));

        //print_r($tallyResposne['result']);
        $syncPayments = array();
        foreach ($tallyResposne->result as $item) {
            if ($item->Status == 'Success') {
                if ($this->api_model->sync_with_tally_credit_note_or_payment($item->id)) {
                    $payment['syncstatus'] = true;
                } else {
                    $payment['syncstatus'] = false;
                }
                $payment['id'] = $item->id;
                array_push($syncPayments, $payment);
            }
        }

        $response['result'] = $syncPayments;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }
    //END Payment


    public function add_hdfc_payment_post()
    {
        try {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required');


            if (!$this->form_validation->run()) {
                throw new Exception(validation_errors());
            }


            $storeCode = current(explode("_", $this->input->post('order_id')));

            $storeInfo = $this->store_model->get_store_by_code($storeCode);


            $data = array(
                'voucher_type' => 'R',
                'store_id' => $storeInfo['id'],
                'amount' => $this->input->post('amount'),
                'create_date' => date('Y-m-d H:i:s'),
                'descriptions' => $this->input->post('descriptions')
            );



            if ($this->Voucher_model->add_voucher($data) > 0) {
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
    //END Payment


    //Start Paytm Payment

    public function paytm_payment_post()
    {
        try {
            //$_POST = json_decode(file_get_contents('php://input'), true);
            $data = file_get_contents('php://input');
            // $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required');
            // $this->form_validation->set_rules('amount', 'Amount', 'trim|required');


            // if (!$this->form_validation->run()) {
            //     throw new Exception(validation_errors());
            // }


            // $storeCode = current(explode("_", $this->input->post('order_id')));

            // $storeInfo = $this->store_model->get_store_by_code($storeCode);


            $data = array(

                'descriptions' => $data
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



    public function stores_get()
    {

        $items = $this->api_model->get_all_customers();
        $response['result'] = $items;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }



}