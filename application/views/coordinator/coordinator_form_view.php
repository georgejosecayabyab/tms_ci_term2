<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
    Form Download Links
    
    </h2>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="<?php echo $active_tab['form'];?>"><a href="<?php echo site_url('coordinator/view_form');?>"><i class="fa fa-sticky-note"></i> <span>Forms</span></a></li>
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
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <center><h4><i class="icon fa fa-info"></i> Alert!</h4>
      <?php echo $this->session->flashdata('success'); ?></center>
    </div>
  <?php endif; ?>
  <style type="text/css">
    #addForm{
      margin-left: 30px;
      margin-top: 20px;
    }
  </style>
  <div class="row">
    <div class="col-lg-12 col-xs-8">
      <button id="addForm" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Form</button>
    </div>
  </div>
  <!-- Modal -->
  <form action="<?php echo site_url('coordinator/upload_form');?>" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Form</h4>
          </div>
          <div class="modal-body">
            <div class="col-sm-8">
              <div id="upload" class="form-group">
                <label for="exampleInputFile">Upload <b>.docx or .pdf</b> form </label> 
                <input id="submission" type="file" name="userfile" size="20">
              </div>
            </div>
          <div class="form-group ">
            <div class="col-sm-8">
              <label for="course" class="col-sm-2 control-label">Course</label>
              <select class="form-control" id="course" name="course" style="width: 50%;">
                <?php foreach($course as $row):?>
                  <option><?php echo $row['course_code'];?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
        </div>
        <style>
          #btnb{
            margin-right: 20px;
          }
        </style>
        <div class="modal-footer">
          <div class="row" align="center">
           
            <button id="btnb" onclick="location.href='';" data-dismiss="modal" type="button" class="btn btn-danger">Exit</button>
             <button type="submit" class="btn btn-success">Save and Quit</button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </form>
  <section id="tableSection" class="content container-fluid">
    <div class="row" id="scheduleRow">
      
      <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Form (click to download)</th>
            <th>Course</th>
            <th></th>
          
          </tr>
        </thead>
        
        <tbody>
          <?php foreach($form as $row):?>
            <tr>
              <td><a href="<?php echo site_url('coordinator/download_form/'.$row['form_name']);?>"><?php echo $row['form_name'];?></a></td>
              <td><?php echo $row['course_code'];?></td>
              <td><a href="<?php echo site_url('coordinator/delete_form/'.$row['form_id']);?>"><button id="delete" type="button" class="btn btn-block btn-danger">Delete</button></a></td>
              
            </tr>
          <?php endforeach;?>
          
        </tbody>
      </table>
    </div>
    <div align="center"><b>Note: Only .docx and .pdf file types are accepted</b></div>
    
  </section>
</div>
<!-- /.content-wrapper -->