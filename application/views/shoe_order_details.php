<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tumbledry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css" />

    <style type="text/css">
    section #services {
        /*text-align: center;*/
        transform: translatez(0);
        margin: 0;
        padding: 0;
    }

    section #services li {
        width: 40px;
        height: 50px;
        display: inline-block;
        margin-right: 10px;
        list-style: none;
    }

    section #services li div {
        width: 40px;
        height: 40px;
        color: #FFBE0E;
        font-size: 1.5em;
        text-align: center;
        line-height: 40px;
        background-color: #fff;
        transition: all 0.5s ease;
    }

    section #services li a {
        color: #FFBE0E;
    }

    section #services li div:hover {
        transform: rotate(360deg);
        border-radius: 100px;
    }

    .credits a {
        display: block;
        text-align: center;
        color: #74d4b3;
        text-decoration: none;
        font-size: 24px;
        margin-top: 50px;
        background: white;
        padding: 20px;
        max-width: 300px;
    }

    footer {
        /* background: #404040; */
        position: relative;
        bottom: 0;
        left: 0;
    }


    /* footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: red;
        color: white;
        text-align: center;
    } */

    .shadow-sm {
        cursor: pointer;
    }

    .row.equal-cols {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .row.equal-cols:before,
    .row.equal-cols:after {
        display: block;
    }

    .row.equal-cols>[class*='col-'] {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .row.equal-cols>[class*='col-']>* {
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
    }

    .card-text {
        font-size: 14px;
    }

    .bg-top {
        background-color: #212121;
    }

    .nav-tabs {
        border: 0;
        padding: 15px 0.7rem;
    }

    .nav-tabs:not(.nav-justified)>.nav-item>.nav-link.active {
        box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
    }

    .card .nav-tabs {
        border-top-right-radius: 0.1875rem;
        border-top-left-radius: 0.1875rem;
    }

    .nav-tabs>.nav-item>.nav-link {
        color: #888888;
        margin: 0;
        margin-right: 5px;
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 30px;
        font-size: 14px;
        padding: 11px 23px;
        line-height: 1.5;
    }

    .nav-tabs>.nav-item>.nav-link:hover {
        background-color: transparent;
    }

    .nav-tabs>.nav-item>.nav-link.active {
        background-color: #444;
        border-radius: 30px;
        color: #FFFFFF;
    }

    .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
        font-size: 14px;
        position: relative;
        top: 1px;
        margin-right: 3px;
    }

    .nav-tabs.nav-justified>.nav-item>.nav-link {
        color: #FFFFFF;
    }

    .nav-tabs.nav-justified>.nav-item>.nav-link.active {
        background-color: #ccc;
        color: #000000;
        font-size: 18px;
        fornt-weight: 700;
        border: 1px solid black;
        text-align: center;
    }


    .nav-tabs.nav-justified>.nav-item>.nav-link:hover {
        background-color: #ccc;
        color: #000000;
        font-size: 18px;
        fornt-weight: 700;
        box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    .nav-tabs.nav-justified>.nav-item>.nav-link {
        background-color: #ccc;
        color: #000000;
        font-size: 18px;
        fornt-weight: 700;
        text-align: center;
    }


    .card {
        border: 0;
        border-radius: 0.1875rem;
        display: inline-block;
        position: relative;
        width: 100%;
        margin-bottom: 30px;
        box-shadow: none;
    }

    .card .card-header {
        background-color: transparent;
        border-bottom: 0;
        background-color: transparent;
        border-radius: 0;
        padding: 0;
    }

    .card[data-background-color="orange"] {
        background-color: #f96332;
    }

    .card[data-background-color="red"] {
        background-color: #FF3636;
    }

    .card[data-background-color="yellow"] {
        background-color: #FFB236;
    }

    .card[data-background-color="blue"] {
        background-color: #2CA8FF;
    }

    .card[data-background-color="green"] {
        background-color: #15b60d;
    }

    [data-background-color="orange"] {
        background-color: #e95e38;
    }

    [data-background-color="black"] {
        background-color: #2c2c2c;
    }

    [data-background-color]:not([data-background-color="gray"]) {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) p {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) a:not(.btn):not(.dropdown-item) {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
        color: #FFFFFF;
    }


    @font-face {
        font-family: 'Nucleo Outline';
        src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot");
        src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot") format("embedded-opentype");
        src: url("https://raw.githack.com/creativetimofficial/now-ui-kit/master/assets/fonts/nucleo-outline.woff2");
        font-weight: normal;
        font-style: normal;

    }

    .now-ui-icons {
        display: inline-block;
        font: normal normal normal 14px/1 'Nucleo Outline';
        font-size: inherit;
        speak: none;
        text-transform: none;
        /* Better Font Rendering */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .album {
        min-height: calc(100vh - 350px);
    }

    .nav-tabs.nav-justified li {
        border-right: 20px solid rgba(255, 255, 255, 0.00);
    }

    .nav-tabs.nav-justified li:last-child {
        border-right-width: 0px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 50% !important;
        cursor: pointer;
        padding: 0.5em 0.9em !important;
    }


    .dataTables_wrapper .dataTables_paginate .paginate_button {
        /* border-radius: 0; */
        /* background: #888888; */
        color: #888;
    }

    .page-item.active .page-link {
        color: #fff !important;
        background: green;
        background-color: #000 !important;
    }

    .page-link {
        color: #000 !important;
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
    }

    .page-link:hover {
        color: #fff !important;
        background-color: #000 !important;
        border-color: #000 !important;
    }

    .table-responsive {
        overflow-y: hidden;
    }

    /* .table {
        border: 1px solid black;
    }

    .table thead th {
        border-top: 1px solid #000 !important;
        border-bottom: 1px solid #000 !important;
        border-left: 1px solid #000;
        border-right: 1px solid #000;
    } */

    .border-td {
        /* border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-top: none !important;
            border-bottom: none !important; */
        /* color: #000 !important; */
        background-color: #000000;
        opacity: 0.2;

    }

    .bg-secondary {
        background-color: #d3d3d3 !important;
    }

    .table td,
    th {
        font-size: 0.875rem !important;
        vertical-align: middle;
        ;

    }

    table.dataTable thead th {
        text-align: center;
        vertical-align: middle;
        ;
    }

    .highlight-background {}

    .text-dark {

        opacity: 1 !important;
    }
    </style>
</head>

<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About SimplifyTumbledry</h4>
                        <p class="text-white">Your business will be a ZERO-hassle affair with Tumbledry’s tech-oriented
                            360-degree support ecosystem. We aim to empower you technologically to run and grow your
                            business with just a few clicks. Be it developing creatives for WhatsApp marketing or
                            managing your inventory procurement or managing your store financials, SimplifyTumbledry
                            provides solutions to all needs in one central system which is completely transparent and
                            easy to use.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>



                        <section>
                            <ul id="services">

                                <li>
                                    <div class="facebook">
                                        <a href="https://www.facebook.com/tumbledry.in" target="_blank">
                                            <i class="bi bi-facebook" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                </li>

                                <li>
                                    <div class="youtube">
                                        <a href="https://www.youtube.com/channel/UCt_WcQ90JG7yp6zf5FY8b-A"
                                            target="_blank">
                                            <i class="bi bi-youtube" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                </li>
                                <li>
                                    <div class="linkedin">
                                        <a href="https://in.linkedin.com/company/tumbledry-dry-clean-and-laundry"
                                            target="_blank">
                                            <i class="bi bi-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                </li>
                                <li>
                                    <div class="instagram">
                                        <a href="https://www.instagram.com/tumbledryind" target="_blank">
                                            <i class="bi bi-instagram" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                </li>

                            </ul>

                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">

                    <img src="<?php echo base_url('assets/images/tumbledry-logo-white.png') ?>" height="40" />

                </a>

                <?php


                if ($this->session->userdata('is_partner_login')) { ?>
                <span class="navbar-text">
                    Welcome <?php echo $this->session->userdata('name'); ?>
                </span>

                <?php } ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-toggler" title="Logout" href="<?php echo base_url('partner/logout') ?>">
                    <i class="bi bi-power"></i>
                </a>
            </div>
        </div>
    </header>


    <!-- <div class="container-fluid p-0">

        <img src="<?php echo base_url('assets/images/project_charter.jpg') ?>" width="100%" />

    </div> -->

    <main>



        <div class="album mt-5">
            <div class="container-fluid">

                <div class="col-md-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3>Shoe Orders</h3>

                        </div> -->
                        <div class="card-body">
                            <div class="row gy-2 gx-3 align-items-center">
                                <div class="col-auto">
                                    <!-- Dropdown to select date column -->
                                    <label for="date-column" class="visually-hidden">Select Date Column:</label>
                                    <select id="date-column" class="form-select form-select-sm">
                                        <option value="3">Last Order Date</option>
                                        <option value="5">Last Shoe Order</option>
                                        <option value="6">Shoe Order</option>

                                    </select>

                                </div>
                                <!-- Date range filter inputs -->
                                <div class="col-auto">
                                    <label for="min-date" class="visually-hidden">Start Date:</label>
                                    <input type="text" id="min-date" class="form-control form-control-sm"
                                        placeholder="From Date">
                                </div>
                                <div class="col-auto">
                                    <label for="max-date" class="visually-hidden">End Date:</label>
                                    <input type="text" id="max-date" class="form-control form-control-sm"
                                        placeholder="To Date">
                                </div>
                                <div class="col-auto">

                                    <a href="<?php echo base_url('partner/order_details'); ?>"
                                        class="btn btn-outline-secondary btn-sm">All</a>
                                </div>
                            </div>


                            <br />

                            <div class="table-responsive">
                                <table class="table text-center table-light table-striped" id="sp_table">
                                    <thead>
                                        <tr class="table-dark">
                                            <th scope="col"></th>
                                            <th scope="col">Cust Id</th>
                                            <th scope="col">Mobile No.</th>
                                            <th scope="col">Last Order Date</th>
                                            <th scope="col">Order Count</th>
                                            <th scope="col" class="text-warning">Last Shoe Order</th>
                                            <th scope="col">Shoe Order</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Update Date</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $totalCustomers = count($order_details);
                                        $total_curtain = 0;
                                        $total_jacket = 0;
                                        $total_blanket = 0;
                                        $total_shoe = 0;
                                        foreach ($order_details as $order) {
                                            // print_r($order);
                                        

                                            if ($order->shoe_order != null)
                                                $total_curtain++;
                                            if ($order->shoe_order != null)
                                                $total_jacket++;
                                            if ($order->shoe_order != null)
                                                $total_blanket++;
                                            if ($order->shoe_order != null)
                                                $total_shoe++;


                                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $i++; ?></th>
                                            <td><?php echo $order->customer_id ?></td>
                                            <td>
                                                <a class="btn btn-default btn-sm"
                                                    data-id="<?php echo $order->mobile_no; ?>"
                                                    onclick="openModalWithData('<?php echo $order->mobile_no; ?>')"
                                                    data-bs-toggle="tooltip" data-bs-placement="right"
                                                    title="Click to get Details"><?php echo substr($order->mobile_no, 0, 6); ?>XXXX</a>
                                            </td>
                                            <td>
                                                <?php echo $order->last_order_date != null ? date('d/m/Y', strtotime($order->last_order_date)) : ""; ?>
                                            </td>
                                            <td><?php echo $order->order_count; ?></td>
                                            <td class="bg-secondary">
                                                <?php echo $order->last_shoe_order != null ? date('d/m/Y', strtotime($order->last_shoe_order)) : ""; ?>
                                            </td>
                                            <td><?php echo $order->shoe_order != null ? date('d/m/Y', strtotime($order->shoe_order)) : ""; ?>
                                            </td>

                                            <td>
                                                <select id="status"
                                                    onchange="update_status('<?php echo $order->id;?>', this.value)">
                                                    <option value="YTC"
                                                        <?php echo $order->shoe_status == 'YTC' ? "selected" : ''; ?>>
                                                        Yet to Contact</option>
                                                    <option value="UF"
                                                        <?php echo $order->shoe_status == 'UF' ? "selected" : ''; ?>>
                                                        Under Followup</option>
                                                    <option value="OD"
                                                        <?php echo $order->shoe_order != null ? "selected" : ''; ?>>
                                                        Order
                                                        Given
                                                    </option>
                                                </select>
                                            </td>
                                            <td><span id="<?php echo $order->id;?>">

                                                    <?php if($order->shoe_status_time != null){echo date('d/m/Y H:i:s', strtotime($order->shoe_status_time)); }?>
                                                </span></td>
                                        </tr>
                                        <?php } ?>
                                </table>
                            </div>


                        </div>
                    </div>


                </div>
            </div>

    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#" class="text-primary">Back to top</a>
            </p>

            <!-- <p class="mb-0 text-center text-secondary">©2019 <a href="https://www.tumbledry.in/" target="_blank"
                    class="text-primary">Tumbledry
                    Solutions
                    Pvt. Ltd.</a> All rights reserved.</p> -->
        </div>
    </footer>

    <!-- 
    <div class="fixed-bottom bg-dark text-white">
        <div class="container p-3">
            <div class="row text-center">
                <div class="col-3">
                    <p class="mb-0"><strong>Shoe:
                        </strong><?php
                        // echo $total_curtain;
                        // echo $totalCustomers;
                        echo round(($total_curtain / $totalCustomers) * 100, 2); ?>
                    </p>
                </div>
                <div class="col-3">
                    <p class="mb-0"><strong>Shoe: </strong><?php
                    // echo $total_jacket;
                    // echo $totalCustomers;
                    echo round(($total_jacket / $totalCustomers) * 100, 2); ?></p>
                </div>
                <div class="col-3">
                    <p class="mb-0"><strong>Shoe: </strong>
                        <?php echo round(($total_blanket / $totalCustomers) * 100, 2); ?>
                    </p>
                </div>
                <div class="col-3">
                    <p class="mb-0"><strong>Shoe: </strong>
                        <?php echo round(($total_shoe / $totalCustomers) * 100, 2); ?>
                    </p>
                </div>
            </div>
        </div>
    </div> -->

    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
    <!-- Include moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include DataTables moment.js plugin -->
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>

    <script type="text/javascript">
    function addDays(date, days) {

        result = new Date(date);
        result.setDate(result.getDate() + parseInt(days));
        return result;
    }
    $(document).ready(function() {

        $.fn.dataTable.moment('DD/MM/YYYY');

        $('#min-date, #max-date').datepicker({
            dateFormat: 'dd/mm/yy'
        });

        var sp_table = $('#sp_table').DataTable({
            responsive: true,
            "pageLength": 100,
            paging: true, // works with or without paging

            order: [

                [3, 'desc']

            ],
            dom: '<"row"<"col-sm-6"><"col-sm-6 text-end"B>>tip',
            buttons: [{
                    extend: 'csvHtml5',
                    title: 'Shoe Order List',
                    text: 'Export',
                    exportOptions: {
                        // columns: [0, 1], // Specify which columns to export
                        format: {
                            body: function(data, row, column, node) {
                                var selectElement = $(node).find('select');
                                if (selectElement.length > 0) {
                                    return selectElement.find('option:selected').text()
                                        .trim();
                                }

                                var anchorElement = $(node).find('a');
                                if (anchorElement.length > 0) {
                                    return anchorElement.text().trim();
                                }

                                var spanElement = $(node).find('span');
                                if (spanElement.length > 0) {
                                    return spanElement.text().trim();
                                }

                                return data.trim();
                            }
                        }
                    }

                }, // Export to Excel

            ],


        });
        new $.fn.dataTable.FixedHeader(sp_table);

        // sp_table.on('order.dt search.dt', function() {
        //     sp_table.column(0, {
        //         search: 'applied',
        //         order: 'applied'
        //     }).nodes().each(function(cell, i) {
        //         cell.innerHTML = i + 1;
        //     });
        // }).draw();


        // $('#sp_table_filter').change(function() {
        //     sp_table.search($(this).val())
        //         .draw(); // this  is for customized searchbox with datatable search feature.
        // });

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var selectedColumn = parseInt($('#date-column').val());

                // Get the date from the selected column
                var date = data[selectedColumn] || '';
                //alert(date);

                if (!date) {
                    // Include blank dates by default
                    return true;
                }

                var dateObj = $.datepicker.parseDate('dd/mm/yy', date);

                if (
                    (min === "" || $.datepicker.parseDate('dd/mm/yy', min) <= dateObj) &&
                    (max === "" || dateObj <= $.datepicker.parseDate('dd/mm/yy', max))
                ) {
                    return true;
                }

                return false; // Exclude the row if it doesn't match the selected date column
            }
        );

        $('#min-date, #max-date, #date-column').change(function() {
            sp_table.draw();
        });

        //End SP Table



    });


    function openModalWithData(mobileNo) {
        // Show the modal
        $('#modalBody').html('');
        $('#contactModal').modal('show');

        // Make the API call
        $.ajax({
            url: '<?php echo base_url(); ?>' + 'api/customer_info_by_mobile/' + mobileNo,
            method: 'GET',
            success: function(response) {
                // Update the modal's body with the response data
                $('#modalBody').html(`
            <p>Mobile: ${mobileNo}</p>
            <p>Name: ${response.Name}</p>
            <p>Email: ${response.Email}</p>
            <p>Address: ${response.Address}</p>
          `);
            },
            error: function() {
                $('#modalBody').html('<p>An error occurred while fetching the data.</p>');
            }
        });
    }


    function update_status(id, status) {
        // Show the modal


        // Make the API call
        $.ajax({
            url: '<?php echo base_url(); ?>' + 'api/customer_update_shoe_status/' + id + '/' + status,
            method: 'GET',
            dataType: "JSON",
            success: function(response) {
                // Update the modal's body with the response data
                console.log(response);
                $('#' + id).html(response.status_update);
            },
            error: function(er) {
                console.log(er);
            }
        });
    }
    </script>
</body>


<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">


            </div>

        </div>
    </div>
</div>
<!-- Modal End-->

</html>