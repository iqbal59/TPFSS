<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Sale BillData</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"> Sale Bill Data</li>
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
                        <h4 class="m-t-0 text-primary"><?php echo $count->inactive_user; ?></h4>
                    </div>
                </div> -->

            </div>
        </div>
    </div>

    <!-- End Bread crumb and right sidebar toggle -->



    <!-- Start Page Content -->


    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-body">


                    <form id="ledger_form" method="get" action="<?php echo base_url('admin/import/saledatabill') ?>"
                        class="form-horizontal" enctype="multipart/form-data" novalidate>


                        <div class="form-body">
                            <br>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Enter From Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="from_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required
                                                value="<?php if (!empty($search_query)) {
    echo date('Y-m-d', strtotime($search_query['from_dt']));
}?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Enter To Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="to_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required
                                                value="<?php if (!empty($search_query)) {
    echo date('Y-m-d', strtotime($search_query['to_dt']));
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




                <?php if (!empty($salesdata)) {?>

                <div class="card">

                    <div class="card-body">



                        <div class="table-responsive m-t-40">

                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Order Date</th>
                                        <th>Order No.</th>
                                        <th>Store Code</th>
                                        <th>Service Code</th>
                                        <th>Taxable Amount</th>
                                        <th>Net Amount</th>
                                        <th>Is Bill</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($salesdata as $sales) {
    foreach ($sales as $s) {
        ?>
                                    <tr>
                                        <td><?php echo $s['customer_id']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($s['order_date'])); ?></td>
                                        <td><?php echo $s['order_no']; ?></td>
                                        <td><?php echo $s['store_code']; ?></td>
                                        <td><?php echo $s['service_code']; ?></td>
                                        <td><?php echo $s['taxable_amount']; ?></td>
                                        <td><?php echo $s['net_amount']; ?></td>
                                        <td><?php if ($s['is_bill']=='1') {
            echo 'Yes';
        } else {
            echo 'No';
        } ?></td>

                                    </tr>
                                    <?php
    }
}?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <?php }?>



            </div>
        </div>


        <!-- End Page Content -->

    </div>