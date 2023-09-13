<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Store</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">All Stores</li>
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



                    <div class="table-responsive">

                        <table id="list_100" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>


                                <tr>
                                    <th>ID</th>
                                    <th>Store Crm Code</th>
                                    <th>Store Name</th>

                                    <th>Firm Name</th>
                                    <th>Store City</th>


                                    <th>Contact Number</th>

                                    <th>Launch Date</th>
                                    <th>AMC Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                foreach ($stores as $s) {
                                    if ($s['store_type'] != 1)
                                        continue;
                                    ?>
                                <tr>
                                    <td>
                                        <?php echo $i++; ?>
                                    </td>

                                    <td>
                                        <?php echo $s['store_crm_code']; ?>
                                    </td>
                                    <td>
                                        <?php echo $s['store_name']; ?>
                                    </td>

                                    <td>
                                        <?php echo $s['firm_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $s['store_city']; ?>
                                    </td>

                                    <td>
                                        <?php echo $s['contact_number']; ?>
                                    </td>



                                    <td>
                                        <?php echo $s['launch_date']; ?>
                                    </td>

                                    <td>
                                        <?php

                                            if ((date('Y-m-d') >= date('Y-m-d', strtotime($s['launch_date'] . ' +365 days')) && $s['launch_date'] > '2022-07-01' && ($s['is_amc'] == 0 || $s['is_amc'] == 1)) || $s['is_amc'] == 1) {
                                                $flg = 1;
                                                echo "YES";
                                            } else {
                                                $flg = 0;
                                                echo "NO";
                                            }



                                            ?>


                                    </td>

                                    <td>
                                        <?php if ($flg == 1) { ?>
                                        <a
                                            href="<?php echo site_url('admin/store/amcupdate/' . $s['id']); ?>?act=remove">Remove</a>

                                        <?php } else { ?>
                                        <a
                                            href="<?php echo site_url('admin/store/amcupdate/' . $s['id']); ?>?act=add">Add</a>

                                        <?php } ?>
                                    </td>
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