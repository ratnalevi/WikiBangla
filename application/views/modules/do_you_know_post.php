<?php
$ci =& get_instance();
$ci->load->model('front_model');

$rows = $ci->front_model->featured_post(1,0,'do_you_know')->result();
$rows_side = $ci->front_model->featured_post(4,1,'do_you_know')->result();
$rows_slider = $ci->front_model->featured_post(9,0,'do_you_know')->result();

if($rows){
?>

<header class="panel panel-info"> 
	<h4 class="panel-heading"><b>Do You Know ?</b></h4>
</header>	
		
<div class="col-sm-6 col-xs-6">

	<?php 
	foreach($rows as $row){ 
		$cat_link = base_url('c/'.$row->c_slug);
		$post_link = base_url('p/'.$row->slug);
		$img = base_url('uploads/featured/300X230_'.$row->featured_image);
		$title = $row->post_title;
		$description = $row->description;
		$category_name = $row->category_name;
	?>
	<div class="do-u-know">
		<a class="" href="<?php echo $post_link; ?>">
			<img class="img-responsive img-thumbnail" src="<?php echo $img; ?>" alt="">
		</a>
	</div>
		  
	<header class=""><h3><a href="<?php echo $post_link; ?>"><?php echo $title; ?></a></h3></header>
	<p><?php echo $this->d_lib->get_def_word($description,50); ?><a href="<?php echo $post_link; ?>"> <i><b>Continue...</b></i></a></p>
		   
		   <footer>

			    <ul class="list-inline">
					<li class="Pull-left"><a href="#"><i class="fa fa-user " aria-hidden="true"></i> By</a></li>
					<li class="text-center"> <i class="fa fa-list-alt" aria-hidden="true"> <?php echo $category_name; ?></i></li>
					<li class="text-center"> <i class="fa fa-bookmark-o" aria-hidden="true"></i></li>
					<li class="pull-right"> <a href="" data-toggle="dropdown"><i class="fa fa-share"></i> </a>
						<ul class="list-inline dropdown-menu pull-right">
							<li> <a class="js-twitter" href="https://twitter.com/share?url=<?php echo $post_link; ?>" data-original-title="Twitter"> <i class="fa fa-twitter"></i></a></li>
							<li><a class="js-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_link; ?>" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>					
							<li><a class="js-plus-google" data-original-title="Google+" href="https://plus.google.com/share?url=<?php echo $post_link; ?>"><i class="fa fa-google-plus"></i></a></li>
						</ul>	
					</li>
			    </ul>
			
		   
		   
		   </footer>
	<?php } ?>
	
	<?php /* if($rows_slider){ ?>
    <div class='col-md-12 hidden-xs'>
      <div class="carousel slide media-carousel" id="media">
        <div class="carousel-inner">
        <?php
        $j = 1; 
		foreach($rows_slider as $i => $row){ 
			$post_link = base_url('p/'.$row->slug);
			$img = base_url('uploads/featured/300X230_'.$row->featured_image);
		?>
			<?php if($j==1){ ?>
			<div class="item <?php if($i==0){ ?>active<?php } ?>">
				<div class="row">
			<?php } ?>
					<div class="col-md-4">
						<a class="thumbnail" href="<?php echo $post_link; ?>"><img alt="" src="<?php echo $img; ?>"></a>
					</div>   
			<?php 
			if($j==3 || ($i==count($rows_slider)-1)){ 
			$j = 1;
			?>        
				</div>
			</div>
			<?php }else{ $j++; } ?>
        <?php } ?>
        </div>
        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media" class="right carousel-control">›</a>
      </div>                          
    </div>
	<?php } */ ?>	   
</div>


<?php 
foreach($rows_side as $row){ 
	$post_link = base_url('p/'.$row->slug);
	$img = base_url('uploads/featured/300X230_'.$row->featured_image);
	$title = $row->post_title; 
?>	
<div class="col-sm-3 col-xs-6">
	<div class="flex-content">
		<a href="<?php echo $post_link; ?>">
		<img class="img-responsive img-thumbnail" src="<?php echo $img; ?>" alt=""/></a>
	</div>	
	<article>
		<header>
			<h5 class="entry-title" itemprop="headline">				
				<a href="<?php echo $post_link; ?>"><?php echo $title; ?></a>
			</h5>
		</header>	
	</article>	
	<div class="clearfix"></div>
</div>
<?php } ?>

<?php } ?>