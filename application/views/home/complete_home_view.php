<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CCS - CT Thesis Management System | Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    


  
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">
    
    <!-- Bootstrap CSS File -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
  
    <!-- Libraries CSS Files -->
    <link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Main <style type="text/css"></style>sheet File -->
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
    
    <link href="<?php echo base_url();?>css/customHome.css" rel="stylesheet">
    <!-- =======================================================
      Theme Name: Bell
      Theme URL: https://bootstrapmade.com/bell-free-bootstrap-4-template/
      Author: BootstrapMade.com
      Author URL: https://bootstrapmade.com
    ======================================================= -->
  </head>

  <body>
    <!-- Page Content
    ================================================== -->
    <!-- Hero -->

    <section class="hero">
      <div class="container text-center">
        <div class="row">
          
        </div>

        <div id="titleFace" class="col-md-12">
          <h1>
            CCS - CT Thesis <br> Management System
          </h1>

          <p id="tagline" class="tagline">
            Everything that you need for your defense <br>
            All in one website
          </p>
          <?php
            require ("vendor/autoload.php");
            //Step 1: Enter you google account credentials

            $g_client = new Google_Client();

            $g_client->setClientId("1067483480445-gengh3tq4anad9odhqs0fralk85veclh.apps.googleusercontent.com");
            $g_client->setClientSecret("lQMtpbYso3Hw0FD3G-H8srEq");
            $g_client->setRedirectUri("http://localhost/tms_ci_term2/index.php/login");     
            $g_client->setScopes("https://www.googleapis.com/auth/plus.login profile email https://mail.google.com/ https://www.googleapis.com/auth/gmail.compose");
            //$g_client->setAccessType("offline");

            //Step 2 : Create the url
            $auth_url = $g_client->createAuthUrl();
            echo "<a href='$auth_url' class='btn btn-full'>Login Through Google </a>";

            //Step 3 : Get the authorization  code
            $code = isset($_GET['code']) ? $_GET['code'] : NULL;

            //Step 4: Get access token
            if(isset($code)) {

                try {

                    $token = $g_client->fetchAccessTokenWithAuthCode($code);
                    $g_client->setAccessToken($token);

                }catch (Exception $e){
                    echo $e->getMessage();
                }




                try {
                    $pay_load = $g_client->verifyIdToken();


                }catch (Exception $e) {
                    echo $e->getMessage();
                }

            } else{
                $pay_load = null;
            }


          ?>
          <!--<a id="loginButton" class="btn btn-full" href="<?php //echo site_url('login/index');?>">Login</a>-->
          <a id="startButton" class="btn btn-full" href="#announcements">Announcements</a>
        </div>
      </div>
      
    </section>
    <!-- /Hero -->
    
  <!-- Header -->
    <!-- About -->



    <header id="announcements">
      <div class="container">
        
        <div class="row">
          <div class="feature-col col-lg-4 col-xs-12">
            <div class="card card-block">
             
              <div>
                <h2>
                <i class="fa fa-calendar"></i><?php echo $news_1['news_title'];?>
                </h2>
                <?php echo $news_1['news_details'];?>
              </div>
            </div>
          </div>

          <div class="feature-col col-lg-4 col-xs-12">
            <div class="card card-block">
             
              <div>
                <h2>
                <i class="fa fa-trophy"></i><?php echo $news_2['news_title'];?>
                </h2>
                <?php echo $news_2['news_details'];?>
              </div>
            </div>
          </div>

           <div class="feature-col col-lg-4 col-xs-12">
            <div class="card card-block">
             
              <div>
                <h2>
                <i class="fa fa-newspaper-o"></i><?php echo $news_3['news_title'];?>
                </h2>
                <?php echo $news_3['news_details'];?>
              </div>
            </div>
          </div>
        </div>

        
      </div>
    </header>

       <!-- /About -->
    <!-- Parallax -->

    
 
    
      
    
    <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a> <!-- JavaScript


    <!-- Required JavaScript Libraries -->
    <script src="<?php echo base_url();?>js/lib/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/lib/superfish/hoverIntent.js"></script>
    <script src="<?php echo base_url();?>js/lib/superfish/superfish.min.js"></script>
    <script src="<?php echo base_url();?>js/lib/tether/js/tether.min.js"></script>
    <script src="<?php echo base_url();?>js/lib/stellar/stellar.min.js"></script>
    <script src="<?php echo base_url();?>js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/lib/counterup/counterup.min.js"></script>
    <script src="<?php echo base_url();?>js/lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo base_url();?>js/lib/easing/easing.js"></script>
    <script src="<?php echo base_url();?>js/lib/stickyjs/sticky.js"></script>
    <script src="<?php echo base_url();?>js/lib/parallax/parallax.js"></script>
   
    
    <!-- Template Specisifc Custom Javascript File -->
    <script src="<?php echo base_url();?>js/custom.js"></script>
    
   
  </body>
</html>