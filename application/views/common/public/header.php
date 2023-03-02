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

</head>

<body>

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