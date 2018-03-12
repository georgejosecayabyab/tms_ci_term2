<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        Upcoming Defense Schedules
        
      </h2>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i>Home</a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row" id="scheduleRow">
        <?php if(sizeof($defense)>0):?>
          <?php foreach($defense as $row):?>
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <?php 
                if($row['DIFF'] >= 14)
                {
                  echo '<div class="small-box bg-blue">';
                }
                else if($row['DIFF'] >= 7)
                {
                  echo '<div class="small-box bg-yellow">';
                }
                else
                {
                  echo '<div class="small-box bg-red">';
                }
              ?>
                <div class="inner">
                  <h3><?php 
                  if($row['DEF_DATE']==$row['NOW'])
                  {
                    echo 'Today';
                  }
                  else
                  {
                    $date_new = strtotime($row['DEF_DATE']);
                    $formatted_date_new = date('F d, Y', $date_new);
                    echo $formatted_date_new;
                  }
                  ?></h3>
                  <p> <b> Time: </b><?php echo $row['START'].'-'.$row['END'];?></p>
                  <p> <b> Group Name: </b><?php echo $row['GROUP_NAME'];?></p>
                  <p> <b> Topic: </b><?php echo $row['THESIS_TITLE']?></p>
                </div>
                <div class="icon">
                <i class="fa fa-calendar"></i>

                </div>
               <a href="<?php echo site_url('coordinator/view_group');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          <?php endforeach;?>
        <?php else:?>
          <div class="alert alert-info alert-dismissible">
            <button type="button"  class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <center><h4><i class="icon fa fa-info"></i> Alert!</h4>
            <?php echo "No Defense"; ?></center>
          </div>
        <?php endif;?>
      </div>

      <!-- /.box-body -->
    </section>
    <div align="center"><h4><b>Legend for defense schedules:</b></h4></div>
    <div align="center">Red: 1 week away</div>
    <div align="center">Yellow: 2 weeks away</div>
    <div align="center">Blue: beyond 2 weeks</div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->