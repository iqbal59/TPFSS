<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
//$new_notifications = $this->Notification_model->check_for_new_notifications( true );
//$new_announcements = $this->Tool_model->check_for_new_announcements();
?>
<!DOCTYPE html>
<html lang="<?php echo lang( 'lang_iso_code' ); ?>">
    <head>
        <!-- Meta: -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php if ( ! empty( $page_meta_description ) ) { ?>
        <meta name="description" content="<?php echo html_escape( $page_meta_description ); ?>">
        <meta property="og:description" content="<?php echo html_escape( $page_meta_description ); ?>">
        <?php } else { ?>
        <meta name="description" content="<?php echo html_escape( db_config( 'site_description' ) ); ?>">
        <?php } ?>
        <?php if ( ! empty( $page_meta_keywords ) ) { ?>
        <meta name="keywords" content="<?php echo html_escape( $page_meta_keywords ); ?>">
        <?php } else { ?>
        <meta name="keywords" content="<?php echo html_escape( db_config( 'site_keywords' ) ); ?>">
        <?php } ?>
        <meta property="og:url" content="<?php echo current_url(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        if ( empty( $page_title ) )
        {
        $page_title = db_config( 'site_name' ) . ' - ' . db_config( 'site_tagline' );
        }
        else
        {
        $page_title = manage_title( $page_title );
        }
        $page_title = 'Tumbledry Knowledge Base';
        ?>
        <title><?php echo html_escape( $page_title ); ?></title>
        <meta property="og:title" content="<?php echo html_escape( $page_title ); ?>">
        <?php if ( ! empty( db_config( 'site_logo' ) ) ) { ?>
        <meta property="og:image" content="<?php echo general_uploads( html_escape( db_config( 'site_logo' ) ) ); ?>">
        <?php } ?>
        <!-- Favicon: -->
        <link rel="icon" href="<?php echo general_uploads( html_escape( db_config( 'site_favicon' ) ) ); ?>">
        <!-- Google Fonts: -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
            rel="stylesheet">
            <!-- Font Awesome CSS: -->
            <link rel="stylesheet" href="<?php assets_path( 'vendor/fontawesome-free/css/all.min.css' ); ?>">
            <!-- Pace CSS: -->
            <link rel="stylesheet" href="<?php assets_path( 'vendor/pace/pace.css' ); ?>">
            <!-- Bootstrap CSS: -->
            <link rel="stylesheet" href="<?php assets_path( 'vendor/bootstrap/css/bootstrap.min.css' ); ?>">
            <!-- Select 2: -->
            <link rel="stylesheet" href="<?php assets_path( 'vendor/select2/css/select2.min.css' ); ?>">
            <!-- Stylesheets: -->
            <link rel="stylesheet" href="<?php assets_path( 'vendor/loading_io/icon.css' ); ?>">
            <link rel="stylesheet" href="<?php assets_path( 'css/public/style.css?v=' . v_combine() ); ?>">
            <link rel="stylesheet" href="<?php assets_path( 'css/public/color_1.css?v=' . v_combine() ); ?>">
            <!-- jQuery: -->
            <script src="<?php assets_path( 'vendor/jquery/jquery.min.js' ); ?>"></script>
            <!-- Dynamic Variables: -->
            <script>
            const csrfToken = '<?php echo $this->security->get_csrf_hash(); ?>';
            const googleAnalyticsID = '<?php echo html_escape( db_config( "google_analytics_id" ) ); ?>';
            const baseURL = '<?php echo base_url(); ?>';
            const chatCookie = '<?php echo CHAT_COOKIE; ?>';
            const liveChattingStatus = '<?php echo db_config( "sp_live_chatting" ); ?>';
            var proceedChat = '<?php echo intval( $this->zuser->is_logged_in ); ?>';
            const errors = {
            'wentWrong': "<?php echo err_lang( 'went_wrong' ); ?>",
            401: "<?php echo err_lang( '401' ); ?>",
            403: "<?php echo err_lang( '403' ); ?>",
            404: "<?php echo err_lang( '404' ); ?>",
            500: "<?php echo err_lang( '500' ); ?>",
            502: "<?php echo err_lang( '502' ); ?>",
            503: "<?php echo err_lang( '503' ); ?>"
            };
            <?php if ( get( 'to_move_box' ) ) { ?>
            const moveToBoxId = '<?php echo get( "to_move_box" ); ?>';
            const subtractBoxMove = 85;
            <?php } ?>
            </script>
            <style>
                h1{
                    color: rgb(35,84,125);
                    margin-bottom: 30px;
                }
               h4{
                margin-bottom: 15px;
                margin-left: 20px;
                color: rgb(35,84,125);
               }
               ul{
                list-style-position: inside;
                margin-bottom: 35px;
                margin-left: 50px;
               }
               .table{
                width: 65vw;
                margin: 0 auto;
               }
               .col{
                border: 1px solid black;
               }
               .img1{
                display: flex;
                justify-content: space-evenly;
               }
               .p1 img{
                border: 1px solid black;
                width: 20vw;
               }
               th{
                color: rgb(35,84,125);
               }
               td,th{
                text-align: center;
               
               }
               b{
                color: rgb(35,84,125);
               }

               .prbtn{
                    margin-left: 65vw;
                    margin-top: 20px;
                    border-radius: 10px;
                    color: white;
                    border: 2px solid white;
                    background-color: DodgerBlue;
                }
                .prbtn a{
                    color: white;
                }

            </style>
        </head>
        <body id="body">

            <?php 
                // echo "<pre>";

                 //echo date('d-m-Y h:i:sa');
                // print_r($fabric);
             ?>
            <!-- Navbar: -->
            <nav class="navbar navbar-dark bg-dark shadow-sm fixed-top">
                <div class="container">
                    <a class="navbar-brand  align-items-center" href="<?php echo base_url(); ?>">
                        <?php if ( ! empty( db_config( 'site_logo' ) ) ) { ?>
                        <img src="<?php echo base_url('assets/images/tumbledry-logo-white.png')?>"
                        alt="<?php echo html_escape( db_config( 'site_name' ) ); ?>" height="40">
                        <?php } else { ?>
                        <!-- <h3 class="p-0 mb-0"><?php echo html_escape( db_config( 'site_name' ) ); ?></h3> -->
                        <img src="<?php echo base_url('assets/images/tumbledry-logo-white.png')?>"
                        alt="<?php echo html_escape( db_config( 'site_name' ) ); ?>" height="40">
                        <?php } ?>
                    </a>
                    <div class="d-flex">
                        <?php if ( $this->zuser->is_logged_in ) { ?>
                        <a class="text-muted me-4 d-lg-none" href="<?php echo env_url( 'user/notifications' ); ?>">
                            <?php if ( user_panel_activate_child_page( 'notifications' ) ) { ?>
                            <i class="fas fa-bell notifications-bell text-sub"></i>
                            <?php } else { ?>
                            <i class="far fa-bell notifications-bell"></i>
                            <?php } ?>
                            <?php if ( $new_notifications ) { ?>
                            <span
                            class="badge bg-danger notifications-count"><?php echo html_escape( $new_notifications ); ?></span>
                            <?php } ?>
                        </a>
                        <?php } ?>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                        aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
                        <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav mx-auto mb-0 mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?php echo ( empty( $this->uri->segment( 1 ) ) ) ? 'active' : ''; ?>"
                                href="<?php echo base_url(); ?>"><?php echo lang( 'home' ); ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
            <?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
            <?php if ( $article->visibility != 1 ) { ?>
            <!-- <div class="alert alert-danger no-radius"><?php echo lang( 'hidden_post' ); ?></div> -->
            <?php } ?>
            
            
           <div class="container mb-5">
               <div class="col">
                <button class="prbtn"><a href="<?php echo base_url('uploads/docs/Starching-Process.pdf')?>" target="_blank"><i class="fa fa-download"></i>  Download Printable Summary</a></button>
                   <h1 class="text-center mt-5">Starch Process</h1>
               </div>
               <div class="col p-5">
                    <h4>What is Starching?</h4>
                   <ul> 
                       <li>Process of making fabric crispy and smooth is known as starching. </li>
                       <li>It keeps clothes wrinkle free after ironing. </li>
                       <li>Starching also keeps clothes cleaner for long as it repels dirt and sweat. </li>
                   </ul>

                   <h4>Which Fabrics are recommended for Starching? </h4>
                   <ul> 
                       <li>Natural Fabric’s like Cotton, Linen and Cotton blends (Mix.)</li>
                       <li>Silk fabrics should be starched at the Ironing stage, using Starch Spray.</li>
                   </ul>

                   <h4>Process of starching.</h4>
                   <ul> 
                       <p><b>Step 1:</b> Starching process needs to be done, “After Washing/Cleaning of Garment” but “Before drying”</p>
                       <br>
        
                        <p><b>Step 2:</b> Prepare a mixture of Starch Solution as per grid below using <b>Chemical: Starch CHK 09 & Water as per recommended proportions</b></p>
                    </ul>

                    <table class="table table-bordered">
                        <tr>
                            <th class="table-active" scope="col">Article</th>
                            <th class="table-active" scope="col">Fabric</th>
                            <th class="table-primary" scope="col">Water Qty (Liters)</th>
                            <th class="table-secondary" scope="col">Light Starch Dosage(gm)</th>
                            <th class="table-secondary" scope="col">Medium Starch Dosage(gm)</th>
                            <th class="table-secondary" scope="col">Heavy Starch Dosage(gm)</th>
                        </tr>
                        <tr class="table-danger">
                            <th scope="row">Dupatta</th>
                            <td>Cotton/Linen</td>
                            <td>1</td>
                            <td>20</td>
                            <td>40</td>
                            <td>60</td>
                        </tr>
                        <tr class="table-success">
                            <th scope="row">Dupatta</th>
                            <td>Cotton Blend</td>
                            <td>1</td>
                            <td>40</td>
                            <td>60</td>
                            <td>80</td>
                        </tr>
                        <tr class="table-danger">
                            <th scope="row">Kurta</th>
                            <td>Cotton/Linen</td>
                            <td>1.5</td>
                            <td>20</td>
                            <td>40</td>
                            <td>60</td>
                        </tr>
                        <tr class="table-success">
                            <th scope="row">Kurta</th>
                            <td>Cotton Blend</td>
                            <td>1.5</td>
                            <td>40</td>
                            <td>60</td>
                            <td>80</td>
                        </tr>
                        <tr class="table-danger">
                            <th scope="row">Pajama</th>
                            <td>Cotton/Linen</td>
                            <td>1</td>
                            <td>20</td>
                            <td>40</td>
                            <td>60</td>
                        </tr>
                        <tr class="table-success">
                            <th scope="row">Pajama</th>
                            <td>Cotton Blend</td>
                            <td>1</td>
                            <td>40</td>
                            <td>60</td>
                            <td>80</td>
                        </tr>
                        <tr class="table-danger">
                            <th scope="row">Pant</th>
                            <td>Cotton/Linen</td>
                            <td>1</td>
                            <td>20</td>
                            <td>40</td>
                            <td>60</td>
                        </tr>
                        <tr class="table-success">
                            <th scope="row">Pant</th>
                            <td>Cotton Blend</td>
                            <td>1</td>
                            <td>40</td>
                            <td>60</td>
                            <td>80</td>
                        </tr>
                        <tr class="table-danger">
                            <th scope="row">Saree</th>
                            <td>Cotton/Linen</td>
                            <td>2</td>
                            <td>30</td>
                            <td>60</td>
                            <td>80</td>
                        </tr>
                        <tr class="table-success">
                            <th scope="row">Saree</th>
                            <td>Cotton Blend</td>
                            <td>2</td>
                            <td>50</td>
                            <td>80</td>
                            <td>120</td>
                        </tr>
                        <tr class="table-danger">
                            <th scope="row">Shirt</th>
                            <td>Cotton/Linen</td>
                            <td>1</td>
                            <td>20</td>
                            <td>40</td>
                            <td>60</td>
                        </tr>
                        <tr class="table-success">
                            <th scope="row">Shirt</th>
                            <td>Cotton Blend</td>
                            <td>1</td>
                            <td>40</td>
                            <td>60</td>
                            <td>80</td>
                        </tr>
                        <tr class="table-danger">
                            <th scope="row">T-Shirt</th>
                            <td>Cotton/Llinen</td>
                            <td>1</td>
                            <td>20</td>
                            <td>40</td>
                            <td>60</td>
                        </tr>
                        <tr class="table-success">
                            <th scope="row">T-Shirt</th>
                            <td>Cotton Blend</td>
                            <td>1</td>
                            <td>40</td>
                            <td>60</td>
                            <td>80</td>
                        </tr>

                    </table>
                    <ul>
                        <p class="mt-5 mb-5"><b>Step 3:</b> Put the required quantity of Starch <b>(Starch CHK 09)</b> in a clean Cotton cloth/Handkerchief to form a “Potli” and tie from top (Indicative Image appended)</p>
                    </ul>

                    <div class="mt-5 img1">
                        <div class="p1">
                            <img src="<?php echo base_url('assets/images/Picture1.jpg')?>" alt="">
                        </div>
                        <div class="p1">
                            <img style="margin-top: 30px;" src="<?php echo base_url('assets/images/Picture2.jpg')?>" alt="">
                        </div>
                    </div>

                    <ul>
                        <p class="mt-5 mb-5"><b>Step 4:</b> Dip the “Potli” in the bucket full of water and keep rotating it, till the entire “Potli” becomes empty and entire starch is mixed with water.</p>
                    </ul>

                    <ul>
                        <p class="mt-5 mb-5"><b>Step 5:</b> Dip the complete garment in the solution of starch and mix it well so that starch fills into the fabric of Garment. </p>
                    </ul>

                    <ul>
                        <p class="mt-5 mb-5"><b>Step 6:</b> Let the Garment be dipped in the solution for 20 mins. </p>
                    </ul>

                    <ul>
                        <p class="mt-5"><b>Step 7:</b> Take the Garment out and put it in Machine for “Spin cycle” (Hydro)</p>
                        <ul>
                            <p><b>PLEASE NOTE:</b></p>
                            <li><b>Do not Rinse the clothes with Water in the Washer</b></li>
                            <li><b>Select only “Spin Mode” in machine and NOT “Rinse & Spin”.</b></li>
                            <li><b>We don’t want the Starch to wash away.</b></li>
                            <li><b>We will use the Spin mode only to remove excess starch from the Garment.</b></li>
                        </ul>
                    </ul>
                    <ul>
                        <p><b>Step 8:</b> After Spin cycle, transfer the garment to the dryer for drying process. </p>
                    </ul>

                    <ul>
                        <p><b>Step 9:</b> Rinse the machine to get rid of any residual starch inside the washer.</p>
                    </ul>

                    <ul>
                        <p><b>Step 10:</b> Once the garment is dried, Iron it properly on High Heat.</p>
                    </ul>

                    <ul>
                        <p><b><u>Other Information</u></b></p>
                        <ul style="list-style-position: outside;">
                            <li><b>Same starch mixture prepared can be used on multiple clothes.</b> Example- All Non-Color bleeding clothes can be processed together with same &nbsp; starch mixture prepared by inserting them all together in bucket. This will also keep the cost low.</li>
                            <li><b>To Remove Starch from Garments:</b> Soak the garment in water for an hour before washing it. </li>
                        </ul>
                    </ul>
                    
               </div>
           </div>







            
            <?php load_view( 'home/still_no_luck' ); ?>
            <?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
            <?php if ( ! is_public_page() ) { ?>
            <footer class="footer-z bg-white pb-3 pb-md-0 shadow">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border-only-sm-bottom">
                                <p class="py-3 mb-0">
                                    <?php printf( lang( 'copyright_main' ), date( 'Y' ) ); ?>
                                    <?php echo lang( 'rights_reserved' ); ?>
                                </p>
                            </div>
                            <!-- /.border-only-sm-bottom -->
                        </div>
                        <!-- /col -->
                        <div class="col-md-6">
                            <div class="pt-3 menu float-md-end">
                                <a href="<?php echo env_url( 'privacy-policy' ); ?>"><?php echo get_page_name( 2 ); ?></a>
                                <a href="<?php echo env_url( 'terms' ); ?>"><?php echo get_page_name( 1 ); ?></a>
                                <div class="dropdown d-inline ms-3">
                                    <span id="language-switch" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo get_language_label( get_language() ); ?> <i class="fas fa-angle-down"></i>
                                    </span>
                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow" aria-labelledby="language-switch">
                                        <?php foreach ( AVAILABLE_LANGUAGES as $key => $value ) { ?>
                                        <li>
                                            <?php if ( $key !== get_language() ) { ?>
                                            <a href="<?php echo env_url(); ?>language/switch/<?php echo html_escape( $key ); ?>"
                                                class="dropdown-item small">
                                                <?php echo html_escape( $value['display_label'] ); ?>
                                            </a>
                                            <?php } else { ?>
                                            <span class="dropdown-item small">
                                                <?php echo html_escape( $value['display_label'] ); ?>
                                                <span class="float-end text-sub">
                                                    <i class="fas fa-check-circle mt-1"></i>
                                                </span>
                                            </span>
                                            <?php } ?>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <!-- /.dropdown -->
                            </div>
                            <!-- /.menu -->
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </footer>
            <?php //load_view( 'common/public/chat_box' ); ?>
            <?php } ?>
            <?php if ( db_config( 'site_show_cookie_popup' ) ) { ?>
            <div class="cookie-popup card border-0 bg-sub shadow-lg">
                <div class="card-body">
                    <p><?php echo lang( 'cookie_message' ); ?></p>
                    <div class="d-grid">
                        <button class="btn btn-light accept-btn text-uppercase accept-btn"><?php echo lang( 'got_it' ); ?></button>
                    </div>
                    <!-- /.d-grid -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.cookie-popup -->
            <?php } ?>
            <?php if ( db_config( 'site_custom_css' ) ) { ?>
            <!-- Custom CSS ( From Admin Panel ): -->
            <style>
            <?php echo html_escape(db_config('site_custom_css'));
            ?>
            </style>
            <?php } ?>
            <?php if ( ! empty( db_config( 'google_analytics_id' ) ) ) { ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async
            src="https://www.googletagmanager.com/gtag/js?id=<?php echo html_escape( db_config( 'google_analytics_id' ) ); ?>">
            </script>
            <?php } ?>
            <?php if ( is_gr_togo() && ! empty( $gr_field ) ) { ?>
            <!-- Google reCaptcha: -->
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <?php } ?>
            <?php if ( ! empty( $scripts ) )
            load_scripts( $scripts );
            ?>
            <!-- Pace JS: -->
            <script src="<?php assets_path( 'vendor/pace/pace.js' ); ?>"></script>
            <!-- jQuery Cookie: -->
            <script src="<?php assets_path( 'vendor/jquery-cookie/jquery.cookie.js' ); ?>"></script>
            <!-- Bootstrap JS: -->
            <script src="<?php assets_path( 'vendor/bootstrap/js/bootstrap.bundle.min.js' ); ?>"></script>
            <!-- Select 2: -->
            <script src="<?php assets_path( 'vendor/select2/js/select2.full.min.js' ); ?>"></script>
            <!-- Custom Scripts: -->
            <script src="<?php assets_path( 'js/functions.js?v=' . v_combine() ); ?>"></script>
            <script src="<?php assets_path( 'js/script.js?v=' . v_combine() ); ?>"></script>
            <script src="<?php assets_path( 'js/script_public.js?v=' . v_combine() ); ?>"></script>
        </body>
    </html>