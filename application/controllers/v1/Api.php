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
    $invoices = $this->api_model->get_all_invoice();
    $this->set_response($invoices, REST_Controller::HTTP_OK);
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