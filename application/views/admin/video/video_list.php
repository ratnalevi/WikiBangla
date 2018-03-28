
<div class="row">
	<div class="col-md-12">	
		<div class="panel panel-primary">
			<div class="panel-heading">
                <h3 class="panel-title">Search</h3>
            </div>
            <div class="panel-body">
				<form class="form-inline" method="GET" action="">
					<div class="form-group">
						<label>Site Language</label>
						<select name="language_id" class="form-control" required="" onchange="loadVideoCategory(this.value)">
							<?php 
							echo $this->d_model->load_site_language($_GET['language_id']);
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Category</label>
						<select name="category_id" id="category_id" class="form-control">
							<?php 
							echo $this->d_model->load_video_category($_GET['language_id'],$_GET['category_id']);
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Title</label>
						<input type="text" class="form-control" name="title" value="<?php echo $_GET['title']; ?>" />
					</div>
					<input type="submit" class="btn btn-primary" value="Search" name="submit">
					<a href="<?php echo base_url(); ?>admin/video_list" class="btn btn-success">Clear Search</a>
				</form>
			</div>
		</div>
			
		<div class="table-scrollable">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Action</th>
						<th>Site Language</th>
						<th>Category</th>
						<th>Title</th>
						<th>View</th>
						<th>Craeted By</th>
						<th>Status</th>						
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($rows as $row){
				?>
					<tr>
						<td>
                        <a title="Edit" href="<?php echo base_url(); ?>admin/video_update/<?php echo $row->id; ?>" class="btn btn-xs green">Edit</a>
                        <a title="Delete" onclick="return confirm('Are you sure delete this video?')" href="<?php echo base_url(); ?>admin/video_delete/<?php echo $row->id; ?>" class="btn btn-xs red">Delete</a>
						</td>
						<td><?php echo $row->language; ?></td>
						<td><?php echo $row->category_name; ?></td>
						<td><?php echo $row->title; ?></td>
						<td><?php echo $row->total_view; ?></td>
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
