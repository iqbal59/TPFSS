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
               

                    <form id="ledger_form" method="post"
                        action="<?php echo base_url('admin/accounts/customerledger/'.$storebalance['id']) ?>"
                        class="form-horizontal" enctype="multipart/form-data" novalidate>

                        <input type="hidden" id="show_ledger_url"
                            value="<?php echo base_url('admin/accounts/customerledger/'.$storebalance['id']) ?>" />
                        <input type="hidden" id="print_ledger_url"
                            value="<?php echo base_url('admin/accounts/printledger/'.$storebalance['id']) ?>" />
                        <input type="hidden" id="download_ledger_url"
                            value="<?php echo base_url('admin/accounts/downloadledger/'.$storebalance['id']) ?>" />

                            <input type="hidden" id="export_ledger_url"
                            value="<?php echo base_url('admin/accounts/exportledger/'.$storebalance['id']) ?>" />
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
                                            <button type="button" id="show_ledger" class="btn btn-success">Show</button>
                                            <button type="button" id="print_ledger"
                                                class="btn btn-success">Print</button>
                                            <button type="button" id="download_ledger"
                                                class="btn btn-success">Download</button>

                                                <button type="button" id="export_ledger"
                                                class="btn btn-success">Export</button>
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


                   
                            <h3><?php echo $storebalance['store_name'];?></h3>
                    <div class="table-responsive m-t-40">
                        <table id="" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Voucher No.</th>
                                    <th>Voucher Type</th>
                                    <th>Voucher Date</th>
                                    <!-- <th>Sale</th>
                                    <th>Receipt</th> -->
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Descriptions</th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                <th>Customer Name</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                             -->
                            <tbody>

                                <tr>
                                    <td>-</td>
                                    <td>Opening Balance</td>
                                    <td><?php echo date("d-m-Y", strtotime($open_date));?></td>
                                    <td><?php echo $total_balalnce=$storebalance['openbalance'];?></td>
                                    <!-- <td>-</td>
                            <td>-</td> -->
                                    <td>-</td>
                                    <td>-</td>
                                    <td><?php echo $total_balalnce=$storebalance['openbalance'];?></td>

                                </tr>

                                <?php
                        
                          //  print_r($ledgerItems);

foreach ($ledgerItems as $li) {?>

                                <tr>
                                    <td><?php echo $li['voucher_no'];?></td>
                                    <td><?php
                            
                            if ($li['voucher_type']=='C') {
                                echo 'Credit';
                            } elseif ($li['voucher_type']=='R') {
                                echo 'Receipt';
                            } elseif ($li['voucher_type']=='D') {
                                echo 'Debit';
                            } else {
                                echo $li['voucher_type'];
                            }
                            ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($li['voucher_date']));?></td>

                                    <td><?php if ($li['voucher_type']=='D' or $li['voucher_type']=='Sale') {
                                echo $li['np'];
                                $total_balalnce+=$li['np'];
                            }?>
                                    </td>
                                    <td><?php if ($li['voucher_type']=='C' or  $li['voucher_type']=='R') {
                                echo $li['np'];
                                $total_balalnce-=$li['np'];
                            }?>
                                    </td>
                                    <td><?php echo  $li['descriptions'];?></td>
                                    <td><?php echo $total_balalnce;?></td>

                                </tr>


                                <?php }

?>



                            </tbody>


                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <!-- <th>-</th>
                                    <th>-</th> -->
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th><strong><?php echo $total_balalnce;?></strong></th>

                                </tr>
                            </tfoot>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Page Content -->

</div>