
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label class="col-sm-2 control-label">Title<span class="required">*</span></label>
		<div class="col-sm-6">
			<input type="text" name="title" class="form-control" value="<?php echo $row->title; ?>" required=""/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Image<span class="required">*</span></label>
		<div class="col-sm-6 padding-top-5">
			<?php if($row->filename){ ?>
			<input type="file" name="filename" />
			<input type="hidden" name="filename1" value="<?php echo $row->filename; ?>" />
			<img width="100" src="<?php echo base_url(); ?>uploads/gallery/<?php echo $row->filename; ?>">
			<?php }else{ ?>
			<input type="file" name="filename" required="" />
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
