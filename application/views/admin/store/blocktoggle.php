<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Store</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Block / Unblock</li>
            </ol>
        </div>

    </div>

    <!-- End Bread crumb and right sidebar toggle -->



    <!-- Start Page Content -->

    <div class="row">

        <div class="col-lg-12">

            <?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
            <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i>
                <?php echo $msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                        aria-hidden="true">×</span> </button>
            </div>
            <?php endif ?>

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i>
                <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                        aria-hidden="true">×</span> </button>
            </div>
            <?php endif ?>
        </div>
        <div class="col-lg-6">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Block Store
                    </h4>
                </div>
                <div class="card-body">
                    <?php echo form_open('admin/store/block'); ?>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="store_code">Store Code</label>
                            <input type="text" name="store_code" class="form-control form-control-sm"
                                value="<?php echo $this->input->post('store_code'); ?>" placeholder="e.g. T123" />
                            <span class="text-danger">
                                <?php echo form_error('store_code'); ?>
                            </span>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-danger btn-block">Block</button>
                        </div>

                    </div>
                    <?php echo form_close(); ?>

                    <h3 class="text-center">or</h3>
                    <?php echo form_open_multipart('admin/store/blockbyfile'); ?>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Choose File</label>
                            <input type="file" name="csv_file_upload" class="form-control form-control-sm"
                                value="<?php echo $this->input->post('csv_file_upload'); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('csv_file_upload'); ?>
                            </span>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-danger btn-block">Upload for Block</button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>


        <!-- Second Column-->

        <div class="col-lg-6">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Unblock Store
                    </h4>
                </div>
                <div class="card-body">
                    <?php echo form_open('admin/store/unblock'); ?>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="store_code">Store Code</label>
                            <input type="text" name="store_code" class="form-control form-control-sm"
                                value="<?php echo $this->input->post('store_code'); ?>" placeholder="e.g. T123" />
                            <span class="text-danger">
                                <?php echo form_error('store_code'); ?>
                            </span>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-danger btn-block">Unblock</button>
                        </div>

                    </div>
                    <?php echo form_close(); ?>

                    <h3 class="text-center">or</h3>
                    <?php echo form_open_multipart('admin/store/unblockbyfile'); ?>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Choose File</label>
                            <input type="file" name="csv_file_upload" class="form-control form-control-sm"
                                value="<?php echo $this->input->post('csv_file_upload'); ?>" />
                            <span class="text-danger">
                                <?php echo form_error('csv_file_upload'); ?>
                            </span>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-danger btn-block">Upload for Unblock</button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
        <!-- Second Column end-->

    </div>

    <!-- End Page Content -->

</div>