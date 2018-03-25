
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Site Language</th>
						<th>Category Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($rows as $row){
				?>
					<tr>
						<td><?php echo $row->language; ?></td>
						<td><?php echo $row->category_name; ?></td>
						<td><?php echo $row->status; ?></td>
						<td>
						<a class="btn btn-primary btn-xs" title="Edit" href="<?php echo base_url(); ?>admin/video_category_update/<?php echo $row->id; ?>">Edit</a>
						<a class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Are you sure delete this Category?')" href="<?php echo base_url(); ?>admin/video_category_delete/<?php echo $row->id; ?>">Delete</a>
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