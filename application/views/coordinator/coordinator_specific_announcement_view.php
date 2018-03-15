 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h2>
          Course Specific Announcement
          
          </h2>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="<?php echo $active_tab['specific_announcement'];?>"><a href="<?php echo site_url('coordinator/view_specific_announcement');?>"><i class="fa fa-circle-o"></i> Specific Announcements</a></li>
          </ol>
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
        </section>
        <!-- Main content -->
        <style type="text/css">
          #newAnn{
            margin-top: 20px;
            margin-bottom: 20px;
            width: 250px;
          }

        </style>
        <div class="col-lg-1 col-xs-1">
          <a href="<?php echo site_url('coordinator/view_new_specific_announcement');?>"><button id="newAnn" type="button" class="btn btn-block btn-primary">New Announcement</button></a>
        </div>
        <section id="tableSection" class="content container-fluid">
          <div class="row" id="scheduleRow">
            <table id="table" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Course</th>
                
                  <th></th>
                  
                </tr>
              </thead>
              
              <tbody>
                <?php foreach($related_news as $row):?>
                  <tr>
                    <td><a href="<?php echo site_url('coordinator/view_edit_specific_announcement/'.$row['event_id']);?>"><?php echo $row['event_desc'];?></a></td>
                    <td><?php echo $row['course_code'];?></td>
                 
                    <td><a href="<?php echo site_url('coordinator/delete_related_news/'.$row['event_id']);?>"><button type="button" class="btn btn-block btn-danger">Delete</button></td>

                  </tr>
                <?php endforeach;?>
                
              </tbody>
            </table>
           
            
          </div>
        </div>
        
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->