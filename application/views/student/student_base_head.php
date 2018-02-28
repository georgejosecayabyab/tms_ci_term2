<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> CTP - Student | Home </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>css/select2.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>css/skins/skin-green.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>css/custom.css">
  
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>css/index.css">

  <link href="<?php echo base_url();?>css/editor.css" rel="stylesheet"> -->

  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-datepicker.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-datepicker.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>

  <script src="<?php echo base_url();?>js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>jquery.weekly-schedule-plugin.js"></script>
  <?php 
    $day1_content = array();
    foreach($mo as $row)
    {
      $no_space = str_replace(' ', '', $row['START_TIME']);
      array_push($day1_content, ltrim($no_space, '0'));
    }

    $day2_content = array();
    foreach($tu as $row)
    {
      $no_space = str_replace(' ', '', $row['START_TIME']);
      array_push($day2_content, ltrim($no_space, '0'));
    }

    $day3_content = array();
    foreach($we as $row)
    {
      $no_space = str_replace(' ', '', $row['START_TIME']);
      array_push($day3_content, ltrim($no_space, '0'));
    }

    $day4_content = array();
    foreach($th as $row)
    {
      $no_space = str_replace(' ', '', $row['START_TIME']);
      array_push($day4_content, ltrim($no_space, '0'));
    }

    $day5_content = array();
    foreach($fr as $row)
    {
      $no_space = str_replace(' ', '', $row['START_TIME']);
      array_push($day5_content, ltrim($no_space, '0'));
    }

    $day6_content = array();
    foreach($sa as $row)
    {
      $no_space = str_replace(' ', '', $row['START_TIME']);
      array_push($day6_content, ltrim($no_space, '0'));
    }

    $day1 = $day1_content;
    $day2 = $day2_content;
    $day3 = $day3_content;
    $day4 = $day4_content;
    $day5 = $day5_content;
    $day6 = $day6_content;
    $array = array('day1'=>$day1,'day2'=>$day2,'day3'=>$day3,'day4'=>$day4,'day5'=>$day5,'day6'=>$day6);
    echo "<script> var schedule=".json_encode($array)."; passData(schedule); </script>";

    // $day1 = $day1_content;
    // $day2 = array("07:30AM");
    // $day3 = array("7:30AM");
    // $day4 = array("7:30AM");
    // $day5 = array("7:30AM");
    // $day6 = array("7:30PM");
  ?>
  <!-- <script>

    var scheduleTest1 = {


      day1: ["7:30AM"],
      day2: [],
      day3: [],
      day4: [],
      day5: [],
      day6: [],


    };

    var scheduleTest2 = {


      day1: ["7:30AM", "9:15AM", "11:00AM", "12:45PM", "2:30PM", "4:15PM", "6:00PM", "8:45PM"],
      day2: ["7:30AM", "9:15AM", "11:00AM", "6:00PM", "8:45PM"],
      day3: ["7:30AM", "9:15AM", "2:30PM", "4:15PM"],
      day4: ["7:30AM", "11:00AM",  "2:30PM", "4:15PM", "8:45PM"],
      day5: ["7:30AM", "9:15AM", "11:00AM", "12:45PM", "2:30PM", "4:15PM", "6:00PM", "8:45PM"],
      day6: ["9:15AM", "11:00AM","12:45PM"]


    };


    var blank={


      day1: [],
      day2: [],
      day3: [],
      day4: [],
      day5: [],
      day6: []


    };

    passData(scheduleTest1);


  </script> -->

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">


    <!-- Logo -->
    <a href="<?php echo site_url('student');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>TT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CT</b>   THESIS</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
     <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
     
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li id="notification" class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span id="new_notification_number" class="label label-warning"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul id="notification_list" class="menu">
                  <!-- start notification -->
                    
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
        
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-user"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left info">
          
        </div>
      </div>

      <!-- search form (Optional) -->
     
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul id="header" class="sidebar-menu" data-widget="tree">
        <li  class="header">MENU -STUDENT</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="<?php echo $active_tab['group'];?>"><a href="<?php echo site_url('student/view_group/'.$group_id['group_id']);?>"><i class="fa fa-users"></i> <span>Group</span></a></li>
        <li class="<?php echo $active_tab['group_schedule'];?>"><a href="<?php echo site_url('student/view_schedule');?>"><i class="fa fa-clock-o"></i> <span>Group Schedule</span></a></li>
        <li class="<?php echo $active_tab['form'];?>"><a href="<?php echo site_url('student/view_forms');?>"><i class="fa fa-sticky-note"></i> <span>Forms</span></a></li>
        <li class="<?php echo $active_tab['archive'];?>"><a href="<?php echo site_url('student/view_archive');?>"><i class="fa fa-archive"></i> <span>Archive</span></a></li>
        
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>