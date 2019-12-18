<?php
class Accounts extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Accounts_model');
    } 

function index(){
           
            $data['invoices']=$this->Accounts_model->get_all_invoice();
            $data['main_content'] = $this->load->view('admin/accounts/index', $data, TRUE);
            $this->load->view('admin/index',$data);
}


function ledger(){
    
    $data['ledgers']=$this->Accounts_model->calculate_balance_by_date(date('Y-m-d'));
    $data['main_content'] = $this->load->view('admin/accounts/ledger', $data, TRUE);
    $this->load->view('admin/index',$data);
}


function customerledger($id){
    $data['open_date']='2019-11-01';
    $data['storebalance']=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
    $data['ledgerItems']=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date'])))    , $id);
    $data['main_content'] = $this->load->view('admin/accounts/customerledger', $data, TRUE);
    $this->load->view('admin/index',$data);
}

function createinvoices()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('invoice_date','Invoice Date','required');
      
        if($this->form_validation->run())     
        {



            $data['storesales']=$this->Accounts_model->get_all_sale_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))));
            //print_r($data['storesales']);
           
            foreach($data['storesales'] as $s)
            {
                if(!$s['id'] || !$s['store_royalty'])
                continue;

                $item=array('amount'=>$s['amount'], 'service_code'=>$s['service_code'], 'store_royalty'=>$s['store_royalty'], 'order_ids'=>$s['order_nos'], 'item_name'=>'Royalty @'.$s['store_royalty'], 'rate'=>($s['amount']*$s['store_royalty']/100));
                
                $data['invoice'][$s['id']][]=$item;
            }
            $this->Accounts_model->saveInvoice($data['invoice']);

            //BHARATE PE
            $bharatpe=$this->Accounts_model->get_bharatpe_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))));
            
            foreach($bharatpe as $bp)
                {
                        $this->Common_model->insert(array('store_id'=>$bp['store_id'], 'voucher_type'=>'R', 'amount'=>$bp['amount'], 'descriptions'=>'Bharate Pe'), "vouchers");

                        $this->Common_model->bharatpebill($bp['ids']);
                }


            //PAYTM    
            $paytm=$this->Accounts_model->get_paytm_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))));

            foreach($paytm as $p)
            {
                    $this->Common_model->insert(array('store_id'=>$p['store_id'], 'voucher_type'=>'R', 'amount'=>$p['final_amount'], 'descriptions'=>'Paytm'), "vouchers");

                    $this->Common_model->paytmbill($p['ids']);
            }

            $this->session->set_flashdata('msg', 'Invoice created Successfully');           
            redirect('admin/accounts/index');

        }else
        {
            $data['main_content'] = $this->load->view('admin/accounts/createinvoice', null, TRUE);
            $this->load->view('admin/index',$data);
        }

       
    }


}

?>