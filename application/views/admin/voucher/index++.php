<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Voucher</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">All Vouchers</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">


            <div class="d-flex m-t-10 justify-content-end">
                <!-- <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>Active Store</small></h6>
                        <h4 class="m-t-0 text-info">21</h4>
                    </div>
                </div> -->
                <!-- <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>Inctive User</small></h6>
                        <h4 class="m-t-0 text-primary"><?php echo $count->inactive_user; ?>
                </h4>
            </div>
        </div> -->

            </div>
        </div>
    </div>

    <!-- End Bread crumb and right sidebar toggle -->


    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-body">


                    <form id="ledger_form" method="get" action="<?php echo base_url('admin/voucher') ?>"
                        class="form-horizontal" enctype="multipart/form-data" novalidate>


                        <div class="form-body">
                            <br>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Enter From Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="from_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required value="<?php if (!empty($search_query)) {
    echo date('Y-m-d', strtotime($search_query['from_dt']));
} else {
    echo date('Y-m-01');
}?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Enter To Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="to_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required value="<?php if (!empty($search_query)) {
    echo date('Y-m-d', strtotime($search_query['to_dt']));
} else {
    echo date('Y-m-d');
}?>">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <h5>Actions</h5>
                                        <div class="controls">
                                            <button type="submit" class="btn btn-success">Show</button>

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- CSRF token -->
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
                                value="<?=$this->security->get_csrf_hash();?>" />




                    </form>
                </div>
            </div>

        </div>


        <!-- Start Page Content -->

        <div class="row">
            <div class="col-12">

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
                <?php if ($vouchers) {?>
                <div class="card">

                    <div class="card-body">

                        <?php if ($this->session->userdata('role') == 'admin'): ?>
                        <a href="<?php echo base_url('admin/voucher/add') ?>" class="btn btn-info pull-right"><i
                                class="fa fa-plus"></i> Add New Voucher</a> &nbsp;


                        <?php else: ?>
                        <!-- check logged user role permissions -->

                        <?php if (check_power(1)):?>
                        <a href="<?php echo base_url('admin/voucher/add') ?>" class="btn btn-info pull-right"><i
                                class="fa fa-plus"></i> Add New Voucher</a>
                        <?php endif; ?>
                        <?php endif ?>



                        <div class="col-md-12">
                            <table id="table-voucher" class="table table-striped"
                                style="table-layout:fixed; width:100%">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">Sr. No.</th>
                                        <th>Voucher ID</th>
                                        <th>Voucher Type</th>
                                        <th>Store Id</th>
                                        <th>Amount</th>
                                        <th class="wrapword col-md-4">Desc</th>
                                        <th>Create Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!-- <div class="pull-right">
                                    <?php //echo $this->pagination->create_links();?>
                    </div> -->

                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>


        <!-- End Page Content -->

    </div>