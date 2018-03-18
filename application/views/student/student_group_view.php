
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>
      <?php echo $group['group_name'];?>
    </h2>
    <br>
    <ol class="breadcrumb">
      <li class="<?php echo $active_tab['home'];?>"><a href="<?php echo site_url('student/index');?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li class="<?php echo $active_tab['group'];?>"><a href="<?php echo site_url('student/view_group/'.$group_id['group_id']);?>"><i class="fa fa-users"></i> <span>Group</span></a></li>
      <li class="active"><?php echo $group['group_name'];?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <input type="hidden" id="base_url" value="<?php echo base_url();?>">
    <div id="flash_message">
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
    </div>
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>img/team-2.png" alt="User profile picture">

            <h3 class="profile-username text-center"><?php echo $group['thesis_title'];?></h3>

           

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Current Course</b> <a class="pull-right"><?php echo $group['course_code'];?></a>
              </li>
              <li class="list-group-item">
                <b>Defense Date</b> <a class="pull-right">
                  <?php 
                    if(sizeof($defense)>0)
                    {
                      $date_new = strtotime($defense['DEF_DATE']);
                      $formatted_date_new = date('F d, Y', $date_new);
                      echo $formatted_date_new;
                    } 
                    else
                    {
                      echo 'None';
                    }
                    
                  ?>
                </a>
              </li>
              <li class="list-group-item">
                <b>Defense Venue</b> <a class="pull-right">
                  <?php
                    if(sizeof($defense)>0)
                    {
                      echo $defense['VENUE'];
                    } 
                    else
                    {
                      echo 'None';
                    }
                  ?></a>
              </li>
             
            </ul>

            
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">About Us</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <strong><i class="fa fa-users margin-r-5"></i>Thesis Members</strong>

            <p>
             <?php
              $list = "";
              if(sizeof($member)>0)
              {
                foreach($member as $member_row)
                {
                  if($member_row['group_id']==$group['group_id'])
                  {
                    $list .= $member_row['first_name'].' '.$member_row['last_name'].', ';
                  }
                }
                echo substr(trim($list), 0, -1);
              }
              else
              {
                echo 'None';
              }
            ?>
            </p>

            <hr>

           <strong><i class="fa fa-graduation-cap margin-r-5"></i>Thesis Adivser</i></strong>

            <p>
              <?php echo $group['first_name'].' '.$group['last_name'];?>
            </p>

            <hr>

            <strong><i class="fa fa-pencil margin-r-5"></i> Specialization</strong>

            <p>
              <?php if(sizeof($tag)>0):?>
                <?php foreach($tag as $row):?>
                  <span class="label regularLabel"><?php echo $row['specialization'];?></span>
                <?php endforeach;?>
              <?php else:?>
                <?php echo 'None';?><!-- create + button for adding new tag-->
              <?php endif;?>
            </p>

            <hr>

           
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->


      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Discussions</a></li>
            <li><a href="#timeline" data-toggle="tab">Current Upload</a></li>
            <li><a href="#newUpload" data-toggle="tab">New Upload</a></li>
            <li><a href="#abstract" data-toggle="tab">Abstract</a></li>
            <li><a href="#setMeeting" data-toggle="tab">Set Meeting</a></li>
            <li><a href="#settings" data-toggle="tab">Edit Group</a></li>
           
          </ul>

          <div class="tab-content">

            <div class="active tab-pane" id="activity"><!--discussion tab-->
              <!-- Post -->
              <!-- discussion button-->
              <div class="row">
                <div class="col-md-3">
                  <button type="button" class="btn btn-block btn-primary" onclick="location.href='<?php echo site_url('student/view_new_discussion');?>';" id="discussion">Create New Discussion </button>
                </div>
              </div>
              <!-- end of discussion button-->

              <?php if(sizeof($discussion) > 0):?><!-- if there is discussion-->
                <?php foreach($discussion as $row):?>
                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="<?php echo base_url();?>img/003-user.png" alt="user image">
                          <span class="username">
                            <a href="<?php echo site_url('student/view_discussion_specific/'.$row['TOPIC_DISCUSSION_ID']);?>"><?php echo $row['TOPIC_NAME'];?></a><!-- topic -->
                          </span>
                      <span class="description"><!-- created by , date, time-->
                      <?php 
                        echo $row['NAME'].' - '.$row['TIME'].' ';
                        $date_new = strtotime($row['DATE']);
                        $formatted_date_new = date('F d, Y', $date_new);
                        echo $formatted_date_new;
                      ?></span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      <?php echo $row['TOPIC_INFO']?>
                    </p>
                    <ul class="list-inline">
                      
                      </li>
                      <li class="pull-right">
                        <a href="<?php echo site_url('student/view_discussion_specific/'.$row['TOPIC_DISCUSSION_ID']);?>" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i>Replies
                        <?php
                          $num = 0;
                          foreach($reply as $rep)
                          {
                            if($rep['TOPIC_DISCUSSION_ID']==$row['TOPIC_DISCUSSION_ID'])
                            {
                              $num = $rep['COUNT'];
                            }
                          }
                          if($num > 0)
                          {
                            echo '('.$num.')';
                          }
                          else
                          {
                            echo '('.$num.')';
                          }
                        ?>
                        </a></li>
                    </ul>

                    <br>
                  </div>
                <?php endforeach;?>
              <?php else:?><!-- if there is none-->
                <div class="post">
                  <div class="user-block">
                    <?php echo 'No Discussions';?>
                  </div>
                </div>
              <?php endif;?>
              <!-- /.post -->


              <!-- Post -->
            
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="timeline"><!--current upload tab-->

              <h3>Current Version: Revised Document #<?php echo sizeof($uploads);?></h3><br>
              
              <!-- The timeline -->
              <ul class="timeline timeline-inverse">
                <!-- timeline time label -->
                <?php 
                  //echo form_open('faculty/delete_comment');
                  echo '<input type="hidden" name="group_id" value="'.$group['group_id'].'">';
                  if(sizeof($comment)>0)
                  {
                    $date = '';
                    foreach($comment as $row)
                    {
                      $type = "";
                      if($row['TYPE'] == 0)
                      {
                        $type="(Student)";
                      }
                      else
                      {
                        $type="(Faculty)";
                      }
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

                            <h3 class="timeline-header"><a href="#">'.$row['COMMENTED BY'].' '.$type.'</a> commented</h3>

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

                            <h3 class="timeline-header"><a href="#">'.$row['COMMENTED BY'].' '.$type.'</a> commented</h3>

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
                

                <li class="time-label">
                    <span class="bg-gray" id="panelComments">
                        Post a comment
                    </span>
                </li>

                <li id="inputComment">
                  <i class="fa  fa-pencil-square-o bg-blue"></i>

                  <div class="timeline-item">
                   
                    <h3 class="timeline-header">Post a Comment</h3>
                    <?php echo form_open('student/validate_comment');?>
                      <input type="hidden" name="group_id" value="<?php echo $group['group_id'];?>">
                      <input type="hidden" name="thesis_title" value="<?php echo $group['thesis_title'];?>">
                      <div class="timeline-body">
                        <div class="form-group">
                          <label></label>
                          <textarea id="com" name="comment" class="form-control" rows="3" placeholder="Post a comment about your verdict on the thesis document."></textarea>
                        </div>
                      </div>
                      <div class="timeline-footer">
                        <input id="sub" type="submit" name="submit_comment" value="Submit" class="btn btn-primary btn-xs">
                      </div>
                    </form>
                  </div>
                </li>
                <style type="text/css">
                  #com{
                    margin-left: 20px;
                    margin-right: 20px;
                    width: 90%;
                  }
                  #sub{
                    margin-left: 20px;
                    margin-right: 20px;
                    margin-bottom: 20px;
                  }

                </style>
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="settings"><!--settings tab-->
              <form class="form-horizontal" action="<?php echo site_url('student/add_tags');?>"  method="post">
              <div id="select_tags" hidden></div>
                
                
                <div class="form-group ">
                  <label for="inputName" class="col-sm-2 control-label">Specialization</label>
                  
                  <div class="col-sm-10">
                    <select class="form-control select2" name="tags[]" id="tags" multiple="multiple" data-placeholder="Select areas of specialization"
                      style="width: 100%;">
                      <?php foreach($tag as $row):?>
                        <option selected><?php echo $row['specialization'];?></option>
                      <?php endforeach;?>
                      <?php foreach($tags as $row):?>
                        <option><?php echo $row['specialization'];?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    
                    <button id="submitbtn2" onclick="location.href='<?php echo site_url('student');?>';" type="button" class="btn btn-danger">Exit</button>
                    <!-- <a href="<?php echo site_url('student/view_group/'.$group_id['group_id']);?>"> -->
                      <button id="submit_tag" type="submit" class="btn btn-success">Save and Quit</button>
                    <!-- </a> -->
                  </div>
                </div>
              </form>
            </div>
            <style type="text/css">
              
              #up{
                margin-left: -25px;
              }

            </style>
            <div class="tab-pane" id="newUpload"><!--new upload tab-->
              
              <form action="<?php echo site_url('student/validate_thesis_uploads');?>" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
               
                  
                  <button id="up" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload Documents</button>

                    
                   
                    
                    <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Upload Documents</h4>
                              </div>
                              <div class="modal-body">
                                <div class="col-md-6"><!--upload document-->
                                  <div class="form-group">
                                    <label for="thesis_file"><font size="+1">Upload New Revised Document</font></label>
                                    <input id="thesis_file" type="file" name="thesis_file" size="20"> <!--document file to be uploaded-->
                                    <p class="help-block"><font size="-1"> Last upload was on:<?php echo $submit['upload_date_time'];?><br>

                                      Note: upload must be in pairs and ONLY in pdf format </font>
                                    </p>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <input id="upload_comment" name="upload_comment" type="hidden" value="Revised Document #<?php echo sizeof($uploads)+1;?> and Revisions List #<?php echo sizeof($uploads)+1;?> has been uploaded">
                                  <input id="group_id" type="hidden" name="group_id" value="<?php echo $group['group_id'];?>">
                                  <input type="hidden" id="upload_thesis_title" name="upload_thesis_title" value="<?php echo $group['thesis_title'];?>">
                                </div>
                                <div class="col-md-6"> <!--upload revisions list-->
                                  <div class="form-group">
                                    <label for="revision_file"><font size="+1">Upload Revisions List</font></label>
                                    <input id="revision_file" type="file" name="revision_file" size="20" />
                                   
                                  </div>
                                </div>
                                
                              </div>

                              
                              <div class="row">
                          
                      
                                  <button id="uploadForm" style="margin-bottom: 20px" onclick="comment_upload()" type="submit" name="upload_thesis_revision" class="btn btn-success">upload forms</button>  
                                
                                  
                              
                              </div>
                            </div>
                          </div>
                        </div>

                
                
                
              </form>
              <section id="tableSection" class="content container-fluid">
                <div class="col-lg-14">
                  <label for="table"> Archive</label>
                  <table id="table" class="display" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Document Name (click to download)</th>
                        <th>Date Uploaded</th>
                        
                        <th>Revisions List</th>
                        
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php $num = 1;?>
                      <?php foreach($uploads as $row):?>
                        
                        <tr>
                          <td><a href="<?php echo site_url('student/download_file/'.$row['upload_name']);?>"><?php echo 'Revised Document #'.$num;?></a></td>
                          <td><?php echo $row['upload_date_time'];?></td>
                          <td><a href="<?php echo site_url('student/download_file/'.$row['revision_name']);?>"><?php echo 'Revisions List #'.$num;?></a></td>
                        </tr>
                        <?php $num = $num + 1;?>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                  
                  <!-- END timeline item -->
                  <!-- timeline item -->
                </div>

              </section>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="abstract"><!--abstract tab-->
              <form action="<?php echo site_url('student/validate_abstract');?>" method="post">
                <input type="hidden" name="thesis_id" value="<?php echo $group['thesis_id'];?>">
                <input type="hidden" name="group_id" value="<?php echo $group['group_id'];?>">
                <div class="row">
                  <div class="tab-content">
                    <div id="abstract" class="col-lg-9 col-xs-4">
                      <div class="box-body">
                        <h3>Abstract</h3>
                        <textarea name="abstract_text" rows="10" cols="110"><?php echo $group['abstract'];?></textarea>
                        <div class="col-lg-1">
                        </div>
                        
                        <a href=""><button id="submitbtn2" type="button" class="btn btn-danger">Exit</button></a>
                        <button id="submitbtn" type="submit" class="btn btn-success">Save and Quit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>   
            </div>

            <div class="tab-pane" id="setMeeting">
              <div>
                <div class="form-group">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="datepicker" id="datepicker">
                  </div>
                </div>

                <div class="form-group">
                  <label for="venue" class="control-label">Venue</label>
                  <input class="form-control" id="venue" name="venue" placeholder="venue">
                </div>

                <div class="form-group">
                  <label for="start_time" class="control-label">Start Time</label>
                  <input type="time" class="form-control" id="start_time" name="start_time" placeholder="Start Time">
                </div>

                <div class="form-group">
                  <label for="end_time" class="control-label">End Time</label>
                  <input type="time" class="form-control" id="end_time" name="end_time" placeholder="End Time">
                </div>
                <style type="text/css">
                  #submitbtn2{
                    margin-right: 20px;
                  }

                </style>
                <div class="form-group">
                  <a href="<?php echo site_url('student/view_group/'.$group_id['group_id']);?>"><button id="submitbtn2" type="button" class="btn btn-danger">Exit</button></a>
                  <button onclick="meeting()" id="submitbtn" type="submit" class="btn btn-success">Set Meeting</button>
                  
                </div>

                
              </div>
            </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->