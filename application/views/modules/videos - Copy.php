<?php
$ci =& get_instance();
$ci->load->model('front_model');

$rows = $ci->front_model->home_video(3,0)->result();
$rows1 = $ci->front_model->home_video(4,0)->result();

$session = $this->session->userdata('bangla');
if($rows){
?>

<header class="panel-default"> 
	<div class="panel-heading">  <b>Video</b>
		<div class="dorp-don-menu-vieo">
    		<div class="navbar-inverse">
				<nav role="navigation" class="navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">View All <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php  
								$cats = $this->d_model->table_row('videos_category','status','publish')->result();
								foreach($cats as $cat){
									$cat_link = base_url('video-category/'.$cat->id);
									if($session=='bangla'){ 
										$category_name = $cat->category_bn; 
									}else{ 
										$category_name = $cat->category_en; 
									}
								?>
									<li>
										<a class="dropdown-item" href="<?php echo $cat_link; ?>"><?php echo $category_name; ?></a>
									</li>
								<?php } ?>
		                        <li>
									<a class="dropdown-item" href="#">More Post</a>
								</li>
							</ul>
						</li>							
					</ul>
				</nav>
			</div>
    	</div>
	</div>
</header>
			
			
		
<div class="row-flex-wrap"> 
	<div class="section"> 
		<div class="col-xs-12 col-sm-6"> 
			<div id="myCarousel" class="carousel slide">
			    <div class="carousel-inner">
			    <?php 
			    foreach($rows as $i => $row){
					$post_link = base_url('video-detail/'.$row->id);
					$img = base_url('uploads/video_img/640X426_'.$row->filename);
					if($session=='bangla'){ 
						$title = $row->title_bn; 
						$description = $row->des_bn; 
					}else{ 
						$title = $row->title_en; 
						$description = $row->des_en; 
					}
			    ?>
			        <div class="item <?php if($i==0){ ?>active<?php } ?>">
			            <img src="<?php echo $img; ?>" alt="" class="">
			            <div class="carousel-caption">
			                <h4 class=""><a href="<?php echo $post_link; ?>"><?php echo $title; ?></a></h4>
			                <p class="">
			                   <?php echo $this->d_lib->get_def_word($description,20); ?>
			                </p>
			            </div>
			        </div>
			    <?php } ?>
			    </div> 
  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
			</div>
		</div>
	
		
		<div class="col-xs-12 col-sm-6"> 
			<ul class="older-post pull-left clearfix"> 
				<?php 
			    foreach($rows1 as $i => $row){
					$post_link = base_url('video-detail/'.$row->id);
					$img = base_url('uploads/video_img/305X225_'.$row->filename);
					if($session=='bangla'){ 
						$title = $row->title_bn; 
						$description = $row->des_bn; 
					}else{ 
						$title = $row->title_en; 
						$description = $row->des_en; 
					}
					
					$v_comment = $ci->front_model->count_video_comment($row->id);
			    ?>
				<li>
					<article class="entry-item clearfix">
						<div class="entry-thumb pull-left">
							<a href="<?php echo $post_link; ?>"><img src="<?php echo $img; ?>" alt=""></a>
						</div>
						<!-- end:entry-thumb -->
						<div class="entry-content">
							<h6 class="entry-title"><a href="<?php echo $post_link; ?>"><?php echo $title; ?></a></h6>
							<div class="meta-box clearfix">
								<span class="entry-author pull-left">By <a href="#"><?php echo $row->fullname; ?></a></span>
								<a href="#" class="entry-comments pull-left"><?php echo $v_comment; ?> Comment</a>
							</div>
							<!-- end:meta-box -->
						</div>
						<!-- end:entry-content -->
					</article>
					<!-- end:entry-item -->
				</li> 
				<?php } ?>        
			</ul>
		</div>
	</div>
</div>

<?php } ?>