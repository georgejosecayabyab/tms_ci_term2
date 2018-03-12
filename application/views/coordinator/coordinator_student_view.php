<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
    Students
    
    </h2>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="<?php echo $active_tab['student'];?>"><a href="<?php echo site_url('coordinator/view_student');?>"><i class="fa fa-user"></i> <span>Students</span></a></li>
    </ol>
  </section>
  <!-- Main content -->
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
  <style type="text/css">
    #addStu{
      margin-top: 20px;
      margin-left: 30px;
      margin-right: 20px;
    }
    #addGroup{
      margin-top: 20px;
    }
  </style>
  <div class="row">
    <div class="col-lg-12 col-xs-8">
      <button id="addStu" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Student</button>
      <button id="addGroup" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">Add Group</button>
    </div>
  </div>
  <input id="base_url" type="hidden" value="<?php echo base_url();?>">
  <!-- Modal 1 -->
  <form action="<?php echo site_url('coordinator/validate_student');?>" method="POST" class="form-horizontal">
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Student</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-8">
                <input class="form-control" id="email" name="email" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="first_name" class="col-sm-2 control-label">First Name</label>
              <div class="col-sm-8">
                <input class="form-control" id="first_name" name="first_name" placeholder="First Name">
              </div>
            </div>
            
            <div class="form-group">
              <label for="last_name" class="col-sm-2 control-label">Last Name</label>
              <div class="col-sm-8">
                <input class="form-control" id="last_name" name="last_name" placeholder="Last Name">
              </div>
            </div>
            <div class="form-group ">
              <label for="course" class="col-sm-2 control-label">Course</label>
              
              <div class="col-sm-8">
                <select class="form-control" id="course" name="course">
                  <?php foreach($course as $row):?>
                    <option><?php echo $row['course_code'];?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
            
          </div>
          <style>
          #ex2{
            margin-right: 20px;
          }
          </style>
          <div class="modal-footer">
            <div class="row" align="center">
              
              <button id="ex2" onclick="location.href='';" data-dismiss="modal" type="button" class="btn btn-danger">Exit</button>
              <button type="submit" class="btn btn-success">Save and Quit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- Modal2 -->

  <form method="POST" action="<?php echo site_url('coordinator/insert_group');?>" class="form-horizontal">
    <div id="user_id" hidden>

    </div>
    <div id="adviser_id" hidden>

    </div>
    <div id="myModal2" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Group</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="group_name" class="col-sm-2 control-label">Group Name</label>
              <div class="col-sm-8">
                <input class="form-control" name="group_name" id="group_name" placeholder="Group Name">
              </div>
            </div>
            <div class="form-group">
              <label for="thesis_title" class="col-sm-2 control-label">Thesis Title</label>
              <div class="col-sm-8">
                <input class="form-control" name="thesis_title" id="thesis_title" placeholder="Thesis Title">
              </div>
            </div>
            <div class="form-group">
              <label for="course" class="col-sm-2 control-label">Course</label>
              <div class="col-sm-8">
                <select class="form-control" id="course" name="course" style="width: 100%;">
                  <?php foreach($course as $row):?>
                    <option><?php echo $row['course_code'];?></option>
                  <?php endforeach;?>
                </select> 
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Adviser</label>
              <div class="col-sm-8">
                <select class="form-control" name="adviser" id="adviser" style="width: 100%;">
                  <?php foreach($faculty as $row):?>
                    <option value="<?php echo $row['user_id'];?>"><?php echo $row['last_name'].', '.$row['first_name'];?></option>
                  <?php endforeach;?>
                </select> 
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Members</label>
              <div id="group_members" class="col-sm-8">
                <h5>None</h5>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row" align="center">
              <button id="ex2" data-dismiss="modal" type="button" class="btn btn-danger">Exit</button>
              <button id="add_group_submit" onclick="" type="submit" class="btn btn-success">Save and Quit</button>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- Main content -->
  <section id="tableSection" class="content container-fluid">
    <div class="row" id="scheduleRow">
      
      <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Course</th>
            <th>Group</th>
            <th>Status</th>
          </tr>
        </thead>
        <div class="form-group">
          <tbody>
            <?php foreach($student as $row):?>


              <tr>
              <?php 
                if($row['IS_ACTIVE'] == 1 && $row['GROUP_NAME'] == null)
                {
                  ?>
                <td><input name="<?php echo $row['USER_ID'];?>" type="checkbox" id="student_box"></td>

                <?php } 
                else
                {
                  echo '<td></td>';

                }


                ?>

                <td><?php echo $row['NAME'];?></a></td>
                <td>
                  <?php
                    echo $row['COURSE_CODE'];
                  ?>
                </td>
                <td><?php echo $row['GROUP_NAME']?></td>
                <td>
                  <?php 
                    if($row['IS_ACTIVE'] == 1)
                    {
                      echo 'Active';
                    }
                    else
                    {
                      echo 'Inactive';
                    }
                  ?>
                    
                </td>
              </tr>
            <?php endforeach;?>
            
          </tbody>
        </div>
      </table>

    </div>
  
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->