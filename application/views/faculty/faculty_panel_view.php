<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
      Panels
      
    </h2>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('faculty');?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="<?php echo $active_tab['panels'];?>"><a href="<?php echo site_url("faculty/view_panel_details");?>"><i class="fa fa-graduation-cap"></i> <span>Panels</span></a></li>
      
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    
    <div class="row" id="groupsRow">
      <?php foreach($panel_details as $row):?>
      <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            
          <h2><b><?php echo $row['GROUP_NAME'];?></b></h2>
            <div class="row">
                <div class="col-lg-6">
                <p class="titleCard"> <b>
                  <?php 
                  $date_new = strtotime($row['DEFENSE_DATE']);
                  $formatted_date_new = date('F d, Y', $date_new);
                  echo $formatted_date_new;
                  ?>  
                </b></p>           
                <p> <b> Time: </b><?php echo $row['START'].'-'.$row['END'];?></p>
                
                
                </div>
                <div class="col-lg-6">
                
                <p> <b> Document: </b>
                  <?php 
                    $list="";
                    foreach($comment as $row_comment)
                    {
                      if($row['GROUP_ID']==$row_comment['GROUP_ID'])
                      {
                        if($row_comment['COUNT'] > 0)
                        {
                          if($row_comment['COUNT'] > 1)
                          {
                            $list = $row_comment['COUNT']." Comments";
                          }
                          else
                          {
                            $list = $row_comment['COUNT']." Comment";
                          }
                        }
                      }
                    }
                    if($list == "")
                    {
                      $list = "No Comments";
                    }
                    echo $list;
                  ?>
                </p>
                <p> <b> Members: </b> 
                  <?php 
                    $list="";
                    foreach($member as $row_member)
                    {
                      
                      if($row['GROUP_ID']==$row_member['GROUP_ID'])
                      {
                        $list .= $row_member['FIRST_NAME'].' '.$row_member['LAST_NAME'].', ';
                      }
                    }
                    echo substr(trim($list), 0, -1);
                  ?>
                </p>
                
              
                </div>

                <div class="col-lg-12">
                
                  <p>
                  <b> Specialization: </b>
                    <span></span>
                    <?php foreach($tags as $row_tag):?>
                      <?php if($row['GROUP_ID']==$row_tag['group_id']):?>
                        <span class="label regularLabel"><?php echo $row_tag['specialization'];?></span>
                      <?php endif;?>
                    <?php endforeach;?>
                  </p>

                </div>  
            </div>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="<?php echo site_url('faculty/view_panel_specific/'.$row['GROUP_ID']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <?php endforeach;?>
    </div>
   
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
