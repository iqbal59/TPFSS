<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Data</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Material Sale Data</li>
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



                    <div class="table-responsive m-t-40">




                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                    <th>Invoice No.</th>
                                    <th>Invoice Date</th>
                                    <th>Amount</th>
                                    <th>Store Code</th>
                                    <th>Desc</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($mbdata as $s){ ?>
                                <tr>

                                    <td><?php echo $s['invoice_no']; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($s['invoice_date'])); ?></td>


                                    <td><?php echo $s['amount']; ?></td>


                                    <td><?php echo $s['store_code']; ?></td>
                                    <td><?php echo $s['material_description']; ?></td>
                                    <td><a href="<?php echo base_url('admin/import/editmb/'.$s['id'])?>">Edit</a></td>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Page Content -->

</div>