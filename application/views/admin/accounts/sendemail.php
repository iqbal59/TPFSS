<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Email</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Send Email Customer Ledger</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">


            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <!-- <h6 class="m-b-0"><small>Active User</small></h6>
                        <h4 class="m-t-0 text-info"><?php echo $count->active_user; ?>
                        </h4> -->
                    </div>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <!-- <h6 class="m-b-0"><small>Inctive User</small></h6>
                        <h4 class="m-t-0 text-primary"><?php echo $count->inactive_user; ?>
                        </h4> -->
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


                    <form id="ledger_form" method="post" action="<?php echo base_url('admin/accounts/processemail') ?>"
                        class="form-horizontal" enctype="multipart/form-data" novalidate>

                        <div class="form-body">
                            <br>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Enter From Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="from_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required
                                                value="<?php echo isset($open_date)?$open_date:date("Y-m-01");?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Enter To Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="to_date" class="form-control"
                                                placeholder="MM/DD/YYYY" required
                                                value="<?php echo isset($to_date)?$to_date:date("Y-m-d");?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group bootstrap-select">
                                        <h5>Store <span class="text-danger">*</span></h5>

                                        <select class="form-control" placeholder="--select Store--" name="store_id[]"
                                            multiple="multiple" id="store_email" style="width:100%;">

                                            <?php
                                          foreach ($stores as $store) {
                                              ?>
                                            <option value="<?php echo $store['id']; ?>">
                                                <?php echo $store['store_name']; ?>
                                            </option>
                                            <?php
                                          }?>


                                        </select>
                                        <!-- <div
                                            style="max-height:300px; border:1px solid #67757c; padding:5px; overflow-y:scroll">

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectall" value=""
                                                    onclick="$('input[name*=\'store_id\']').attr('checked', this.checked);">
                                                <label class="form-check-label" for="selectall">Selelct All</label>
                                            </div>
                                            <?php foreach ($stores as $store) {?>
                                        <div class="form-check">
                                            <input class="form-check-input" name="store_id[]" type="checkbox"
                                                id="checkbox-<?php echo $store['id'];?>"
                                                value="<?php echo $store['id'];?>">
                                            <label class="form-check-label"
                                                for="checkbox-<?php echo $store['id'];?>"><?php echo $store['store_name'];?></label>
                                        </div>
                                        <?php }?>

                                    </div> -->
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group ">
                                        <h5>Actions</h5>
                                        <div class="controls">
                                            <button type="submit" class="btn btn-success">Send Email</button>

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
    </div>


    <!-- End Page Content -->

</div>