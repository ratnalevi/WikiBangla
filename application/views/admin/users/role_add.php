
<div class="row">
	<div class="col-md-12">
		<h3 class="main-title"><?php echo $title; ?></h3>
	</div>
</div> 


<form action="<?php echo base_url(); ?>user/<?php if($role){ echo 'role_update/'.$role->id; }else{ echo 'role_add'; } ?>" method="POST">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="form-group">
				<label>Role Name:</label>
				<input type="text" name="role_name" required="" class="form-control" value="<?php echo $role->role_name; ?>" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12">	
			<div class="form-group">
				<label>Status:</label>
				<select name="status" class="form-control">
					<option <?php if($role->status=='1'){ echo 'selected=""'; } ?> value="1">Publish</option>
					<option <?php if($role->status=='0'){ echo 'selected=""'; } ?> value="0">Unpublish</option>
				</select>
			</div>					
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12">			
			<div class="form-group">
				<input type="submit" class="btn btn-primary" name="submit" value="Save">
			</div>	
		</div>
	</div>  
</form>	

