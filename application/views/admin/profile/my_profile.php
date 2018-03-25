<?php 
$ci = & get_instance();
$ci->load->model('user_model');
$roles = $ci->user_model->role_load()->result();	
?>

<div class="row">
	<div class="col-sm-12 col-md-8">	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">View Profile</h3>
			</div>
			<div class="panel-body">
				<form onsubmit="return CheckUsernameEdit();" action="" method="POST" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">User Type<span class="required">*</span></label>
						<div class="col-sm-6">
							<select name="rid" class="form-control" required="" disabled="">
								<option value="">--Select User Type--</option>
								<?php 
								foreach($roles as $role){
									if($role->id==$user->rid){
										$selected = 'selected=""';
									}else{
										$selected = '';
									}
									echo '<option '.$selected.' value="'.$role->id.'">'.$role->role_name.'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Name<span class="required">*</span></label>
						<div class="col-sm-6">
							<input type="text" name="fullname" required="" class="form-control" value="<?php echo $user->fullname; ?>" required="" />
						</div>
					</div>
					<!---<div class="form-group">
						<label class="col-sm-3 control-label">Username<span class="required">*</span></label>
						<div class="col-sm-6">
							<input type="text" name="username" required="" class="form-control" value="<?php echo $user->username; ?>" />
						</div>
					</div>--->
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Email<span class="required">*</span></label>
						<div class="col-sm-6">
							<input type="email" name="email" class="form-control" value="<?php echo $user->email; ?>" id="email" required="">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Designation</label>
						<div class="col-sm-6">
							<input type="text" name="designation" class="form-control" value="<?php echo $user->designation; ?>">
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Status</label>
						<div class="col-sm-6">
							<select name="status" class="form-control" disabled="">
								<option <?php if($user->status=='1'){ echo 'selected=""'; } ?> value="1">Active</option>
								<option <?php if($user->status=='0'){ echo 'selected=""'; } ?> value="0">Inactive</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-6">
							<input type="submit" class="btn btn-primary" name="submit" value="Update Profile">
						</div>
					</div>
					
				</form>	
			</div>
		</div>
	</div>
</div>



<script>	
	function CheckUsernameEdit()
	{	 
		var username = $('#username').val();
		var email = $('#email').val(); 
        var html = $.ajax({
	        async: false,
	        url: base_url + 'profile/check_username?username=' + username + '&email=' + email + "&user_id=<?php echo $this->session->userdata('user')->uid; ?>",
	        type: 'POST',
	        dataType: 'html',
	        //data: {'pnr': a},
	        timeout: 2000,
	    }).responseText;
	    if(html == 1){
			$('#infoMessage').empty();
	        $('#infoMessage').append('<div class="alert alert-warning" role="alert">Warning! Username already taken.</div>');
	        return false;
		}else if(html == 2){
			$('#infoMessage').empty();
	        $('#infoMessage').append('<div class="alert alert-warning" role="alert">Warning! Email already taken.</div>');
	        return false;
	    }else{
			return true;
	    }	    
	}
</script>

