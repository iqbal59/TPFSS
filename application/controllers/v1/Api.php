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
        $invoiceItem['id']=$item->id;
        $invoiceItem['voucher_type']='Sales';
        $invoiceItem['voucher_no']=$item->invoice_no;
        $invoiceItem['voucher_date']=date('d/m/Y', strtotime($item->invoice_date));
        $invoiceItem['party_name']=$item->firm_name;
        $invoiceItem['address1']=$item->store_address;
        $invoiceItem['address2']=$item->id;
        $invoiceItem['address3']=$item->store_city;
        $invoiceItem['state']=$item->store_state;
        $invoiceItem['country']='India';
        $invoiceItem['gst_no']=$item->gstin_no;
        $invoiceItem['pan_no']=$item->pan_no;
        $invoiceItem['pin_code']='';
        $invoiceItem['email_id']=$item->email_id;
        $invoiceItem['reg_type']=$item->gstin_no != ''?"Regular":"Non Regsitered";
        $invoiceItem['contact_person']='';
        $invoiceItem['mobile_No']=$item->contact_number;
        $invoiceItem['narration']='';
        $ledgerDetails=array();
        $ld['ledger_name']=$item->firm_name;
        $ld['ledger_perc']="";
        $ld['ledger_amt']=$item->net_amount;
        $ld['dr_cr']="DR";
        array_push($ledgerDetails, $ld);

        $ld['ledger_name']="Royalty on Laundry";
        $ld['ledger_perc']="";
        $ld['ledger_amt']=$item->amount;
        $ld['dr_cr']="CR";
        array_push($ledgerDetails, $ld);

        if ($item->gst_st_code=='09' || $item->gst_st_code=='9') {
            $cgstRate=$item->tax_rate/2;
            $sgstRate=$item->tax_rate/2;
            $igstRate='0.00';
            $cgstAmount=$item->tax_amount/2;
            $sgstAmount=$item->tax_amount/2;
            $igstAmount='0.00';
        } else {
            $cgstRate='0.00';
            $sgstRate='0.00';
            $igstRate=$item->tax_rate;
            $cgstAmount='0.00';
            $sgstAmount='0.00';
            $igstAmount=$item->tax_amount;
        }


        $ld['ledger_name']="CGST";
        $ld['ledger_perc']=$cgstRate;
        $ld['ledger_amt']=$cgstAmount;
        $ld['dr_cr']="CR";
        array_push($ledgerDetails, $ld);

        $ld['ledger_name']="SGST";
        $ld['ledger_perc']=$sgstRate;
        $ld['ledger_amt']=$sgstAmount;
        $ld['dr_cr']="CR";
        array_push($ledgerDetails, $ld);

        $ld['ledger_name']="IGST";
        $ld['ledger_perc']=$igstRate;
        $ld['ledger_amt']=$igstAmount;
        $ld['dr_cr']="CR";
        array_push($ledgerDetails, $ld);


        $invoiceItem['ledger_details']=$ledgerDetails;
        array_push($invoices, $invoiceItem);
    }




    $response['result']=$invoices;
    $this->set_response($response, REST_Controller::HTTP_OK);
}


public function sync_with_tally_post()
{
    $invoiceId=$this->input->post('invoice_id');
    // $syncStatus=$this->input->post('sync_status');
    if ($invoiceId) {
        $invoices = $this->api_model->sync_with_tally($invoiceId);
        $this->set_response([
            $this->config->item('rest_status_field_name') => true,
            $this->config->item('rest_message_field_name') => "Success"
        ], self::HTTP_FORBIDDEN);
    } else {
        $this->set_response([
            $this->config->item('rest_status_field_name') => false,
            $this->config->item('rest_message_field_name') => "Invlid Invoice ID or Sync Status"
        ], self::HTTP_FORBIDDEN);
    }
}
}