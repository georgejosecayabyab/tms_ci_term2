<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h2>
		Coordinators
		
		</h2>
		<ol class="breadcrumb">
			<li><a href="studentHome"><i class="fa fa-home"></i> Home</a></li>
			
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
	<input type="hidden" value="<?php echo base_url();?>" id="base_url">
	<!-- Main content -->
	<div class="row">
		<div class="col-lg-2 col-xs-4">
			<button id="addFaculty" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Coordinator</button>
		</div>
		
	</div>
	<!-- Modal2 -->
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<form method="POST" action="<?php echo site_url('super_user/insert_user');?>">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Student</h4>
					</div>
					<div class="modal-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-8">
									<input class="form-control" name="email" id="email" placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<label for="first_name" class="col-sm-2 control-label">First Name</label>
								<div class="col-sm-8">
									<input class="form-control" name="first_name" id="first_name" placeholder="First Name">
								</div>
							</div>
							
							<div class="form-group">
								<label for="last_name" class="col-sm-2 control-label">Last Name</label>
								<div class="col-sm-8">
									<input class="form-control" name="last_name" id="last_name" placeholder="Last Name">
								</div>
							</div>
							
						</div>
						
						
						<div class="modal-footer">
							<div class="row" align="center">
								<a href="<?php echo site_url('super_user');?>"><button id="submitbtn2" data-dismiss="modal" type="button" class="btn btn-danger">Exit</button></a>
								<button id="submitbtn" onclick="" type="submit" class="btn btn-success">Save and Quit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--Modal content END-->
		</div>
	</div>

	<section id="tableSection" class="content container-fluid">
		<div class="row" id="scheduleRow">
			<table id="table" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Date Joined (mm/dd/yy)</th>
						<th></th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($coordinator as $row):?>
						<tr>
							<td><?php echo ucwords(strtolower($row['last_name'].', '.$row['first_name']));?></td>
							<td><?php echo $row['email'];?></td>
							<td>
								<?php
									$date_new = strtotime($row['date_joined']);
                      				$formatted_date_new = date('m/d/Y', $date_new);
                      				echo $formatted_date_new;
								?>
							</td>
							<td>
								<?php 
				                  echo '<div id="status_section_'.$row['user_id'].'">';
				                  if($row['is_active'] == 1)
				                  {
				                    echo '<button id="'.$row['user_id'].'" class="btn btn-success" onclick="editStatus(this)" value="1">';
				                    echo 'Active';
				                    echo '</button>';
				                  }
				                  else
				                  {
				                    echo '<button id="'.$row['user_id'].'" class="btn btn-default" onclick="editStatus(this)" value="0">';
				                    echo 'Inactive';
				                    echo '</button>';
				                  }
				                  echo '</div>';
				                ?> 
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

			