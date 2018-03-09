 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        Forms
        
      </h2>
      <ol class="breadcrumb">
        <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="<?php echo $active_tab['form'];?>"><a href="<?php echo site_url('student/view_forms');?>"><i class="fa fa-sticky-note"></i> <span>Forms</span></a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--aguy -->
      <section class="content container-fluid">
        <div class="row" id="scheduleRow">


           
        </div>

        <div class="row">
          <div class="col-lg-12 col-xs-8">
            <div class="box box-primary">
            
              <!-- /.box-header -->
            
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              
            </div>
            <!-- /.box-body -->
            
          </div>
        </div>    

        <div class="col-lg-10 col-xs-8">
          <div class="form-group">
            <h2><?php echo $course['course_code'];?></h2>
          </div>
          <div class="form-group">
            <?php if(sizeof($form) > 0):?>
              <?php foreach($form as $row):?>
                <div class="box-header with-border">
                  <h3 class="box-title"><a href="<?php echo site_url('student/download_form/'.$row['form_name']);?>"><?php echo $row['form_name'];?></a>
                </div>
              <?php endforeach;?>
            <?php else:?>
              <div class="alert alert-info alert-dismissible">
                <button type="button"  class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <center><h4><i class="icon fa fa-info"></i> Alert!</h4>
                <?php echo "No Forms"; ?></center>
              </div>
            <?php endif;?>
          </div>

            <!-- /.box-header -->
          
        </div>
            <!-- /.box-body -->
      </section>
      <div class="row" id="scheduleRow">
      </div>

          
   
    </section>
    <!-- /.content -->
  </div>