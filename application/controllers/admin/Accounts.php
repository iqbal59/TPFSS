<?php
class Accounts extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Accounts_model');
        $this->load->model('Common_model');
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
    if($this->input->post('from_date'))
    $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
    else
    $data['open_date']=date('Y-m-01');

    if($this->input->post('to_date'))
    $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
    else
    $data['to_date']=date('Y-m-d');

    $data['storebalance']=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
    $data['ledgerItems']=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date']))),  $data['to_date']   , $id);
    $data['main_content'] = $this->load->view('admin/accounts/customerledger', $data, TRUE);
    $this->load->view('admin/index',$data);
}

function printledger($id){
    if($this->input->post('from_date'))
    $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
    else
    $data['open_date']=date('Y-m-01');

    if($this->input->post('to_date'))
    $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
    else
    $data['to_date']=date('Y-m-d');

    $data['storebalance']=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
    $data['ledgerItems']=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date']))),  $data['to_date']   , $id);
    $this->load->view('admin/accounts/printledger', $data);
    
}


function createinvoices()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('invoice_date','Invoice Date','required');
        $this->form_validation->set_rules('invoice_to_date','Invoice Date','required');
        if($this->form_validation->run())     
        {

            

            $data['storesales']=$this->Accounts_model->get_all_sale_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))),date('Y-m-d', strtotime($this->input->post('invoice_to_date'))));
            //print_r($data['storesales']);
           
            foreach($data['storesales'] as $s)
            {
                if(!$s['id'] || !$s['store_royalty'])
                continue;

                $item=array('amount'=>$s['amount'], 'service_code'=>$s['service_code'], 'store_royalty'=>$s['store_royalty'], 'order_ids'=>$s['order_nos'], 'item_name'=>$s['service_code'].' Royalty @'.$s['store_royalty'], 'rate'=>($s['amount']*$s['store_royalty']/100));
                
                $data['invoice'][$s['id']][]=$item;
            }

            if(!is_array($data['invoice']))
            $data['invoice']=array();
            $data['period']=date('d-m-Y', strtotime($this->input->post('invoice_date')))." to ".date('d-m-Y', strtotime($this->input->post('invoice_to_date')));
            $this->Accounts_model->saveInvoice($data['invoice'], $data['period']);


            //REFUND SALES
            $data['refundSales']=$this->Accounts_model->get_all_refund_sales();
            if($data['refundSales']){
            foreach($data['refundSales'] as $r)
                {
                    $item=array('amount'=>$r['amount'], 'service_code'=>$r['service_code'], 'store_royalty'=>$r['store_royalty'], 'order_ids'=>$r['order_nos'], 'item_name'=>$r['service_code'].' Royalty @'.$r['store_royalty'], 'rate'=>($r['amount']*$r['store_royalty']/100));
                    $data['rsales'][$r['id']][]=$item;
                }


            //if($data['rsales'])
            $this->Accounts_model->refundInvoice($data['rsales']);
            }
            //END REFUND
            
            //BHARATE PE
            $bharatpe=$this->Accounts_model->get_bharatpe_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))),date('Y-m-d', strtotime($this->input->post('invoice_to_date'))));
            
            foreach($bharatpe as $bp)
                {
                        $this->Common_model->insert(array('store_id'=>$bp['store_id'], 'voucher_type'=>'R', 'amount'=>$bp['amount'], 'descriptions'=>'Bharate Pe '.$data['period']), "vouchers");

                        $this->Common_model->bharatpebill($bp['ids']);
                }


            //PAYTM    
            $paytm=$this->Accounts_model->get_paytm_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))),date('Y-m-d', strtotime($this->input->post('invoice_to_date'))));

            foreach($paytm as $p)
            {
                if($p['store_id']==null)
                continue;
                    $this->Common_model->insert(array('store_id'=>$p['store_id'], 'voucher_type'=>'R', 'amount'=>$p['final_amount'], 'descriptions'=>'Paytm '.$data['period']), "vouchers");
                    $this->Common_model->insert(array('store_id'=>$p['store_id'], 'voucher_type'=>'C', 'amount'=>($p['paytmcommission']*7.5/100), 'descriptions'=>'Paytm '.$p['paytmcommission']." @7.5% ".$data['period'] ), "vouchers");

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

function invoicepdf($id)
    {
        $data['invoice']=$this->Accounts_model->get_invoice_by_id($id);
        $data['invoiceitems']=$this->Accounts_model->get_invoice_item_by_id($id);
        $this->load->view('admin/accounts/invoice',$data);
    }


}

?>