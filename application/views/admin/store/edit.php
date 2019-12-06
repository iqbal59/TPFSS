

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
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
            
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Edit Store <a href="<?php echo base_url('admin/store/') ?>" class="btn btn-info pull-right"><i class="fa fa-list"></i> All Store </a></h4>

                </div>
                <div class="card-body">
                <?php echo form_open('admin/store/edit/'.$store['id']); ?>

                    <div class="form-body">
                        <br>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Store Code <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="store_code" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('store_code') ? $this->input->post('store_code') : $store['store_code']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Store Name  <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="store_name" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('store_name') ? $this->input->post('store_name') : $store['store_name']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Store Crm Code   <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="store_crm_code" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('store_crm_code') ? $this->input->post('store_crm_code') : $store['store_crm_code']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Firm Name   <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="firm_name" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('firm_name') ? $this->input->post('firm_name') : $store['firm_name']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Store City <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="store_city" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('store_city') ? $this->input->post('store_city') : $store['store_city']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Store State <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="store_state" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('store_state') ? $this->input->post('store_state') : $store['store_state']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Email Id <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="email_id" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('email_id') ? $this->input->post('email_id') : $store['email_id']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Gstin No<span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="gstin_no" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('gstin_no') ? $this->input->post('gstin_no') : $store['gstin_no']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Contact Number<span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="contact_number" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('contact_number') ? $this->input->post('contact_number') : $store['contact_number']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Paytm Mid1 <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="paytm_mid1" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('paytm_mid1') ? $this->input->post('paytm_mid1') : $store['paytm_mid1']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Paytm Mid2 <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="paytm_mid2" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('paytm_mid2') ? $this->input->post('paytm_mid2') : $store['paytm_mid2']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>
                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Paytm Mid3 <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="paytm_mid3" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('paytm_mid3') ? $this->input->post('paytm_mid3') : $store['paytm_mid3']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Bharatpay Id <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="bharatpay_id" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('bharatpay_id') ? $this->input->post('bharatpay_id') : $store['bharatpay_id']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Store Address <span class="text-danger">*</span></label>
                                    <div class="col-md-9 controls">
                                        <input type="text" name="store_address" class="form-control" required data-validation-required-message="First Name is required" value="<?php echo ($this->input->post('store_address') ? $this->input->post('store_address') : $store['store_address']); ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3"></label>
                                        <div class="controls">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


<!-- <button type="submit">Save</button> -->

<?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

</div>