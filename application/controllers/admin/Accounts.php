<?php
class Accounts extends CI_Controller{
    function __construct()
    {
        parent::__construct();
       
        $this->load->model('Accounts_model');
        $this->load->model('Common_model');
    } 

function index(){
    check_login_user();
            $data['invoices']=$this->Accounts_model->get_all_invoice();
            $data['main_content'] = $this->load->view('admin/accounts/index', $data, TRUE);
            $this->load->view('admin/index',$data);
}


function ledger(){
    check_login_user();
    $data['ledgers']=$this->Accounts_model->calculate_balance_by_date(date('Y-m-d'));
    $data['main_content'] = $this->load->view('admin/accounts/ledger', $data, TRUE);
    $this->load->view('admin/index',$data);
}


function customerledger($id){
    check_login_user();
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
    check_login_user();
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
        check_login_user();
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


    function invoicepdfdownload($id)
    {
        check_login_user();
        $invoiceData=$this->Accounts_model->get_invoice_by_id($id);
       // print_r($invoiceData);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Inovice');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(10);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('tumbledry');
       // $pdf->SetDisplayMode('real', 'default');
        //$pdf->Write(5, 'CodeIgniter TCPDF Integration');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->AddPage();

        $html=file_get_contents(base_url('admin/accounts/invoicepdf/'.$id));
        //$html="<p>AAA</p>";

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output($invoiceData->firm_name.'_'.$invoiceData->id.'.pdf', 'D');
    }


    function downloadledger($id){
        check_login_user();
        if($this->input->post('from_date'))
        $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        else
        $data['open_date']=date('Y-m-01');
    
        if($this->input->post('to_date'))
        $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        else
        $data['to_date']=date('Y-m-d');
    
        $openBalance=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $ledgerItems=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date']))),  $data['to_date']   , $id);

        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Customer Ledger');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(10);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('tumbledry');
       // $pdf->SetDisplayMode('real', 'default');
        //$pdf->Write(5, 'CodeIgniter TCPDF Integration');
        $pdf->SetFont('dejavusans', '', 7);
        $pdf->AddPage();


        $html='<p align="right"><img src="'.base_url('assets/images/logo-light-login.png').'"/></p>' ;

        // $html .= '<p align="center"><strong>FSS Period : '.date("d-m-Y", strtotime($data['open_date'])).' to
        //         '.date("d-m-Y", strtotime( $data['to_date'])).'</strong></p>
//<p align="center"><strong>FSS Period : 12-04-2021 to 18-04-2021</strong></p>
        $html .= '
        <div style="font-size:9px;">
            <div align="right" style="font-size:9px;">
                <b class="title_name">TUMBLEDRY SOLUTIONS PRIVATE LIMITED</b><br />

                5, 512-B, 98-MODI TOWER, NEHRU PLACE, NEW DELHI,<br>
                South East Delhi, New Delhi, Delhi 110019<br>
                01204317564<br>
                GSTIN 07AAHCT2140E1ZP<br>
                PAN AAHCT2140E<br>
                CIN U74999DL2019PTC347046
            </div>
            <hr />


            <b class="title_name"> '.$openBalance['firm_name'].' </b>
            <BR />
           '.$openBalance['store_address'].'



        </div>
        <br /><br />
        <table id="" class="list" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td class="center" width="10%">Voucher No.</td>
                    <td class="center" width="15%">Voucher Type</td>
                    <td class="center" width="15%">Voucher Date</td>
                    <td class="center" width="10%">Debit</td>
                    <td class="center" width="10%">Credit</td>
                    <td class="center" width="30%">Descriptions</td>
                    <td class="center" width="20%">Balance</td>

                </tr>
            </thead>
          
            <tbody>

                <tr>
                    <td width="10%">-</td>
                    <td width="15%">Opening Balance</td>
                    <td width="15%">'.date("d-m-Y", strtotime($data['open_date'])).'</td>
                    <td class="right" width="10%">'.$openBalance['openbalance'].'</td>

                    <td width="10%">-</td>
                    <td width="30%">-</td>
                    <td class="right" width="10%">'.$openBalance['openbalance'].'</td>

                </tr>';

                $total_balalnce=$openBalance['openbalance'];

                $saleInvoice=array();
                $paytmR=array();
                $bharatpeR=array();

                foreach($ledgerItems as $li){
                    if ( preg_match("~\bTD\b~",$li['voucher_no']) )

                        {
                            $saleInvoice[]=$li['id'];
                        }

                        if ( preg_match("~\bBharate Pe\b~",$li['descriptions']) && $li['voucher_type'] =='R')

                        {
                            $bharatpeR[]=$li['descriptions'];
                        }

                        if ( preg_match("~\bPaytm\b~",$li['descriptions'])  && $li['voucher_type'] =='R')

                        {
                            $paytmR[]=$li['descriptions'];
                        }


                    $html.='<tr>
                        <td width="10%">'.$li['voucher_no'].'</td>
                        <td width="15%">';
                                if($li['voucher_type']=='C')
                                $voucher_type= 'Credit';
                                elseif($li['voucher_type']=='R')
                                $voucher_type= 'Receipt';
                                elseif($li['voucher_type']=='D')
                                $voucher_type= 'Debit';
                                else
                                $voucher_type= $li['voucher_type'];
                            $html.= $voucher_type.'</td>
                        <td width="15%">'.date("d-m-Y", strtotime($li['voucher_date'])).'</td>
    
                        ';
                        

                        if($li['voucher_type']=='D' or $li['voucher_type']=='Sale')
                        {
                            $total_balalnce+=$li['np']; 
                            $html.='<td class="right" width="10%">'.$li['np'].'</td>';
                        }
                        else
                        {
                            $html.='<td>-</td>';
                        }

                        if($li['voucher_type']=='C' or $li['voucher_type']=='R')
                        {
                            $total_balalnce-=$li['np']; 
                            $html.='<td class="right" width="10%">'.$li['np'].'</td>';
                        }
                        else
                        {
                            $html.='<td width="10%">-</td>';
                        }
                        
                        


$html.='<td width="30%">'.$li['descriptions'].'</td>
<td class="right" width="10%">'.$total_balalnce.'</td>

</tr>';
}

$color='#FF0000';
if($total_balalnce < 0)
$color='#008000';

$html.='</tbody>


<tfoot>
    <tr>
        <th></th>
        <th></th>

        <th>-</th>
        <th>-</th>
        <th>-</th>
        <th>-</th>
        <th class="right" style="color:'.$color.';" ><strong>'.$total_balalnce.'</strong></th>

    </tr>
</tfoot>


</table>
';

$html.='<p><strong>Note :-</strong> <em>If Balance is in Negative then tumbledry will Pay to Franchise or if Balance is in Positive then Franchise has to Pay to Tumbledry)</em></p>';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

if(!empty($saleInvoice)){

foreach($saleInvoice as $sv){
$pdf->lastPage();
$pdf->AddPage();
$invoice=$this->Accounts_model->get_invoice_by_id($sv);
$invoiceItems=$this->Accounts_model->get_invoice_item_by_id($sv);

$orderNos=array();
foreach($invoiceItems as $item){
$rawOrderNo=$item->order_nos;
$rawOrderNo=explode(',', $rawOrderNo);
    foreach($rawOrderNo as $orderNo)
    {
        //echo trim($orderNo, '\'');
        $orderNos[]=$orderNo;
    }
}
$saleRoyaltyData=$this->Accounts_model->get_royalty_sale_data($orderNos, $invoice->store_name);
$html='<h4 align="center">Sale Data ('.$invoice->descriptions.')</h4>';
$html.='<table id="" class="list" cellspacing="0" width="100%">
<thead>
    <tr>
        <td class="center">Order Date</td>
        <td class="center">Order No.</td>
        <td class="center">Taxable Amount</td>

        <td class="center">Net Amount</td>
        <td class="center">Service Code</td>
        

    </tr>
</thead>
<tbody>';
$txt=0;
$ntt=0;
foreach($saleRoyaltyData as $data){
$txt+=$data['taxable_amount'];
$ntt+=$data['net_amount'];
$html.='<tr>
        <td>'.date('d-m-Y', strtotime($data['order_date'])).'</td>
        <td>'.$data['order_no'].'</td>
        <td>'.$data['taxable_amount'].'</td>
        <td>'.$data['net_amount'].'</td>
        <td>'.$data['service_code'].'</td>
</tr>';
}

$html.='<tr>
        <td><strong>Total</strong></td>
        <td>-</td>
        <td><strong>'.number_format($txt, 2).'</strong></td>
        <td><strong>'.number_format($ntt, 2).'</strong></td>
        <td>-</td>
</tr>';


$html.='</tbody></table>';
$pdf->writeHTML($html, true, false, true, false, '');
}
}

//Paytm

if(!empty($paytmR)){

    foreach($paytmR as $sv){
    $pdf->lastPage();
    $pdf->AddPage();
    
    $paytmRawData=explode(' ', $sv);
    $fromDate=date('Y-m-d', strtotime($paytmRawData[1]));
    $toDate=date('Y-m-d', strtotime($paytmRawData[3]));
    $paytmRoyaltyData=$this->Accounts_model->get_royalty_paytm_data($openBalance['paytm_mid1'], $openBalance['paytm_mid2'], $openBalance['paytm_mid3'], $fromDate ,$toDate);
    $html='<h4 align="center">'.$sv.'</h4>';
    $html.='<table id="" class="list" cellspacing="0" width="100%">
    <thead>
        <tr>
            <td class="center">Transaction Date</td>
            <td class="center">UTR No.</td>
            <td class="center">Amount</td>
    
            <td class="center">Commission</td>
            <td class="center">GST</td>
            
    
        </tr>
    </thead>
    <tbody>';
    foreach($paytmRoyaltyData as $data){
    $html.='<tr>
            <td>'.date('d-m-Y', strtotime($data['transaction_date'])).'</td>
            <td>'.$data['utr_no'].'</td>
            <td>'.$data['amount'].'</td>
            <td>'.$data['commission'].'</td>
            <td>'.$data['gst'].'</td>
    </tr>';
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    }
    }

    //Bharate Pe

if(!empty($bharatpeR)){

    foreach($bharatpeR as $sv){
    $pdf->lastPage();
    $pdf->AddPage();
    
    
    $bharatRawData=explode(' ', $sv);
    $fromDate=date('Y-m-d', strtotime($bharatRawData[2]));
    $toDate=date('Y-m-d', strtotime($bharatRawData[4]));
    $bharatRoyaltyData=$this->Accounts_model->get_royalty_bharatPe_data($openBalance['bharatpay_id'], $fromDate ,$toDate);
    $html='<h4 align="center">'.$sv.'</h4>';
    $html.='<table id="" class="list" cellspacing="0" width="100%">
    <thead>
        <tr>
            <td class="center">Transaction Date</td>
            <td class="center">UTR No.</td>
            <td class="center">Amount</td>
    
            
    
        </tr>
    </thead>
    <tbody>';
    foreach($bharatRoyaltyData as $data){
    $html.='<tr>
            <td>'.date('d-m-Y', strtotime($data['transaction_date'])).'</td>
            <td>'.$data['utr_no'].'</td>
            <td>'.$data['amount'].'</td>
           
    </tr>';
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    }
    }

$pdf->Output($openBalance['firm_name'].'-fss.pdf', 'D');


}

}







?>