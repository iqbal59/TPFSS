<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Services</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">All Services</li>
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

                    <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <a href="<?php echo base_url('admin/service/add') ?>" class="btn btn-info pull-right"><i
                            class="fa fa-plus"></i> Add New Service</a> &nbsp;


                    <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if (check_power(1)):?>
                    <a href="<?php echo base_url('admin/service/add') ?>" class="btn btn-info pull-right"><i
                            class="fa fa-plus"></i> Add New Service</a>
                    <?php endif; ?>
                    <?php endif ?>










                    <div class="table-responsive m-t-40">



                        <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
                            width="100%">

                            <thead>

                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Sac Code</th>
                                    <th>Royality</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    $i=1;
    foreach ($services as $s) { ?>
                                <tr>
                                    <td><?php echo $i++; ?>
                                    </td>
                                    <td><?php echo $s['name']; ?>
                                    </td>
                                    <td><?php echo $s['code']; ?>
                                    </td>
                                    <td><?php echo $s['sac_code']; ?>
                                    </td>
                                    <td><?php echo $s['royality']; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('admin/service/edit/'.$s['id']); ?>">Edit</a>
                                        <!-- <a href="<?php echo site_url('admin/service/remove/'.$s['id']); ?>">Delete</a>
                                    -->
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