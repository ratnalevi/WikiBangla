
<?php
$this->db->where('language_id',SITE_LANG);
$this->db->where('status','publish');
$this->db->order_by('total_view','desc');
$this->db->limit(5);
$cats = $this->db->get('category')->result();
foreach($cats as $cat){
	$title = $cat->category_name;
	if($cat->parent_id){
		$main_cat = $this->db->get_where('category',array('id'=>$cat->parent_id))->row();
		$c = $main_cat->slug.':'.$cat->slug;
	}else{
		$c = $cat->slug;
	}
	$link = base_url('c/'.$c);
?>
<div class="tag-lin-paet"> 
	<div class="subCatagory"> 	
		<p><a style="float: none;" href="<?php echo $link; ?>"><?php echo $link; ?></a></p>
	</div>
</div>
<?php } ?>