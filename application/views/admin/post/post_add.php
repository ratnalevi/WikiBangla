


<form action="" method="POST" enctype="multipart/form-data">

<div class="row">	
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Basic Information</h3>
			</div>
			<div class="panel-body form-horizontal">
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
					<label class="col-sm-3 control-label">Featured Image (Min 300X230px)<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="file" name="featured_image" required="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Post Title<span class="required">*</span></label>
					<div class="col-sm-7">
						<input type="text" name="post_title" class="form-control" value="" required=""/>
					</div>
				</div>				
				<div class="form-group">
					<label class="col-sm-3 control-label">Tags</label>
					<div class="col-sm-7">
						<input type="text" name="tags" class="form-control tags" value="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Description</label>
					<div class="col-sm-7">
						<textarea name="description" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Youtube Video</label>
					<div class="col-sm-7">
						<input type="text" name="youtube_video" class="form-control" value="" />
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
						<input type="submit" class="btn btn-primary" name="submit" value="Submit"> Step add after submit.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
</form>	

<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js" type="text/javascript"></script>



<link href="<?php echo base_url(); ?>assets/css/selectize.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/selectize.bootstrap3.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/js/standalone/selectize.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/selectize.js" type="text/javascript"></script>

<?php 
$tags = $this->d_model->table_list('tags','id','asc')->result();
$tag_list = '';
foreach($tags as $tag){
	$tag_list .= "{label: '".$tag->tag_name."'},";
}
?>

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
