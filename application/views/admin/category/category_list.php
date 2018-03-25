
<div class="row">
	<div class="col-md-12">
		
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Action</th>
						<th>Site Language</th>
						<th>Parent</th>
						<th>Category Name</th>
						<th>Slug</th>
						<th>BG Iamge</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($rows as $row){
				?>
					<tr>
						<td>
						<a class="btn btn-primary btn-xs" title="Edit" href="<?php echo base_url(); ?>admin/category_update/<?php echo $row->id; ?>">Edit</a>
						<a class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Are you sure delete this Category?')" href="<?php echo base_url(); ?>admin/category_delete/<?php echo $row->id; ?>">Delete</a>
						</td>
						<td><?php echo $row->language; ?></td>
						<td><?php echo $this->db->get_where('category',array('id'=>$row->parent_id))->row()->category_name; ?></td>
						<td><?php echo $row->category_name; ?></td>
						<td><?php echo $row->slug; ?></td>
						<td><?php echo $row->bg_image; ?></td>
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