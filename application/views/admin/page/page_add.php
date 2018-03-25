
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label class="col-sm-2 control-label">Site Language<span class="required">*</span></label>
		<div class="col-sm-6">
			<select name="language_id" class="form-control" required="">
				<?php 
				echo $this->d_model->load_site_language($row->language_id);
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Page Title<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="text" name="title" class="form-control" value="<?php echo $row->title; ?>" required=""/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Description<span class="required">*</span></label>
		<div class="col-sm-10">
			<textarea name="description" class="form-control ckeditor" required=""><?php echo $row->description; ?></textarea>
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

<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js" type="text/javascript"></script>