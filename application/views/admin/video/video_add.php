
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label class="col-sm-2 control-label">Site Language<span class="required">*</span></label>
		<div class="col-sm-6">
			<select name="language_id" class="form-control" required="" onchange="loadVideoCategory(this.value)">
				<?php 
				echo $this->d_model->load_site_language($row->language_id);
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Category<span class="required">*</span></label>
		<div class="col-sm-6">
			<select name="category_id" id="category_id" class="form-control" required="">
				<?php 
				echo $this->d_model->load_video_category($row->language_id,$row->category_id);
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Title<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="text" name="title" class="form-control" value="<?php echo $row->title; ?>" required=""/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Video (Youtube)<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="text" name="video_link" class="form-control" value='<?php echo $row->video_link; ?>' required=""/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Duration<span class="required">*</span></label>
		<div class="col-sm-6">
			<div class="durationpicker-container form-control">
				<div class="durationpicker-innercontainer" style="display: inline-block;">
					<input min="0" max="24" placeholder="0" type="number" id="duration-hours" class="durationpicker-duration" value="<?php if($row->duration){ echo date('H',strtotime($row->duration)); }else{ echo '00'; } ?>" name="hour"><span class="durationpicker-label">h</span>
				</div>
				<div class="durationpicker-innercontainer" style="display: inline-block;">
					<input min="0" max="60" placeholder="0" type="number" id="duration-minutes" class="durationpicker-duration" value="<?php if($row->duration){ echo date('i',strtotime($row->duration)); }else{ echo '00'; } ?>" name="minute"><span class="durationpicker-label">m</span>
				</div>
				<div class="durationpicker-innercontainer" style="display: inline-block;">
					<input min="0" max="60" placeholder="0" type="number" id="duration-seconds" class="durationpicker-duration" value="<?php if($row->duration){ echo date('s',strtotime($row->duration)); }else{ echo '00'; } ?>" name="second"><span class="durationpicker-label">s</span>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Thumbnail Image (min 640X426px)<span class="required">*</span></label>
		<div class="col-sm-6 padding-top-5">
			<?php if($row->filename){ ?>
			<input type="file" name="filename" />
			<img width="100" src="<?php echo base_url(); ?>uploads/video_img/<?php echo $row->filename; ?>">
			<?php }else{ ?>
			<input type="file" name="filename" required="" />
			<?php } ?>
			<input type="hidden" name="filename1" value="<?php echo $row->filename; ?>" />
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
		<label class="col-sm-2 control-label">Description</label>
		<div class="col-sm-10">
			<textarea name="des" class="form-control ckeditor"><?php echo $row->des; ?></textarea>
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