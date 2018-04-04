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
        <?php if($this->session->flashdata('fail')): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <center><h4><i class="icon fa fa-info"></i> Alert!</h4>
            <?php echo $this->session->flashdata('fail'); ?></center>
          </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <center><h4><i class="icon fa fa-info"></i> Alert!</h4>
            <?php echo $this->session->flashdata('success'); ?></center>
          </div>
        <?php endif; ?> 

        <div id="titleFace" class="col-md-12">
          <h1>
            CCS - CT Thesis <br> Management System
          </h1>

          <p id="tagline" class="tagline">
            Everything that you need for your defense <br>
            All in one website
          </p>
          <?php
            echo "<a href='$auth_url' class='btn btn-full'>Login Through Google </a>";
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
                <?php echo $news_1['news_title'];?>
                </h2>
                <?php echo $news_1['news_details'];?>
              </div>
            </div>
          </div>

          <div class="feature-col col-lg-4 col-xs-12">
            <div class="card card-block">
             
              <div>
                <h2>
                <?php echo $news_2['news_title'];?>
                </h2>
                <?php echo $news_2['news_details'];?>
              </div>
            </div>
          </div>

           <div class="feature-col col-lg-4 col-xs-12">
            <div class="card card-block">
             
              <div>
                <h2>
                <?php echo $news_3['news_title'];?>
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