<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
      Set Schedule Time Slot

    </h2>
    <ol class="breadcrumb">
     <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i>Home</a></li>
     <li><a href="studentGroup.html"><i class="fa fa-home"></i> Group</a></li>

   </ol>
  </section>
  <!-- Main content -->

  <section class="content container-fluid">
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
    <input type="hidden" value="<?php echo base_url();?>" id="base_url">
    <div class="row">
      <div class="col-lg-12 col-xs-8">
        <div class="box box-primary">
          <div class="box-header"></div>
          <div class="form-horizontal">
            <!-- /.box-header -->
            <div  class="box-body">
              <div class="form-group">
                <style type="text/css">
                  .slot{
                    margin-top: 0px;
                  
                  }

                  .toStyle{
                    right: 5px;
                    padding-left: 30px;

                  }

     
                  .lines{
                    padding-left: 12.5%;
                    padding-bottom: 0px;
                    position: relative;

                  }    

                  .lines2{
                    padding-left: 10%;
                    padding-bottom: 0px;
                    position: relative;

                  }


                  .firstRow{
                    padding-left: 2%;
                  }

                  #secondRow{

                    padding-left: 10%;
                  }

                </style>

                
                <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                <div class="form-horizontal">

                  <div class="form-group">


                    <div  class="row firstRow">

                      <label class="col-sm-2 control-label">Starting Time</label>

                      <div class="col-sm-2">
                        <div class="input-group">
                          <input id="startTime" data-toggle="tooltip" title="Input the starting time"  class="form-control timepicker">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>

                      <label class="col-sm-1 control-label">Interval</label>

                      <div class="col-sm-2">
                        <input data-toggle="tooltip" title="Input the break intervals for each class in minutes" class="form-control" id="interval" placeholder="Interval">

                      </div>

                      <label class="col-sm-1 control-label">Duration</label>

                    

                      <div class="col-sm-2">
                        <div class="input-group">
                          <input id="duration" data-toggle="tooltip" title="Input the duration of each class" type="text" class="form-control timepicker2">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <br>
                    </div>
                    <div id="secondRow" class="row">
                      <div class="col-sm-2">
                       <button type="button" id="generate" class="btn btn-block btn-primary">Generate Schedule</button>
                     </div>
                    </div>

                    <div class="row lines2">
                      <div class="col-sm-10">
                        <hr>
                      </div>
                    </div>

                    <!--SLOT #1-->
                    <div class="row slot">
                      <label class="col-sm-2 control-label">Timeslot 1</label>
                      <div class="col-sm-2">
                        <div class="input-group timepick">
                          <input type="text" id="timeslot1" class="form-control timepicker">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>

                     
                      <label class="col-sm-1 control-label toStyle">Timeslot 2</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input type="text" id="timeslot2" class="form-control timepicker">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="row lines">
                      <div class="col-sm-6">
                        <hr>
                      </div>
                    </div>

                    <!--SLOT #2-->
                    <div class="row">
                      <label class="col-sm-2 control-label">Timeslot 3</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input id="timeslot3" type="text"  class="form-control timepicker">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                      
                      <label class="col-sm-1 control-label toStyle">Timeslot 4</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input type="text" id="timeslot4" class="form-control timepicker">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row lines">
                      <div class="col-sm-6">
                        <hr>
                      </div>
                    </div>

                    <!--SLOT #3-->
                    <div id="slot" class="row">
                      <label class="col-sm-2 control-label">Timeslot 5</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input type="text" id="timeslot5" class="form-control timepicker">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                       
                      <label class="col-sm-1 control-label toStyle">Timeslot 6</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input type="text" id="timeslot6" class="form-control timepicker">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>  


                    <div class="row lines">
                      <div class="col-sm-6">
                        <hr>
                      </div>
                    </div>

                    <!--SLOT #4-->
                    <div id="slot" class="row">
                      <label class="col-sm-2 control-label">Timeslot 7</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input type="text" id="timeslot7" class="form-control timepicker">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                      <label class="col-sm-1 control-label toStyle">Timeslot 8</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input type="text" id="timeslot8" class="form-control timepicker">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row lines">
                      <div class="col-sm-6">
                        <hr>
                      </div>
                    </div>



                    <style type="text/css">
                      #mid{
                        margin-left: 200px;
                        margin-top: 20px;
                      }
                    </style>

                    <div class="container-fluid">
                      <div class="row" id="mid">

                        <div class="col-lg-12 col-xs-12">
                          <div class="row" >
                            <div>
                             <a href="<?php echo site_url('coordinator');?>"><button type="button" class="btn btn-danger">Exit</button></a>
                             <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Save and Quit</button>
                           </div>
                         </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <style type="text/css">
              #but {
                margin-top: 30px;
                margin-bottom: 30px;
              }

            </style>
          </div>
        </div>

        <style type="text/css">
          .btn-danger{
            margin-left: 70px;
            margin-right: 20px;
          }
          #schoolyr{
            width: 100px;
          }
          #term1{
            width: 100px;
          }

        </style>
        
      </div>
    </div>

    <!--modal start-->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Set New Timeslots</h4>
          </div>
          <div class="modal-body">
            <div id="time_message">
              Do you want to replace old timeslots? This will affect the timeslots shown on the faculty and student accounts.
            </div>
            
          </div>
          
          <div class="modal-footer">
            <a href="<?php echo site_url('coordinator');?>"><button type="button" class="btn btn-danger">Exit</button></a>
            <button onclick="get_time_slots()" class="btn btn-success" data-dismiss="modal">Set New Timeslots</button></p>
          </div>
        </div>
      </div>
    </div>
    <!--modal end-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->