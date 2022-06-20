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
        background: #a5cd39;
    }


    footer a {
        /* color: #ffc10e; */
        color: #fff;
    }
    </style>
</head>

<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-white">A laundry and dry clean e-commerce organization founded with an intent to
                            revolutionize the unorganized laundry service provided by maids, dhobis, and other stores
                            into an organized professionally managed retail and e-commerce service.</p>
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
            </div>
        </div>
    </header>

    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Making Business Easy For You</h1>
                    <!--<p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>-->

                </div>
            </div>
        </section>

        <div class="album bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                    <div class="col">
                        <div class="card shadow-sm">


                            <img src="<?php echo base_url('assets/images/tumbledry-logo-white.png')?>" class="p-5"
                                width="100%" />

                            <div class="card-body">
                                <h5 class="card-title">Design with tumbledry</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="https://designwithtumbledry.in/" target="_blank"
                                    class="btn btn-primary float-end">Go</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="<?php echo base_url('assets/images/tumbledry-logo-white.png')?>" class="p-5"
                                width="100%" />

                            <div class="card-body">
                                <h5 class="card-title">SCM</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <button type="button" class="btn btn-primary float-end" onclick="goToPage('order');">
                                    Go
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="<?php echo base_url('assets/images/tumbledry-logo-white.png')?>" class="p-5"
                                width="100%" />

                            <div class="card-body">
                                <h5 class="card-title">FSS</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>


                                <button type="button" class="btn btn-primary float-end" onclick="goToPage('fss');">
                                    Go
                                </button>


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
                <a href="#">Back to top</a>
            </p>

            <p class="mb-0 text-center">©2019 <a href="https://www.tumbledry.in/" target="_blank">Tumbledry Solutions
                    Pvt. Ltd.</a> All rights reserved.</p>
        </div>
    </footer>
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script>
    function goToPage(value) {
        $.ajax({
            url: "home/check_login",
            type: "POST",
            dataType: "json",
            data: "<?=$this->security->get_csrf_token_name();?>=<?=$this->security->get_csrf_hash();?>&url=" +
                value,
            success: function(data) {
                $('#l_type').val(value);
                console.log(data);
                if (data.st == 0) {
                    $('#loginModal').modal('show')

                } else {
                    // alert(data.url);
                    window.open(data.url, '_blank');
                }
            },
            error: function(error) {
                console.log(error);
            }

        });

    }

    function submitLoginForm() {
        $.post(
            'home/log',
            $("#login-form").serialize(),
            function(json) {
                if (json.st == 0) {
                    $('#error_msg').removeClass('d-none');
                    $('#error_msg').addClass('d-block');
                } else {
                    $('#error_msg').removeClass('d-none');
                    $('#loginModal').modal('hide')
                    window.open(json.url, '_blank');
                }
            },
            "json"
        );
    }

    // $("#login-form").submit(function() {

    //     return false;
    // });
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
                <form class="" id="login-form" action="<?php echo base_url('home/log'); ?>" method="post">
                    <input type="hidden" name="l_type" id="l_type" value="fss" />
                    <h2 class="box-title m-b-10 text-center">
                        <img src="<?php echo base_url() ?>assets/images/logo-light-login.png" alt="loginpage" />
                    </h2>

                    <div class="mb-3 ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="user_name" required=""
                                placeholder="Store Code">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required=""
                                placeholder="Password">
                        </div>
                    </div>

                    <!-- CSRF token -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
                        value="<?=$this->security->get_csrf_hash();?>" />

                    <div class="mb-3 text-center m-t-50">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="button"
                                onclick="submitLoginForm()">Log In</button>
                        </div>
                    </div>


                </form>

            </div>

        </div>
    </div>
</div>
<!-- Modal End-->

</html>