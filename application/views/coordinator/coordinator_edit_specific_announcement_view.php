<?php echo validation_errors(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
    Specific Announcement
    
    </h2>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <input type="hidden" id="base_url" value="<?php echo base_url();?>">

    <div id="flash_message">
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
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <input type="hidden" id="event_id" value="<?php echo $related_news['event_id'];?>">
          <div>
            <div class="box-header">
            
              <div class="form-group">
                <label for="course" class="col-sm-2 control-label">Course</label>
                <span>
                  <select class="form-control select2" name="course" style="width: 50%;">
                    <?php foreach($course as $row):?>
                      <?php if($row['course_code'] == $related_news['course_code']):?>
                        <option selected><?php echo $row['course_code'];?></option>
                      <?php else:?>
                        <option><?php echo $row['course_code'];?></option>
                      <?php endif;?>
                      
                    <?php endforeach;?>  
                  </select>
                </span>
              </div>
              
              <!-- tools box -->
              <div class="pull-right box-tools">
                
              </div>
              <!-- /. tools -->
            </div>
            <style type="text/css">
              #save_discussion {
                margin-left: 20px;
                margin-top: 20px;

              }
              #exita {
                margin-top: 20px;
              }
            </style>
            <!-- /.box-header -->
            <div class="box-body pad">
              <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $related_news['event_desc'];?></textarea>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-4 col-xs-12">
                    <span></span>
                  </div>
                  <div class="col-lg-3 col-xs-12">
                    <span></span>
                    <a href="<?php echo site_url('coordinator/view_specific_announcement/');?>"><button id="exita" name="exit" type="button" class="btn btn-danger" value="Exit">Exit</button></a>
                    <button onclick="fill_in()" id="save_discussion" name="save" type="submit" class="btn btn-success" value="Save and Quit">Save and Quit</button>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->