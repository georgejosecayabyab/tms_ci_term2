		<!-- Main Footer -->
						
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
				
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
				<div class="tab-pane active" id="control-sidebar-home-tab">
					<ul class="control-sidebar-menu">
						
					</ul>
					<!-- /.control-sidebar-menu -->
					<ul class="control-sidebar-menu">
						<li>
							<a href="<?php echo site_url('super_user/logout');?>">
								<i class="menu-icon fa fa-sign-out bg-green"></i>
								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Logout</h4>
									
								</div>
							</a>
						</li>
					</ul>
					
					<!-- /.control-sidebar-menu -->
				</div>
				<!-- /.tab-pane -->
				
				
			</div>
		</aside>
		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
		immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->
	<!-- REQUIRED JS SCRIPTS -->
	<!-- jQuery 3 -->
	<script src="<?php echo base_url();?>js/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url();?>js/adminlte.min.js"></script>
	<script src="<?php echo base_url();?>jquery-1.11.2.js"></script>
	<script src="<?php echo base_url();?>js/select2.full.min.js"></script>
	<script>
	$(function () {
	//Initialize Select2 Elements
	$('.select2').select2()
	});
	</script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#table').DataTable();
	} );
	</script>
	<!-- Optionally, you can add Slimscroll and FastClick plugins.
	Both of these plugins are recommended to enhance the
	user experience. -->

	<script>
		function editStatus(id)
		{
			var base = $('#base_url').val();
			var status_button_id = id.id;
			var status = $('#'+status_button_id).val();
			$.ajax({
				type: 'POST',
				url: base+'index.php/super_user/update_user_status',
				data: {'user_id':status_button_id, 'status': status},
				success: function(data)
				{
					$('#status_section_'+status_button_id).empty();
					if(data['is_active'] == 0)
					{
					$('#status_section_'+status_button_id).append('<button id="'+data['user_id']+'" class="btn btn-default" onclick="editStatus(this)" value="0">Inactive </button>');
					}
					else
					{
					  $('#status_section_'+status_button_id).append('<button id="'+data['user_id']+'" class="btn btn-success" onclick="editStatus(this)" value="1">Active </button>');
					}
					console.log(data['is_active']);
				},
				error: function(err)
				{
					console.log(err);
				}
			})


		}
	</script>

</body>
</html>