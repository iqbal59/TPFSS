<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tumbledry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
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
        }

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
                    <span class="navbar-text text-white">
                        Welcome
                        <?php echo $this->session->userdata('name'); ?>
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

    <main>



        <div class="album bg-light">
            <div class="container">




                <div class="row col-md-12 p-4">


                    <div class="panel panel-default">
                        <div class="panel-body">

                            <?php
                            if ($flg == 0) {
                                echo form_open(site_url("home/viewbyaadhar"), array('method' => 'get')) ?>
                                <fieldset>
                                    <legend>Search Details</legend>
                                    <div class="row g-3">


                                        <div class="col-auto">
                                            <label for="inputPassword2" class="visually-hidden">Password</label>
                                            <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" value=""
                                                placeholder="Enter aadhar no...." required>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mb-3">View</button>
                                        </div>




                                    </div>
                                </fieldset>

                                <?php echo form_close();
                            }

                            //print_r($s);
                            //print_r($studentDetails);
                            if ($flg == 1) {
                                if (!$s && !$studentDetails) {
                                    echo "<p class='text-center'>Record not found</p>";
                                } else {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6 mt-4">
                                            <h4>Personal Details</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td width="35%" class="table-header">Aadhar No.</td>
                                                        <th><?php echo $s->aadhar_no ? 'XXXXXXXX' . substr($s->aadhar_no, -4) : 'XXXXXXXX' . substr($studentDetails[0]->aadhar_no, -4); ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-header">Candidate Name</td>
                                                        <th><?php echo ucfirst($s->candidate_name ? $s->candidate_name : $studentDetails[0]->candidate_name); ?>
                                                        </th>
                                                    </tr>

                                                    <tr>
                                                        <td class="table-header">City/Town/Village</td>
                                                        <th><?php echo ucfirst($s->city ? $s->city : $studentDetails[0]->city_name); ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-header">District</td>
                                                        <th><?php echo ucfirst($s->district ? $s->district : $studentDetails[0]->district_name); ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-header">State</td>
                                                        <th><?php echo ucfirst($s->state ? $s->state : $studentDetails[0]->state_name); ?>
                                                        </th>
                                                    </tr>
                                                    <?php if ($this->user->info->ID == 472) { ?>
                                                        <tr>
                                                            <td>Mobile No.</td>
                                                            <th><?php echo $s->mobile ? $s->mobile : $studentDetails[0]->mobile_no; ?>
                                                            </th>
                                                        </tr>
                                                    <?php } ?>
                                                    <!-- <tr>
                                <td>Alternative Mobile No.</td>
                                <th><?php //echo $s->alternative_mobile; ?></th>
                            </tr> -->

                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <h4>Training Details</h4>
                                            <div class="table-responsive">
                                                <?php if ($s) { ?>
                                                    <table class="table table-bordered ">
                                                        <tr>
                                                            <td width="35%" class="table-header">Batch No.</td>
                                                            <th><?php echo $s->batch_no; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <td class="table-header">Batch Date</td>
                                                            <th><?php echo $s->batch_date ? date('d-m-Y', strtotime($s->batch_date)) : ""; ?>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td class="table-header">Certification Date</td>
                                                            <th><?php echo $s->certification_date ? date('d-m-Y', strtotime($s->certification_date)) : ""; ?>
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <td class="table-header">Role</td>
                                                            <th><?php echo $s->role_as; ?>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                <?php } else {
                                                    echo "<p class='text-center'>NA</p>";
                                                } ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6 mt-4">
                                            <h4>Blacklist Status</h4>
                                            <div class="table-responsive">

                                                <table class="table table-bordered ">
                                                    <tr>
                                                        <td class="table-header" width="25%">Status</td>
                                                        <th><?php echo $s->is_black_list == 1 ? "<strong class='text-danger'>Blacklist</strong>" : "<strong class='text-success'>Whitelist</strong>"; ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-header" width="25%">Remark</td>
                                                        <th><?php echo $s->remarks; ?>
                                                        </th>
                                                    </tr>


                                                </table>

                                            </div>

                                        </div>


                                        <div class="col-md-6 mt-4">
                                            <h4>Salary Details</h4>
                                            <div class="table-responsive">

                                                <table class="table table-bordered ">

                                                    <tr>
                                                        <td class="table-header" width="25%">Eligible Salary</td>
                                                        <th>
                                                            <?php
                                                            echo $salary;
                                                            ?>
                                                        </th>
                                                    </tr>


                                                </table>

                                            </div>

                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <h4>Employment History</h4>

                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                        <tr class="table-header">

                                                            <td>Update Date</td>
                                                            <td>Update By</td>
                                                            <td>Store Code</td>
                                                            <!-- <td>Store Name</td> -->
                                                            <td>Store Address</td>
                                                            <td>Joining Date</td>
                                                            <td>Exit date</td>
                                                            <td>Tenure</td>
                                                            <td>Salary</td>
                                                            <td>Role</td>


                                                        </tr>
                                                    </thead>
                                                    <tbody class="small-text">
                                                        <?php foreach ($studentDetails as $sd) { ?>
                                                            <tr>
                                                                <td><?php echo date('d-m-Y', strtotime($sd->create_date)); ?></td>
                                                                <td><?php echo $sd->create_by; ?></td>
                                                                <td><?php echo $sd->store_code ?></td>
                                                                <!-- <td><?php echo $sd->store_name ?></td> -->
                                                                <td><?php echo $sd->address ?></td>
                                                                <td><?php echo $sd->joining_date ? date('d-m-Y', strtotime($sd->joining_date)) : ""; ?>
                                                                </td>
                                                                <td><?php echo $sd->exit_date ? date('d-m-Y', strtotime($sd->exit_date)) : ""; ?>
                                                                <td>-</td>
                                                                <td><?php echo $sd->salary ?></td>
                                                                <td><?php echo $sd->role_as ?></td>


                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>


                                        <?php
                                }
                            }
                            ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </main>



    <!-- <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#" class="text-primary">Back to top</a>
            </p>

            <p class="mb-0 text-center text-secondary">©2019 <a href="https://www.tumbledry.in/" target="_blank"
                    class="text-primary">Tumbledry
                    Solutions
                    Pvt. Ltd.</a> All rights reserved.</p>
        </div>
    </footer> -->






    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
        </script>




</body>

</html>