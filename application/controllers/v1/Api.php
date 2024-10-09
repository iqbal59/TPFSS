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

            if ($item->invoice_type == 1)
                $vtype = 'AMC';
            else if ($item->invoice_type == 2)
                $vtype = 'CRM';
            else
                $vtype = 'Sales';

            $invoiceItem['id'] = $item->id;
            $invoiceItem['voucher_type'] = $vtype;
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

            if ($item->invoice_type == '0') {
                $ld['ledger_name'] = "Royalty on Laundry";
                $ld['ledger_perc'] = "";
                $ld['ledger_amt'] = $item->amount;
                $ld['dr_cr'] = "CR";
                array_push($ledgerDetails, $ld);
            }

            if ($item->invoice_type == '1') {
                $ld['ledger_name'] = "AMC Charges";
                $ld['ledger_perc'] = "";
                $ld['ledger_amt'] = $item->amount;
                $ld['dr_cr'] = "CR";
                array_push($ledgerDetails, $ld);
            }

            if ($item->invoice_type == '2') {
                $ld['ledger_name'] = "CRM Renewal Charges";
                $ld['ledger_perc'] = "";
                $ld['ledger_amt'] = $item->amount;
                $ld['dr_cr'] = "CR";
                array_push($ledgerDetails, $ld);
            }

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


    public function creditnote_by_tally_post()
    {
        $tallyData = json_decode(file_get_contents('php://input'));

        $creditNotes = array();
        foreach ($tallyData->result as $item) {
            $storeCode = $this->store_model->get_store_by_firm_name(trim($item->party_name));
            $data = array(
                'voucher_type' => 'C',
                'store_id' => $storeCode['id'],
                'amount' => str_replace(',', '', $item->ledger_details[0]->ledger_amt),
                'create_date' => date('Y-m-d H:i:s', strtotime($item->voucher_date)),
                'descriptions' => $item->voucher_no . ' ' . $item->narration,
                'voucher_no' => $item->voucher_no,
                'is_sync' => 1,
                'created_by' => 2
            );

            $creditNote['voucher_no'] = $item->voucher_no;
            $creditNote['id'] = $item->id;

            if ($this->Voucher_model->add_model('vouchers', $data) > 0) {
                $creditNote['syncstatus'] = true;
            } else {
                $creditNote['syncstatus'] = false;
            }

            array_push($creditNotes, $creditNote);

        }

        $response['result'] = $creditNotes;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }
    //END CREDIT

    //CREDIT NOTE push by Tally


    //Payment push by Tally
    public function payment_by_tally_post()
    {
        $tallyData = json_decode(file_get_contents('php://input'));

        $payments = array();
        foreach ($tallyData->result as $item) {
            $storeCode = $this->store_model->get_store_by_firm_name(trim($item->ledger_entries[0]->ledger_name));
            $data = array(
                'voucher_type' => 'R',
                'store_id' => $storeCode['id'],
                'amount' => '-' . str_replace(',', '', $item->ledger_entries[0]->ledger_amt),
                'create_date' => date('Y-m-d H:i:s', strtotime($item->voucher_date)),
                'descriptions' => $item->narration,
                'voucher_no' => $item->voucher_no,
                'is_sync' => 1,
                'created_by' => 2
            );

            $payment['voucher_no'] = $item->voucher_no;
            $payment['id'] = $item->id;
            if ($this->Voucher_model->add_model('vouchers', $data) > 0) {
                $payment['syncstatus'] = true;
            } else {
                $payment['syncstatus'] = false;
            }

            array_push($payments, $payment);

        }

        $response['result'] = $payments;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }

    //END payment push by Tally



    //Reciept push by Tally
    public function receipt_by_tally_post()
    {
        $tallyData = json_decode(file_get_contents('php://input'));

        $reciepts = array();
        foreach ($tallyData->result as $item) {
            $storeCode = $this->store_model->get_store_by_firm_name(trim($item->ledger_entries[0]->ledger_name));
            $data = array(
                'voucher_type' => 'R',
                'store_id' => $storeCode['id'],
                'amount' => str_replace(',', '', $item->ledger_entries[0]->ledger_amt),
                'create_date' => date('Y-m-d H:i:s', strtotime($item->voucher_date)),
                'descriptions' => $item->narration,
                'voucher_no' => $item->voucher_no,
                'is_sync' => 1,
                'created_by' => 2
            );

            $reciept['voucher_no'] = $item->voucher_no;
            $reciept['id'] = $item->id;
            if ($this->Voucher_model->add_model('vouchers', $data) > 0) {
                $reciept['syncstatus'] = true;
            } else {
                $reciept['syncstatus'] = false;
            }

            array_push($reciepts, $reciept);

        }

        $response['result'] = $reciepts;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }

    //END Reciept push by Tally



    //DebitNote push by Tally
    public function debitnote_by_tally_post()
    {
        $tallyData = json_decode(file_get_contents('php://input'));

        $debits = array();
        foreach ($tallyData->result as $item) {
            $storeCode = $this->store_model->get_store_by_firm_name(trim($item->ledger_entries[0]->ledger_name));
            $data = array(
                'voucher_type' => 'D',
                'store_id' => $storeCode['id'],
                'amount' => $item->ledger_entries[0]->ledger_amt,
                'create_date' => date('Y-m-d H:i:s', strtotime($item->voucher_date)),
                'descriptions' => $item->narration,
                'voucher_no' => $item->voucher_no,
                'is_sync' => 1,
                'created_by' => 2
            );

            $debit['voucher_no'] = $item->voucher_no;
            $debit['id'] = $item->id;
            if ($this->Voucher_model->add_model('vouchers_new', $data) > 0) {
                $debit['syncstatus'] = true;
            } else {
                $debit['syncstatus'] = false;
            }

            array_push($debits, $debit);

        }

        $response['result'] = $debits;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }

    //END DebitNote push by Tally




    //Journal push by Tally
    public function journal_by_tally_post()
    {
        $tallyData = json_decode(file_get_contents('php://input'));

        $journals = array();
        foreach ($tallyData->result as $item) {
            foreach ($item->ledger_entries as $le) {
                $storeCode = $this->store_model->get_store_by_firm_name(trim($le->ledger_name));
                if (!$storeCode)
                    continue;
                // $amount = 0;
                if ($le->Dr_Cr == 'Dr')
                    $amount = '-' . str_replace(',', '', $le->ledger_amt);
                else
                    $amount = str_replace(',', '', $le->ledger_amt);

                $data = array(
                    'voucher_type' => 'R',
                    'store_id' => $storeCode['id'],
                    'amount' => $amount,
                    'create_date' => date('Y-m-d H:i:s', strtotime($item->voucher_date)),
                    'descriptions' => $item->narration,
                    'voucher_no' => $item->voucher_no,
                    'is_sync' => 1,
                    'created_by' => 2
                );

                $journal['voucher_no'] = $item->voucher_no;
                $journal['id'] = $item->id;
                if ($this->Voucher_model->add_model('vouchers', $data) > 0) {
                    $journal['syncstatus'] = true;
                } else {
                    $journal['syncstatus'] = false;
                }

                array_push($journals, $journal);
            }
        }

        $response['result'] = $journals;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }

    //END Journal push by Tally


    //Material Invoice push by Tally
    public function invoice_by_tally_post()
    {
        $tallyData = json_decode(file_get_contents('php://input'));

        $invoices = array();
        foreach ($tallyData->result as $item) {
            $storeCode = $this->store_model->get_store_by_firm_name(addslashes(trim($item->ledger_details[0]->ledger_name)));
            //echo $this->db->last_query();
            $data = array(
                // 'voucher_type' => 'R',
                'store_crm_code' => $storeCode['store_crm_code'],
                'store_auto_id' => $storeCode['id'],
                'amount' => str_replace(',', '', $item->ledger_details[0]->ledger_amt),
                'invoice_date' => date('Y-m-d H:i:s', strtotime($item->voucher_date)),
                'material_description' => addslashes($item->narration),
                'invoice_no' => $item->voucher_no,

            );

            $invoice['voucher_no'] = $item->voucher_no;
            $invoice['id'] = $item->id;

            if ($this->Voucher_model->insert_or_update_voucher('material_invoices', $data) > 0) {
                $invoice['syncstatus'] = true;
            } else {
                $invoice['syncstatus'] = false;
            }

            array_push($invoices, $invoice);

        }

        $response['result'] = $invoices;
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            'message' => $response
        ], REST_Controller::HTTP_OK);
    }

    //END Material Invoice push by Tally




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

    //END Credit Note

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



            if (current(explode(' ', $item->descriptions)) == 'Paytm' && $item->voucher_type == 'C')
                $ld['ledger_name'] = 'Paytm Gateway Charges';
            else
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

            if ($storeCode == 'TS48')
                $storeCode = 'TS48_New';

            if ($storeCode == 'TS31')
                $storeCode = 'TS31_New';

            $storeInfo = $this->store_model->get_store_by_code($storeCode);



            $data = array(
                'voucher_type' => 'R',
                'store_id' => $storeInfo['id'],
                'amount' => $this->input->post('amount'),
                //'create_date' => date('Y-m-d H:i:s'),
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

    //GARMENT REPORT

    public function all_garments_get()
    {

        $s_from_date = $this->input->post('s_from_date') ? $this->input->post('s_from_date') : date('Y-m-d', strtotime('-2 days'));
        $s_to_date = $this->input->post('s_to_date') ? $this->input->post('s_to_date') : date('Y-m-d');

        if ($s_from_date && $s_to_date) {

            $stores = array('TS13', 'TS90', 'B004', 'T181', 'TS36');

            // print_r($stores);

            $headers = ['Content-Type: application/json', 'token:  EXDHXUXobI5WmIwVSoIPb4JnmLSVTT92OjbLIymOQSzCfs2HIzkjMaaaOPVLBB5R9DID6kMUBuzS5GItjLMT8pQdJAxsdbMOnh2ckZaXn0iSbRFHH11qoLijm4u6nUhZhk5nd5JUbo6IHyCrvpkLJWZbyjpP4Ea3jSbqmR3bRHPzeabo1Cax95PUVtpugup7ODYpXMFdWJuCHZxXHA', 'ClientID: 2469'];
            $url = "https://api.quickdrycleaning.com/QDCV1/GarmentDetailsData";
            $post_fields = json_encode(array('ClientID' => '2469', "FromDate" => date('d M Y', strtotime($s_from_date)), "ToDate" => date('d M Y', strtotime($s_to_date)), "StoreCodeList" => $stores));
            $garmentInfo = $this->cUrlGetData($url, $post_fields, $headers);
            //print_r($garmentInfo);

            //$garmentInfo = json_decode($garmentInfo);
            echo $garmentInfo;

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

    //Once payment success on QDC app

    public function paytm_payment_by_app_post()
    {
        try {
            $_POST = json_decode(file_get_contents('php://input'), true);

            $data = array(

                'order_id' => $_POST['ORDERID'],
                'transaction_no' => $_POST['TXNID'],
                'mid_no' => $_POST['MID'],
                'amount' => $_POST['TXNAMOUNT'],
                'transaction_date' => $_POST['TXNDATE'],
                'status' => $_POST['STATUS'],
                'store_code' => $_POST['STORECODE'],
                'payment_mode' => $_POST['PAYMENTMODE'],

            );

            if ($this->Voucher_model->add_model('paytm_qdc', $data) > 0) {
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




    public function stores_get()
    {

        $items = $this->api_model->get_all_customers();
        $response['result'] = $items;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


    public function fss_status_post()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $storeInfo = $this->store_model->get_store_by_code($_POST['store_code']);
        $items = $this->api_model->get_fss_status($storeInfo['id']);
        $response['result'] = $items;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }




    public function add_store_post()
    {
        try {
            $_POST = json_decode(file_get_contents('php://input'), true);

            $this->form_validation->set_rules('store_code', 'Store Code', 'required|is_unique[stores_new.store_code]');
            $this->form_validation->set_rules('store_crm_code', 'Store CRM Code', 'required|is_unique[stores_new.store_crm_code]');
            $this->form_validation->set_rules('store_name', 'Store Name', 'required|is_unique[stores_new.store_name]');
            $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|is_unique[stores_new.firm_name]');
            //$this->form_validation->set_rules('bharatpay_id', 'Bharat Pay Id', 'is_unique[stores_new.bharatpay_id]');
            $this->form_validation->set_rules('paytm_mid1', 'Paytm MID1', 'is_unique[stores_new.paytm_mid1]');
            $this->form_validation->set_rules('firm_pin_code', 'Pin Code', 'required|min_length[6]|max_length[6]');

            if (!$this->form_validation->run()) {
                throw new Exception(validation_errors());
            }


            // $params = array(
            //     'store_code' => $this->input->post('store_code'),
            //     'store_name' => $this->input->post('store_name'),
            //     'store_crm_code' => $this->input->post('store_crm_code'),
            //     'firm_name' => $this->input->post('firm_name'),
            //     'store_city' => $this->input->post('store_city'),
            //     'store_state' => $this->input->post('store_state'),
            //     'email_id' => $this->input->post('email_id'),
            //     'gstin_no' => $this->input->post('gstin_no'),
            //     'contact_number' => $this->input->post('contact_number'),
            //     'paytm_mid1' => $this->input->post('paytm_mid1'),
            //     'paytm_mid2' => $this->input->post('paytm_mid2'),
            //     'paytm_mid3' => $this->input->post('paytm_mid3'),
            //     'bharatpay_id' => $this->input->post('bharatpay_id'),
            //     'store_address' => $this->input->post('store_address'),
            //     'launch_date' => $this->input->post('launch_date'),
            //     'pan_no' => $this->input->post('pan_no'),
            //     'opening_balance' => $this->input->post('opening_balance'),
            //     'is_active' => $this->input->post('is_active'),
            //     'gst_st_code' => $this->input->post('gst_st_code'),
            //     'discount' => $this->input->post('discount'),
            //     'pin_code' => $this->input->post('pin_code'),
            //     'store_type' => $this->input->post('store_type'),
            // );


            $params = array(
                'partner_name' => $this->input->post('partner_name'),
                'mobile_no' => $this->input->post('mobile_no'),
                'email_id' => $this->input->post('email_id'),
                'store_code' => $this->input->post('store_code'),
                'store_name' => $this->input->post('store_name'),
                'is_fofo' => $this->input->post('is_fofo'),
                'paytm_mid_1' => $this->input->post('paytm_mid_1'),
                'first_pickup' => $this->input->post('first_pickup') ? $this->input->post('first_pickup') : null,
                'last_pickup' => $this->input->post('last_pickup') ? $this->input->post('last_pickup') : null,
                'str_manager_name' => $this->input->post('str_manager_name'),
                'tsm_name' => $this->input->post('tsm_name'),
                'str_address' => $this->input->post('str_address'),
                'store_city' => $this->input->post('store_city'),
                'store_state' => $this->input->post('store_state') ? $this->input->post('store_state') : 0,
                'str_pin_code' => $this->input->post('str_pin_code'),
                'firm_name' => $this->input->post('firm_name'),
                'firm_gst_regis_type' => $this->input->post('firm_gst_regis_type') ? $this->input->post('firm_gst_regis_type') : 2,
                'gst_no' => $this->input->post('gst_no'),
                'firm_pan_no' => $this->input->post('firm_pan_no'),
                'firm_address' => $this->input->post('firm_address'),
                'firm_city' => $this->input->post('firm_city'),
                'firm_state' => $this->input->post('firm_state') ? $this->input->post('firm_state') : 0,
                'firm_pin_code' => $this->input->post('firm_pin_code'),
                'bank_name' => $this->input->post('bank_name'),
                'account_no' => $this->input->post('account_no'),
                'ifsc_code' => $this->input->post('ifsc_code'),
                'cancelled_cheque' => $this->input->post('cancelled_cheque'),
                'store_crm_code' => $this->input->post('store_crm_code'),
                'franchise_agreement_date' => $this->input->post('franchise_agreement_date') ? $this->input->post('franchise_agreement_date') : null,
                'additional_info' => $this->input->post('additional_info'),
                'machine_info' => $this->input->post('machine_info'),

            );




            if ($this->store_model->add_store_new($params) > 0) {
                $this->set_response([
                    'status' => true,
                    'message' => $params,
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

    //MIS API



    public function get_sales_summary_get()
    {
        $items = $this->api_model->get_sales_summary($_GET['input_current_date'], $_GET['type']);
        $response['result'] = $items;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function get_mis_usermap_get()
    {
        $items = $this->api_model->get_mis_usermap();
        $response['result'] = $items;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }
    public function get_target_get()
    {
        $items = $this->api_model->get_target();
        $response['result'] = $items;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }
}