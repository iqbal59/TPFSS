<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

// $new_notifications = $this->Notification_model->check_for_new_notifications();
// $limited_notifications = $this->Notification_model->notifications( ['limit' => 3] );

?>
<!DOCTYPE html>
<html lang="<?php echo lang( 'lang_iso_code' ); ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width: -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo html_escape( manage_title( $page_title ) ); ?></title>

    <!-- Favicon: -->
    <link rel="icon" href="<?php echo general_uploads( html_escape( db_config( 'site_favicon' ) ) ); ?>">

    <!-- Font Awesome: -->
    <link rel="stylesheet" href="<?php assets_path( 'vendor/fontawesome-free/css/all.min.css' ); ?>">

    <!-- Overlay Scrollbars: -->
    <link rel="stylesheet"
        href="<?php admin_lte_asset( 'plugins/overlayScrollbars/css/OverlayScrollbars.min.css' ); ?>">

    <!-- iCheck Bootstrap: -->
    <link rel="stylesheet" href="<?php admin_lte_asset( 'plugins/icheck-bootstrap/icheck-bootstrap.min.css' ); ?>">

    <!-- Select 2: -->
    <link rel="stylesheet" href="<?php admin_lte_asset( 'plugins/select2/css/select2.min.css' ); ?>">

    <!-- Summernote: -->
    <link rel="stylesheet" href="<?php admin_lte_asset( 'plugins/summernote/summernote-bs4.css' ); ?>">

    <!-- jQuery Upload Preview: -->
    <link rel="stylesheet"
        href="<?php assets_path( 'panel/vendor/jquery_upload_preview/css/jquery.uploadPreview.css' ); ?>">

    <!-- Theme Style: -->
    <link rel="stylesheet" href="<?php admin_lte_asset( 'css/adminlte.min.css' ); ?>">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Pace: -->
    <link rel="stylesheet" href="<?php assets_path( 'vendor/pace/pace.css' ); ?>">

    <!-- Custom Styles: -->
    <link rel="stylesheet" href="<?php assets_path( 'vendor/loading_io/icon.css' ); ?>">
    <link rel="stylesheet" href="<?php assets_path( 'css/custom.css?v=' . v_combine() ); ?>">

    <!-- jQuery: -->
    <script src="<?php assets_path( 'vendor/jquery/jquery.min.js' ); ?>"></script>

    <!-- Dynamic Variables: -->
    <script>
    const csrfToken = '<?php echo $this->security->get_csrf_hash(); ?>';
    const msgSeemsDeleted = "<?php echo lang( 'seems_deleted' ); ?>";
    const processing = "<?php echo lang( 'processing' ); ?>";
    const changeFile = "<?php echo lang( 'change_file' ); ?>";
    const chooseFile = "<?php echo lang( 'choose_file' ); ?>";
    const googleAnalyticsID = "<?php echo html_escape( db_config( 'google_analytics_id' ) ); ?>";
    const eProtocol = "<?php echo html_escape( db_config( 'e_protocol' ) ); ?>";
    const baseURL = '<?php echo base_url(); ?>';
    const sidebarCookie = '<?php echo SIDEBAR_COOKIE; ?>';
    const snImageUpload = '<?php echo env_url(); ?>admin/kbm/support/sn_image_upload';
    const snDeleteUpload = '<?php echo env_url(); ?>admin/kbm/support/sn_image_delete';

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
    <?php } ?>
    </script>

</head>

<body class="hold-transition <?php echo get_body_classes(); ?>">

    <div class="wrapper">

        <!-- Navbar: -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
            <!-- Left Navbar Links: -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link sidebar-toggle" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?php echo base_url(); ?>" class="btn btn-dark">
                        <i class="fas fa-home mr-2 nav-home-icon"></i>
                        <span class="d-none d-sm-inline-block"><?php echo lang('main_website'); ?></span>
                    </a>
                </li> -->
            </ul>

            <!-- Right Navbar Links: -->
            <ul class="navbar-nav ml-auto">
                <?php if ( get_session( 'impersonating' ) ) { ?>
                <li class="nav-item">
                    <a class="nav-link text-danger border-right-1"
                        href="<?php admin_action( 'users/deimpersonate' ); ?>">
                        <span class="d-none d-sm-block"><?php echo lang( 'stop_impersonating' ); ?></span>
                        <i class="fas fa-stop-circle d-block d-sm-none mt-1" data-toggle="tooltip" data-placement="left"
                            title="<?php echo lang( 'stop_impersonating' ); ?>"></i>
                    </a>
                </li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link border-right-1" data-toggle="dropdown" href="#" aria-expanded="false">

                        <?php if ( panel_activate_child_page( 'notifications' ) ) { ?>
                        <i class="fas fa-bell"></i>
                        <?php } else { ?>
                        <i class="far fa-bell"></i>
                        <?php } ?>

                        <?php if ( $new_notifications ) { ?>
                        <span
                            class="badge badge-danger notifications-count"><?php echo html_escape( $new_notifications ); ?></span>
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right dropdown-notifications">
                        <span class="dropdown-item dropdown-header"><?php echo lang( 'notifications' ); ?></span>
                        <div class="dropdown-divider"></div>
                        <?php
          if ( ! empty( $limited_notifications ) ) {
            foreach ( $limited_notifications as $notification_header ) {
              $nh_togo = ( $notification_header->is_read == 1 ) ? $notification_header->location : "admin/read_notification/{$notification_header->id}"; ?>
                        <a href="<?php echo html_escape( env_url( $nh_togo ) ); ?>" class="dropdown-item">

                            <?php if ( $notification_header->is_read == 0 ) { ?>
                            <span class="badge badge-danger mb-1"><?php echo lang( 'unread' ); ?></span>
                            <?php } ?>

                            <span
                                class="d-block"><?php echo lang( html_escape( $notification_header->message_key ) ); ?></span>
                            <span class="text-muted d-block mt-1">
                                <i class="far fa-clock"></i>
                                <?php echo get_date_time_by_timezone( html_escape( $notification_header->created_at ), true ); ?>
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <?php } ?>

                        <a href="<?php echo env_url( 'admin/notifications' ); ?>"
                            class="dropdown-item dropdown-footer"><?php echo lang( 'see_all' ); ?></a>
                        <?php } else { ?>
                        <span class="dropdown-item text-center"><?php echo lang( 'no_notifications' ); ?></span>
                        <?php } ?>
                    </div>
                    <!-- /.dropdown-menu -->
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" data-toggle="dropdown" href="#">
                        <?php echo get_language_label( get_language() ); ?> <i class="fas fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php foreach ( AVAILABLE_LANGUAGES as $key => $value ) { ?>

                        <?php if ( $key !== get_language() ) { ?>
                        <a href="<?php echo env_url(); ?>language/switch/<?php echo html_escape( $key ); ?>"
                            class="dropdown-item">
                            <?php echo html_escape( $value['display_label'] ); ?>
                        </a>
                        <?php } else { ?>
                        <span class="dropdown-item">
                            <?php echo html_escape( $value['display_label'] ); ?>

                            <span class="float-right text-primary text-sm">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        </span>
                        <?php } ?>

                        <?php } ?>
                    </div>
                    <!-- /.dropdown-menu -->
                </li>
                <!-- Account Dropdown Menu: -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <?php echo lang( 'account' ); ?> <i class="fas fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a href="<?php echo env_url( 'admin/account/profile_settings' ); ?>"
                            class="dropdown-item <?php echo panel_activate_sub_child_page( 'profile_settings' ); ?>">
                            <?php echo lang( 'profile_settings' ); ?>
                        </a>
                        <a href="<?php echo env_url( 'admin/account/change_password' ); ?>"
                            class="dropdown-item <?php echo panel_activate_sub_child_page( 'change_password' ); ?>">
                            <?php echo lang( 'change_password' ); ?>
                        </a> -->
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo env_url( 'admin/knowledge_base/logout' ); ?>" class="dropdown-item">
                            <?php echo lang( 'logout' ); ?>
                        </a>
                    </div>
                    <!-- /.dropdown-menu -->
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container: -->
        <aside class="main-sidebar sidebar-dark-danger elevation-4">
            <!-- Brand Logo/Name: -->
            <a href="<?php echo env_url( 'admin/knowledge_base/dashboard' ); ?>" class="brand-link text-sm">
                <img src="<?php echo base_url('assets/images/logo-light-icon.png'); //echo general_uploads( html_escape( db_config( 'site_favicon' ) ) ); ?>"
                    alt="" class="brand-image favicon img-opacity img-circle elevation-3">
                <span class="brand-text">tumbledry<?php //echo html_escape( db_config( 'site_name' ) ); ?></span>
            </a>
            <!-- Sidebar: -->
            <div class="sidebar os-host-overflow">

                <?php if ( db_config( 'maintenance_mode' ) ) { ?>
                <div class="bg-danger text-center p-2 mb-3 text-sm">
                    <span><i class="fas fa-check-circle mr-1"></i> <?php echo lang( 'maintenance_mode' ); ?></span>
                </div>
                <?php } ?>

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image position-relative">
                        <img src="<?php echo base_url('assets/images/default.png'); //echo user_picture( html_esc_url( $this->zuser->get( 'picture' ) ) ); ?>"
                            class="img-circle img-opacity elevation-2 profile-pic-sm" alt="User Image">
                    </div>
                    <!-- /.image -->
                    <div class="info text-sm">
                        <a href="javascript:void(0)" class="d-block"> IA Alam
                            <?php //echo html_escape( long_to_short_name( $this->zuser->get( 'first_name' ) . ' ' . $this->zuser->get( 'last_name' ) ) ); ?></a>
                    </div>
                    <!-- /.info -->
                </div>
                <!-- /.user-panel -->

                <!-- Sidebar Menu: -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-legacy text-sm" data-widget="treeview"
                        role="menu" data-accordion="true">
                        <li class="nav-item">
                            <a href="<?php echo env_url( 'admin/knowledge_base/dashboard' ); ?>"
                                class="nav-link <?php echo panel_activate_child_page( 'dashboard' ); ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p><?php echo lang( 'dashboard' ); ?></p>
                            </a>
                        </li>



                        <?php //if ( $this->zuser->has_permission( 'knowledge_base' ) ) { ?>
                        <li class="nav-item has-treeview <?php echo panel_open_parent_menu( 'knowledge_base' ); ?>">
                            <a href="#" class="nav-link <?php echo panel_activate_parent_menu( 'knowledge_base' ); ?>">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    <?php echo lang( 'knowledge_base' ); ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo env_url( 'admin/knowledge_base/categories' ); ?>"
                                        class="nav-link <?php echo panel_activate_sub_child_page( 'categories', 'admin', 'knowledge_base' ); ?>">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p><?php echo lang( 'categories' ); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo env_url( 'admin/knowledge_base/subcategories' ); ?>"
                                        class="nav-link <?php echo panel_activate_sub_child_page( 'subcategories' ); ?>">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p><?php echo lang( 'subcategories' ); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo env_url( 'admin/knowledge_base/articles' ); ?>"
                                        class="nav-link <?php echo panel_activate_sub_child_page( ['articles', 'new_article', 'edit_article'] ); ?>">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p><?php echo lang( 'articles' ); ?></p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo env_url( 'admin/knowledge_base/washing' ); ?>"
                                        class="nav-link <?php echo panel_activate_sub_child_page( ['washing', 'new_washing', 'edit_washing'] ); ?>">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Washing and Drying</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo env_url( 'admin/knowledge_base/ironing' ); ?>"
                                        class="nav-link <?php echo panel_activate_sub_child_page( ['ironing', 'new_ironing', 'edit_ironing'] ); ?>">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Ironing</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <?php //} ?>



                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper: -->
        <div class="content-wrapper pt-3">