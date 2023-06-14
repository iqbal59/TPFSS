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
                .box{
                    background: rgb(235,235,235);
                    padding: 2vw;
                    padding-bottom: 6vw;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                h2{
                    color: rgb(35,84,125);
                    margin: 2vw 0 2vw 0;
                }
                .ptxt{
                    margin: 0 12vw 3vw 12vw;
                    text-align: center;
                    font-size: 17px;
                }

                .accordion {
                  background-color:rgb(225,225,225);
                  color: rgb(35,84,125);
                  cursor: pointer;
                  padding: 18px;
                  margin-top: 1px;
                  width: 80%;
                  border: none;
                  text-align: left;
                  outline: none;
                  font-size: 18px;
                  transition: 0.4s;
                  box-shadow: 1px 1px 7px 0px rgba(0,0,0,0.75);
                }

                .active, .accordion:hover {
                  background-color: rgb(200,200,200);
                }

                .accordion:after {
                  content: '\002B';
                  color: #575656;
                  font-weight: bold;
                  float: right;
                  margin-left: 5px;
                }

                .active:after {
                  content: "\2212";
                }

                .panel {
                  padding: 0 18px;
                  background-color: white;
                  max-height: 0;
                  width: 80%;
                  overflow: hidden;
                  transition: max-height 0.2s ease-out;
                }
                .mmm{
                    width: 50px;
                    height: 50px;
                    margin-right: 15px;
                }
                .mm{
                    width: 50px;
                    height: 50px;
                    display: block;
                    margin: 8px auto;
/*                    border: 1px solid black;*/
                }
                th{
                    color: #575656;

                }
                .prbtn{
                    margin-left: 1000px;
                    border-radius: 10px;
                    color: white;
                    border: 2px solid white;
                    background-color: DodgerBlue;
                }
                /*@media print {
                    #prfb{
                        display: block;
                    }
                }*/

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
            
           <!--  <div class="row">
              <div class="col">
                <form action="<?php echo base_url('knowledge-base/sub-stain-article'); ?>">
                  <input type="text" class="form-control" name="stain_type">
                  <input type="submit">
                </form>
              </div>
            </div> -->

            <div class="accordion">
        <div class="accordion-content">
            <header>
                <span class="title">What do you mean by Accordion?</span>
                <i class="fa-solid fa-plus"></i>
            </header>

            <p class="description">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus nobis ut perspiciatis minima quidem nisi, obcaecati, delectus consequatur fuga nostrum iusto ipsam ducimus quibusdam possimus. Maiores non enim numquam voluptatem?
            </p>
        </div>

        <div class="accordion-content">
            <header>
                <span class="title">What do you mean by Accordion?</span>
                <i class="fa-solid fa-plus"></i>
            </header>

            <p class="description">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus nobis ut perspiciatis minima quidem nisi, obcaecati, delectus consequatur fuga nostrum iusto ipsam ducimus quibusdam possimus. Maiores non enim numquam voluptatem?
            </p>
        </div>
        <div class="accordion-content">
            <header>
                <span class="title">What do you mean by Accordion?</span>
                <i class="fa-solid fa-plus"></i>
            </header>

            <p class="description">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus nobis ut perspiciatis minima quidem nisi, obcaecati, delectus consequatur fuga nostrum iusto ipsam ducimus quibusdam possimus. Maiores non enim numquam voluptatem?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto neque, sed inventore 
            </p>
        </div>
        <div class="accordion-content">
            <header>
                <span class="title">What do you mean by Accordion?</span>
                <i class="fa-solid fa-plus"></i>
            </header>

            <p class="description">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus nobis ut perspiciatis minima quidem nisi, obcaecati, delectus consequatur fuga nostrum iusto ipsam ducimus quibusdam possimus. Maiores non enim numquam voluptatem?
            </p>
        </div>
    </div>


            <div id="prfb" class="d-none">
                <table class="" border="1">
                    <tr class="text-center" style="border:1px solid black;">

                        <th style="border:1px solid black;">Fabric</th>
                        <th style="border:1px solid black;">Heat Mode</th>
                        <th style="border:1px solid black;">Steam</th>
                        <th style="border:1px solid black;">Cotton Cloth On Fabric</th>
                        <th style="border:1px solid black;">Inside out</th>
                        <th style="border:1px solid black;">Water Spray</th>
                        <th style="border:1px solid black;">Starch Spray</th>
                        <th style="border:1px solid black;">Hand Pressure</th>
                    </tr>
                    
                        <?php                       
                    if( ! empty( $fabric) ) {
                    foreach( $fabric as $f ) { ?>
                     <tr class="text-center" style="border:1px solid black;">
                        <td style="border:1px solid black;"><?php echo $f->fabric; ?></td>
                        <td style="border:1px solid black;"><?php echo $f->heat_mode; ?></td>
                        <td style="border:1px solid black;"><?php echo $f->steam; ?></td>
                        <td style="border:1px solid black;"><?php echo $f->cotton_cloth_on_fabric; ?></td>
                        <td style="border:1px solid black;"><?php echo $f->inside_out; ?></td>
                        <td style="border:1px solid black;"><?php echo $f->water_spray; ?></td>
                        <td style="border:1px solid black;"><?php echo $f->starch_spray; ?></td>
                        <td style="border:1px solid black;"><?php echo $f->hand_pressure; ?></td>
                    </tr>
                    <?php }
                    } ?>
                    
                </table>
            </div>

<script>
    function printdiv(){
        var body = document.getElementById('body').innerHTML;
        var prfb = document.getElementById('prfb').innerHTML;
        document.getElementById('body').innerHTML = prfb;
        window.print();
    }
</script>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>


            
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


































<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <!-- =====Fontawesome CDN Link===== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <title>Accordion in HTML CSS & JavaScript</title>

   <style>
     /* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #E3F2FD;
}
.accordion{
    max-width: 530px;
    width: 100%;
    background: #FFF;
    margin: 0 15px;
    padding: 15px;
    border-radius: 8px;
    box-shadow:  0 0 4px rgba(0,0,0,0.2);
}
.accordion .accordion-content{
    margin: 10px 0;
    border-radius: 4px;
    background: #FFF7F0;
    border: 1px solid #FFD6B3;
    overflow: hidden;
}
.accordion-content:nth-child(2){
    background-color: #F0FAFF;
    border-color: #CCEEFF;
}
.accordion-content:nth-child(3){
    background-color: #FFF0F3;
    border-color: #FFCCD6;
}
.accordion-content:nth-child(4){
    background-color: #F0F0FF;
    border-color: #CCCCFF;
}
.accordion-content.open{
    padding-bottom: 10px;
}
.accordion-content header{
    display: flex;
    min-height: 50px;
    padding: 0 15px;
    cursor: pointer;
    align-items: center;
    justify-content: space-between;
    transition: all 0.2s linear;
}
.accordion-content.open header{
    min-height: 35px;
}
.accordion-content header .title{
    font-size: 14px;
    font-weight: 500;
    color: #333;
}
.accordion-content header i{
    font-size: 15px;
    color: #333;
}
.accordion-content .description{
    height: 0;
    font-size: 12px;
    color: #333;
    font-weight: 400;
    padding: 0 15px;
    transition: all 0.2s linear;
}
   </style>
</head>
<body>
    
    
    <script>
       const accordionContent = document.querySelectorAll(".accordion-content");

accordionContent.forEach((item, index) => {
    let header = item.querySelector("header");
    header.addEventListener("click", () =>{
        item.classList.toggle("open");

        let description = item.querySelector(".description");
        if(item.classList.contains("open")){
            description.style.height = `${description.scrollHeight}px`; //scrollHeight property returns the height of an element including padding , but excluding borders, scrollbar or margin
            item.querySelector("i").classList.replace("fa-plus", "fa-minus");
        }else{
            description.style.height = "0px";
            item.querySelector("i").classList.replace("fa-minus", "fa-plus");
        }
        removeOpen(index); //calling the funtion and also passing the index number of the clicked header
    })
})

function removeOpen(index1){
    accordionContent.forEach((item2, index2) => {
        if(index1 != index2){
            item2.classList.remove("open");

            let des = item2.querySelector(".description");
            des.style.height = "0px";
            item2.querySelector("i").classList.replace("fa-minus", "fa-plus");
        }
    })
}
    </script>
</body>
</html>