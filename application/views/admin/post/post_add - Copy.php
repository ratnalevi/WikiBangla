
<form action="" method="POST" enctype="multipart/form-data">

	
<div class="row">	
	<div class="col-md-7">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Basic Information</h3>
			</div>
			<div class="panel-body form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label">Featured</label>
					<div class="col-sm-7">
						<input <?php if($row->featured=='Yes'){ echo 'checked=""'; } ?> type="checkbox" name="featured" value="Yes"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Title (English)<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="title" class="form-control" value="<?php echo $row->title; ?>" required=""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Title (Bangla)</label>
					<div class="col-sm-7">
						<input type="text" name="title_bn" class="form-control" value="<?php echo $row->title_bn; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Category<span class="required">*</span></label>
					<div class="col-sm-7">
						<select name="category_id" class="form-control" required="" onchange="loadSubCategory(this.value);">
							<option value="">--Select a Category--</option>
							<?php 
							$cats = $this->d_model->table_row('category','parent_id','0')->result();
							foreach($cats as $cat){
								if($cat->id==$row->category_id){
									$selected = 'selected=""';
								}else{
									$selected = '';
								}
								echo '<option '.$selected.' value="'.$cat->id.'">'.$cat->category_name.'</option>';
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Sub Category</label>
					<div class="col-sm-7">
						<select name="sub_category_id" id="sub_category_id" class="form-control">
							<option value="">--Select a Sub Category--</option>
							<?php 
							if($row->category_id){
							$cats = $this->d_model->table_row('category','parent_id',$row->category_id)->result();
							foreach($cats as $cat){
								$selected = '';
								if($cat->id==$row->sub_category_id){
									$selected = 'selected=""';
								}
								echo '<option '.$selected.' value="'.$cat->id.'">'.$cat->category_name.'</option>';
							}
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Tags</label>
					<div class="col-sm-7">
						<select name="tag_id[]" class="form-control select3" multiple="">
							<?php 
							$tags = $this->d_model->table_list('tags','id','asc')->result();
							foreach($tags as $tag){
								$selected = '';
								if(in_array($tag->id,explode(',',$row->tag_id))){
									$selected = 'selected=""';
								}
								echo '<option '.$selected.' value="'.$tag->id.'">'.$tag->tag_name.'</option>';
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Copyright</label>
					<div class="col-sm-7">
						<input type="text" name="copyright" class="form-control" value="<?php echo $row->copyright; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Owner</label>
					<div class="col-sm-7">
						<input type="text" name="owner" class="form-control" value="<?php echo $row->owner; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Year<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="year" class="form-control" value="<?php echo $row->year; ?>" required=""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Address<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="address" class="form-control" value="<?php echo $row->address; ?>" required=""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">City<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="city" class="form-control" value="<?php echo $row->city; ?>" required=""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">State<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="state" class="form-control" value="<?php echo $row->state; ?>" required=""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Country<span class="required">*</span></label>
					<div class="col-sm-7">
						<select name="country_id" class="form-control" required="">
							<option value="">--Select a Country--</option>
							<?php 
							$cous = $this->d_model->table_list('countries','id','asc')->result();
							foreach($cous as $cou){
								$selected = '';
								if($cou->id==$row->country_id){
									$selected = 'selected=""';
								}
								echo '<option '.$selected.' value="'.$cou->id.'">'.$cou->country_name.'</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Zip Code</label>
					<div class="col-sm-7">
						<input type="text" name="zip_code" class="form-control" value="<?php echo $row->zip_code; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Map Location</label>
					<div class="col-sm-7">
						<input type="text" name="map_location" class="form-control" value="<?php echo $row->map_location; ?>"/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Featured Image (Min 305X225px)</h3>
			</div>
			<div class="panel-body">
				<?php if($row->featured_image){ ?>
				<input type="file" name="featured_image" />
				<img src="<?php echo base_url(); ?>uploads/featured/<?php echo $row->featured_image; ?>" width="100">
				<?php }else{ ?>
				<input type="file" name="featured_image" required="" />
				<?php } ?>
				<input type="hidden" name="featured_image1" value="<?php echo $row->featured_image; ?>" />
			</div>
		</div>
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Images</h3>
			</div>
			<div class="panel-body form-horizontal">
				<input onclick="addRowImage();" type="button" class="btn btn-secondary btn-sm" value="Add Row"> 
				<div id="multi_image">
					
				</div>
				<?php if($i_row){ ?>
				<br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($i_row as $i_r){ ?>
						<tr>
							<td><img width="30" src="<?php echo base_url(); ?>uploads/post/<?php echo $i_r->filename; ?>"></td>
							<td><a onclick="return confirm('Are you sure delete this image?')" href="<?php echo base_url(); ?>admin/file_delete/<?php echo $i_r->post_id; ?>/<?php echo $i_r->fid; ?>">Delete</a></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Videos</h3>
			</div>
			<div class="panel-body form-horizontal">
				<input onclick="addRowVideo();" type="button" class="btn btn-secondary btn-sm" value="Add Row"> 
				<div id="multi_video">
					
				</div>
				<?php if($v_row){ ?>
				<br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Video Link</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($v_row as $v_r){ ?>
						<tr>
							<td><?php echo $v_r->video_link; ?></td>
							<td><a onclick="return confirm('Are you sure delete this video?')" href="<?php echo base_url(); ?>admin/post_video_delete/<?php echo $v_r->post_id; ?>/<?php echo $v_r->id; ?>">Delete</a></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Description</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">Shot Description (English)<span class="required">*</span></label>
					<textarea name="shot_description" class="form-control" required=""><?php echo $row->shot_description; ?></textarea>
				</div>
				<div class="form-group">
					<label class="control-label">Shot Description (Bangla)</label>
					<textarea name="shot_description_bn" class="form-control"><?php echo $row->shot_description_bn; ?></textarea>
				</div>
				<div class="form-group">
					<label class="control-label">Description (English)<span class="required">*</span></label>
					<textarea name="description" class="form-control ckeditor" required=""><?php echo $row->description; ?></textarea>
				</div> 
				<div class="form-group">
					<label class="control-label">Description (Bangla)</label>
					<textarea name="description_bn" class="form-control ckeditor"><?php echo $row->description_bn; ?></textarea>
				</div> 
			</div>
		</div>
	</div>
</div>

	
	
<div class="form-horizontal">	
	<div class="form-group">
		<label class="col-sm-2 control-label">Status</label>
		<div class="col-sm-6">
			<select name="status" class="form-control">
				<option <?php if($row->status=='publish'){ echo 'selected=""'; } ?> value="publish">Publish</option>
				<option <?php if($row->status=='unpublish'){ echo 'selected=""'; } ?> value="unpublish">Unpublish</option>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-6">
			<input type="submit" class="btn btn-primary" name="submit" value="Submit">
		</div>
	</div>
</div>

<br>
</form>	

<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js" type="text/javascript"></script>

<script>
	//alert(CKEDITOR.version);
</script>



