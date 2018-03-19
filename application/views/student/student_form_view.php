 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        <?php echo $course['course_code'];?> Forms 
        
      </h2>
      <ol class="breadcrumb">
        <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="<?php echo $active_tab['form'];?>"><a href="<?php echo site_url('student/view_forms');?>"><i class="fa fa-sticky-note"></i> <span>Forms</span></a></li>
        
      </ol>
    </section>

    <!-- Main content -->
      
      <section class="content container-fluid">
        <div class="col-lg-12 col-xs-12">
          <div class="form-group">
            <table id="table" class="display" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                  
                  <th>Form</th>
                  
                 
                </tr>



            <?php if(sizeof($form) > 0):?>
              <?php foreach($form as $row):?>
                <tr>
                  <td><a href="<?php echo site_url('student/download_form/'.$row['form_name']);?>"><?php echo $row['form_name'];?></a>
                  </td>
                </tr>
                

              <?php endforeach;?>
               </tbody>
            </table>
            <?php else:?>
              <div class="alert alert-info alert-dismissible">
                <button type="button"  class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <center><h4><i class="icon fa fa-info"></i> Alert!</h4>
                <?php echo "No Forms"; ?></center>
              </div>
            <?php endif;?>
          </div>






            <!-- /.box-header -->
          
        </div>
            <!-- /.box-body -->
      </section>
  

          
   
  
    <!-- /.content -->
  </div>