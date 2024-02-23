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


    <!-- Main content -->
    <section class="content">
        <?php if ($msg = $this->session->flashdata('msg')):
            $msg_class = $this->session->flashdata('msg_class')
                ?>
        <div class="row">
            <div class="col-lg-12">
                <div class=" alert <?= $msg_class; ?>">
                    <?= $msg; ?>
                </div>
            </div>
        </div>
        <?php

            $this->session->set_flashdata('msg', '');
        endif ?>
        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Store List
                            <?php //echo date('Y-m-01') .' to '. date('Y-m-d') ;      ?>
                        </h3>
                        <a class="btn btn-sm btn-info pull-right" style="margin: 10px"
                            href="<?php echo base_url('admin/storenew/add'); ?>" title="Add Store" onclick="">
                            Add Store
                            <?php // echo $this->lang->line('user_btn_new');      ?>
                        </a>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body" style="padding: 20px">
                        <div class="table-responsive">
                            <!-- class="box-body" ==> for not responsive table -->
                            <table id="example23" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                            <?php // echo $this->lang->line('product_no');      ?>
                                        </th>
                                        <!-- <th>
                                        User Name
                                    </th> -->
                                        <th>
                                            Store Code
                                            <?php // echo $this->lang->line('user_lable_fname');      ?>
                                        </th>
                                        <!-- <th>
                                        Firm Name
                                        <?php // echo $this->lang->line('user_lable_lname');      ?>
                                    </th> -->
                                        <th>
                                            GST No.
                                            <?php // echo $this->lang->line('user_lable_email');      ?>
                                        </th>
                                        <th>
                                            Mobile No.
                                            <?php // echo $this->lang->line('user_lable_group');      ?>
                                        </th>
                                        <th>Store Address</th>
                                        <th>Email Id</th>
                                        <th>Store Name</th>
                                        <th>Store CRM Code</th>
                                        <!-- <th>Firm GST Registration Type</th>
                                    <th>Store City</th>
                                    <th>Store State</th>
                                    <th>Postal Code</th>
                                    <th>GST State Code</th> -->
                                        <!-- <th>State Code</th> -->
                                        <!-- <th>Pin Code</th> -->
                                        <!-- <th>Launch Date</th> -->
                                        <!-- <th>Pan No.</th> -->
                                        <!-- <th>Courier Charge Per Kg</th>
                                    <th>Out Of Delivery Charge</th>
                                    <th>IS FOFO</th>
                                    <th>Reporting Manager</th> -->
                                        <!-- <th>User Role</th> -->
                                        <!-- <th>User Groups</th> -->
                                        <!-- <th>PayTM Mid 1</th>
                                    <th>PayTM Mid 2</th>
                                    <th>PayTM Mid 3</th> -->
                                        <!-- <th>Opening Balance</th>
                                    <th>Discount (%)</th> -->
                                        <!-- <th>Updated</th>
                                    <th>Created</th> -->
                                        <!-- <th>Royality</th> -->
                                        <th>View</th>
                                        <th>Status</th>
                                        <th>
                                            Action
                                            <?php // echo $this->lang->line('user_lable_action');      ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stores as $s): ?>
                                    <tr>
                                        <td>
                                            <?= $s->id ?>
                                        </td>
                                        <!-- <td><?= $s->user_name ?></td> -->
                                        <td>
                                            <?= $s->store_code ?>
                                        </td>
                                        <!-- <td><?= $s->firm_name ?></td> -->
                                        <td>
                                            <?= $s->gst_no ?>
                                        </td>
                                        <td>
                                            <?= $s->mobile_no ?>
                                        </td>
                                        <td>
                                            <?= $s->str_address ?>
                                        </td>
                                        <td>
                                            <?= $s->email_id ?>
                                        </td>
                                        <td>
                                            <?= $s->store_name ?>
                                        </td>
                                        <td>
                                            <?= $s->store_crm_code ?>
                                        </td>
                                        <!-- <td><?php if ($s->firm_gst_regis_type == 1) {
                                                echo "GST";
                                            } else {
                                                echo "NON GST";
                                            } ?>
                                      
                                    </td>
                                    <td><?= $s->store_city ?></td>
                                    <td><?= $s->store_state ?></td>
                                    <td><?= $s->postal_code ?></td>
                                    <td><?= $s->gst_state_code ?></td> -->
                                        <!-- <td><?= $s->state_code ?></td>
                                    <td><?= $s->pin_code ?></td> -->
                                        <!-- <td>
                                        <?= $s->launch_date ?>
                                    </td> -->
                                        <!-- <td><?= $s->pan_no ?></td> -->
                                        <!-- <td><?= $s->courier_charge_per_kg ?></td>
                                    <td><?= $s->out_of_delivery_charge ?></td>
                                    <td><?php if ($s->is_fofo == 1) {
                                        echo "Yes";
                                    } else {
                                        echo "No";
                                    } ?></td>
                                    <td><?= $s->reporting_manager ?></td> -->
                                        <!-- <td><? // = $s->user_role      ?></td> -->
                                        <!-- <td><? // = $s->user_groups      ?></td> -->
                                        <!-- <td><?= $s->paytm_mid_1 ?></td>
                                    <td><?= $s->paytm_mid_2 ?></td>
                                    <td><?= $s->paytm_mid_3 ?></td> -->
                                        <!-- <td><?= $s->opening_balance ?></td>
                                    <td><?= $s->discount ?></td> -->
                                        <!-- <td><?php
                                            if (empty($s->updated_at)) {
                                                echo "Never";
                                            } else {
                                                echo $s->updated_at;
                                            }

                                            ?> </td>
                                    <td><?= $s->created_at ?></td> -->
                                        <!-- <td><a href="<?php echo base_url('store/royality/'); ?><?php echo $s->id; ?>">Royality</a></td> -->

                                        <td class="text-center"><a
                                                href="<?php echo base_url('admin/storenew/view/'); ?><?php echo $s->id; ?>"
                                                class="btn btn-xs btn-warning">view</a></td>


                                        <td>
                                            <?php if (($s->store_crm_code == null) || ($s->status == 2)) { ?>
                                            <a
                                                href="<?php echo base_url('admin/storenew/status/'); ?><?php echo $s->id; ?>">

                                                Make Live

                                            </a>
                                            <?php } else {
                                                    echo "<sapn class='btn btn-xs btn-success'>Live</span>";
                                                } ?>
                                        </td>
                                        <td>

                                            <a href="<?php echo base_url('admin/storenew/edit/'); ?><?php echo $s->id; ?>"
                                                title="Edit" class="btn btn-xs btn-info"><span
                                                    class="fa fa-edit"></span></a>


                                        </td>



                                    </tr>
                                    <?php endforeach; ?>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script type="text/javascript" rel="stylesheet">
$('document').ready(function() {
    $(".alert").fadeIn(1000).fadeOut(4000);
});
</script>