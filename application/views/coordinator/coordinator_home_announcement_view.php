<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h2>
          Home Announcements
          
          </h2>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="<?php echo $active_tab['home_announcement'];?>"><a href="<?php echo site_url('coordinator/view_home_announcement');?>"><i class="fa fa-circle-o"></i> Home Announcements</a></li>
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
          #newann{
            margin-top: 20px;
            margin-bottom: 20px;
          }

        </style>
        
        <section id="tableSection" class="content container-fluid">
          <div class="row" id="scheduleRow">
            <table id="table" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Announcement Title</th>
                
                  <th></th>
                  
                </tr>
              </thead>
              
              <tbody>
                <?php foreach($news as $row):?>
                  <tr>
                    <td><a href="<?php echo site_url('coordinator/view_specific_home_announcement/'.$row['news_id']);?>"><?php echo $row['news_title'];?></a></td>
                    <td id="del"><a href="<?php echo site_url('coordinator/view_specific_home_announcement/'.$row['news_id']);?>"><button type="button" value= "<?php echo $row['news_id'];?>" class="btn btn-block btn-primary">Edit</button></a></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
           
            
          </div>
        </div>
        <style type="text/css">
          #del{
            width: 50px;
          }
        </style>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->