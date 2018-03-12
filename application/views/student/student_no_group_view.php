<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        No Group Assigned
        
      </h2>
      <ol class="breadcrumb">
         <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="<?php echo $active_tab['group'];?>"><a href="<?php echo site_url('student/view_group/'.$group_id['group_id']);?>"><i class="fa fa-users"></i> <span>Group</span></a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="alert alert-info alert-dismissible">
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        No group has been assigned yet! Ask for thesis coordinator's help!
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->