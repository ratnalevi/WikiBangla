<?php 
$ci = & get_instance();
$ci->load->model('user_model');
$roles = $ci->user_model->role_load()->result();	
?>

<div class="row">
	<div class="col-sm-12 col-md-8">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Change Password</h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo base_url(); ?>user/change_password" method="POST" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">Old Password<span class="required">*</span></label>
						<div class="col-sm-6">
							<input type="password" name="old_password" class="form-control" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">New Password<span class="required">*</span></label>
						<div class="col-sm-6">
							<input type="password" name="new_password" class="form-control" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Confirm Password<span class="required">*</span></label>
						<div class="col-sm-6">
							<input type="password" name="confirm_password" class="form-control" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-6">
							<input type="submit" class="btn btn-primary" name="submit" value="Change Password">
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>




