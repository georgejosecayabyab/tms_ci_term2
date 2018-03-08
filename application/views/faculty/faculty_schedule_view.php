<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
      Input Schedule
    </h2>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i>Home</a>
      <li><a href="<?php echo site_url("faculty/view_schedule");?>"><i class="fa fa-clock-o"></i> <span>Schedule</span></a></li>
      
      
    </ol>
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

                  <div id="target">
                  </div>


                </div>
              </div>


            </div>
          </div>
          <div class="col-xs-5">
            <div class="box">

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
                      <div>
                        <div>
                          <br>
                          <a href="#" id="specialCase"> + Add a Special Case Schedule</a>
                          <br> ex: LASARE3/Nov 24/8AM-5PM
                        </div>
                        <br>
                        <div class="col-xs-10" id="specialField">
                        </div>

                      </div>
                    </div>

                  </a>
                </li>

              </ul>
            </div>


            <!-- /.box-body -->

          </div>
          <style type="text/css">
            #submitbtn2{
              margin-right: 20px;
            }

          </style>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4 col-xs-12">
              </div>  
              <div class="col-lg-3 col-xs-12">
                <form>
                  
                  <button id="submitbtn2" onclick="location.href='facultyViewProfile.html';" type="button" class="btn btn-danger">Exit</button>
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
                    <button id="editSched"  type="button" class="btn btn-success">Edit schedule</button>
                    <button id="submitbtn2" onclick="location.href='facultyViewProfile.html';" type="button" class="btn btn-danger">Exit</button>

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
