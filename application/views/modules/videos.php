<?php
$ci =& get_instance();
$ci->load->model('front_model');

$rows = $ci->front_model->home_video(1,0)->row();
$rows1 = $ci->front_model->home_video(10,0)->result();
if($rows){
?>

<header class="panel-default"> 
	<div class="panel-heading"> <b>Video</b>
		<div class="dorp-don-menu-vieo">
    		<div class="navbar-inverse">
				<nav role="navigation" class="navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">View All <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php  
								$cats = $ci->front_model->video_category()->result();
								foreach($cats as $cat){
									$cat_link = base_url('video-category/'.$cat->id);
									$category_name = $cat->category_name; 
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
	<div class="vid-main-wrapper clearfix">
  	<!-- THE YOUTUBE PLAYER -->
      <div class="vid-container">
          <iframe id="vid_frame" src="<?php echo $rows->video_link; ?>" frameborder="0" width="560" height="315"></iframe>
      </div>

      <!-- THE PLAYLIST -->
      <div class="vid-list-container">
        <ol id="vid-list">
            <?php 
            foreach($rows1 as $i => $row){
				$img = base_url('uploads/video_img/305X225_'.$row->filename);
				$video_link = $row->video_link;
				$title = $row->title; 
				$description = $row->des; 
            ?>
              <li>
                <a href="javascript:void();" onClick="document.getElementById('vid_frame').src='<?php echo $video_link; ?>'">
                  <span class="vid-thumb"><img width=72 src="<?php echo $img; ?>" /></span>
                  <div class="desc"><?php echo $title; ?></div>
                </a>
              </li>
            <?php } ?>
            </ol>
       </div>	
	</div>

</div>

<?php } ?>