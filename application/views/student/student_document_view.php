<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h2>
          Documents
          
          </h2>
          <ol class="breadcrumb">
            <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li class="<?php echo $active_tab['group'];?>"><a href="<?php echo site_url('student/view_group/'.$group_id['group_id']);?>"><i class="fa fa-users"></i> <span>Group</span></a></li>
            <li class="active">CT - Thesis Platform</li>
            
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
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#document" data-toggle="tab" aria-expanded="true">Document</a></li>
                  <li class=""><a href="#revision" data-toggle="tab" aria-expanded="false">Revision List</a></li>
                  
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="document">
                    <div id="pdf">
                      <iframe src = "<?php echo base_url();?>uploaded_thesis/<?php echo $upload['upload_name'];?>" width='1000' height='500' allowfullscreen webkitallowfullscreen></iframe>
                    </div>
                    
                  </div>
                  <div class="tab-pane" id="revision">
                    <div id="pdf" >
                      <iframe src = "<?php echo base_url();?>uploaded_thesis/<?php echo $upload['revision_name'];?>" width='1000' height='500' allowfullscreen webkitallowfullscreen></iframe>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div  id="timeline">
              <!-- The timeline -->
              <ul class="timeline timeline-inverse">

                <!-- timeline time label -->
                <li class="time-label">
                      <span class="bg-gray" id="panelComments">
                          Panel Comments
                      </span>
                 <a href="#inputComment"><i id="addComment" class="fa fa-fw fa-plus-circle bg-blue"></i> </a>

                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <?php 
                  //echo form_open('faculty/delete_comment');
                  echo '<input type="hidden" name="group_id" value="'.$group['group_id'].'">';
                  if(sizeof($comment)>0)
                  {
                    $date = '';
                    foreach($comment as $row)
                    {
                      if($date != $row['DATE'])
                      {
                        $date_new = strtotime($row['DATE']);
                        $formatted_date_new = date('F d, Y', $date_new);
                        $date = $row['DATE'];
                        echo '<li class="time-label">
                          <span class="bg-green">'
                            .$formatted_date_new.'
                          </span>
                        </li>';
                        echo '<li>
                         <i class="fa fa-comments bg-green"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i>'.$row['TIME'].'</span>

                            <h3 class="timeline-header"><a href="#">'.$row['COMMENTED BY'].'</a> commented</h3>

                            <div class="timeline-body">'
                              .$row['THESIS_COMMENT'].
                            '</div>';
                          echo '</div>
                        </li>';
                      }
                      else
                      {
                        echo '<li>
                         <i class="fa fa-comments bg-green"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i>'.$row['TIME'].'</span>

                            <h3 class="timeline-header"><a href="#">'.$row['COMMENTED BY'].'</a> commented</h3>

                            <div class="timeline-body">'
                              .$row['THESIS_COMMENT'].
                            '</div>';
                          echo '</div>
                        </li>';
                      }
                    }
                  }
                  else
                  {
                    echo '
                      <li>
                        <div class="timeline-item">
                          <div class="timeline-body">
                            No Comment
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->';
                  }
                  //echo '</form>';
                ?>
              
                <!-- END timeline item -->
                <!-- timeline item -->

                
              </ul>
            </div>
            

          </div>
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->