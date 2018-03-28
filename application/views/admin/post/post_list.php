
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
						<select name="language_id" class="form-control" onchange="loadCategory1(this.value)">
							<?php 
							echo $this->d_model->load_site_language($_GET['language_id']);
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Category</label>
						<select name="category_id" id="category_id" class="form-control" onchange="loadSubCategory(this.value);">
							<?php 
							echo $this->d_model->load_category($_GET['language_id'],$_GET['category_id']);
							?>
						</select>
					</div>
					
					<div class="form-group">
						<label>Sub Category</label>
						<select name="sub_category_id" id="sub_category_id" class="form-control">
							<option value="">--Select a Sub Category--</option>
							<?php 
							if($_GET['category_id']){
							$cats = $this->d_model->table_row('category','parent_id',$_GET['category_id'])->result();
							foreach($cats as $cat){
								$selected = '';
								if($cat->id==$_GET['sub_category_id']){
									$selected = 'selected=""';
								}
								echo '<option '.$selected.' value="'.$cat->id.'">'.$cat->category_name.'</option>';
							}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Post Title</label>
						<input type="text" class="form-control" name="post_title" value="<?php echo $_GET['post_title']; ?>" />
					</div>
					<input type="submit" class="btn btn-primary" value="Search" name="submit">
					<a href="<?php echo base_url(); ?>admin/post_list" class="btn btn-success">Clear Search</a>
				</form>
			</div>
		</div>
		
		<div class="table-scrollable">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th width="60">Action</th>
						<th>Site Language</th>
						<th>Category</th>
						<th>Sub Category</th>
						<th>Post Title</th>
						<th>Owner</th>
						<th width="40">View</th>
						<th width="40">Like</th>	
						<th width="50">Featured</th>	
						<th width="50">Status</th>						
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($rows as $row){
				?>
					<tr>
						<td>
                        <a title="Edit" href="<?php echo base_url(); ?>admin/post_update/<?php echo $row->id; ?>" class="btn btn-xs green">Edit</a>
                        <a title="Delete" onclick="return confirm('Are you sure delete this post?')" href="<?php echo base_url(); ?>admin/post_delete/<?php echo $row->id; ?>" class="btn btn-xs red">Delete</a>
						</td>
						<td><?php echo $row->language; ?></td>
						<td><?php echo $row->maincat; ?></td>
						<td><?php echo $row->subcat; ?></td>
						<td><?php echo $row->post_title; ?></td>
						<td><?php echo $row->fullname; ?></td>
						<td><?php echo $this->d_model->total_view_post($row->id); ?></td>
						<td><?php echo $this->d_model->total_like_post($row->id); ?></td>
						<td><?php echo $row->featured; ?></td>
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
