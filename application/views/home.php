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

        <section class="pt-2 pb-4 text-center container-fluid bg-top">
            <div class="row ">
                <div class="col-md-2 col-sm-12 mx-auto">
                    <a class="d-md-block" href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><img class="text-center" width="50%"
                            src="<?php echo base_url('assets/images/tutorial.png') ?>" /></a>
                </div>
                <div class="col-md-8 col-sm-12 mx-auto">
                    <img class="d-none d-md-block" width="100%"
                        src="<?php echo base_url('assets/images/cover.jpg') ?>" />

                    <img class="d-block d-md-none" width="100%"
                        src="<?php echo base_url('assets/images/cover_mobile.jpg') ?>" />
                    <!-- <h1 class="fw-light">Making Business Easy For You</h1> -->
                    <!--<p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>-->

                </div>
            </div>
        </section>

        <div class="album bg-light">
            <div class="container">

                <div class="row row-cols-1 equal-cols row-cols-sm-2 row-cols-md-3 g-3 mb-4">


                    <?php $msg = $this->session->flashdata('msg'); ?>
                    <?php if (isset($msg)): ?>

                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle"></i>
                            <?php echo $msg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                    <?php endif ?>





                    <div class="col-md-4">

                        <div class="card shadow-sm" onclick="window.open('https://designwithtumbledry.in/', '_blank');">


                            <img src="<?php echo base_url('assets/images/design-with-tumbledry.jpg') ?>"
                                class="card-img-top" />

                            <div class="card-body">
                                <h5 class="card-title">Marketing Creatives</h5>
                                <h6 class="card-subtitle mb-2 text-muted">DIY Design Tool<br /><br /></h6>
                                <p class="card-text">Easily make unique social media designs in a flash using 100s of
                                    templates, images, trending design assets, and more.</p>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm"
                            onclick="window.open('https://orderattumbledry.in/partner/log/'+'<?php echo $this->session->userdata('code') . "/" . $this->session->userdata('psw'); ?>', '_blank');">
                            <img src="<?php echo base_url('assets/images/scm.jpg') ?>" class="card-img-top" />

                            <div class="card-body">
                                <h5 class="card-title">Procurement</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Order - Pay - Track<br /><br /></h6>

                                <p class="card-text">A convenient online portal to order supplies, make online payments
                                    and track shipment at a click of a button.</p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm" onclick="window.open('partner/dashboard', '_blank');">
                            <img src="<?php echo base_url('assets/images/fss.jpg') ?>" class="card-img-top" />

                            <div class="card-body">


                                <h5 class="card-title">Transactions</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Manage Purchase/Royalty Invoices, Payments,
                                    Account Statement</h6>

                                <p class="card-text">Get full control of your financial transactions with tumbledry –
                                    Access Purchase & Royalty invoices, Payments & Your Account statements</p>




                            </div>


                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="card shadow-sm" onclick="window.open('partner/poject_charter', '_blank');">
                            <img src="<?php echo base_url('assets/images/project_small.jpg') ?>" class="card-img-top" />

                            <div class="card-body">


                                <h5 class="card-title">Project Tracker</h5>
                                <h6 class="card-subtitle mb-2 text-muted">End-to-end project management tool</h6>

                                <p class="card-text">There are 250 distinct activities that need to be completed to
                                    launch your tumbledry store. Track the live status of all these activities here.</p>




                            </div>


                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card shadow-sm" onclick="window.open('knowledge-base', '_blank');">
                            <img src="<?php echo base_url('assets/images/knowledge-base.jpg') ?>"
                                class="card-img-top" />

                            <div class="card-body">


                                <h5 class="card-title">Knowledge Management

                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    E-learning tool for training & development</h6>

                                <p class="card-text">A self-learning tool to get comprehensive knowledge of how to
                                    process items to deliver top-notch quality.

                                </p>




                            </div>


                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="card shadow-sm"
                            onclick="window.open('https://tms.simplifytumbledry.in/login/simplypro/'+'<?php echo $this->session->userdata('code') . "/" . $this->session->userdata('psw'); ?>', '_blank');">
                            <img src="<?php echo base_url('assets/images/ticket.jpg') ?>" class="card-img-top" />

                            <div class="card-body">


                                <h5 class="card-title">Support Hub

                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Comprehensive ticket management system for seamless issue resolution</h6>

                                <p class="card-text">An efficient and effective medium to raise your queries and
                                    streamline the process of issue resolution. It aims to centralize, organize, and
                                    track tickets, ensuring that each request is addressed, and resolved in a timely
                                    manner.

                                </p>




                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="modal-body">
                    <!-- <video width="100%" height="315" controls>
                        <source src="https://drive.google.com/file/d/1I_C02hgjHkxW12sJykutAhWK1QqsR7uf/view?usp=sharing"
                            type="video/mp4">

                        Your browser does not support the video tag.
                    </video> -->
                    <div style="padding:75% 0 0 0;position:relative;"><iframe
                            src="https://player.vimeo.com/video/760287483?h=8c4f569f66&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479"
                            frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                            title="Tutorial First"></iframe>
                    </div>
                    <script src="https://player.vimeo.com/api/player.js"></script>

                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

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

</html>