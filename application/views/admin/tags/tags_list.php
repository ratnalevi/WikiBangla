
<div class="row">	
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Tag Add</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="">
					<div class="form-group">
						<label class="col-sm-3 control-label">Tag Name</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="tag_name" value="<?php echo $c_row->tag_name; ?>" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<input type="submit" class="btn btn-primary" name="submit" value="Submit">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Tag List</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Action</th>
								<th>Tag Name</th>				
							</tr>
						</thead>
						<tbody>
						<?php
						foreach($rows as $row){
						?>
							<tr>
								<td>
		                        <a title="Edit" href="<?php echo base_url(); ?>admin/tags/<?php echo $row->id; ?>" class="btn btn-primary btn-xs">Edit</a>
		                        <a title="Delete" onclick="return confirm('Are you sure delete this Tag?')" href="<?php echo base_url(); ?>admin/tag_delete/<?php echo $row->id; ?>" class="btn btn-danger btn-xs">Delete</a>
		                        </td>
								<td><?php echo $row->tag_name; ?></td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


	