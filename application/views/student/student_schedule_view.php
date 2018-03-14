<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
      Input Schedule
    </h2>
    <ol class="breadcrumb">
      <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
       <li class="<?php echo $active_tab['group_schedule'];?>"><a href="<?php echo site_url('student/view_schedule');?>"><i class="fa fa-clock-o"></i> <span>Group Schedule</span></a></li>
    </ol>
    <br>
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
    <!-- Default box -->
    <div class="box">
      <div class="row">
        <div id="noSched">
          <div class="col-xs-6">
            <div class="box-body">
              <div id="schedule">
                <div style="width:100%; height: 50%; display: flex; flex-direction: row; justify-content: center;">
                </div>
              </div>


            </div>
          </div>
          <div class="col-xs-5">
            <div class="box box-primary">

              <!-- /.box-header -->
              <div  class="box-body">
                <h2>Legend</h2></div >
                <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                <ul class="todo-list">
                  <li>
                    <div class="box-header with-border">
                      <h3 class="box-title">  Each Block Represent 1 Class Schedule</h3> <br><br>
                      <h3 class="box-title">  <canvas id="myCanvas" width="50" height="10" style="border:1px solid #000000; background: #bfbfbf">
                      </canvas> - Free Schedule</h3> <br>
                      <h3 class="box-title"> <canvas id="myCanvas" width="50" height="10" style="border:1px solid #000000; background: #6fa6dc">
                      </canvas> - Occupied Schedule</h3> </h3>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4 col-xs-12">
              </div>
              <div class="col-lg-3 col-xs-12">
                <form>
                  <button id="submitbtn2" onclick="location.href='<?php echo site_url('student');?>';" type="button" class="btn btn-danger">Exit</button>
                  <button id="submitbtn"  type="button" class="btn btn-success">Save and Quit</button>
                </form>
              </div>
            </div>
          </div>
        </div>    
      </div>

      <div id="withSched">

        <div class="row">
          <div class="col-md-8">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h1> Your Schedule</h1>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <span> <h4> Monday: </h3> <h4> 7:30 AM - 9:00 AM | 9:15 AM - 10:45 AM | 11:00 AM - 12:45 PM</h4></h3> </span>
                <span> <h4> Tuesday: </h3> <h4> 7:30 AM - 9:00 AM | 9:15 AM - 10:45 AM | 11:00 AM - 12:45 PM</h4> </h3> </span>
                <span> <h4> Wednesday: </h3> <h4> 7:30 AM - 9:00 AM | 9:15 AM - 10:45 AM | 11:00 AM - 12:45 PM</h4>  </h3></span>
                <span> <h4> Thursday: </h3> <h4> 7:30 AM - 9:00 AM | 9:15 AM - 10:45 AM | 11:00 AM - 12:45 PM</h4> </h3> </span>
                <span> <h4> Friday: </h3> <h4> 7:30 AM - 9:00 AM | 9:15 AM - 10:45 AM | 11:00 AM - 12:45 PM</h4> </h3> </span>
                <span> <h4> Saturday: </h3> <h4> 7:30 AM - 9:00 AM | 9:15 AM - 10:45 AM | 11:00 AM - 12:45 PM</h4> </h3> </span>
              </div>

              <div class="row">
                <div class="col-lg-1 col-xs-12">
                </div>
                <div class="col-lg-3 col-xs-12">
                  <form>
                    <button id="submitbtn2" onclick="location.href='<?php echo site_url('student');?>';" type="button" class="btn btn-danger">Exit</button>
                    <button id="editSched"  type="button" class="btn btn-success">Edit schedule</button>
                    
                  </form>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      </div>  
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
