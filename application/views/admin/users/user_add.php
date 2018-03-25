<?php 
$ci = & get_instance();
$ci->load->model('user_model');
$roles = $ci->user_model->role_load()->result();	
?>

<form action="" method="POST" class="form-horizontal">

	<div class="form-group">
		<label class="col-sm-2 control-label">User Type<span class="required">*</span></label>
		<div class="col-sm-6">
			<select name="rid" class="form-control" required="">
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
		<label class="col-sm-2 control-label">Name<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="text" name="fullname" required="" class="form-control" value="<?php echo $user->fullname; ?>" required="" />
		</div>
	</div>
	<?php if(!$user){ ?>
	<!--<div class="form-group">
		<label class="col-sm-2 control-label">Username<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="text" name="username" required="" class="form-control" value="<?php echo $user->username; ?>" id="username" />
		</div>
	</div>-->
	
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Email<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="email" name="email" class="form-control" value="<?php echo $user->email; ?>" id="email" required="">
		</div>
	</div>
	<?php } ?>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Designation</label>
		<div class="col-sm-6">
			<input type="text" name="designation" class="form-control" value="<?php echo $user->designation; ?>">
		</div>
	</div>
	
	
	<?php if(!$user){ ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Password<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="password" name="password" id="password" class="form-control" required="">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Confirm Password<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="password" name="confirm_password" id="confirm_password" class="form-control" required="">
		</div>
	</div>
	<?php } ?>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Status</label>
		<div class="col-sm-6">
			<select name="status" class="form-control">
				<option <?php if($user->status=='1'){ echo 'selected=""'; } ?> value="1">Active</option>
				<option <?php if($user->status=='0'){ echo 'selected=""'; } ?> value="0">Inactive</option>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-6">
			<input type="submit" class="btn btn-primary" name="submit" value="<?php if($user){ echo 'Update User'; }else{ echo 'Add User'; } ?>">
		</div>
	</div>
	
</form>	

<script>
	function CheckUsername()
	{	 
		var username = $('#username').val();
		var email = $('#email').val();  
		var password = $('#password').val();
		var confirm_password = $('#confirm_password').val();
        if(password==confirm_password){ 
	        var html = $.ajax({
		        async: false,
		        url: base_url + 'user/check_username?username=' + username + '&email=' + email,
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
		}else{
			$('#infoMessage').empty();
	        $('#infoMessage').append('<div class="alert alert-warning" role="alert">Warning! Password not match.</div>');
	        return false;
	    }	    
	}
</script>
