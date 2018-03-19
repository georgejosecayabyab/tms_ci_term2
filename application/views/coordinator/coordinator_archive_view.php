<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        Thesis Archive
        
      </h2>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('coordinator');?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="<?php echo $active_tab['archive'];?>"><a href="<?php echo site_url('coordinator/view_archive');?>"><i class="fa fa-archive"></i> <span>Archive</span></a></li>
      </ol>
    </section>

    <!-- Main content -->
        <section id="tableSection" class="content container-fluid">
          <div class="row" id="scheduleRow">
            <table id="table" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Thesis Title</th>
                  <th>Department</th>
                  <th>Specialization</th>
                  <th>Members</th>
                  <th>Panel</th>
                  
                </tr>
              </thead>
              
              <tbody>
                <?php foreach($thesis as $trow):?>
                  <tr>
                    <td><a href="<?php echo site_url('coordinator/view_archive_specific/'.$trow['thesis_id']);?>"><?php echo $trow['thesis_title'];?></a></td>
                    <td>
                      <?php 
                       $course_code = $trow['course_code'];
                       if(strpos($course_code, "IT") !== FALSE){
                          echo "Information Technology";
                       }
                       if(strpos($course_code, "CT") !== FALSE){
                          echo "Computer Technology";
                       }
                       if(strpos($course_code, "ST") !== FALSE){
                          echo "Software Technology";
                       }
                      ?>
                    </td>
                    <td>
                      <?php
                        $tags = '';
                        foreach($specialization as $srow)
                        {
                          if($trow['thesis_id']==$srow['thesis_id'])
                          {
                            $tags.=$srow['specialization'].', ';
                          }
                        }
                        echo substr(trim($tags), 0, -1);
                      ?>
                    </td>
                    <td>
                      <?php
                        $tags = '';
                        foreach($member as $mrow)
                        {
                          if($trow['thesis_id']==$mrow['thesis_id'])
                          {
                            $tags.=$mrow['name'].', ';
                          }
                        }
                        echo substr(trim($tags), 0, -1);
                      ?>
                    </td>
                    <td>
                      <?php
                        $tags = '';
                        foreach($panel as $prow)
                        {
                          if($trow['thesis_id']==$prow['thesis_id'])
                          {
                            $tags.=$prow['name'].', ';
                          }
                        }
                        echo substr(trim($tags), 0, -1);
                      ?>
                    </td>
                    
                  </tr>
                <?php endforeach;?>  
                
              </tbody>
            </table>
            
            
          </div>
          </div>
        
        </section>
  </div>
  <!-- /.content-wrapper -->