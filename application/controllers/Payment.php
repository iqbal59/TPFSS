<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('accounts_model');
        $this->load->model('common_model');
        $this->load->library('encryption');
    }


    public function pay($id)
    {
        if ($id != null) {
            $customer_id= base64_decode($id);

            //   $var_to_encode=$this->encryption->decrypt(base64_decode($url_val));

            $data = array();
            $data['storeData']=$this->accounts_model->calculate_balance_by_store(date('Y-m-d', strtotime('+1 day')), $customer_id);
            $data['page'] = 'Pay Partner';
            // if ($customer_id != 29) {
            //     $data['payUrl']='https://orderattumbledry.in/sales/fsspaynow';
            // } else {
            //     $data['payUrl']='https://orderattumbledry.in/sales/fsspayhdfcnow';
            // }
            $data['payUrl']='https://orderattumbledry.in/sales/fsspayhdfcnow';
            $this->load->view('partner/pay', $data);
        }
    }
}