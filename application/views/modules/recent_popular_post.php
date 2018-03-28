<?php
$ci =& get_instance();
$ci->load->model('front_model');

$recent = $ci->front_model->featured_post(5,0,'recent')->result();
$popular = $ci->front_model->top_weekly_post(5,0,'popular')->result();
?>
<div class="bs-example">
    <ul class="nav nav-tabs" id="myTab">
        <li><a data-toggle="tab" href="#sectionA">Recent</a></li>
        <li><a data-toggle="tab" href="#sectionB">Popular Content</a></li>
    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
	        <div class="post-deti-shoert">
	        	<?php 
	        	foreach($recent as $row){ 
	        		$title = $row->post_title; 
	        	?>
					<li><a href="<?php echo base_url('p/'.$row->slug); ?>"><?php echo $title; ?></a></li>
				<?php } ?>
			</div>          
		</div>
		<div id="sectionB" class="tab-pane fade">
			<div class="post-deti-shoert">
				<?php 
	        	foreach($popular as $row){ 
	        		$title = $row->post_title; 
	        	?>
					<li><a href="<?php echo base_url('p/'.$row->slug); ?>"><?php echo $title; ?></a></li>
				<?php } ?>
		  	</div>     
        </div>
        
    </div>
</div>