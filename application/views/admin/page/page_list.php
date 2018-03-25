
<div class="row">
	<div class="col-md-12">		
		<div class="table-scrollable">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Action</th>
						<th>Site Language</th>
						<th>Title</th>
						<th>Status</th>						
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($rows as $row){
				?>
					<tr>
						<td>
                        <a title="Edit" href="<?php echo base_url(); ?>admin/page_update/<?php echo $row->id; ?>" class="btn btn-xs green">Edit</a>
                        <a title="Delete" onclick="return confirm('Are you sure delete this page?')" href="<?php echo base_url(); ?>admin/page_delete/<?php echo $row->id; ?>" class="btn btn-xs red">Delete</a>
						</td>
						<td><?php echo $row->language; ?></td>
						<td><?php echo $row->title; ?></td>
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
