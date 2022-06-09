<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->


    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php //print_r($storeData);?>
                    <h4 class="m-b-0 text-center">Current Outstanding: ₹
                        <strong><?php echo $storeData['openbalance'];?></strong>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php if ($storeData['openbalance'] > 0) {?>
                        <a href="#" class="btn btn-primary">Pay Now</a> <?php }?>
                    </h4>

                    <p class="text-center m-b-0"><?php if ($storeData['openbalance'] > 0) {
    echo $this->session->userdata('name')." pay to tumbledry";
} else {
    echo "tumbledry pay to ".$this->session->userdata('name');
}?>
                    </p>



                </div>
            </div>
        </div>
        <!-- Column -->

    </div>



    <!-- Row -->
    <div class="row my-flex-card">
        <!-- Column -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Royalty Invoices</h4>

                    <div class="table-responsive">
                        <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Invoice No.</th>
                                    <th>Date</th>

                                    <th>Net Amount</th>
                                    <th>Action</th>


                                </tr>
                            </thead>

                            <tbody>



                                <?php
                            
                            $sr_no=1;
                            foreach ($invoices as $invoice): ?>

                                <tr>
                                    <td><?php echo $sr_no++;?>
                                    </td>
                                    <td><?php echo $invoice['invoice_no']; ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($invoice['invoice_date'])); ?>
                                    </td>

                                    <td><?php echo $invoice['net_amount']; ?>
                                    </td>



                                    <td class="text-nowrap">


                                        <a href="<?php echo base_url('admin/accounts/invoicepdfdownload/'.$invoice['id']) ?>"
                                            data-toggle="tooltip" data-original-title="Download"> <i
                                                class="fa fa-file-pdf-o  text-danger m-r-10"></i>
                                        </a>







                                    </td>
                                </tr>

                                <?php endforeach ?>

                            </tbody>


                        </table>
                    </div>

                    <a href="<?php echo base_url('partner/invoice')?>"
                        class="btn btn-warning btn-sm pull-right">more</a>

                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 ">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Account Summary
                    </h4>

                    <?php //print_r($expense);?>

                    <div class="table-responsive">
                        <table id="" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Revenue</th>
                                    <th>Total Expense</th>
                                    <th>Consumable</th>
                                    <th>Royalty</th>
                                    <th>Credit</th>
                                    <th>Debit</th>


                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($expense as $e) { ?>
                                <tr>
                                    <td><?php echo $e['m'];?>
                                    <td><?php echo $e['totalsales'];?>
                                    </td>
                                    <td><?php echo($e['msales']+$e['rsales']+$e['debit']-$e['credit']);?>
                                    </td>
                                    <td><?php echo $e['msales'];?>
                                    </td>
                                    <td><?php echo $e['rsales'];?>
                                    </td>
                                    <td><?php echo $e['credit'];?>
                                    </td>
                                    <td><?php echo $e['debit'];?>
                                    </td>


                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>

                    <a href="<?php echo base_url('partner/summary')?>"
                        class="btn btn-warning btn-sm pull-right">more</a>
                </div>
            </div>



        </div>
        <!-- Column -->
    </div>






    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">


                    <h6 class="m-b-20 text-center">Account statement for period
                        <?php echo date('d-m-Y', strtotime($open_date));?>
                        to <?php echo date('d-m-Y');?>
                    </h6>
                    <div class="table-responsive">
                        <table id="" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Voucher No.</th>
                                    <th>Voucher Type</th>
                                    <th>Voucher Date</th>

                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Descriptions</th>
                                    <th>Total</th>

                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>-</td>
                                    <td>Opening Balance</td>
                                    <td><?php echo date("d-m-Y", strtotime($open_date));?>
                                    </td>
                                    <td><?php echo $total_balalnce=$storebalance['openbalance'];?>
                                    </td>

                                    <td>-</td>
                                    <td>-</td>
                                    <td><?php echo $total_balalnce=$storebalance['openbalance'];?>
                                    </td>

                                </tr>

                                <?php
                        
                          //  print_r($ledgerItems);

                                    foreach ($ledgerItems as $li) {?>

                                <tr>
                                    <td><?php echo $li['voucher_no'];?>
                                    </td>
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
                            ?>
                                    </td>
                                    <td><?php echo date("d-m-Y", strtotime($li['voucher_date']));?>
                                    </td>

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
                                    <td><?php echo  $li['descriptions'];?>
                                    </td>
                                    <td><?php echo number_format($total_balalnce, 2);?>
                                    </td>

                                </tr>


                                <?php }

?>



                            </tbody>


                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th><strong><?php echo $total_balalnce;?></strong>
                                    </th>

                                </tr>
                            </tfoot>


                        </table>
                    </div>
                    <a href="<?php echo base_url('partner/ledger')?>" class="btn btn-warning btn-sm pull-right">more</a>


                </div>
            </div>
        </div>
        <!-- Column -->

    </div>

    <!-- Row -->

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->