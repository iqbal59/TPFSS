<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Partner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('accounts_model');
        $this->load->model('store_model');
        $this->load->model('common_model');
    }


    public function index()
    {
        $data = array();
        $data['page'] = 'Login';
        $this->load->view('partner/login', $data);
    }


    public function recover()
    {
        $data = array();
        $data['page'] = 'Forget Password';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email_id', 'Email ID', 'trim|required|valid_email');



        if ($this->form_validation->run()) {
            if ($storeData=$this->store_model->get_store_by_email_id($this->input->post('email_id'))) {
                $password=$this->random_password(6);
                $params = array(

                    'password' => md5($password),
                    'is_first_login' => 1


                );

                $this->store_model->forget_password($storeData['id'], $params);



                $message="Hi ".$storeData['firm_name'].",<br/><br/>";
                $message.="Please find below the password for <a href='https://simplifytumbledry.in'>simplifytumbledry.in</a> portal <br/><br/>Login ID : <strong>".$storeData['store_crm_code']."</strong><br/><br/>New Password :
                 <strong>".$password."</strong>
                <br/><br/>
                Thanks<br/>
                Tumbledry";



                if ($this->sendEmail($storeData['email_id'], "Forget Password", $message)) {
                    $this->session->set_flashdata('msg', 'Password has been sent to your registerd email id '.$storeData['email_id']);
                    redirect('partner/recover');
                } else {
                    $this->session->set_flashdata('error_msg', 'Something went wrong. Please try again');
                    redirect('partner/recover');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Email Id does not exist.');
                redirect('partner/recover');
            }
        // echo $this->db->last_query();
        } else {
            $this->load->view('partner/recover', $data);
        }
    }



    public function sendEmail($to, $subject, $content)
    {
        // Load PHPMailer library
        $this->load->library('PHPMailer_Lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'digitaloperations@tumbledry.in';
        $mail->Password = 'Wuz17917';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;

        // $mail->Host     = 'outlook.office365.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'deepak.verma@tumbledry.in';
        // $mail->Password = 'Hellboy@06';
        // $mail->SMTPSecure = 'ssl';
        // $mail->Port     = 587;

        $mail->setFrom('digitaloperations@tumbledry.in', 'MIS');
        $mail->addReplyTo('mis@tumbledry.in', 'MIS');


        // Add a recipient
        $mail->addAddress($to);
        // $mail->addAddress('iqbal.alam59@gmail.com');

        // Add cc or bcc
        // $mail->addCC('Gaurav.Teotia@tumbledry.in');
        // $mail->addCC('Gaurav.Nigam@tumbledry.in');
        // $mail->addCC('Sachin.bhatia@tumbledry.in');
        // $mail->addCC('deepak.verma@tumbledry.in');

        //$mail->addBCC('iqbal.alam59@gmail.com');
        // $mail->AddAttachment($attachmentpdf);
        // $mail->AddAttachment($invoicepdf);

        // Email subject
        $mail->Subject = $subject;

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent = $content;

        $mail->Body =$mailContent;

        // Send email
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return true;
        }
    }


    // public function profile()
    // {
    //     check_login_partner();
    //     $id=$this->session->userdata('id');
    //     $data = array();
    //     $data['page'] = 'Profile';
    //     $data['storeData']=$this->store_model->get_store($id);
    //     //echo $this->db->last_query();
    //     $data['main_content'] = $this->load->view('partner/profile', $data, true);
    //     $this->load->view('partner/index', $data);
    // }


    public function random_password($length = 8)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+=-<>?/,.';
        $password = str_shuffle($alphabet);
        return substr($password, 0, $length);
    }

    public function profile()
    {
        check_login_partner();
        $id=$this->session->userdata('id');
        $data = array();
        $data['page'] = 'Profile';
        $data['storeData']=$this->store_model->get_store($id);


        if (isset($data['storeData']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('cur_password', 'Current Password', 'required');

            $this->form_validation->set_rules('new_password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

            if ($this->form_validation->run()) {
                $params = array(

                    'password' => md5($this->input->post('new_password')),
                    'is_first_login' => 0


                );

                if ($this->store_model->change_password($id, $params, $this->input->post('cur_password'))) {
                    $this->session->set_flashdata('msg', 'Password updated Successfully');
                    redirect('partner/profile');
                } else {
                    $this->session->set_flashdata('error_msg', 'Current Passoword is Wrong');
                    redirect('partner/profile');
                }
            //echo $this->db->last_query();
            } else {
                $data['main_content'] = $this->load->view('partner/profile', $data, true);
                $this->load->view('partner/index', $data);
            }
        } else {
            show_error('The store you are trying to edit does not exist.');
        }
    }





    public function log()
    {
        $data = array();
        if ($_POST) {
            $query = $this->login_model->validate_partner();

            //-- if valid
            if ($query) {
                foreach ($query as $row) {
                    $data = array(
                        'id' => $row->id,
                        'name' => $row->firm_name,
                        'email' =>$row->email_id,
                        'role' =>'user',
                        'is_partner_login' => true
                    );



                    $this->session->set_userdata($data);
                    if ($row->is_first_login) {
                        $url = base_url('partner/profile');
                    } else {
                        $url = base_url('partner/dashboard');
                    }
                }
                echo json_encode(array('st'=>1,'url'=> $url)); //--success
            } else {
                echo json_encode(array('st'=>0)); //-- error
            }
        } else {
            $this->load->view('auth', $data);
        }
    }



    public function logout()
    {
        $this->session->sess_destroy();
        $data = array();
        $data['page'] = 'logout';
        //$this->load->view('home/login', $data);
        redirect('home/login');
    }



    public function dashboard()
    {
        check_login_partner();
        $id=$this->session->userdata('id');
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['expense'] = $this->accounts_model->calculate_expense_by_partner_new($id, 4);
        $data['paytm'] = $this->common_model->getPaytmDataMonthly(date('Y-m-01', strtotime('-6 months')), date('Y-m-d'), $id);
        $data['bharatpe'] = $this->common_model->getBharatPeDataMonthly(date('Y-m-01', strtotime('-6 months')), date('Y-m-d'), $id);
        //$this->db->last_query();
        $data['storeData']=$this->accounts_model->calculate_balance_by_store(date('Y-m-d'), $id);
        $data['invoices']=$this->accounts_model->get_all_invoice_by_partner($this->session->userdata('id'), date('Y-m-d', strtotime("-30 days")), date('y-m-d'));
        $data['open_date']=date('Y-m-d', strtotime('-30 days'));
        $data['storebalance']=$this->accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $data['ledgerItems']=$this->accounts_model->ledgerItem(date('Y-m-d', strtotime("-30 days")), date('y-m-d'), $id);
        $data['main_content'] = $this->load->view('partner/home', $data, true);
        $this->load->view('partner/index', $data);
    }



    public function invoice()
    {
        check_login_partner();

        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-d', strtotime('-30 days'));
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }


        $data['invoices']=$this->accounts_model->get_all_invoice_by_partner($this->session->userdata('id'), $data['open_date'], $data['to_date']);
        $data['main_content'] = $this->load->view('partner/invoice', $data, true);
        $this->load->view('partner/index', $data);
    }


    public function summary()
    {
        check_login_partner();
        $curMonth = date("m", time());
        $curQuarter = ceil($curMonth/3);
        $id=$this->session->userdata('id');
        if ($this->input->post('month')) {
            if ($this->input->post('month')=='MONTH') {
                $data['month']=1;
            } elseif ($this->input->post('month')=='QUARTER') {
                $data['month']=3;
            } elseif ($this->input->post('month')=='YEAR') {
                $data['month']=$curMonth;
            } elseif ($this->input->post('month')=='PYEAR') {
                $data['month']=24;
            }
        } else {
            $data['month']=date('n');
        }

        // if ($this->input->post('year')) {
        //     $data['year']=$this->input->post('year');
        // } else {
        //     $data['year']=date('Y');
        // }


        $data['expense'] = $this->accounts_model->calculate_expense_by_partner_new($id, $data['month']);
        //  echo $this->db->last_query();
        $data['main_content'] = $this->load->view('partner/summary', $data, true);
        $this->load->view('partner/index', $data);
    }


    public function ledger()
    {
        check_login_partner();
        $id=$this->session->userdata('id');
        if ($this->input->post('from_date')) {
            $data['open_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['open_date']=date('Y-m-d', strtotime('-30 days'));
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        $data['storebalance']=$this->accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $data['ledgerItems']=$this->accounts_model->ledgerItem($data['open_date'], $data['to_date'], $id);
        $data['main_content'] = $this->load->view('partner/ledger', $data, true);
        $this->load->view('partner/index', $data);
    }



    public function printledger()
    {
        check_login_partner();
        $id=$this->session->userdata('id');
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

        $data['storebalance']=$this->accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $data['ledgerItems']=$this->accounts_model->ledgerItem($data['open_date'], $data['to_date'], $id);
        $this->load->view('admin/accounts/printledger', $data);
    }


    public function exportledger()
    {
        check_login_partner();
        $id=$this->session->userdata('id');
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
        $data['storebalance']=$this->accounts_model->calculate_balance_by_store($data['open_date'], $id);
        $total_balalnce=$data['storebalance']['openbalance'];
        $itemrow=array('', 'Opening Balance', date("d-m-Y", strtotime($data['open_date'])), $total_balalnce, '', '', $total_balalnce);
        fputcsv($output, $itemrow);
        $data['ledgerItems']=$this->accounts_model->ledgerItem($data['open_date'], $data['to_date'], $id);

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
            } else {
                $debit= '';
            }

            if ($row['voucher_type']=='C' or $row['voucher_type']=='R') {
                $credit= $row['np'];
                $total_balalnce-=$row['np'];
            } else {
                $credit='';
            }



            $itemrow=array($row['voucher_no'], $voucher_type, date("d-m-Y", strtotime($row['voucher_date'])), $debit ,$credit, $row['descriptions'], $total_balalnce);


            fputcsv($output, $itemrow);
        }
    }




    public function paytm()
    {
        $id=$this->session->userdata('id');

        // $params['limit'] = 100;
        // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;

        // $config = $this->config->item('pagination');
        // $config['base_url'] = site_url('admin/import/paytmdata/page');
        // $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
        // $this->pagination->initialize($config);


        if ($this->input->post('from_date')) {
            $data['from_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['from_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        $data['paytmdata'] = $this->common_model->getPaytmData($data['from_date'], $data['to_date'], $id);
        // echo $this->db->last_query();
        $data['main_content'] = $this->load->view('partner/paytmdata', $data, true);
        $this->load->view('partner/index', $data);
    }


    public function bharatpay()
    {
        $id=$this->session->userdata('id');

        // $params['limit'] = 100;
        // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;

        // $config = $this->config->item('pagination');
        // $config['base_url'] = site_url('admin/import/paytmdata/page');
        // $config['total_rows'] = $this->common_model->get_all_count_by_table('paytm');
        // $this->pagination->initialize($config);

        if ($this->input->post('from_date')) {
            $data['from_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
        } else {
            $data['from_date']=date('Y-m-01');
        }

        if ($this->input->post('to_date')) {
            $data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));
        } else {
            $data['to_date']=date('Y-m-d');
        }

        $data['bharatpedata'] = $this->common_model->getBharatPeData($data['from_date'], $data['to_date'], $id);
        //echo $this->db->last_query();
        $data['main_content'] = $this->load->view('partner/bharatpe', $data, true);
        $this->load->view('partner/index', $data);
    }
}