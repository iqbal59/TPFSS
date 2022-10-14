<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page;?>
    </title>
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

                    <img src="<?php echo base_url('assets/images/tumbledry-logo-white.png')?>" height="40" />

                </a>

                <?php
                
               
                if ($this->session->userdata('is_partner_login')) {?>
                <span class="navbar-text text-white">
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

    <main>

        <section class="pt-2 pb-4 text-center container-fluid bg-top">
            <div class="row ">
                <div class="col-md-12 mx-auto">
                    <img class="d-none d-md-block" width="100%"
                        src="<?php echo base_url('assets/images/cover.jpg')?>" />

                    <img class="d-block d-md-none" width="100%"
                        src="<?php echo base_url('assets/images/cover_mobile.jpg')?>" />
                    <!-- <h1 class="fw-light">Making Business Easy For You</h1> -->
                    <!--<p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>-->

                </div>
            </div>
        </section>

        <div class="album bg-light">
            <div class="container">

                <div class="row justify-content-center m-4">
                    <div class="col-md-6">

                        <div class="card shadow-sm">



                            <div class="card-body">

                                <?php $msg = $this->session->flashdata('msg'); ?>
                                <?php if (isset($msg)): ?>


                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check-circle"></i>
                                    <?php echo $msg; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>


                                <?php endif ?>

                                <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                                <?php if (isset($error_msg)): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check-circle"></i>
                                    <?php echo $error_msg; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                                <?php endif ?>





                                <form method="post" action="<?php echo base_url('home/profile')?>">

                                    <h4 class="box-title m-b-10 text-center">
                                        Change Password
                                    </h4>

                                    <input type="hidden" name="store_id" value="<?php echo $storeData['id'];?>" />



                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
                                        value="<?=$this->security->get_csrf_hash();?>" />


                                    <div class="mb-3">
                                        <label class="from-label">Current Password</label>

                                        <input type="password" name="cur_password"
                                            value="<?php echo $this->input->post('cur_password');?>"
                                            class="form-control" />
                                        <div class="form-text text-danger"><?php echo form_error('cur_password');?>
                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label class="from-label">New Password</label>

                                        <input type="password" name="new_password"
                                            value="<?php echo $this->input->post('new_password');?>"
                                            class="form-control " />
                                        <div class="form-text text-danger"><?php echo form_error('new_password');?>
                                        </div>

                                    </div>


                                    <div class="mb-3">
                                        <label class="from-label">Confirm Password</label>

                                        <input type="password" name="confirm_password"
                                            value="<?php echo $this->input->post('confirm_password');?>"
                                            class="form-control " />
                                        <div class="form-text text-danger"><?php echo form_error('confirm_password');?>
                                        </div>

                                    </div>




                                    <div class="mb-3">

                                        <button class="btn btn-primary">Change Password</button>

                                    </div>
                                </form>



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