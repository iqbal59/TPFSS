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
        background: #404040;
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

                    <img src="<?php echo base_url('assets/images/tumbledry-logo-white.png')?>" height="40" />

                </a>

                <?php
                
               
                if ($this->session->userdata('is_partner_login')) {?>
                <span class="navbar-text">
                    Welcome <?php echo $this->session->userdata('name');?>
                </span>

                <?php } ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-toggler" title="Logout" href="<?php echo base_url('partner/logout')?>">
                    <i class="bi bi-power"></i>
                </a>
            </div>
        </div>
    </header>


    <div class="container-fluid p-0">

        <img src="<?php echo base_url('assets/images/project_charter.jpg')?>" width="100%" />

    </div>

    <main>



        <div class="album mt-5">
            <div class="container">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            <ul class="nav nav-tabs nav-justified justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#sp" href="#sp"
                                        role="tab">Standard
                                        Project<br />
                                        (45-55 Days)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#prc" href="#prc"
                                        role="tab">Projects
                                        Requiring Civil Work<br />(75-85
                                        Days)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#cc" href="#cc"
                                        role="tab">Collection
                                        Center
                                        with 1 Machine<br />
                                        (40-45 Days)</a>
                                </li>

                            </ul>

                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade" id="sp" role="tabpanel">
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Activity Header</label>
                                            <select name="sp_table_filter" id="sp_table_filter"
                                                class="form-control select2">
                                                <option value=''>All</option>
                                                <?php 
                                            foreach($activities_header2 as $ah){
                                            ?>
                                                <option value='<?php echo $ah->header;?>'><?php echo $ah->header;?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Project Start Date</label>
                                            <div class="input-group">

                                                <input type="date" name="sp_launch_dt" id="sp_launch_dt"
                                                    class="form-control" style="width:60%"
                                                    placeholder="Enter Project Launch Date">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table  table-light table-striped" id="sp_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Activity Header</th>
                                                    <th scope="col">Actitivity Name</th>
                                                    <th scope="col">Days To Complete</th>
                                                    <th scope="col">Estimated End Date</th>
                                                    <th scope="col">Actual Completion Date</th>
                                                    <th scope="col">Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                            $i=1;
                                            foreach ($activities as $activitie){
                                                if($activitie['project_type']!= 2)
                                                continue;
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i++;?></th>
                                                    <td><?php echo $activitie['header'];?></td>
                                                    <td><?php echo $activitie['activity_name'];?></td>
                                                    <td><?php echo $activitie['completion_day'];?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <?php  }?>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="prc" role="tabpanel">
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Activity Header</label>
                                            <select name="prc_table_filter" id="prc_table_filter"
                                                class="form-control select2">
                                                <option value=''>All</option>
                                                <?php 
                                            foreach($activities_header2 as $ah){
                                            ?>
                                                <option value='<?php echo $ah->header;?>'><?php echo $ah->header;?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Project Start Date</label>
                                            <div class="input-group">

                                                <input type="date" name="prc_launch_dt" id="prc_launch_dt"
                                                    class="form-control" style="width:60%"
                                                    placeholder="Enter Project Launch Date">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-light table-striped" id="prc_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Activity Header</th>
                                                    <th scope="col">Actitivity Name</th>
                                                    <th scope="col">Days To Complete</th>
                                                    <th scope="col">Estimated End Date</th>
                                                    <th scope="col">Actual Completion Date</th>
                                                    <th scope="col">Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                            $i=1;
                                            foreach ($activities as $activitie){
                                                if($activitie['project_type']!= 2)
                                                continue;
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i++;?></th>
                                                    <td><?php echo $activitie['header'];?></td>
                                                    <td><?php echo $activitie['activity_name'];?></td>
                                                    <td><?php echo $activitie['completion_day'];?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <?php  }?>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cc" role="tabpanel">
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Activity Header</label>
                                            <select name="cc_table_filter" id="cc_table_filter"
                                                class="form-control select2">
                                                <option value=''>All</option>
                                                <?php 
                                            foreach($activities_header1 as $ah){
                                            ?>
                                                <option value='<?php echo $ah->header;?>'><?php echo $ah->header;?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Project Start Date</label>
                                            <div class="input-group">

                                                <input type="date" name="cc_launch_dt" id="cc_launch_dt"
                                                    class="form-control" style="width:60%"
                                                    placeholder="Enter Project Launch Date">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-light table-striped" id="cc_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Activity Header</th>
                                                    <th scope="col">Actitivity Name</th>
                                                    <th scope="col">Days To Complete</th>
                                                    <th scope="col">Estimated End Date</th>
                                                    <th scope="col">Actual Completion Date</th>
                                                    <th scope="col">Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                            $i=1;
                                            foreach ($activities as $activitie){
                                                if($activitie['project_type'] != 1)
                                                continue;
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i++;?></th>
                                                    <td><?php echo $activitie['header'];?></td>
                                                    <td><?php echo $activitie['activity_name'];?></td>
                                                    <td><?php echo $activitie['completion_day'];?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <?php  }?>
                                        </table>
                                    </div>
                                </div>

                            </div>
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

            <p class="mb-0 text-center text-secondary">©2019 <a href="https://www.tumbledry.in/" target="_blank"
                    class="text-primary">Tumbledry
                    Solutions
                    Pvt. Ltd.</a> All rights reserved.</p>
        </div>
    </footer>
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript">
    function addDays(date, days) {

        result = new Date(date);
        result.setDate(result.getDate() + parseInt(days));
        return result;
    }
    $(document).ready(function() {

        var sp_table = $('#sp_table').DataTable({
            responsive: true,
            paging: false, // works with or without paging
            columnDefs: [{
                render: function(data, type, row) {
                    launch_dt = $('#sp_launch_dt').val();
                    console.log(launch_dt);
                    if (launch_dt && launch_dt != '') {
                        final_dt = addDays(launch_dt, row[3]);
                        return final_dt.getDate() + "-" + (final_dt
                                .getMonth() + 1) +
                            "-" +
                            final_dt.getFullYear();
                    }

                    return "";
                },
                targets: 4,
            }, {
                "targets": [0, 2, 3, 4, 5],
                "searchable": false
            }],
            order: [
                [3, 'asc']
            ],
            dom: 'lrtip',


        });
        new $.fn.dataTable.FixedHeader(sp_table);

        sp_table.on('order.dt search.dt', function() {
            sp_table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


        $('#sp_table_filter').change(function() {
            sp_table.search($(this).val())
                .draw(); // this  is for customized searchbox with datatable search feature.
        });

        $('#sp_launch_dt').change(function() {
            console.log($('#sp_launch_dt').val());
            sp_table.rows().invalidate('Yes');
        });


        //End SP Table



        var prc_table = $('#prc_table').DataTable({
            responsive: true,
            paging: false, // works with or without paging
            columnDefs: [{
                render: function(data, type, row) {
                    launch_dt = $('#prc_launch_dt').val();
                    console.log(launch_dt);
                    if (launch_dt && launch_dt != '') {
                        final_dt = addDays(launch_dt, row[3]);
                        return final_dt.getDate() + "-" + (final_dt
                                .getMonth() + 1) +
                            "-" +
                            final_dt.getFullYear();
                    }

                    return "";
                },
                targets: 4,
            }, {
                "targets": [0, 2, 3, 4, 5],
                "searchable": false
            }],
            order: [
                [3, 'asc']
            ],
            dom: 'lrtip',
        });

        new $.fn.dataTable.FixedHeader(prc_table);

        prc_table.on('order.dt search.dt', function() {
            prc_table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


        $('#prc_table_filter').change(function() {
            prc_table.search($(this).val())
                .draw(); // this  is for customized searchbox with datatable search feature.
        });

        $('#prc_launch_dt').change(function() {
            console.log($('#prc_launch_dt').val());
            prc_table.rows().invalidate('Yes');
        });

        //end prc table



        var cc_table = $('#cc_table').DataTable({
            responsive: true,
            paging: false, // works with or without paging
            columnDefs: [{
                render: function(data, type, row) {
                    launch_dt = $('#cc_launch_dt').val();
                    console.log(launch_dt);
                    if (launch_dt && launch_dt != '') {
                        final_dt = addDays(launch_dt, row[3]);
                        return final_dt.getDate() + "-" + (final_dt
                                .getMonth() + 1) +
                            "-" +
                            final_dt.getFullYear();
                    }

                    return "";
                },
                targets: 4,
            }, {
                "targets": [0, 2, 3, 4, 5],
                "searchable": false
            }],
            order: [
                [3, 'asc']
            ],
            dom: 'lrtip',
        });
        new $.fn.dataTable.FixedHeader(cc_table);

        cc_table.on('order.dt search.dt', function() {
            cc_table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $('#cc_table_filter').change(function() {
            cc_table.search($(this).val())
                .draw(); // this  is for customized searchbox with datatable search feature.
        });

        $('#cc_launch_dt').change(function() {
            console.log($('#cc_launch_dt').val());
            cc_table.rows().invalidate('Yes');
        });

    });
    </script>
</body>


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="error_msg" role="alert">
                    Incorrect Storcode or Password
                </div>


            </div>

        </div>
    </div>
</div>
<!-- Modal End-->

</html>