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

    </div>

    <!-- End Bread crumb and right sidebar toggle -->



    <!-- Start Page Content -->

    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">


                    <form id="ledger_form" method="post" action="<?php echo base_url('partner/ledger') ?>"
                        class="form-horizontal" enctype="multipart/form-data" novalidate>

                        <input type="hidden" id="show_ledger_url" value="<?php echo base_url('partner/ledger') ?>" />
                        <input type="hidden" id="print_ledger_url"
                            value="<?php echo base_url('partner/printledger') ?>" />
                        <input type="hidden" id="download_ledger_url"
                            value="<?php echo base_url('admin/accounts/downloadledger/'.$this->session->userdata('id')) ?>" />

                        <input type="hidden" id="export_ledger_url"
                            value="<?php echo base_url('partner/exportledger') ?>" />
                        <div class="form-body">



                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Enter From Date <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="date" name="from_date"
                                                min="<?php echo date('Y-m-d', mktime(0, 0, 0, 4, 1, date('m')==7?(date('Y')-1):(date('Y')-2)))?>"
                                                class="form-control form-control-sm" placeholder="mm/dd/yyyy" required
                                                value="<?php echo isset($open_date)?$open_date:date("Y-m-01");?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Enter To Date <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="date"
                                                min="<?php echo date('Y-m-d', mktime(0, 0, 0, 4, 1, date('m')==7?(date('Y')-1):(date('Y')-2)))?>"
                                                name="to_date" class="form-control form-control-sm"
                                                placeholder="mm/dd/yyyy" required
                                                value="<?php echo isset($to_date)?$to_date:date("Y-m-d");?>">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Actions</label>
                                        <div class="controls">
                                            <button type="button" id="show_ledger"
                                                class="btn btn-sm btn-success">Show</button>
                                            <!-- <button type="button" id="print_ledger"
                                                class="btn btn-sm btn-success">Print</button> -->
                                            <button type="button" id="download_ledger"
                                                class="btn btn-sm btn-success">Download</button>

                                            <!-- <button type="button" id="export_ledger"
                                                class="btn btn-sm btn-success">Export</button> -->
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- CSRF token -->
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
                                value="<?=$this->security->get_csrf_hash();?>" />


                        </div>

                    </form>
                </div>
            </div>




            <div class="card">

                <div class="card-body">





                    <div class="table-responsive">
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
                                    <td><?php echo date("d-m-Y", strtotime($open_date));?>
                                    </td>
                                    <td><?php echo $total_balalnce=$storebalance['openbalance'];?>
                                    </td>
                                    <!-- <td>-</td>
                            <td>-</td> -->
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
                                    <!-- <th>-</th>
                                    <th>-</th> -->
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
                </div>
            </div>




        </div>
    </div>