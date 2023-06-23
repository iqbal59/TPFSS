<?php
require APPPATH . 'libraries/REST_Controller.php';



class Api extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
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

    public function stores_get()
    {

        $items = $this->api_model->get_all_customers();
        $response['result'] = $items;
        $this->set_response($response, REST_Controller::HTTP_OK);
    }



}