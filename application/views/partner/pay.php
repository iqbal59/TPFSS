<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Jan 2018 19:06:51 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png">
    <title>Payment</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <!--alerts CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url() ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style type="text/css">
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">


        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">

                    <?php if (isset($page) && $page == "logout"): ?>
                    <div class="alert alert-success hide_msg pull" style="width: 100%"> <i
                            class="fa fa-check-circle"></i> Logout Successfully &nbsp;
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                                aria-hidden="true">×</span> </button>
                    </div>
                    <?php endif ?>


                    <?php //print_r($storeData);?>

                    <form class="" id="pay-form" action="https://orderattumbledry.in/sales/fsspaynow" method="post">

                        <input type="hidden" name="customer_id" value="<?php echo $storeData['store_crm_code'];?>" />
                        <input type="hidden" name="customer_mobile" value="" />
                        <input type="hidden" name="customer_email" value="" />
                        <input type="hidden" name="order_id"
                            value="<?php echo $storeData['store_crm_code']."-".time();?>" />


                        <h2 class="box-title m-b-10 text-center">
                            <img src="<?php echo base_url() ?>assets/images/logo-light-login.png" alt="loginpage" />
                        </h2>
                        <h4 class="text-center"><?php  echo $storeData['store_crm_code']." ".$storeData['firm_name'];?>
                        </h4>

                        <h5 class="text-center"><?php  echo $storeData['store_name'];?>
                        </h5>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">



                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">₹</span>

                                            <input class="form-control form-control-lg" type="number" min="1" step="any"
                                                name="pay_amount" required="" readonly
                                                value="<?php echo $storeData['openbalance']; ?>" placeholder="Amount">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="pay_type" value="Royalty" />
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="pay_type" class="form-control  form-control-lg">
                                            <option value="Royalty">Royalty</option>
                                            <option value="Material">Material</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div> -->

                            </div>
                        </div>




                        <div class="form-group text-center m-t-50">
                            <div class="col-xs-12">
                                <button class="btn btn-info text-uppercase waves-effect waves-light"
                                    type="submit">Pay</button>
                            </div>
                        </div>


                    </form>


                </div>
            </div>
        </div>

    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js">
    </script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/popper.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js">
    </script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/jquery.slimscroll.js">
    </script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url() ?>assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <!-- Sweet-Alert  -->
    <script src="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/sweetalert/jquery.sweet-alert.custom.js">
    </script>

    <script src="<?php echo base_url() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js">
    </script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/custom.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/plugins/styleswitcher/jQuery.style.switcher.js">
    </script>

    <!-- auto hide message div-->
    <script type="text/javascript">
    $(document).ready(function() {
        $('.hide_msg').delay(2000).slideUp();
    });
    </script>

</body>


</html>