<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js" type="text/javascript"></script>
<?php $post_id = $row->id; ?>
<form action="<?php echo base_url('admin/post_update/'.$post_id); ?>" method="POST" enctype="multipart/form-data">

<?php 
$tags = $this->d_model->table_list('tags','id','asc')->result();
$tag_list = '';
//$tag_list_active = '';
foreach($tags as $tag){
	if(in_array($tag->id,explode(',',$row->tag_id))){
		//$tag_list_active .= $tag->tag_name.",";
	}else{
		$tag_list .= "{label: '".$tag->tag_name."'},";
	}
}

$this->db->select('tag_name');
$this->db->join('tags','tags.id=posts_tags.tag_id');
$this->db->where('post_id',$row->id);
$tag_active = $this->db->get('posts_tags')->result();
$tag_list_active = '';
foreach($tag_active as $t => $tag_ac){
	if($t==COUNT($tag_active)-1){
		$tag_list_active .= $tag_ac->tag_name;
	}else{
		$tag_list_active .= $tag_ac->tag_name.",";
	}
}
?>

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
					<label class="col-sm-3 control-label">Site Language<span class="required">*</span></label>
					<div class="col-sm-7">
						<select name="language_id" class="form-control" required="" onchange="loadCategory1(this.value)">
							<?php 
							echo $this->d_model->load_site_language($row->language_id);
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Category<span class="required">*</span></label>
					<div class="col-sm-7">
						<select name="category_id" id="category_id" class="form-control" required="" onchange="loadSubCategory(this.value);">
							<?php 
							echo $this->d_model->load_category($row->language_id,$row->category_id);
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
					<label class="col-sm-3 control-label">Featured Image (Min 300X230px)</label>
					<div class="col-sm-7">
						<input type="file" name="featured_image" /><br>
						<img src="<?php echo base_url(); ?>uploads/featured/300X230_<?php echo $row->featured_image; ?>" width="100">
						<input type="hidden" name="featured_image1" value="<?php echo $row->featured_image; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Post Title<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="post_title" class="form-control" value="<?php echo $row->post_title; ?>" required=""/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tags</label>
					<div class="col-sm-7">
						<input type="text" name="tags" class="form-control tags" value="<?php echo $tag_list_active; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Description</label>
					<div class="col-sm-7">
						<textarea name="description" class="form-control"><?php echo $row->description; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Youtube Video</label>
					<div class="col-sm-7">
						<input type="text" name="youtube_video" class="form-control" value="<?php echo $row->youtube_video; ?>" />
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

<form action="<?php echo base_url('admin/post_summary_add/'.$post_id); ?>" method="POST" enctype="multipart/form-data">
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="caption">
						Summary
					</div>
					<div class="tools">
						<a class="accordion-toggle" data-toggle="collapse" href="#summary"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
					</div>
				</div>
				<div id="summary" class="panel-body form-horizontal collapse">
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Image (Min Width: 160px, Max Width: 200px) and (Min Height: 210px, Max Height: 270px)</label>
						<div class="col-sm-7">
							<?php if($row->summary_image){ ?>
							<input type="file" name="summary_image" />
							<br><img src="<?php echo base_url(); ?>uploads/summary/<?php echo $row->summary_image; ?>" width="100">
							<?php }else{ ?>
							<input type="file" name="summary_image" />
							<?php } ?>
							<input type="hidden" name="summary_image1" value="<?php echo $row->summary_image; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Summary Name</label>
						<div class="col-sm-7">
							<input type="text" name="summary_name" class="form-control" value="<?php echo $row->summary_name; ?>"/>
						</div>
					</div>
					<input onclick="loadSummary();" type="button" class="btn btn-info btn-xs" value="New Summary Field"/>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="5%"></th>
								<th width="20%">Label</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody id="loadSummary">
						<?php 
						$summarys = $this->d_model->table_row('posts_summary','post_id',$post_id)->result();
						foreach($summarys as $i => $summary){
						?>
							<tr class="<?php echo $i; ?>">
								<td><input onclick="deleteSummary(<?php echo $i; ?>);" type="button" class="btn btn-info btn-xs" value="Delete"/></td>
								<td><input type="text" name="label[]" class="form-control" value="<?php echo $summary->label; ?>" required=""/></td>
								<td><input type="text" name="description[]" class="form-control" value="<?php echo $summary->description; ?>" required=""/></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<input type="submit" class="btn btn-primary" name="submit" value="Submit">
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
				Part <?php echo $i+1; ?>: <?php echo $part->part_title; ?>
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
					<label class="col-sm-3 control-label">Part Title</label>
					<div class="col-sm-7">
						<input type="text" name="part_title" class="form-control" value="<?php echo $part->part_title; ?>"/>
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
								Section <?php echo $j+1; ?>
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
								<label class="col-sm-3 control-label">Description</label>
								<div class="col-sm-9">
									<textarea type="text" name="section_description[]" class="form-control ckeditor"><?php echo $section->section_description; ?></textarea>
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


<link href="<?php echo base_url(); ?>assets/css/selectize.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/selectize.bootstrap3.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/js/standalone/selectize.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/selectize.js" type="text/javascript"></script>

<script>
$( function() {
	$('.tags').selectize({
		delimiter: ',',
        valueField: 'label',
        labelField: 'label',
        searchField: 'label',
        maxItems: 1000,
        create: true,
        options: [ <?php echo $tag_list; ?> ]
        ,
        render: {
            option: function(item) {
                return '<div><span>'+item.label+'</span></div>';
            }
        }
    });
});
</script>
