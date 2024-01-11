<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Store extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Store_model');
        $this->load->model('Service_model');
    }

    /*
     * Listing of stores
     */
    public function index()
    {
        $params['limit'] = 10;
        //echo $this->input->get('page');
        $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;

        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('/admin/store/index');
        $config['total_rows'] = $this->Store_model->get_all_stores_count();
        $this->pagination->initialize($config);

        $data['stores'] = $this->Store_model->get_all_stores($params);

        $data['main_content'] = $this->load->view('admin/store/index', $data, true);
        $this->load->view('admin/index', $data);
    }


    public function amcstore()
    {
        $params['limit'] = 10;
        // echo $this->input->get('page');
        // $params['offset'] = ($this->input->get('page')) ? $this->input->get('page') : 0;

        // $config = $this->config->item('pagination');
        // $config['base_url'] = site_url('/admin/store/index');
        // $config['total_rows'] = $this->Store_model->get_all_stores_count();
        // $this->pagination->initialize($config);

        $data['stores'] = $this->Store_model->get_all_active_stores_with_balance();

        $data['main_content'] = $this->load->view('admin/store/amcstore', $data, true);
        $this->load->view('admin/index', $data);
    }

    /*
     * Adding a new store
     */
    public function add()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('store_code', 'Store Code', 'required|is_unique[stores.store_code]');
        $this->form_validation->set_rules('store_crm_code', 'Store CRM Code', 'required|is_unique[stores.store_crm_code]');
        $this->form_validation->set_rules('store_name', 'Store Name', 'required|is_unique[stores.store_name]');
        $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|is_unique[stores.firm_name]');
        $this->form_validation->set_rules('bharatpay_id', 'Bharat Pay Id', 'is_unique[stores.bharatpay_id]');
        $this->form_validation->set_rules('paytm_mid1', 'Paytm MID1', 'is_unique[stores.paytm_mid1]');
        $this->form_validation->set_rules('paytm_mid2', 'Paytm MID2', 'is_unique[stores.paytm_mid2]');
        $this->form_validation->set_rules('paytm_mid3', 'Paytm MID3', 'is_unique[stores.paytm_mid3]');
        $this->form_validation->set_rules('pin_code', 'Pin Code', 'required|min_length[6]|max_length[6]');
        $this->form_validation->set_rules('email_id', 'Email ID', 'required|valid_email');

        if ($this->form_validation->run()) {
            $params = array(
                'store_code' => $this->input->post('store_code'),
                'store_name' => $this->input->post('store_name'),
                'store_crm_code' => $this->input->post('store_crm_code'),
                'firm_name' => $this->input->post('firm_name'),
                'store_city' => $this->input->post('store_city'),
                'store_state' => $this->input->post('store_state'),
                'email_id' => $this->input->post('email_id'),
                'gstin_no' => $this->input->post('gstin_no'),
                'contact_number' => $this->input->post('contact_number'),
                'paytm_mid1' => $this->input->post('paytm_mid1'),
                'paytm_mid2' => $this->input->post('paytm_mid2'),
                'paytm_mid3' => $this->input->post('paytm_mid3'),
                'bharatpay_id' => $this->input->post('bharatpay_id'),
                'store_address' => $this->input->post('store_address'),
                'launch_date' => $this->input->post('launch_date'),
                'pan_no' => $this->input->post('pan_no'),
                'opening_balance' => $this->input->post('opening_balance'),
                'is_active' => $this->input->post('is_active'),
                'gst_st_code' => $this->input->post('gst_st_code'),
                'discount' => $this->input->post('discount'),
                'pin_code' => $this->input->post('pin_code'),
                'store_type' => $this->input->post('store_type'),
            );

            $store_id = $this->Store_model->add_store($params);
            $this->session->set_flashdata('msg', 'Store added Successfully');
            redirect('admin/store/index');
        } else {
            $data['main_content'] = $this->load->view('admin/store/add', null, true);
            $this->load->view('admin/index', $data);
        }
    }

    //Block/Unblock Store in QDC

    public function blocktoggle()
    {
        $this->load->library('form_validation');
        $data['main_content'] = $this->load->view('admin/store/blocktoggle', null, true);
        $this->load->view('admin/index', $data);
    }


    public function block()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('store_code', 'Store Code', 'required');

        if ($this->form_validation->run()) {

            $this->load->library('tumbledryqdc');
            $params = array(

                "ClientID" => "2469",
                "RoleName" => array(
                    "Store Incharge",
                    "Store Incharge Limited Access",
                    "Mobile POS"
                ),
                "StoreCode" => trim($this->input->post('store_code')),
                "IsEnable" => "false"

            );


            $response = $this->tumbledryqdc->QDCLiveApi('EnableDisableUserByRoleName', $params);
            $response = json_decode($response);
            if ($response->Status == 'True')
                $this->session->set_flashdata('msg', 'Store blocked Successfully');
            else
                $this->session->set_flashdata('error_msg', 'Somthing went wrong');
            redirect('admin/store/blocktoggle');
        } else {
            $data['main_content'] = $this->load->view('admin/store/blocktoggle', null, true);
            $this->load->view('admin/index', $data);
        }
    }


    public function blockbyfile()
    {
        if ($_FILES) {
            $file = $_FILES['csv_file_upload']['tmp_name'];
            if ($file == null) {
                show_error('Please select a file to import');
                $this->session->set_flashdata('error_msg', "Please select file");
                redirect('admin/import/blocktoggle');
            } else {
                $handle = fopen($file, "r") or die("err");
                $row = 0;
                $stores = array();
                $this->load->library('tumbledryqdc');
                while (($filesop = fgetcsv($handle, 10000, ",")) !== false) {

                    if ($row++ < 1 || $filesop[0] == '')
                        continue;

                    $params = array(

                        "ClientID" => "2469",
                        "RoleName" => array(
                            "Store Incharge",
                            "Store Incharge Limited Access",
                            "Mobile POS"
                        ),
                        "StoreCode" => trim($filesop[0]),
                        "IsEnable" => "false"

                    );

                    // print_r($params);
                    $response = $this->tumbledryqdc->QDCLiveApi('EnableDisableUserByRoleName', $params);
                    $response = json_decode($response);
                    if ($response->Status == 'True')
                        $stores[] = $filesop[0];

                }


            }


            $this->session->set_flashdata('msg', implode(",", $stores) . ' store blocked Successfully');

            redirect('admin/store/blocktoggle');
        } else {
            //show_error('Please select a file to import');
            $this->session->set_flashdata('error_msg', "Please select file");
            redirect('admin/store/blocktoggle');
        }
    }



    public function unblock()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('store_code', 'Store Code', 'required');

        if ($this->form_validation->run()) {

            $this->load->library('tumbledryqdc');
            $params = array(

                "ClientID" => "2469",
                "RoleName" => array(
                    "Store Incharge",
                    "Store Incharge Limited Access",
                    "Mobile POS"
                ),
                "StoreCode" => trim($this->input->post('store_code')),
                "IsEnable" => "true"

            );


            $response = $this->tumbledryqdc->QDCLiveApi('EnableDisableUserByRoleName', $params);
            $response = json_decode($response);
            if ($response->Status == 'True')
                $this->session->set_flashdata('msg', 'Store unblock Successfully');
            else
                $this->session->set_flashdata('error_msg', 'Somthing went wrong');
            redirect('admin/store/blocktoggle');
        } else {
            $data['main_content'] = $this->load->view('admin/store/blocktoggle', null, true);
            $this->load->view('admin/index', $data);
        }
    }


    public function unblockbyfile()
    {
        if ($_FILES) {
            $file = $_FILES['csv_file_upload']['tmp_name'];
            if ($file == null) {
                show_error('Please select a file to import');
                $this->session->set_flashdata('error_msg', "Please select file");
                redirect('admin/import/blocktoggle');
            } else {
                $handle = fopen($file, "r") or die("err");
                $row = 0;
                $stores = array();
                $this->load->library('tumbledryqdc');
                while (($filesop = fgetcsv($handle, 10000, ",")) !== false) {

                    if ($row++ < 1 || $filesop[0] == '')
                        continue;

                    $params = array(

                        "ClientID" => "2469",
                        "RoleName" => array(
                            "Store Incharge",
                            "Store Incharge Limited Access",
                            "Mobile POS"
                        ),
                        "StoreCode" => trim($filesop[0]),
                        "IsEnable" => "true"

                    );

                    // print_r($params);
                    $response = $this->tumbledryqdc->QDCLiveApi('EnableDisableUserByRoleName', $params);
                    $response = json_decode($response);
                    if ($response->Status == 'True')
                        $stores[] = $filesop[0];

                }


            }


            $this->session->set_flashdata('msg', implode(",", $stores) . ' store unblock Successfully');

            redirect('admin/store/blocktoggle');
        } else {
            //show_error('Please select a file to import');
            $this->session->set_flashdata('error_msg', "Please select file");
            redirect('admin/store/blocktoggle');
        }
    }

    //Block/Unblock Store in QDC End



    /*
     * Editing a store
     */
    public function edit($id)
    {
        // check if the store exists before trying to edit it
        $data['store'] = $this->Store_model->get_store($id);

        if (isset($data['store']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('store_code', 'Store Code', 'required|edit_unique[stores.store_code.' . $data['store']['id'] . ']');
            $this->form_validation->set_rules('store_crm_code', 'Store CRM Code', 'required|edit_unique[stores.store_crm_code.' . $data['store']['id'] . ']');
            $this->form_validation->set_rules('store_name', 'Store Name', 'required|edit_unique[stores.store_name.' . $data['store']['id'] . ']');
            $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|edit_unique[stores.firm_name.' . $data['store']['id'] . ']');
            $this->form_validation->set_rules('bharatpay_id', 'Bharat Pay Id', 'edit_unique[stores.bharatpay_id.' . $data['store']['id'] . ']');
            $this->form_validation->set_rules('paytm_mid1', 'Paytm MID1', 'edit_unique[stores.paytm_mid1.' . $data['store']['id'] . ']');
            $this->form_validation->set_rules('paytm_mid2', 'Paytm MID2', 'edit_unique[stores.paytm_mid2.' . $data['store']['id'] . ']');
            $this->form_validation->set_rules('paytm_mid3', 'Paytm MID3', 'edit_unique[stores.paytm_mid3.' . $data['store']['id'] . ']');
            //$this->form_validation->set_rules('email_id','Email ID','required|valid_email|edit_unique[stores.email_id.'.$data['store']['id'].']');
            $this->form_validation->set_rules('pin_code', 'Pin Code', 'required|min_length[6]|max_length[6]');

            if ($this->form_validation->run()) {
                $params = array(
                    'store_code' => $this->input->post('store_code'),
                    'store_name' => $this->input->post('store_name'),
                    'store_crm_code' => $this->input->post('store_crm_code'),
                    'firm_name' => $this->input->post('firm_name'),
                    'store_city' => $this->input->post('store_city'),
                    'store_state' => $this->input->post('store_state'),
                    'email_id' => $this->input->post('email_id'),
                    'gstin_no' => $this->input->post('gstin_no'),
                    'contact_number' => $this->input->post('contact_number'),
                    'paytm_mid1' => $this->input->post('paytm_mid1'),
                    'paytm_mid2' => $this->input->post('paytm_mid2'),
                    'paytm_mid3' => $this->input->post('paytm_mid3'),
                    'bharatpay_id' => $this->input->post('bharatpay_id'),
                    'store_address' => $this->input->post('store_address'),
                    'launch_date' => $this->input->post('launch_date'),
                    'pan_no' => $this->input->post('pan_no'),
                    'opening_balance' => $this->input->post('opening_balance'),
                    'is_active' => $this->input->post('is_active'),
                    'gst_st_code' => $this->input->post('gst_st_code'),
                    'discount' => $this->input->post('discount'),
                    'pin_code' => $this->input->post('pin_code'),
                    'store_type' => $this->input->post('store_type'),
                );

                $this->Store_model->update_store($id, $params);
                $this->session->set_flashdata('msg', 'Store updated Successfully');
                redirect('admin/store/index');
            } else {
                $data['main_content'] = $this->load->view('admin/store/edit', $data, true);
                $this->load->view('admin/index', $data);
            }
        } else {
            show_error('The store you are trying to edit does not exist.');
        }
    }


    /*
     * Add a store royalty
     */
    public function royalty($id)
    {
        // check if the store exists before trying to edit it
        $data['store'] = $this->Store_model->get_store($id);
        $data['services'] = $this->Store_model->get_store_all_royalties($id);

        if (isset($data['store']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('store_royalty[]', 'Store Royalty', 'required');

            if ($this->form_validation->run()) {
                $params = array(

                    'store_royalty' => $this->input->post('store_royalty'),
                    'royality' => $this->input->post('royality'),

                );
                //print_r($params['store_royalty']);
                $this->Store_model->update_store_royality($id, $params);
                $this->session->set_flashdata('msg', 'Royality updated Successfully');
                redirect('admin/store/index');
            } else {
                $data['main_content'] = $this->load->view('admin/store/royalty', $data, true);
                $this->load->view('admin/index', $data);
            }
        } else {
            show_error('The store you are trying to edit does not exist.');
        }
    }


    /*
     * Deleting store
     */
    public function remove($id)
    {
        $store = $this->Store_model->get_store($id);

        // check if the store exists before trying to delete it
        if (isset($store['id'])) {
            $this->Store_model->delete_store($id);
            $this->session->set_flashdata('msg', 'Store deleted Successfully');
            redirect('admin/store/index');
        } else {
            show_error('The store you are trying to delete does not exist.');
        }
    }

    public function amcupdate($id)
    {
        $store = $this->Store_model->get_store($id);

        // check if the store exists before trying to delete it
        if (isset($store['id'])) {
            if ($this->input->get('act') == 'remove') {
                $this->Store_model->update_store($id, array('is_amc' => '2'));
                $this->session->set_flashdata('msg', 'AMC Service removed Successfully');
            } else if ($this->input->get('act') == 'add') {
                $this->Store_model->update_store($id, array('is_amc' => '1'));
                $this->session->set_flashdata('msg', 'AMC Service added Successfully');
            }

            redirect('admin/store/amcstore');
        } else {
            show_error('The store you are trying to delete does not exist.');
        }
    }



}