<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
class Accounts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
       
        $this->load->model('Accounts_model');
        $this->load->model('Common_model');
        $this->load->model('Store_model');
        $this->load->library('zip');
    }

    public function index()
    {
        check_login_user();

        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        $data['invoices']=$this->Accounts_model->get_all_invoice($data['open_date'], $data['to_date']);
        $data['main_content'] = $this->load->view('admin/accounts/index', $data, true);
        $this->load->view('admin/index', $data);
    }


    public function sendemail()
    {
        check_login_user();

        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }
        $data['stores']=$this->Store_model->get_all_active_stores();
        $data['main_content'] = $this->load->view('admin/accounts/sendemail', $data, true);
        $this->load->view('admin/index', $data);
    }


    public function processemail()
    {
        check_login_user();

        
        $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));

        $data['storedIds']=$this->input->post('store_id');
        
        foreach ($data['storedIds'] as $store_id) {
            $storeData=$this->Store_model->get_store($store_id);
            $invoiceData=$this->Accounts_model->get_invoice_by_store($store_id, $data['open_date'], $data['to_date']);
        

            $this->savePDF($store_id, $data['open_date'], $data['to_date']);
            $this->savePDFInvoice($invoiceData->id);

            $message='<p>Dear Partner<br><br>PFA the Financial Statement along with Royalty invoice for the period '.$invoiceData->descriptions.'. Please note that only transactions till '.end(explode(' ', $invoiceData->descriptions)).' are considered in the attached statement.</p>';

            echo $message.='<br><br><br><p>Regards<br><br><br>Deepak-|- 9368067789 -|-<a href="mailto:deepak.verma@tumbledry.in">deepak.verma@tumbledry.in</a></p>';
            echo  $subject="Financial Settlement Sheet for the period ".$invoiceData->descriptions;
            // $this->send(trim($storeData['email_id']), $data['open_date'], $data['to_date'], $message, FCPATH.'uploads/temppdf/'.$storeData['firm_name'].'-fss.pdf', FCPATH.'uploads/tempinvoice/'.$storeData['firm_name'].'.pdf', $subject);
        }

        //  $this->session->set_flashdata('msg', 'Mail has been sent Successfully');
       // redirect('admin/accounts/sendemail');
    }


   
    public function send($to_address, $from, $to, $content, $attachmentpdf, $invoicepdf, $subject)
    {
        // Load PHPMailer library
        $this->load->library('PHPMailer_Lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'mail.centuryfasteners.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'admin@centuryfasteners.in';
        $mail->Password = 'B5]DIG&#OcNH';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;

        $mail->setFrom('deepak.verma@tumbledry.in', 'Deepak Verma');
        $mail->addReplyTo('deepak.verma@tumbledry.in', 'Deepak Verma');

        // Add a recipient
        $mail->addAddress($to_address);
        // $mail->addAddress('iqbal.alam59@gmail.com');

        // Add cc or bcc
        $mail->addCC('Gaurav.Teotia@tumbledry.in');
        $mail->addCC('Gaurav.Nigam@tumbledry.in');
        $mail->addCC('Sachin.bhatia@tumbledry.in');

        //$mail->addBCC('iqbal.alam59@gmail.com');
        $mail->AddAttachment($attachmentpdf);
        $mail->AddAttachment($invoicepdf);
         
        // Email subject
        $mail->Subject = $subject;

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent = $content;
            
        $mail->Body = $mailContent;

        // Send email
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return true;
        }
    }
    

    public function ledger()
    {
        check_login_user();
        $data['ledgers']=$this->Accounts_model->calculate_balance_by_date(date('Y-m-d'));
        $data['main_content'] = $this->load->view('admin/accounts/ledger', $data, true);
        $this->load->view('admin/index', $data);
    }


    public function customerledger($id)
    {
        check_login_user();
        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        $data['storebalance']=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $data['ledgerItems']=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date']))), $data['to_date'], $id);
        $data['main_content'] = $this->load->view('admin/accounts/customerledger', $data, true);
        $this->load->view('admin/index', $data);
    }

    public function printledger($id)
    {
        check_login_user();
        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        $data['storebalance']=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $data['ledgerItems']=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date']))), $data['to_date'], $id);
        $this->load->view('admin/accounts/printledger', $data);
    }


    public function exportledger($id)
    {
        check_login_user();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=customer_ledger-'.date('d-m-Y').'.csv');
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        
        
        // output the column headings
        fputcsv($output, array('Voucher No.','Voucher Type', 'Voucher Date', 'Debit', 'Credit', 'Description', 'Total'));
        $data['storebalance']=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $total_balalnce=$data['storebalance']['openbalance'];
        $itemrow=array('', 'Opening Balance', date("d-m-Y", strtotime($data['open_date'])), $total_balalnce, '', '', $total_balalnce);
        fputcsv($output, $itemrow);
        $data['ledgerItems']=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date']))), $data['to_date'], $id);
       
        foreach ($data['ledgerItems'] as $row) {
            if ($row['voucher_type']=='C') {
                $voucher_type= 'Credit';
            } elseif ($row['voucher_type']=='R') {
                $voucher_type ='Receipt';
            } elseif ($row['voucher_type']=='D') {
                $voucher_type = 'Debit';
            } else {
                $voucher_type = $row['voucher_type'];
            }
                  
           

           
            if ($row['voucher_type']=='D' or $row['voucher_type']=='Sale') {
                $debit= $row['np'];
                $total_balalnce+=$row['np'];
            }
            
           
            if ($row['voucher_type']=='C' or $row['voucher_type']=='R') {
                $credit= $row['np'];
                $total_balalnce-=$row['np'];
            }
         


            $itemrow=array($row['voucher_no'], $voucher_type, date("d-m-Y", strtotime($row['voucher_date'])), $debit ,$credit, $row['descriptions'], $total_balalnce);
        
        
            fputcsv($output, $itemrow);
        }
    }


    public function createinvoices()
    {
        check_login_user();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required');
        $this->form_validation->set_rules('invoice_to_date', 'Invoice Date', 'required');
        if ($this->form_validation->run()) {

            
           
//REFUND SALES
            $data['refundSales']=$this->Accounts_model->get_all_refund_sales();
            if ($data['refundSales']) {
                foreach ($data['refundSales'] as $r) {
                    $item=array('amount'=>$r['amount'], 'service_code'=>$r['service_code'], 'store_royalty'=>$r['store_royalty'], 'order_ids'=>$r['order_nos'], 'item_name'=>$r['service_code'].' Royalty @'.$r['store_royalty'], 'rate'=>($r['amount']*$r['store_royalty']/100));
                    $data['rsales'][$r['id']][]=$item;
                }


                if ($data['rsales']) {
                    $this->Accounts_model->refundInvoice($data['rsales']);
                }
            }
            //END REFUND


       


            $data['storesales']=$this->Accounts_model->get_all_sale_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))), date('Y-m-d', strtotime($this->input->post('invoice_to_date'))));
            //print_r($data['storesales']);
           
            foreach ($data['storesales'] as $s) {
                if (!$s['id'] || !$s['store_royalty']) {
                    continue;
                }

                $item=array('amount'=>$s['amount'], 'service_code'=>$s['service_code'], 'store_royalty'=>$s['store_royalty'], 'order_ids'=>$s['order_nos'], 'item_name'=>$s['service_code'].' Royalty @'.$s['store_royalty'], 'rate'=>($s['amount']*$s['store_royalty']/100));
                
                $data['invoice'][$s['id']][]=$item;
            }

            if (!is_array($data['invoice'])) {
                $data['invoice']=array();
            }
            $data['period']=date('d-m-Y', strtotime($this->input->post('invoice_date')))." to ".date('d-m-Y', strtotime($this->input->post('invoice_to_date')));
            $this->Accounts_model->saveInvoice($data['invoice'], $data['period']);


            
            
            //BHARATE PE
            $bharatpe=$this->Accounts_model->get_bharatpe_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))), date('Y-m-d', strtotime($this->input->post('invoice_to_date'))));
            
            foreach ($bharatpe as $bp) {
                $this->Common_model->insert(array('store_id'=>$bp['store_id'], 'voucher_type'=>'R', 'amount'=>$bp['amount'], 'descriptions'=>'Bharate Pe '.$data['period']), "vouchers");

                $this->Common_model->bharatpebill($bp['ids']);
            }


            //PAYTM
            $paytm=$this->Accounts_model->get_paytm_by_store(date('Y-m-d', strtotime($this->input->post('invoice_date'))), date('Y-m-d', strtotime($this->input->post('invoice_to_date'))));

            foreach ($paytm as $p) {
                if ($p['store_id']==null) {
                    continue;
                }
                $this->Common_model->insert(array('store_id'=>$p['store_id'], 'voucher_type'=>'R', 'amount'=>$p['final_amount'], 'descriptions'=>'Paytm '.$data['period']), "vouchers");
                $this->Common_model->insert(array('store_id'=>$p['store_id'], 'voucher_type'=>'C', 'amount'=>($p['paytmcommission']*7.5/100), 'descriptions'=>'Paytm '.$p['paytmcommission']." @7.5% ".$data['period'] ), "vouchers");

                $this->Common_model->paytmbill($p['ids']);
            }

            $this->session->set_flashdata('msg', 'Invoice created Successfully');
            redirect('admin/accounts/index');
        } else {
            $data['main_content'] = $this->load->view('admin/accounts/createinvoice', null, true);
            $this->load->view('admin/index', $data);
        }
    }

    public function invoicepdf($id)
    {
        $data['invoice']=$this->Accounts_model->get_invoice_by_id($id);
        $data['invoiceitems']=$this->Accounts_model->get_invoice_item_by_id($id);
        $this->load->view('admin/accounts/invoice', $data);
    }


    public function invoicepdfdownload($id)
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


    public function savePDFInvoice($id)
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
        $pdf->Output(FCPATH.'uploads/tempinvoice/'.$invoiceData->firm_name.'.pdf', 'F');
    }

    public function downloadledgerall()
    {
        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-01');
        }
    
        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }
        $storeList=$this->Store_model->get_all_active_stores();
        
        foreach ($storeList as $store) {
            $this->savePDF($store['id'], $data['open_date'], $data['to_date']);
        }

        $filename = "allfss_".date('d_m_Y_H_i_s', strtotime('+ 330 minutes')).".zip";
        $path = 'uploads/temppdf';
        $this->zip->read_dir($path);
        $this->zip->download($filename);
    }


    public function downloadallinvoice()
    {
        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-01');
        }
    
        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }
        $invoices=$this->Accounts_model->get_all_invoice($data['open_date'], $data['to_date']);
        
        foreach ($invoices as $invoice) {
            //echo $invoice['id'];
            $this->savePDFInvoice($invoice['id']);
        }

        $filename = "allinvoice_".date('d_m_Y_H_i_s', strtotime('+ 330 minutes')).".zip";
        $path = 'uploads/tempinvoice';
        $this->zip->read_dir($path);
        $this->zip->download($filename);
    }

    public function savePDF($id, $from_date, $to_date)
    {
        check_login_user();
       
        $data['open_date']=$from_date;
        $data['to_date']=$to_date;
        
    
        $openBalance=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $ledgerItems=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date']))), $data['to_date'], $id);

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

        foreach ($ledgerItems as $li) {
            if (preg_match("~\bTD\b~", $li['voucher_no'])) {
                $saleInvoice[]=$li['id'];
            }

            if (preg_match("~\bBharate Pe\b~", $li['descriptions']) && $li['voucher_type'] =='R') {
                $bharatpeR[]=$li['descriptions'];
            }

            if (preg_match("~\bPaytm\b~", $li['descriptions'])  && $li['voucher_type'] =='R') {
                $paytmR[]=$li['descriptions'];
            }


            $html.='<tr>
                        <td width="10%">'.$li['voucher_no'].'</td>
                        <td width="15%">';
            if ($li['voucher_type']=='C') {
                $voucher_type= 'Credit';
            } elseif ($li['voucher_type']=='R') {
                $voucher_type= 'Receipt';
            } elseif ($li['voucher_type']=='D') {
                $voucher_type= 'Debit';
            } else {
                $voucher_type= $li['voucher_type'];
            }
            $html.= $voucher_type.'</td>
                        <td width="15%">'.date("d-m-Y", strtotime($li['voucher_date'])).'</td>
    
                        ';
                        

            if ($li['voucher_type']=='D' or $li['voucher_type']=='Sale') {
                $total_balalnce+=$li['np'];
                $html.='<td class="right" width="10%">'.$li['np'].'</td>';
            } else {
                $html.='<td>-</td>';
            }

            if ($li['voucher_type']=='C' or $li['voucher_type']=='R') {
                $total_balalnce-=$li['np'];
                $html.='<td class="right" width="10%">'.$li['np'].'</td>';
            } else {
                $html.='<td width="10%">-</td>';
            }
                        
                        


            $html.='<td width="30%">'.$li['descriptions'].'</td>
<td class="right" width="10%">'.$total_balalnce.'</td>

</tr>';
        }

        $color='#FF0000';
        if ($total_balalnce < 0) {
            $color='#008000';
        }

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

        if (!empty($saleInvoice)) {
            foreach ($saleInvoice as $sv) {
                $pdf->lastPage();
                $pdf->AddPage();
                $invoice=$this->Accounts_model->get_invoice_by_id($sv);
                $invoiceItems=$this->Accounts_model->get_invoice_item_by_id($sv);

                $orderNos=array();
                foreach ($invoiceItems as $item) {
                    $rawOrderNo=$item->order_nos;
                    $rawOrderNo=explode(',', $rawOrderNo);
                    foreach ($rawOrderNo as $orderNo) {
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
                foreach ($saleRoyaltyData as $data) {
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

        if (!empty($paytmR)) {
            foreach ($paytmR as $sv) {
                $pdf->lastPage();
                $pdf->AddPage();
    
                $paytmRawData=explode(' ', $sv);
                $fromDate=date('Y-m-d', strtotime($paytmRawData[1]));
                $toDate=date('Y-m-d', strtotime($paytmRawData[3]));
                $paytmRoyaltyData=$this->Accounts_model->get_royalty_paytm_data($openBalance['paytm_mid1'], $openBalance['paytm_mid2'], $openBalance['paytm_mid3'], $fromDate, $toDate);
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
                foreach ($paytmRoyaltyData as $data) {
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

        if (!empty($bharatpeR)) {
            foreach ($bharatpeR as $sv) {
                $pdf->lastPage();
                $pdf->AddPage();
    
    
                $bharatRawData=explode(' ', $sv);
                $fromDate=date('Y-m-d', strtotime($bharatRawData[2]));
                $toDate=date('Y-m-d', strtotime($bharatRawData[4]));
                $bharatRoyaltyData=$this->Accounts_model->get_royalty_bharatPe_data($openBalance['bharatpay_id'], $fromDate, $toDate);
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
                foreach ($bharatRoyaltyData as $data) {
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
        
        $pdf->Output(FCPATH.'uploads/temppdf/'.$openBalance['firm_name'].'-fss.pdf', 'F');
    }







    public function downloadledger($id)
    {
        check_login_user();
        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-01');
        }
    
        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }
    
        $openBalance=$this->Accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $ledgerItems=$this->Accounts_model->ledgerItem(date('Y-m-d', strtotime("+1 day", strtotime($data['open_date']))), $data['to_date'], $id);

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

        foreach ($ledgerItems as $li) {
            if (preg_match("~\bTD\b~", $li['voucher_no'])) {
                $saleInvoice[]=$li['id'];
            }

            if (preg_match("~\bBharate Pe\b~", $li['descriptions']) && $li['voucher_type'] =='R') {
                $bharatpeR[]=$li['descriptions'];
            }

            if (preg_match("~\bPaytm\b~", $li['descriptions'])  && $li['voucher_type'] =='R') {
                $paytmR[]=$li['descriptions'];
            }


            $html.='<tr>
                        <td width="10%">'.$li['voucher_no'].'</td>
                        <td width="15%">';
            if ($li['voucher_type']=='C') {
                $voucher_type= 'Credit';
            } elseif ($li['voucher_type']=='R') {
                $voucher_type= 'Receipt';
            } elseif ($li['voucher_type']=='D') {
                $voucher_type= 'Debit';
            } else {
                $voucher_type= $li['voucher_type'];
            }
            $html.= $voucher_type.'</td>
                        <td width="15%">'.date("d-m-Y", strtotime($li['voucher_date'])).'</td>
    
                        ';
                        

            if ($li['voucher_type']=='D' or $li['voucher_type']=='Sale') {
                $total_balalnce+=$li['np'];
                $html.='<td class="right" width="10%">'.$li['np'].'</td>';
            } else {
                $html.='<td>-</td>';
            }

            if ($li['voucher_type']=='C' or $li['voucher_type']=='R') {
                $total_balalnce-=$li['np'];
                $html.='<td class="right" width="10%">'.$li['np'].'</td>';
            } else {
                $html.='<td width="10%">-</td>';
            }
                        
                        


            $html.='<td width="30%">'.$li['descriptions'].'</td>
<td class="right" width="10%">'.$total_balalnce.'</td>

</tr>';
        }

        $color='#FF0000';
        if ($total_balalnce < 0) {
            $color='#008000';
        }

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

        if (!empty($saleInvoice)) {
            foreach ($saleInvoice as $sv) {
                $pdf->lastPage();
                $pdf->AddPage();
                $invoice=$this->Accounts_model->get_invoice_by_id($sv);
                $invoiceItems=$this->Accounts_model->get_invoice_item_by_id($sv);

                $orderNos=array();
                foreach ($invoiceItems as $item) {
                    $rawOrderNo=$item->order_nos;
                    $rawOrderNo=explode(',', $rawOrderNo);
                    foreach ($rawOrderNo as $orderNo) {
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
                foreach ($saleRoyaltyData as $data) {
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

        if (!empty($paytmR)) {
            foreach ($paytmR as $sv) {
                $pdf->lastPage();
                $pdf->AddPage();
    
                $paytmRawData=explode(' ', $sv);
                $fromDate=date('Y-m-d', strtotime($paytmRawData[1]));
                $toDate=date('Y-m-d', strtotime($paytmRawData[3]));
                $paytmRoyaltyData=$this->Accounts_model->get_royalty_paytm_data($openBalance['paytm_mid1'], $openBalance['paytm_mid2'], $openBalance['paytm_mid3'], $fromDate, $toDate);
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
                foreach ($paytmRoyaltyData as $data) {
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

        if (!empty($bharatpeR)) {
            foreach ($bharatpeR as $sv) {
                $pdf->lastPage();
                $pdf->AddPage();
    
    
                $bharatRawData=explode(' ', $sv);
                $fromDate=date('Y-m-d', strtotime($bharatRawData[2]));
                $toDate=date('Y-m-d', strtotime($bharatRawData[4]));
                $bharatRoyaltyData=$this->Accounts_model->get_royalty_bharatPe_data($openBalance['bharatpay_id'], $fromDate, $toDate);
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
                foreach ($bharatRoyaltyData as $data) {
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
