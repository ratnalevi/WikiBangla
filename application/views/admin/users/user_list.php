
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>User Type</th>
						<th>Name</th>
						<!--<th>Username</th>-->
						<th>Email</th>
						<th>Designation</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($users as $user){
				if($user->status=='1'){ $publish = '<a class="btn btn-success btn-xs">Active</div>';}
				else{ $publish = '<a class="btn btn-warning btn-xs">Inactive</div>'; }
				?>
					<tr>
						<td><?php echo $user->role_name; ?></td>
						<td><?php echo $user->fullname; ?></td>
						<!---<td><?php echo $user->username; ?></td>-->
						<td><?php echo $user->email; ?></td>
						<td><?php echo $user->designation; ?></td>
						<td><?php echo $publish; ?></td>
						<td>
						<?php if($user->uid!='1'){ ?>
						<a class="btn btn-primary btn-xs" title="Edit" href="<?php echo base_url(); ?>user/user_update/<?php echo $user->uid; ?>">Edit</a>
						<a class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Are you sure delete this User?')" href="<?php echo base_url(); ?>user/user_delete/<?php echo $user->uid; ?>">Delete</a>
						<?php } ?>
						</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div> 