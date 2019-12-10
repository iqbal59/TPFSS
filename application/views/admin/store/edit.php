

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

<div>
    Store Code : 
    <input type="text" name="store_code" value="<?php echo ($this->input->post('store_code') ? $this->input->post('store_code') : $store['store_code']); ?>" />
    <span class="text-danger"><?php echo form_error('store_code');?></span>
</div>
<div>
    Store Name : 
    <input type="text" name="store_name" value="<?php echo ($this->input->post('store_name') ? $this->input->post('store_name') : $store['store_name']); ?>" />
    <span class="text-danger"><?php echo form_error('store_name');?></span>
</div>
<div>
    Store Crm Code : 
    <input type="text" name="store_crm_code" value="<?php echo ($this->input->post('store_crm_code') ? $this->input->post('store_crm_code') : $store['store_crm_code']); ?>" />
    <span class="text-danger"><?php echo form_error('store_crm_code');?></span>
</div>
<div>
    Firm Name : 
    <input type="text" name="firm_name" value="<?php echo ($this->input->post('firm_name') ? $this->input->post('firm_name') : $store['firm_name']); ?>" />
    <span class="text-danger"><?php echo form_error('firm_name');?></span>           
</div>
<div>
    Store City : 
    <input type="text" name="store_city" value="<?php echo ($this->input->post('store_city') ? $this->input->post('store_city') : $store['store_city']); ?>" />
</div>
<div>
    Store State : 
    <input type="text" name="store_state" value="<?php echo ($this->input->post('store_state') ? $this->input->post('store_state') : $store['store_state']); ?>" />
</div>
<div>
    Email Id : 
    <input type="text" name="email_id" value="<?php echo ($this->input->post('email_id') ? $this->input->post('email_id') : $store['email_id']); ?>" />
    <span class="text-danger"><?php echo form_error('email_id');?></span> 
</div>
<div>
    Gstin No : 
    <input type="text" name="gstin_no" value="<?php echo ($this->input->post('gstin_no') ? $this->input->post('gstin_no') : $store['gstin_no']); ?>" />
</div>
<div>
    Contact Number : 
    <input type="text" name="contact_number" value="<?php echo ($this->input->post('contact_number') ? $this->input->post('contact_number') : $store['contact_number']); ?>" />
</div>
<div>
    Paytm Mid1 : 
    <input type="text" name="paytm_mid1" value="<?php echo ($this->input->post('paytm_mid1') ? $this->input->post('paytm_mid1') : $store['paytm_mid1']); ?>" />
    <span class="text-danger"><?php echo form_error('paytm_mid1');?></span> 
</div>
<div>
    Paytm Mid2 : 
    <input type="text" name="paytm_mid2" value="<?php echo ($this->input->post('paytm_mid2') ? $this->input->post('paytm_mid2') : $store['paytm_mid2']); ?>" />
    <span class="text-danger"><?php echo form_error('paytm_mid2');?></span>
</div>
<div>
    Paytm Mid3 : 
    <input type="text" name="paytm_mid3" value="<?php echo ($this->input->post('paytm_mid3') ? $this->input->post('paytm_mid3') : $store['paytm_mid3']); ?>" />
    <span class="text-danger"><?php echo form_error('paytm_mid3');?></span>
</div>
<div>
    Bharatpay Id : 
    <input type="text" name="bharatpay_id" value="<?php echo ($this->input->post('bharatpay_id') ? $this->input->post('bharatpay_id') : $store['bharatpay_id']); ?>" />
    <span class="text-danger"><?php echo form_error('bharatpay_id');?></span>
</div>

<div>
    Launch Date : 
    <input type="text" name="launch_date" value="<?php echo ($this->input->post('launch_date') ? $this->input->post('launch_date') : $store['launch_date']); ?>" />   e.g. YYYY-MM-DD
    <span class="text-danger"><?php echo form_error('launch_date');?></span>
</div>

<div>
    Pan No : 
    <input type="text" name="pan_no" value="<?php echo ($this->input->post('pan_no') ? $this->input->post('pan_no') : $store['pan_no']); ?>" />
</div>



<div>
    Store Address : 
    <textarea name="store_address"><?php echo ($this->input->post('store_address') ? $this->input->post('store_address') : $store['store_address']); ?></textarea>
</div>

<button type="submit">Save</button>

<?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

</div>