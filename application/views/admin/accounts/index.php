<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Royalty Invoice</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Royalty Invoice</li>
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
                    <form id="ledger_form" method="post"
                        action="<?php echo base_url('admin/accounts') ?>"
                        class="form-horizontal" enctype="multipart/form-data" novalidate>

                        <input type="hidden" id="show_invoice_url"
                            value="<?php echo base_url('admin/accounts') ?>" />
                            <input type="hidden" id="download_all_invoice_url"
                            value="<?php echo base_url('admin/accounts/downloadallinvoice') ?>" />

                        <div class="form-body">
                            <br>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Enter From Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="from_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required
                                                value="<?php echo isset($open_date)?$open_date:date("Y-m-01");?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Enter To Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="to_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required
                                                value="<?php echo isset($to_date)?$to_date:date("Y-m-d");?>">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <h5>Actions</h5>
                                        <div class="controls">
                                            <button type="button" id="show_invoice" class="btn btn-success">Show</button>
                                            <button type="button" id="download_all_invoice" class="btn btn-success">Download All Invoice</button>
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

            
            <div class="card">

                <div class="card-body">

                    <a href="<?php echo base_url('admin/accounts/createinvoices') ?>" class="btn btn-info pull-right"><i
                            class="fa fa-plus"></i> Create Invoice</a>


                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Date</th>
                                    <th>Store Name</th>
                                    <th>Net Amount</th>
                                    <th>Action</th>

                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Date</th>
                                    <th>Store Name</th>
                                    <th>Net Amount</th>
                                    <th>Action</th>

                                    <!-- <th>Action</th> -->
                                </tr>
                            </tfoot>

                            <tbody>



                                <?php
                            
                          //  print_r($invoices);
                            foreach ($invoices as $invoice): ?>

                                <tr>

                                    <td><?php echo $invoice['id']; ?></td>
                                    <td><?php echo $invoice['invoice_date']; ?></td>
                                    <td><?php echo $invoice['store_name']; ?></td>
                                    <td><?php echo $invoice['net_amount']; ?></td>



                                    <td class="text-nowrap">


                                        <a href="<?php echo base_url('admin/accounts/invoicepdf/'.$invoice['id']) ?>"
                                            target="_blank" data-toggle="tooltip" data-original-title="View"> <i
                                                class="fa fa-file-text  text-success m-r-10"></i> </a>
                                        <a href="<?php echo base_url('admin/accounts/invoicepdfdownload/'.$invoice['id']) ?>"
                                            data-toggle="tooltip" data-original-title="Download"> <i
                                                class="fa fa-file-pdf-o  text-success m-r-10"></i>
                                        </a>







                                    </td>
                                </tr>

                                <?php endforeach ?>

                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Page Content -->

</div>