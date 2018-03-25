<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js" type="text/javascript"></script>
<?php $post_id = $row->id; ?>
<form action="<?php echo base_url('admin/post_update/'.$post_id); ?>" method="POST" enctype="multipart/form-data">

<div class="row">	
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="caption">
					Basic Information
				</div>
				<div class="tools">
					<a class="accordion-toggle" data-toggle="collapse" href="#basic_info"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
				</div>
			</div>
			<div id="basic_info" class="panel-body form-horizontal collapse">
				<div class="form-group">
					<label class="col-sm-3 control-label">History</label>
					<div class="col-sm-7">
						<input <?php if($row->history=='Yes'){ echo 'checked=""'; } ?> type="checkbox" name="history" value="Yes"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Do You Know ?</label>
					<div class="col-sm-7">
						<input <?php if($row->do_you_know=='Yes'){ echo 'checked=""'; } ?> type="checkbox" name="do_you_know" value="Yes"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Featured</label>
					<div class="col-sm-7">
						<input <?php if($row->featured=='Yes'){ echo 'checked=""'; } ?> type="checkbox" name="featured" value="Yes"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Featured Image (Min 300X230px)</label>
					<div class="col-sm-7">
						<input type="file" name="featured_image" /><br>
						<img src="<?php echo base_url(); ?>uploads/featured/300X230_<?php echo $row->featured_image; ?>" width="100">
						<input type="hidden" name="featured_image1" value="<?php echo $row->featured_image; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Title (English)<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="title_en" class="form-control" value="<?php echo $row->title_en; ?>" required=""/>
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
					<label class="col-sm-3 control-label">Description (English)<span class="required">*</span></label>
					<div class="col-sm-7">
						<textarea name="description_en" class="form-control" required=""><?php echo $row->description_en; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Description (Bangla)</label>
					<div class="col-sm-7">
						<textarea name="description_bn" class="form-control"><?php echo $row->description_bn; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status</label>
					<div class="col-sm-7">
						<select name="status" class="form-control">
							<option <?php if($row->status=='Publish'){ echo 'selected=""'; } ?> value="Publish">Publish</option>
							<option <?php if($row->status=='Unpublish'){ echo 'selected=""'; } ?> value="Unpublish">Unpublish</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<input type="submit" class="btn btn-primary" name="submit" value="Update">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
</form>	


<div id="loadPartEdit">	
	<?php 
	foreach($parts as $i => $part){ 
	$part_id = $part->id; 
	?>
	<div id="delete_part_<?php echo $part_id; ?>" class="panel panel-primary">
		<div class="panel-heading">
			<div class="caption">
				Part <?php echo $i+1; ?>: <?php echo $part->part_title_en; ?>
			</div>
			<div class="tools">
				<a onclick="deletePart(<?php echo $part_id; ?>)" href="javascript:;"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
				<a class="accordion-toggle" data-toggle="collapse" href="#part_<?php echo $part_id; ?>"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
			</div>	
		</div>
		<div id="part_<?php echo $part_id; ?>" class="panel-body form-horizontal collapse">
			<div class="form-group">
				<div class="col-sm-7">
					<input type="button" class="btn btn-info btn-xs" value="Add Section" onclick="loadSection(<?php echo $part_id; ?>);"/>
				</div>
			</div>
			<form action="<?php echo base_url('admin/part_update/'.$post_id.'/'.$part_id); ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label">Part Title (English)<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="part_title_en" class="form-control" value="<?php echo $part->part_title_en; ?>" required=""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Part Title (Bangla)</label>
					<div class="col-sm-7">
						<input type="text" name="part_title_bn" class="form-control" value="<?php echo $part->part_title_bn; ?>"/>
					</div>
				</div>
				<div id="load_section_<?php echo $part_id; ?>">
				<?php
				$sections = $this->d_model->table_row('posts_parts_sections','post_part_id',$part_id)->result();
				foreach($sections as $j => $section){
					$section_id = $section->id;
				?>
					<div id="delete_section_<?php echo $section_id; ?>" class="panel panel-primary">
						<div class="panel-heading">
							<div class="caption">
								Section <?php echo $j+1; ?>: <?php echo $section->section_title_en; ?> 
							</div>
							<div class="tools">
								<a onclick="deleteSection(<?php echo $section_id; ?>)" href="javascript:;"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
								<a class="accordion-toggle" data-toggle="collapse" href="#section_<?php echo $section_id; ?>"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
							</div>
						</div>
						<div id="section_<?php echo $section_id; ?>" class="panel-body form-horizontal collapse">
							<div class="form-group">
								<label class="col-sm-3 control-label">Image (Min 900X700px)<span class="required">*</span></label>
								<div class="col-sm-7">
									<input type="file" name="image[]"/>
									<?php echo $section->image; ?>
									<input type="hidden" name="image1[]" value="<?php echo $section->image; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Section Title (English)<span class="required">*</span></label>
								<div class="col-sm-7">
									<input type="text" name="section_title_en[]" class="form-control" value="<?php echo $section->section_title_en; ?>" required=""/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Section Title (Bangla)</label>
								<div class="col-sm-7">
									<input type="text" name="section_title_bn[]" class="form-control" value="<?php echo $section->section_title_bn; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Shot Description (English)</label>
								<div class="col-sm-7">
									<textarea type="text" name="section_shot_description_en[]" class="form-control"><?php echo $section->section_shot_description_en; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Shot Description (Bangla)</label>
								<div class="col-sm-7">
									<textarea type="text" name="section_shot_description_bn[]" class="form-control"><?php echo $section->section_shot_description_bn; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Description (English)</label>
								<div class="col-sm-9">
									<textarea type="text" name="section_description_en[]" class="form-control ckeditor"><?php echo $section->section_description_en; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Description (Bangla)</label>
								<div class="col-sm-9">
									<textarea type="text" name="section_description_bn[]" class="form-control ckeditor"><?php echo $section->section_description_bn; ?></textarea>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<input type="submit" class="btn btn-primary" name="submit" value="Update">
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php } ?>
</div>


<div class="row" id="loadPartButton">
	<div class="col-sm-12">
		<div class="form-group">
			<input onclick="loadPart(<?php echo $post_id; ?>);" type="button" class="btn btn-info btn-xs" value="Add Part"/>
		</div>
	</div>
</div>

<div id="loadPart">

</div>


<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js" type="text/javascript"></script>



