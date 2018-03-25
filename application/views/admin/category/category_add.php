
<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-sm-2 control-label">Site Language<span class="required">*</span></label>
		<div class="col-sm-6">
			<select name="language_id" class="form-control" required="" onchange="loadCategory(this.value)">
				<?php 
				echo $this->d_model->load_site_language($row->language_id);
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Parent<span class="required">*</span></label>
		<div class="col-sm-6">
			<select name="parent_id" id="category_id" class="form-control" required="">
				<?php 
				echo $this->d_model->load_category($row->language_id,$row->parent_id,'root');
				?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Category Name<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="text" name="category_name" required="" class="form-control" value="<?php echo $row->category_name; ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">BG Image</label>
		<div class="col-sm-6 padding-top-5">
			<input type="file" name="bg_image" />
			<input type="hidden" name="bg_image1" value="<?php echo $row->bg_image; ?>" />
			<?php if($row->bg_image){ ?>
			<img width="200" src="<?php echo base_url('uploads/bg_image/'.$row->bg_image); ?>" />
			<?php } ?>
		</div>
	</div>
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
	
</form>	
