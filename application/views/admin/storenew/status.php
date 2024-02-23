<?php
defined('BASEPATH') or exit('No direct script access allowed');
$p = array('admin', 'manager', 'pmcc');
if (!(in_array($this->session->userdata('type'), $p))) {
  redirect('auth');
}
$this->load->view('layout/header');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section style="padding: 1px 15px 0 15px;" class="content-header">
        <h5>
            <ol style="margin-bottom: -10px;" class="breadcrumb">
                <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="<?php echo base_url('store/index'); ?>">Store</a></li>
                <li class="active">Make Live Store</li>
            </ol>
        </h5>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Make Store Live</h3>
                        <?php // echo $id; ?>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open("store/status/" . $id, 'class="form-horizontal row-border"'); ?>
                    <div class="box-body" style="padding: 20px">

                        <div class="form-group col-md-5">
                            <label class="form-label" for="store_crm_code">Store CRM Code</label>
                            <input type="text" name="store_crm_code" class="form-control form-control-sm" required
                                value="<?php echo set_value('store_crm_code', $str->store_crm_code); ?>">
                            <span class="text-danger">
                                <?php echo form_error('store_crm_code'); ?>
                            </span>
                        </div>

                        <?php echo form_hidden($csrf); ?>
                        <?php echo form_hidden(array('id' => $id)); ?>
                        <?php echo form_hidden(array('confirm' => 1)); ?>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <?php echo form_submit('submit', 'Submit', 'class="btn btn-info "'); ?>
                        <span class="btn btn-default" id="cancel" style="margin-left: 2%"
                            onclick="cancel('store')">Cancel</span>
                    </div>
                    <!-- /.box-footer -->
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

</div>

<?php
$this->load->view('layout/footer');
?>