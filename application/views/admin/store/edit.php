<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Store</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Edit Store</li>
            </ol>
        </div>

    </div>

    <!-- End Bread crumb and right sidebar toggle -->



    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i>
                <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                        aria-hidden="true">×</span> </button>
            </div>
            <?php endif ?>

            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Edit Store <a href="<?php echo base_url('admin/store/') ?>"
                            class="btn btn-info pull-right"><i class="fa fa-list"></i> All Store </a></h4>

                </div>
                <div class="card-body">
                    <?php echo form_open('admin/store/edit/' . $store['id']); ?>






                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="store_code">Store Code</label>
                            <input type="text" name="store_code" class="form-control form-control-sm"
                                value="<?php echo ($this->input->post('store_code') ? $this->input->post('store_code') : $store['store_code']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('store_code'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Store Name</label>
                            <input type="text" name="store_name" class="form-control form-control-sm"
                                value="<?php echo ($this->input->post('store_name') ? $this->input->post('store_name') : $store['store_name']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('store_name'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-2">
                            <label>Store Crm Code</label>
                            <input type="text" class="form-control form-control-sm" name="store_crm_code"
                                value="<?php echo ($this->input->post('store_crm_code') ? $this->input->post('store_crm_code') : $store['store_crm_code']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('store_crm_code'); ?>
                            </span>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Store Type</label>

                            <select name="store_type" class="form-control form-control-sm">
                                <option value="1" <?php echo ($store['store_type'] == '1' ? "selected" : ""); ?>>
                                    Live
                                </option>

                                <option value="2" <?php echo ($store['store_type'] == '2' ? "selected" : ""); ?>>
                                    CC
                                </option>

                            </select>

                        </div>


                        <div class="form-group col-md-4">
                            <label>Firm Name</label>
                            <input type="text" class="form-control form-control-sm" name="firm_name"
                                value="<?php echo ($this->input->post('firm_name') ? $this->input->post('firm_name') : $store['firm_name']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('firm_name'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Store City</label>
                            <input type="text" name="store_city" class="form-control form-control-sm"
                                value="<?php echo ($this->input->post('store_city') ? $this->input->post('store_city') : $store['store_city']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('store_city'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Store State</label>
                            <input type="text" class="form-control form-control-sm" name="store_state"
                                value="<?php echo ($this->input->post('store_state') ? $this->input->post('store_state') : $store['store_state']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('store_state'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Email Id</label>
                            <input type="text" class="form-control form-control-sm" name="email_id"
                                value="<?php echo ($this->input->post('email_id') ? $this->input->post('email_id') : $store['email_id']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('email_id'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Gstin No</label>
                            <input type="text" class="form-control form-control-sm" name="gstin_no"
                                value="<?php echo ($this->input->post('gstin_no') ? $this->input->post('gstin_no') : $store['gstin_no']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('gstin_no'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" class="form-control form-control-sm"
                                value="<?php echo ($this->input->post('contact_number') ? $this->input->post('contact_number') : $store['contact_number']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('contact_number'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Paytm Mid1</label>
                            <input type="text" class="form-control form-control-sm" name="paytm_mid1"
                                value="<?php echo ($this->input->post('paytm_mid1') ? $this->input->post('paytm_mid1') : $store['paytm_mid1']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('paytm_mid1'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Paytm Mid2</label>
                            <input type="text" class="form-control form-control-sm" name="paytm_mid2"
                                value="<?php echo ($this->input->post('paytm_mid2') ? $this->input->post('paytm_mid2') : $store['paytm_mid2']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('paytm_mid2'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Paytm Mid3</label>
                            <input type="text" class="form-control form-control-sm" name="paytm_mid3"
                                value="<?php echo ($this->input->post('paytm_mid3') ? $this->input->post('paytm_mid3') : $store['paytm_mid3']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('paytm_mid3'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Bharatpay Id</label>
                            <input type="text" class="form-control form-control-sm" name="bharatpay_id"
                                value="<?php echo ($this->input->post('bharatpay_id') ? $this->input->post('bharatpay_id') : $store['bharatpay_id']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('bharatpay_id'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Launch Date</label>
                            <input type="text" class="form-control form-control-sm" name="launch_date"
                                value="<?php echo ($this->input->post('launch_date') ? $this->input->post('launch_date') : $store['launch_date']); ?>" />
                            <small>e.g. YYYY-MM-DD</small>
                            <span class="text-danger">
                                <?php echo form_error('launch_date'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Pan No.</label>
                            <input type="text" class="form-control form-control-sm" name="pan_no"
                                value="<?php echo ($this->input->post('pan_no') ? $this->input->post('pan_no') : $store['pan_no']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('pan_no'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Store Address</label>
                            <textarea name="store_address"
                                class="form-control form-control-sm"><?php echo ($this->input->post('store_address') ? $this->input->post('store_address') : $store['store_address']); ?></textarea>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Opening Balance</label>
                            <input type="text" name="opening_balance" class="form-control form-control-sm"
                                value="<?php echo ($this->input->post('opening_balance') ? $this->input->post('opening_balance') : $store['opening_balance']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('opening_balance'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>GST State CODE</label>
                            <input type="text" name="gst_st_code" class="form-control form-control-sm"
                                value="<?php echo ($this->input->post('gst_st_code') ? $this->input->post('gst_st_code') : $store['gst_st_code']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('gst_st_code'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Discount (%)</label>
                            <input type="text" name="discount" class="form-control form-control-sm"
                                value="<?php echo ($this->input->post('discount') ? $this->input->post('discount') : $store['discount']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('discount'); ?>
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Pin Code</label>
                            <input type="text" name="pin_code" class="form-control form-control-sm"
                                value="<?php echo ($this->input->post('pin_code') ? $this->input->post('pin_code') : $store['pin_code']); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('pin_code'); ?>
                            </span>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Status</label>

                            <select name="is_active" class="form-control form-control-sm">
                                <option value="0"
                                    <?php echo ($store['is_active'] == '0' ? "selected" : ($this->input->post('is_active') == '0' ? "selected" : "")); ?>>
                                    Inactive
                                </option>
                                <option value="1"
                                    <?php echo ($store['is_active'] == '1' ? "selected" : ($this->input->post('is_active') == '1' ? "selected" : "")); ?>>
                                    Active
                                </option>
                            </select>

                        </div>


                    </div>






                    <button type="submit">Save</button>






                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

</div>