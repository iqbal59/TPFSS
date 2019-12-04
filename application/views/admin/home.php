

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
        <!-- <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                        <h4 class="m-t-0 text-info">$58,356</h4></div>
                    <div class="spark-chart">
                        <div id="monthchart"></div>
                    </div>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                        <h4 class="m-t-0 text-primary">$48,356</h4></div>
                    <div class="spark-chart">
                        <div id="lastmonthchart"></div>
                    </div>
                </div>
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
        </div> -->
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    
    <a href="<?php echo base_url('admin/user/all_user_list') ?>">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="d-flex flex-row">
                    <div class="p-10 bg-info">
                        <h3 class="text-white box m-b-0"><i class="fa fa-users fa-2x"></i></h3></div>
                    <div class="align-self-center m-l-20">
                        <h3 class="m-b-0 text-info"><?php echo $count->total; ?></h3>
                        <h5 class="text-muted m-b-0">Total User</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="d-flex flex-row">
                    <div class="p-10 bg-success">
                        <h3 class="text-white box m-b-0"><i class="fa fa-user fa-2x"></i></h3></div>
                    <div class="align-self-center m-l-20">
                        <h3 class="m-b-0 text-info"><?php echo $count->active_user; ?></h3>
                        <h5 class="text-muted m-b-0">Active User</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="d-flex flex-row">
                    <div class="p-10 bg-danger">
                        <h3 class="text-white box m-b-0"><i class="fa fa-user-times fa-2x"></i></h3></div>
                    <div class="align-self-center m-l-20">
                        <h3 class="m-b-0 text-info"><?php echo $count->inactive_user; ?></h3>
                        <h5 class="text-muted m-b-0">Inactive User</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="d-flex flex-row">
                    <div class="p-10 bg-primary">
                        <h3 class="text-white box m-b-0"><i class="fa fa-user-circle fa-2x"></i></h3></div>
                    <div class="align-self-center m-l-20">
                        <h3 class="m-b-0 text-info"><?php echo $count->admin; ?></h3>
                        <h5 class="text-muted m-b-0">Total Admin</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    </a>

    
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <!-- <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <ul class="list-inline pull-right">
                        <li>
                            <h6 class="text-muted"><i class="fa fa-circle m-r-5" style="color:#51bdff"></i>2015</h6>
                        </li>
                        <li>
                            <h6 class="text-muted"><i class="fa fa-circle m-r-5" style="color:#11a0f8"></i>2016</h6>
                        </li>
                        <li>
                            <h6 class="text-muted"><i class="fa fa-circle m-r-5 text-info"></i>2017</h6>
                        </li>
                    </ul>
                    <h4 class="card-title">Total Revenue</h4>
                    <div class="clear"></div>
                    <div class="total-sales" style="height: 365px;"></div>
                </div>
            </div>
        </div> -->
        <!-- Column -->
        <!-- <div class="col-lg-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sales Prediction</h4>
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <span class="display-6 text-primary">$3528</span>
                                    <h6 class="text-muted">10% Increased</h6>
                                    <h5>(150-165 Sales)</h5>
                                </div>
                                <div class="ml-auto">
                                    <div id="gauge-chart" style=" width:150px; height:150px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sales Difference</h4>
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <span class="display-6 text-success">$4316</span>
                                    <h6 class="text-muted">10% Increased</h6>
                                    <h5>(150-165 Sales)</h5>
                                </div>
                                <div class="ml-auto">
                                    <div class="ct-chart" style="width:120px; height: 120px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
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
            