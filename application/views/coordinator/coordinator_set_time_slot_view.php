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
    <?php if($this->session->flashdata('fail')): ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <center><h4><i class="icon fa fa-info"></i> Alert!</h4>
          <?php echo $this->session->flashdata('fail'); ?></center>
        </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('success')): ?>
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <center><h4><i class="icon fa fa-info"></i> Alert!</h4>
        <?php echo $this->session->flashdata('success'); ?></center>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-lg-12 col-xs-8">
        <div class="box box-primary">
          <div class="box-header"></div>
          <form action="<?php echo site_url('coordinator/move_to_next_term');?>" method="post" class="form-horizontal">
            <!-- /.box-header -->
            <div  class="box-body">
              <div class="form-group">
                <style type="text/css">
        #slot{
          margin-top: 20px;
        }

      </style>
      
              
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <form class="form-horizontal">
                
                <div class="form-group">
                  
                  <div id="slot" class="row">
                    <label for="inputName1" class="col-sm-2 control-label">Timeslot 1</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName1" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    <label for="inputName1" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    
                  </div>
                  
                 
                  <div id="slot" class="row">
                    <label for="inputName2" class="col-sm-2 control-label">Timeslot 2</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName2" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    <label for="inputName1" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    
                  </div>
                  
                  <div id="slot" class="row">
                    <label for="inputName3" class="col-sm-2 control-label">Timeslot 3</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName3" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    <label for="inputName1" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    
                  </div>
                  
                  <div id="slot" class="row">
                    <label for="inputName4" class="col-sm-2 control-label">Timeslot 4</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName4" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    <label for="inputName1" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    
                  </div>
                  
                  <div id="slot" class="row">
                    <label for="inputName5" class="col-sm-2 control-label">Timeslot 5</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName5" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    <label for="inputName1" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    
                  </div>
                  
                  <div id="slot" class="row">
                    <label for="inputName6" class="col-sm-2 control-label">Timeslot 6</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName6" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    <label for="inputName1" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    
                  </div>
                  
                  <div id="slot" class="row">
                    <label for="inputName" class="col-sm-2 control-label">Timeslot 7</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName7" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    <label for="inputName1" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    
                  </div>
                  
                  <div id="slot" class="row">
                    <label for="inputName" class="col-sm-2 control-label">Timeslot 8</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName8" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    <label for="inputName1" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="hour">
                    </div>
                    <div class="col-sm-1">
                      <input class="form-control" id="inputName" placeholder="min">
                    </div>
                    
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
                        <form>
                        	<a href="<?php echo site_url('coordinator');?>"><button type="button" class="btn btn-danger">Exit</button></a>
                    		<button type="submit" class="btn btn-success">Save and Quit</button>
                          
                          
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          
              </div>
          
              
              

              <style type="text/css">
                #but {
                  margin-top: 30px;
                  margin-bottom: 30px;
                }

              </style>
             
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
            <!-- /.box-body -->
          </form>
        </div>
      </div>
    </div>
    
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->