<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Customers</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Customers</li>
            </ol>
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

                    <div class="table-responsive">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>Customer Name</th>
                                    <th>Firm Name</th>
                                    <th>Need to pay for unblock</th>

                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                foreach ($ledgers as $l) {
                                    if ($l['openbalance'] <= 0)
                                        continue;
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