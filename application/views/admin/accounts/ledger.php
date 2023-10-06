<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Customer Ledger</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Customer Ledger</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">


            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <!-- <h6 class="m-b-0"><small>Active User</small></h6>
                        <h4 class="m-t-0 text-info"><?php echo $count->active_user; ?></h4> -->
                    </div>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <!-- <h6 class="m-b-0"><small>Inctive User</small></h6>
                        <h4 class="m-t-0 text-primary"><?php echo $count->inactive_user; ?></h4> -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- End Bread crumb and right sidebar toggle -->



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







            <div class="card">

                <div class="card-body">
                    <form id="ledger_form" method="post" action="" class="form-horizontal" enctype="multipart/form-data"
                        novalidate>

                        <input type="hidden" id="download_ledger_url_all"
                            value="<?php echo base_url('admin/accounts/downloadledgerall') ?>" />

                        <div class="form-body">
                            <br>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Enter From Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="from_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required
                                                value="<?php echo isset($open_date) ? $open_date : date('Y-m-d', strtotime(date('Y-m-d') . ' -31 days')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Enter To Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="to_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required
                                                value="<?php echo isset($to_date) ? $to_date : date("Y-m-d"); ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <h5>Actions</h5>
                                        <div class="controls">

                                            <button type="button" id="download_ledger_all"
                                                class="btn btn-success">Download All</button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- CSRF token -->
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />


                        </div>

                    </form>
                </div>
            </div>



            <div class="card">

                <div class="card-body">




                    <div class="table-responsive">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>Customer Name</th>
                                    <th>Firm Name</th>
                                    <th>Balance</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Firm Name</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->

                            <tbody>
                                <?php
                                foreach ($ledgers as $l) {
                                    ?>
                                <tr>
                                    <td>
                                        <?php echo $l['store_crm_code'] ?>
                                    </td>
                                    <td>
                                        <?php echo $l['store_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $l['firm_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $l['openbalance'] ?>
                                    </td>
                                    <td> <a href="javascript:void(0)"
                                            onclick="viewledger(<?php echo $l['id']; ?>)">View</a>
                                        <a href=" javascript:void(0)"
                                            onclick="downloadpdf(<?php echo $l['id']; ?>)">Download</a>
                                    </td>
                                </tr>

                                <?php
                                }
                                ?>



                            </tbody>


                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- End Page Content -->

</div>

<script type="text/javascript">
function downloadpdf(store_id) {
    url = "<?php echo base_url('admin/accounts/downloadledger/') ?>";
    $("#ledger_form").attr("action", url + store_id);
    $("#ledger_form").attr("target", "_self");
    $("#ledger_form").submit();
}


function viewledger(store_id) {
    url = "<?php echo base_url('admin/accounts/customerledger/') ?>";
    $("#ledger_form").attr("action", url + store_id);
    $("#ledger_form").attr("target", "_self");
    $("#ledger_form").submit();
}
</script>