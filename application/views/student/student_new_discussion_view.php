<?php echo validation_errors(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
    Discussions
    
    </h2>
    <ol class="breadcrumb">
       <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
      
    </ol>

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
  </section>
  <!-- Main content -->
  <section class="content">
    <input id="base_url" type="hidden" value="<?php echo base_url();?>">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div>
            <div class="box-header">
              <input type="hidden" value="<?php echo $group_id['group_id'];?>" name="group_id">
              <div class="form-group">
                <label for="discussion_title" class="col-sm-2 control-label">Discussion Title</label>
                <div class="col-sm-6">
                  <input class="form-control" id="discussion_title" name="discussion_title" placeholder="Title">
                </div>
              </div>
              <!-- tools box -->
              <div class="pull-right box-tools">
                
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <textarea id="editor1" name="editor1" rows="10" cols="80"></textarea>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-4 col-xs-12">
                    <span></span>
                  </div>
                  <div class="col-lg-3 col-xs-12">
                    <span></span>
                    <style type="text/css">
                      #exit{
                        margin-right: 20px;
                        margin-top: 20px;

                      }
                      #save_discussion{
                        margin-top: 20px;
                      }

                    </style>
                    <a href="<?php echo site_url('student/view_group/'.$group_id['group_id']);?>"><input id="exit" name="exit" type="button" class="btn btn-danger" value="Exit"></a>
                    <button onclick="fill_in()" id="save_discussion" name="save" class="btn btn-success">Save and Quit</button>
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