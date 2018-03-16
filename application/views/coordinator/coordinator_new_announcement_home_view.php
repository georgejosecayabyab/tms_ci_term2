<?php echo validation_errors(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
    Home Announcement
    
    </h2>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#"><i class="fa fa-exclamation-circle"></i> <span>Announcements</span></a></li>
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
          <div>
            <div class="box-header">
              <div class="form-group">
                <label for="discussion_title" class="col-sm-1 control-label">Title</label>
                <div class="col-sm-6">
                  <input class="form-control" id="discussion_title" name="discussion_title" placeholder="Title" value="<?php echo $specific_news['news_title'];?>">
                </div>
              </div>
              <!-- tools box -->
              <div class="pull-right box-tools">
                
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <style type="text/css">
            #save_discussion{
              margin-top: 20px;
            }
            #exit{
              margin-right: 20px;
              margin-top: 20px;
            }

            </style>
            <div class="box-body pad">
              <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $specific_news['news_details'];?></textarea>
              <input type="hidden" id="news_id" value="<?php echo $specific_news['news_id']?>">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-4 col-xs-12">
                    <span></span>
                  </div>
                  <div class="col-lg-3 col-xs-12">
                    <span></span>
                    
                    <a href="<?php echo site_url('coordinator/view_home_announcement');?>"><button id="exit" name="exit" type="button" class="btn btn-danger" value="Exit">Exit</button></a>
                    <input onclick="home_fill_in()" id="save_discussion" name="save" type="submit" class="btn btn-success" value="Save and Quit">
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