
<div class="row">
	<div class="col-md-12">	
		<div class="panel panel-primary">
			<div class="panel-heading">
                <h3 class="panel-title">Search</h3>
            </div>
            <div class="panel-body">
				<form class="form-inline" method="GET" action="">
					<div class="form-group">
						<label for="">Comment</label>
						<input type="text" class="form-control" name="comment" value="<?php echo $_GET['comment']; ?>" />
					</div>
					<input type="submit" class="btn btn-primary" value="Search" name="submit">
					<a href="<?php echo base_url(); ?>admin/post_comment_list" class="btn btn-success">Clear Search</a>
				</form>
			</div>
		</div>
			
		<div class="table-scrollable">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Action</th>
						<th>Post Title</th>
						<th>Comment</th>
						<th>Comment By</th>
						<th>Status</th>						
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($rows as $row){
				?>
					<tr>
						<td>
                        <a title="Delete" onclick="return confirm('Are you sure delete this comment?')" href="<?php echo base_url(); ?>admin/post_comment_delete/<?php echo $row->id; ?>" class="btn btn-xs red">Delete</a>
						</td>
						<td><?php echo $row->title; ?></td>
						<td><?php echo $row->comment; ?></td>
						<td><?php echo $row->fullname; ?></td>
						<td><?php echo $row->status; ?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<?php echo $example_info; ?>
	</div>
	<div class="col-md-8">
		<?php echo $pagination; ?>
	</div>
</div> 
