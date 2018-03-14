<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
    Thesis Preview
    </h2>
    <ol class="breadcrumb">
      <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li class="<?php echo $active_tab['archive'];?>"><a href="<?php echo site_url('student/view_archive');?>"><i class="fa fa-archive"></i> <span>Archive</span></a></li>
      <li class="active"><?php echo $thesis['thesis_title'];?></li>
      
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
          title="Collapse">
          <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="col-lg-12">
          <h2><?php echo $thesis['thesis_title'];?></h2>
          <div class="form-group">
          </div>
          
          <div class="box-header with-border">
            <h3 class="box-title"> Abstract: <br> </h3>
            <h5>
            <?php echo $thesis['abstract'];?>
            </h5>
          </div>
          
          <div class="form-group">
            <div class="box-header with-border">
              <h3 class="box-title"> Members: </h3>
              <h5>
              <?php
              $tags = '';
              foreach($member as $mrow)
              {
              if($thesis['thesis_id']==$mrow['thesis_id'])
              {
              $tags.=$mrow['name'].', ';
              }
              }
              echo substr(trim($tags), 0, -1);
              ?>
              </h5>
            </div>
          </div>
          <div class="form-group">
            <div class="box-header with-border">
              <h3 class="box-title"> Panel List:  </h3>
              <h5>
              <?php
              $tags = '';
              foreach($panel as $prow)
              {
              if($thesis['thesis_id']==$prow['thesis_id'])
              {
              $tags.=$prow['name'].', ';
              }
              }
              echo substr(trim($tags), 0, -1);
              ?>
              </h5>
            </div>
          </div>
          <div class="form-group">
            <div class="box-header with-border">
              <h3 class="box-title"> Specialization: </h3>
              <h5>
              <?php
              foreach($specialization as $srow)
              {
              if($thesis['thesis_id']==$srow['thesis_id'])
              {
              echo '<span class="label regularLabel">'.$srow['specialization'].'</span>';
              }
              }
              ?>
              </h5>
            </div>
          </div>
          
          
        </div>
        
        
        <!-- /.box-header -->
        
      </div>
      
    </div>
    
    
    <!-- /.box-body -->
    
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->