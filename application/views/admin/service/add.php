<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Service</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add New Service</li>
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
                    <h4 class="m-b-0 text-white"> Add New Service <a href="<?php echo base_url('admin/service/') ?>"
                            class="btn btn-info pull-right"><i class="fa fa-list"></i> All Serivces </a></h4>

                </div>
                <div class="card-body">

                    <?php echo form_open('admin/service/add'); ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Service Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-sm"
                                value="<?php echo $this->input->post('name'); ?>" />
                            <span class="text-danger"><?php echo form_error('name');?></span>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control form-control-sm"
                                value="<?php echo $this->input->post('code'); ?>" />
                            <span class="text-danger"><?php echo form_error('code');?></span>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Sac Code <span class="text-danger">*</span></label>
                            <input type="text" name="sac_code" class="form-control form-control-sm"
                                value="<?php echo $this->input->post('sac_code'); ?>" />
                            <span class="text-danger"><?php echo form_error('sac_code');?></span>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Royalty <span class="text-danger">*</span></label>
                            <input type="number" name="royality" class="form-control form-control-sm"
                                value="<?php echo $this->input->post('royality'); ?>" required min=0 max=100
                                step=0.01 />
                            <span class="text-danger"><?php echo form_error('royality');?></span>
                        </div>

                        <div class="col-md-12 text-center"><button class="btn btn-success" type="submit">Save</button>
                        </div>


                    </div>




                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

</div>