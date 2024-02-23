<?php defined('BASEPATH') or exit('No direct script access allowed');

class Storenew extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Storenew_model');
        $this->load->model('Store_model');
    }

    public function index()
    {
        $data['stores'] = $this->Storenew_model->getstores();
        $data['main_content'] = $this->load->view('admin/storenew/store', $data, true);
        $this->load->view('admin/index', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[stores.user_name]');
        $this->form_validation->set_rules('store_code', 'Store Code', 'is_unique[stores_new.store_code]');
        // $this->form_validation->set_rules('store_name', 'CRM Store Name', 'required|is_unique[stores.store_name]');
        // $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|is_unique[stores.firm_name]');
        // $this->form_validation->set_rules('firm_city', 'Firm City', 'required');
        // $this->form_validation->set_rules('firm_state', 'Firm State', 'required');
        // $this->form_validation->set_rules('firm_pan_no', 'Firm Pan number', 'required');
        // $this->form_validation->set_rules('firm_address', 'Firm Address', 'required');
        // $this->form_validation->set_rules('paytm_mid_1', 'Paytm MID', 'required|is_unique[stores.paytm_mid_1]');
        // $this->form_validation->set_rules('firm_pin_code', 'Firm Pin Code', 'required|min_length[6]|max_length[6]');
        // $this->form_validation->set_rules('str_pin_code', 'Store Pin Code', 'required|min_length[6]|max_length[6]');
        $this->form_validation->set_rules('email_id', 'Email ID', 'required|valid_email');
        $this->form_validation->set_rules('mobile_no', 'Partner Mobile Number', 'required|numeric');
        // $this->form_validation->set_rules('str_manager_name', 'Store Manager Name', 'required');
        // $this->form_validation->set_rules('first_pickup', '1st Pickup Slot', 'required');
        // $this->form_validation->set_rules('last_pickup', 'Last Pickup', 'required');
        // $this->form_validation->set_rules('tsm_name', 'TSM Name', 'required');

        if ($this->form_validation->run()) {

            //$post = $this->input->post();

            $formData = array(
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
                'franchise_agreement_date' => $this->input->post('franchise_agreement_date') ? $this->input->post('franchise_agreement_date') : null,
                'additional_info' => json_encode($this->input->post('extrainfo')),
                'machine_info' => json_encode($this->input->post('machine')),

            );

            if ($_FILES['cancelled_cheque']['name'] != "") {
                $config = [
                    'file_name' => time() . str_replace(' ', '_', $_FILES['cancelled_cheque']['name']),
                    'upload_path' => './assets/uploads/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                ];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('cancelled_cheque')) {
                    $formData['cancelled_cheque'] = $this->upload->data('file_name');

                } else {
                    $data['error_message'] = $this->upload->display_errors();



                    $data['main_content'] = $this->load->view('admin/storenew/add_store', $data);
                    $this->load->view('admin/index', $data);
                    return;
                }
            } else {
                $formData['cancelled_cheque'] = "";
            }

            //print_r($formData);

            if ($this->Storenew_model->add_store($formData)) {
                $data['msg'] = $this->session->set_flashdata('msg', 'Store Added Successfully.');
                $data['msg'] = $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $data['msg'] = $this->session->set_flashdata('msg', 'Store Not Added Please Try Again');
                $data['msg'] = $this->session->set_flashdata('msg_class', 'alert-danger');
            }

            return redirect('admin/storenew/index', $data);

        }

        $data['states'] = $this->Storenew_model->getstate();
        $data['main_content'] = $this->load->view('admin/storenew/add_store', $data, true);
        $this->load->view('admin/index', $data);
    }

    public function city()
    {
        $state = $this->input->get('state');
        $cities = $this->Storenew_model->getcity($state);

        $html = "<option value=''>Select</option>";
        foreach ($cities as $city) {
            $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $html;
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $data['states'] = $this->Storenew_model->getstate();
        // $data['cities'] = $this->Storenew_model->getcityrow($id);
        $data['str'] = $this->Storenew_model->tblrow($id);

        // if ($data['str']->status == 2) {
        $data['main_content'] = $this->load->view('admin/storenew/edit_store', $data, true);
        $this->load->view('admin/index', $data);

        // } else {
        //     echo "<h1>Active Store Can Not Be Edit</h1>";
        // }
    }

    public function editnow()
    {

        $this->load->library('form_validation');
        $id = $this->input->post('id');

        $this->form_validation->set_rules('store_code', 'Store Code', 'edit_unique[stores_new.store_code.' . $id . ']');
        // $this->form_validation->set_rules('store_name', 'Store Name', 'required|edit_unique[stores.store_name.' . $id . ']');
        // $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|edit_unique[stores.firm_name.' . $id . ']');
        // $this->form_validation->set_rules('firm_city', 'Firm City', 'required');
        // $this->form_validation->set_rules('firm_state', 'Firm State', 'required');
        // $this->form_validation->set_rules('paytm_mid_1', 'Paytm MID 1', 'required|edit_unique[stores.paytm_mid_1.' . $id . ']');
        $this->form_validation->set_rules('email_id', 'Email ID', 'required|valid_email');
        $this->form_validation->set_rules('mobile_no', 'Partner Mobile Number', 'required|numeric');
        // $this->form_validation->set_rules('firm_pan_no', 'Firm Pan Number', 'required');
        // $this->form_validation->set_rules('firm_address', 'Firm Address', 'required');
        // $this->form_validation->set_rules('firm_pin_code', 'Firm Pin Code', 'required|min_length[6]|max_length[6]');
        // $this->form_validation->set_rules('str_pin_code', 'Store Pin Code', 'required|min_length[6]|max_length[6]');
        // $this->form_validation->set_rules('str_manager_name', 'Store Manager Name', 'required');
        // $this->form_validation->set_rules('first_pickup', '1st Pickup Slot', 'required');
        // $this->form_validation->set_rules('last_pickup', 'Last Pickup Slot', 'required');
        // $this->form_validation->set_rules('tsm_name', 'TSM Name', 'required');


        if ($this->form_validation->run()) {

            $formData = array(
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
                'franchise_agreement_date' => $this->input->post('franchise_agreement_date') ? $this->input->post('franchise_agreement_date') : null,
                'additional_info' => json_encode($this->input->post('extrainfo')),
                'machine_info' => json_encode($this->input->post('machine')),

            );


            if ($_FILES['cancelled_cheque']['name'] != "") {
                $old_img_path = './assets/uploads/' . $this->input->post('old');

                $config = [
                    'file_name' => time() . str_replace(' ', '_', $_FILES['cancelled_cheque']['name']),
                    'upload_path' => './assets/uploads/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                ];
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('cancelled_cheque')) {
                    $formData['cancelled_cheque'] = $this->upload->data('file_name');
                    unlink($old_img_path);

                } else {
                    $data['error_message'] = $this->upload->display_errors();
                    $data['str'] = $this->Storenew_model->tblrow($id);
                    $data['main_content'] = $this->load->view('admin/storenew/edit_store', $data);
                    $this->load->view('admin/index', $data);
                    return;
                }
            } else {
                $formData['cancelled_cheque'] = $this->input->post('old');
            }
            // echo '<pre>';
            // print_r($formData);
            // echo '</pre>';

            if ($formData) {
                if ($this->Storenew_model->edit_store($id, $formData)) {


                    $stateInfo = $this->Storenew_model->getStateName($this->input->post('firm_state'));
                    $params = array(
                        'store_code' => trim($this->input->post('store_code')),
                        'store_name' => $this->input->post('store_name'),
                        'firm_name' => $this->input->post('firm_name'),
                        'store_city' => $this->input->post('firm_city'),
                        'store_state' => $stateInfo->name,
                        'email_id' => $this->input->post('email_id'),
                        'gstin_no' => $this->input->post('gst_no'),
                        'contact_number' => $this->input->post('mobile_no'),
                        'paytm_mid1' => $this->input->post('paytm_mid_1'),
                        'paytm_mid2' => "",
                        'paytm_mid3' => "",
                        'bharatpay_id' => "",  //this field is not in my table
                        'store_address' => $this->input->post('firm_address'),
                        'launch_date' => "",
                        'pan_no' => $this->input->post('firm_pan_no'),
                        'opening_balance' => 0,
                        'is_active' => 1,
                        'gst_st_code' => "",
                        'discount' => 0,
                        'pin_code' => $this->input->post('firm_pin_code'),
                        'store_type' => $this->input->post('is_fofo'),
                        // 'firm_gst_regis_type' => $storeInfo->firm_gst_regis_type,
                        // 'courier_charge_per_kg' => "",
                        // 'out_of_delivery_charge' => ""
                    );

                    $this->Store_model->add_update_store($params);

                    $this->session->set_flashdata('msg', 'Store updated Successfully.');
                    $this->session->set_flashdata('msg_class', 'alert-success');
                } else {
                    $this->session->set_flashdata('msg', 'Store Not updated Please Try Again');
                    $this->session->set_flashdata('msg_class', 'alert-danger');
                }
                return redirect("admin/storenew/index");
            }
        } else {

            $data['states'] = $this->Storenew_model->getstate();
            $data['str'] = $this->Storenew_model->tblrow($id);
            $data['main_content'] = $this->load->view('admin/storenew/edit_store', $data, true);
            $this->load->view('admin/index', $data);
        }
    }

    public function view($id)
    {
        $this->load->library('form_validation');
        $data['states'] = $this->Storenew_model->getstate();
        $data['str'] = $this->Storenew_model->viewtblrow($id);
        $data['main_content'] = $this->load->view('admin/storenew/view_store', $data, true);
        $this->load->view('admin/index', $data);
    }

    public function status($id)
    {
        $this->load->library('form_validation');

        $storeInfo = $this->Storenew_model->tblrow($id);



        if (
            !empty($storeInfo->store_code) && !empty($storeInfo->store_name) && !empty($storeInfo->firm_name)
            && !empty($storeInfo->firm_city) && !empty($storeInfo->firm_state) && !empty($storeInfo->paytm_mid_1)
            && !empty($storeInfo->email_id) && !empty($storeInfo->mobile_no) && !empty($storeInfo->firm_pan_no)
            && !empty($storeInfo->firm_address) && !empty($storeInfo->firm_pin_code)
        ) {




            $params = array(
                'store_code' => trim($storeInfo->store_code),
                'store_name' => $storeInfo->store_name,
                'store_crm_code' => trim($storeInfo->store_crm_code),
                'firm_name' => $storeInfo->firm_name,
                'store_city' => $storeInfo->firm_city,
                'store_state' => $storeInfo->state_name,
                'email_id' => $storeInfo->email_id,
                'gstin_no' => $storeInfo->gst_no,
                'contact_number' => $storeInfo->mobile_no,
                'paytm_mid1' => $storeInfo->paytm_mid_1,
                'paytm_mid2' => "",
                'paytm_mid3' => "",
                'bharatpay_id' => "",  //this field is not in my table
                'store_address' => $storeInfo->firm_address,
                'launch_date' => "",
                'pan_no' => $storeInfo->firm_pan_no,
                'opening_balance' => 0,
                'is_active' => 1,
                'gst_st_code' => "",
                'discount' => 0,
                'pin_code' => $storeInfo->firm_pin_code,
                'store_type' => $storeInfo->is_fofo,
                // 'firm_gst_regis_type' => $storeInfo->firm_gst_regis_type,
                // 'courier_charge_per_kg' => "",
                // 'out_of_delivery_charge' => ""
            );






            if ($this->Store_model->add_update_store($params) > 0) {

                $postData = array(

                    'status' => 1
                );

                $this->Storenew_model->status($id, $postData);

                $this->session->set_flashdata('msg', "Store has been live successfully");
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_flashdata('msg', 'Something is wrong, Try again.');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }

            redirect("admin/storenew/index");

        } else {
            $this->session->set_flashdata('msg', 'Something is wrong, Try again.');
            $this->session->set_flashdata('msg_class', 'alert-danger');
            redirect("admin/storenew/index");
        }


    }

    // public function delete($id)
    // {
    //     // echo $id;
    //     if ($this->Storenew_model->delete($id)) {

    //         $this->session->set_flashdata('msg', 'Store deleted Successfully.');
    //         $this->session->set_flashdata('msg_class', 'alert-success');
    //     } else {
    //         $this->session->set_flashdata('msg', 'Store Not Deleted Please Try Again');
    //         $this->session->set_flashdata('msg_class', 'alert-danger');
    //     }
    //     return redirect("admin/storenew/index");

    // }


}