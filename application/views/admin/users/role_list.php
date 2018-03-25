
<div class="row">
	<div class="col-sm-12 col-md-8 col-lg-8">
		<h3 class="main-title"><?php echo $title; ?></h3>
	</div>
	<div class="col-sm-12 col-md-4 col-lg-4">
		<a href="<?php echo base_url(); ?>user/role_add" class="btn btn-primary pull-right add-button">Role Add</a>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Role Name</th>
						<th>Permission</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1; 
				foreach($roles as $role){
					
					if($role->status=='1'){ $publish = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';}
					else{ $publish = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'; }	 
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $role->role_name; ?></td>
						<td><a href="<?php echo base_url(); ?>user/permission/<?php echo $role->id; ?>">Permission</a></td>
						<td><?php echo $publish; ?></td>
						<td>
						<?php if($role->id!='1'){ ?>
							<a href="<?php echo base_url(); ?>user/role_update/<?php echo $role->id; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<a onclick="return confirm('Are you sure delete this Role?')" href="<?php echo base_url(); ?>user/role_delete/<?php echo $role->id; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
						<?php } ?>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div> 

