<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h2>
        Student Profile
        
        </h2>
        <ol class="breadcrumb">
          <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li class="<?php echo $active_tab['group'];?>"><a href="<?php echo site_url('student/view_group/'.$group_id['group_id']);?>"><i class="fa fa-users"></i> <span>Group</span></a></li>
          
        </ol>
      </section>
      <!-- Main content -->
                  
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <div class="col-md-6">
              <div class="box box-solid">
                
                <!-- /.box-header -->
                <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
                
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- /.box-footer-->
          </section>
          
          
          <!-- /.modal -->
          
                <!-- /.box-body -->
              </div>
            </div>
          </div>
          
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->