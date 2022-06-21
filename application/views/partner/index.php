<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png">
    <title> <?php echo isset($page_title)?$page_title:"tumbledry"; ?>
    </title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css"
        rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/morrisjs/morris.css" rel="stylesheet">
    <!--alerts CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- toast CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="<?php echo base_url() ?>/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />



    <!--Form css plugins -->
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url() ?>assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css"
        rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css"
        rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/multiselect/css/multi-select.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url() ?>assets/plugins/html5-editor/bootstrap-wysihtml5.css" rel="stylesheet" />
    <!--Form css plugins end -->


    <!-- Vector CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Calendar CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- summernotes CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
    <!-- wysihtml5 CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
    <!-- Dropzone css -->
    <link href="<?php echo base_url() ?>assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet"
        type="text/css" />
    <!-- Cropper CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/cropper/cropper.min.css" rel="stylesheet">

    <!-- Footable CSS -->
    <link href="<?php echo base_url() ?>assets/plugins/footable/css/footable.core.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />

    <!-- Date picker plugins css -->
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css"
        rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url() ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

</head>

<body class="fix-header fix-sidebar card-no-border">

    <!-- Preloader - style you can find in spinners.css -->

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->

    <div id="main-wrapper">

        <!-- Topbar header - style you can find in pages.scss -->

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                <!-- Logo -->

                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('admin/dashboard') ?>">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url() ?>assets/images/logo-icon.png" alt="homepage"
                                class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo base_url() ?>assets/images/logo-light-icon.png" alt="homepage"
                                class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                            <!-- dark Logo text -->
                            <img src="<?php echo base_url() ?>assets/images/logo-text.png" alt="homepage"
                                class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="<?php echo base_url() ?>assets/images/logo-light-text.png" class="light-logo"
                                alt="homepage" />
                        </span>
                    </a>
                </div>

                <!-- End Logo -->

                <div class="navbar-collapse">

                    <!-- toggle and nav items -->

                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a
                                class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a
                                class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>






                    </ul>

                    <!-- User profile and search -->

                    <ul class="navbar-nav my-lg-0">

                        <!-- Profile -->


                        <li class="nav-item dropdown">
                            <a class="nav-link  text-muted waves-effect waves-dark" href="#" aria-haspopup="true"
                                aria-expanded="false"><?php echo $this->session->userdata('name'); ?></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user"
                                    class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img
                                                    src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user">
                                            </div>
                                            <div class="u-text">
                                                <h4><?php echo $this->session->userdata('name'); ?>
                                                </h4>
                                                <p class="text-muted"><?php echo $this->session->userdata('email'); ?>
                                                </p><a href="<?php echo base_url('partner/profile')?>"
                                                    class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('partner/profile')?>"><i class="ti-user"></i> My
                                            Profile</a></li>
                                    <!-- <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li> -->
                                    <!-- <li role="separator" class="divider"></li> -->
                                    <!-- <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li> -->
                                    <!-- <li role="separator" class="divider"></li> -->
                                    <li><a href="<?php echo base_url('partner/logout') ?>"><i
                                                class="fa fa-power-off"></i>
                                            Logout</a></li>
                                </ul>
                            </div>
                        </li>


                    </ul>
                </div>
            </nav>
        </header>

        <!-- End Topbar header -->












        <!-- Left Sidebar - style you can find in sidebar.scss  -->

        <aside class="left-sidebar">


            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">

                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap"></li>
                        <li>
                            <a class="waves-effect waves-dark" href="<?php echo base_url('partner/dashboard') ?>"
                                aria-expanded="false"><i class="mdi mdi-home"></i><span
                                    class="hide-menu">Home</span></a>
                        </li>



                        <li>
                            <a class="waves-effect waves-dark" href="<?php echo base_url('partner/invoice') ?>"
                                aria-expanded="false"><i class="mdi mdi-file-document"></i><span
                                    class="hide-menu">Royalty
                                    Invoice</span></a>
                        </li>

                        <li>
                            <a class="waves-effect waves-dark" href="<?php echo base_url('partner/ledger') ?>"
                                aria-expanded="false"><i class="mdi mdi-calendar-text"></i><span
                                    class="hide-menu">Account
                                    Statment</span></a>
                        </li>


                        <li>
                            <a class="waves-effect waves-dark" href="<?php echo base_url('partner/summary') ?>"
                                aria-expanded="false"><i class="mdi mdi-currency-inr"></i><span
                                    class="hide-menu">Account
                                    Summary</span></a>
                        </li>


                        <li>
                            <a class="waves-effect waves-dark" href="<?php echo base_url('partner/paytm') ?>"
                                aria-expanded="false"><img src="<?php echo base_url('assets/images/paytm-icon.svg');?>"
                                    width="27" /><span class="hide-menu">Paytm</span></a>
                        </li>


                        <li>
                            <a class="waves-effect waves-dark" href="<?php echo base_url('partner/bharatpay') ?>"
                                aria-expanded="false"><img src="<?php echo base_url('assets/images/bharat_pe.png');?>"
                                    width="27" /><span class="hide-menu">BharatPe</span></a>
                        </li>


                        <li>
                            <a class="waves-effect waves-dark" href="<?php echo base_url('assets/faq.pdf') ?>"
                                aria-expanded="false" target="_blank"><i class="mdi mdi-help-circle-outline"></i><span
                                    class="hide-menu">FAQ</span></a>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="#" class="link" data-toggle="tooltip" title="My Profile"><i class="ti-user"></i></a>
                <!-- item-->
                <a href="<?php echo base_url('partner/logout') ?>" class="link" data-toggle="tooltip" title="Logout"><i
                        class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->



        </aside>

        <!-- End Left Sidebar - style you can find in sidebar.scss  -->











        <!-- Page wrapper  -->

        <div class="page-wrapper">




            <!-- ==========================Dynamicaly Show Main Page Content============================ -->

            <?php echo $main_content; ?>

            <!-- ==========================Dynamicaly Show Main Page Content============================ -->




            <!-- footer -->

            <footer class="footer">
                © <?php date('d-m-Y')?> !< </footer>


                    <!-- End footer -->

        </div>

        <!-- End Page wrapper  -->




    </div>



    <!-- End Wrapper -->





    <!-- All Jquery -->

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
    <script src="<?php echo base_url() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js">
    </script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/custom.js"></script>

    <!-- This page plugins -->

    <!-- chartist chart -->
    <script src="<?php echo base_url() ?>assets/plugins/chartist-js/dist/chartist.min.js">
    </script>
    <script
        src="<?php echo base_url() ?>assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/echarts/echarts-all.js">
    </script>

    <!-- Vector map JavaScript -->
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js">
    </script>
    <!-- Calendar JavaScript -->
    <script src="<?php echo base_url() ?>assets/plugins/moment/moment.js">
    </script>
    <script src='<?php echo base_url() ?>assets/plugins/calendar/dist/fullcalendar.min.js'>
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/calendar/dist/jquery.fullcalendar.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/calendar/dist/cal-init.js">
    </script>

    <!-- sparkline chart -->
    <script src="<?php echo base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/js/dashboard4.js"></script>

    <!-- Sweet-Alert  -->
    <script src="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/sweetalert/jquery.sweet-alert.custom.js">
    </script>

    <!-- toast notification CSS -->
    <script src="<?php echo base_url() ?>assets/plugins/toast-master/js/jquery.toast.js">
    </script>
    <script src="<?php echo base_url() ?>assets/js/toastr.js"></script>

    <!-- google maps api -->
    <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyCUBL-6KdclGJ2a_UpmB2LXvq7VOcPT7K4&amp;sensor=true"></script> -->
    <!-- <script src="<?php echo base_url() ?>assets/plugins/gmaps/gmaps.min.js">
    </script>
    <script
        src="<?php echo base_url() ?>assets/plugins/gmaps/jquery.gmaps.js">
    </script> -->

    <!-- Vector map JavaScript -->
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-in-mill.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jquery-jvectormap-au-mill.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/vectormap/jvectormap.custom.js">
    </script>

    <!--Morris JavaScript -->
    <script src="<?php echo base_url() ?>assets/plugins/raphael/raphael-min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/morrisjs/morris.js">
    </script>
    <script src="<?php echo base_url() ?>assets/js/morris-data.js"></script>
    <!-- Chart JS -->

    <script src="<?php echo base_url() ?>assets/plugins/Chart.js/chartjs.init.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/Chart.js/Chart.min.js">
    </script>

    <!-- Invoice print JS -->
    <script src="<?php echo base_url() ?>assets/js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
    </script>


    <!-- Start Table js -->

    <!-- This is data table js -->
    <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script> -->
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <script>
    $(document).ready(function() {







        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' +
                                group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });


        });
    });
    $('#example23').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>

    <!-- Editable datatable-->
    <script src="<?php echo base_url() ?>assets/plugins/jquery-datatables-editable/jquery.dataTables.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/tiny-editable/mindmup-editabletable.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/tiny-editable/numeric-input-example.js">
    </script>
    <script>
    $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    $('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
    $(document).ready(function() {
        $('#editable-datatable').DataTable();
    });
    </script>

    <!-- End Table js -->







    <!-- Start Forms js -->

    <script src="<?php echo base_url() ?>assets/js/validation.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote.min.js">
    </script>
    <script>
    ! function(window, document, $) {
        "use strict";
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
            checkboxClass: "icheckbox_square-green",
            radioClass: "iradio_square-green"
        }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
    }(window, document, jQuery);
    </script>

    <script src="<?php echo base_url() ?>assets/plugins/switchery/dist/switchery.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-select/bootstrap-select.min.js"
        type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"
        type="text/javascript"></script>
    <script type="text/javascript" src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    <script>
    jQuery(document).ready(function() {

        //summernone text editor
        jQuery(document).ready(function() {

            $('#store_id_voucher').select2({
                placeholder: 'Select Store ID'
            });

            $('.summernote').summernote({
                height: 350, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });

            $('.inline-editor').summernote({
                airMode: true
            });

        });

        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
    </script>
    <!-- End form js -->







    <!-- auto hide message div-->
    <script type="text/javascript">
    $(document).ready(function() {
        $('.delete_msg').delay(3000).slideUp();
    });
    </script>





</body>

</html>