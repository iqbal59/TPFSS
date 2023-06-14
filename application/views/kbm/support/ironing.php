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
        <meta property="og:url" content="<?php// echo current_url(); ?>">
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
        </head>
        <body>

            <?php 
                // echo "<pre>";
                // print_r($fabtb);
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
            <section class="bg-image position-fixed w-100" style="z-index:1030">
                <div class="container ">
                    <div class="row">
                        <div class="col-lg-12 m-4 ">
                            <h3 class="text-center">Ironing Tutorial</h3>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div class="content">
                                <form class="row g-3" action="<?php echo base_url( 'knowledge-base/ironing-article' ); ?>">
                                    
                                    
                                    <div class="col">
                                        <?php //echo $fabtb->fabric; ?>
                                        <label class="form-label" for="fabric">Fabric <span class="required">*</span></label>
                                        <select class="form-control select2 " id="fabric_user" data-placeholder="Select fabric"
                                            name="fabric" required>
                                            <option></option>
                                            <?php
                                            
                                            
                                            if ( ! empty( $fabric) ) {
                                            foreach ( $fabric as $f ) { ?>
                                            <option value="<?php echo html_escape( $f->id ); ?>"
                                                <?php echo $fabtb->id==$f->id?"selected":"";?>>
                                            <?php echo html_escape( $f->fabric ); ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="col mt-4">
                                        <br />
                                        <button type="submit" class="btn border-0 btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            
            <?php if ($fabtb): ?>
                
            
            <div class="z-posts container" style="margin-top:250px;">
                <div class="row mb-4">

                    <!-- <div class="col">
                    </div> -->
                    <!-- /col -->
                </div>
                <!-- /.row -->
                <div class="row row-main">
                    <div class="col-lg-12 mb-2">
                        <h3 class="fw-bold mb-2"></h3>
                        <!-- <span class="d-inline-block small me-2">
                            <i class="far fa-clock"></i>
                        Posted on 2023-02-24                </span> -->
                        <div class="content border-top margin-footer">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <h5 class="card-header text-center">Ironing</h5>
                                        
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="card-text fw-bold"><?php echo $fabtb->fabric; ?></h6>
                                                    <br>
                                                </div>
                                                <!-- <div class="col text-end">
                                                    <h6 class="card-title">Water Temeprature</h6>
                                                    <p class="card-text fw-bold">
                                                    Cold                                        </p>
                                                </div> -->
                                            </div>
                                            
                                            <!-- <h6 class="card-title mt-2">Chemical Composition <small
                                            class="text-end text-warning"><i>* Dosage -ml
                                            (per kg for machine and per litre for handwash)</i></small></h6> -->
                                            <table class="table">
                                                <thead>
                                                    <tr class="table-light">
                                                        <th class="text-center">Heat Mode</th>
                                                        <th class="text-center">Steam</th>
                                                        <th class="text-center">Cotton Cloth On Fabric</th>
                                                        <th class="text-center">Inside Out</th>
                                                        <th class="text-center">Water Spray</th>
                                                        <th class="text-center">Starch Spray</th>
                                                        <th class="text-center">Hand Pressure</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><?php echo $fabtb->heat_mode; ?></td>
                                                        <td class="text-center"><?php echo $fabtb->steam; ?></td>
                                                        <td class="text-center"><?php echo $fabtb->cotton_cloth_on_fabric; ?></td>
                                                        <td class="text-center"><?php echo $fabtb->inside_out; ?></td>
                                                        <td class="text-center"><?php echo $fabtb->water_spray; ?></td>
                                                        <td class="text-center"><?php echo $fabtb->starch_spray; ?></td>
                                                        <td class="text-center"><?php echo $fabtb->hand_pressure; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.content -->
                        
                    </div>
                    <!-- /col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->

            <?php endif ?>
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