<?php
$ci =& get_instance();
$ci->load->model('front_model');

$rows = $ci->front_model->featured_post(4,0,'recent')->result();
?>

<header class="panel-default"> 
	<div class="panel-heading"><b>Recent Post</b>				
		<div class="dorp-don-menu-vieo">
			<div class="navbar-inverse">
				<nav role="navigation" class="navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">View All <b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php  
							$cats = $this->d_model->category('0');
							foreach($cats as $cat){
								$cat_link = base_url('c/'.$cat->slug);
								$category_name = $cat->category_name; 
							?>
								<li>
									<a class="dropdown-item" href="<?php echo $cat_link; ?>"><?php echo $category_name; ?></a>
								</li>
							<?php } ?>
								<li>
									<a class="dropdown-item" href="#"><?php echo 'More post'; ?></a>
								</li>
							</ul>
						</li>							
					</ul>
				</nav>
			</div>
		</div>				
	</div> 								
</header>
			
<div class="row-flex row-flex-wrap"> 
	<?php 
	foreach($rows as $row){ 
		$cat_link = base_url('c/'.$row->c_slug);
		$post_link = base_url('p/'.$row->slug);
		$img = base_url('uploads/featured/300X230_'.$row->featured_image);
		$title = $row->post_title;
		$description = $row->description;
		$category_name = $row->category_name;
	?>
	<div class="col-md-3 col-sm-6 group-item col">
		<div class="panel panel-default flex-col">
			<div class="flex-content">
				<a class="" href="<?php echo $post_link; ?>">
					<img class="img-responsive" src="<?php echo $img; ?>" alt="">
				</a>
			</div>
			<header class="flex-post-title clearfix"> <h1><a href="<?php echo $post_link; ?>"><?php echo $title; ?></a> </h1> </header>
			<div class="flex-post-article flex-grow">
				<p><?php echo $this->d_lib->get_def_word($description,50); ?><a href="<?php echo $post_link; ?>"> <i><b>Continue...</b></i></a>
				</p>
			</div>
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
		</div>
	</div>
	<?php } ?>			
</div>