
<div class="row">
	<div class="col-md-12">		
		<div class="table-scrollable">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Action</th>
						<th>Title</th>
						<th>Image</th>
						<th>Status</th>						
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($rows as $row){
				?>
					<tr>
						<td>
                        <a title="Edit" href="<?php echo base_url(); ?>admin/gallery_update/<?php echo $row->id; ?>" class="btn btn-xs green">Edit</a>
                        <a title="Delete" onclick="return confirm('Are you sure delete this gallery?')" href="<?php echo base_url(); ?>admin/gallery_delete/<?php echo $row->id; ?>" class="btn btn-xs red">Delete</a>
						</td>
						<td><?php echo $row->title; ?></td>
						<td><img width="100" src="<?php echo base_url(); ?>uploads/gallery/<?php echo $row->filename; ?>"></td>
						<td><?php echo $row->status; ?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div> 
