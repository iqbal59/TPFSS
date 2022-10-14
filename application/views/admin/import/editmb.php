<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Material</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Edit Material</li>
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
                    <h4 class="m-b-0 text-white"> Edit Material Bill <a
                            href="<?php echo base_url('admin/import/mbdata') ?>" class="btn btn-info pull-right"><i
                                class="fa fa-list"></i> All Store </a></h4>

                </div>
                <div class="card-body">
                    <?php echo form_open('admin/import/editmb/'.$store['id']); ?>

                    <div>
                        Invoice Number :
                        <input type="text" name="invoice_no"
                            value="<?php echo ($this->input->post('invoice_no') ? $this->input->post('invoice_no') : $store['invoice_no']); ?>" />
                        <span class="text-danger"><?php echo form_error('invoice_no');?></span>
                    </div>
                    <div>
                        Invoice Date :
                        <input type="text" name="invoice_date"
                            value="<?php echo ($this->input->post('invoice_date') ? $this->input->post('invoice_date') : $store['invoice_date']); ?>" />
                        YYYY-MM-DD
                        <span class="text-danger"><?php echo form_error('invoice_date');?></span>
                    </div>
                    <div>
                        Amount :
                        <input type="text" name="amount"
                            value="<?php echo ($this->input->post('amount') ? $this->input->post('amount') : $store['amount']); ?>" />
                        <span class="text-danger"><?php echo form_error('amount');?></span>
                    </div>
                    <div>
                        Store CRM Code :
                        <input type="text" name="store_crm_code"
                            value="<?php echo ($this->input->post('store_crm_code') ? $this->input->post('store_crm_code') : $store['store_crm_code']); ?>" />
                        <span class="text-danger"><?php echo form_error('store_crm_code');?></span>
                    </div>


                    <div>
                        Description :
                        <input type="text" name="material_description"
                            value="<?php echo ($this->input->post('material_description') ? $this->input->post('material_description') : $store['material_description']); ?>" />
                        <span class="text-danger"><?php echo form_error('material_description');?></span>
                    </div>
                    <button type="submit">Save</button>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

</div>