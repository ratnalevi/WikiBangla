
<link rel="stylesheet" href="<?php echo base_url(); ?>css/vedio.css" media="screen" >

<div class="row">
	<div class="col-md-12">
		
		
		<div class="main-grids">
					
	
			<div class="recommended">
				<div class="recommended-grids" style="margin-top: 0px;">
					<div class="recommended-info">
						<h3><?php echo $title; ?></h3>
					</div>
					<?php foreach($rows as $row){  ?>
					<div class="col-md-3 resent-grid recommended-grid">
						<div class="resent-grid-img recommended-grid-img">
							<a href="<?php echo base_url('video/single/'.$row->id); ?>"><img src="<?php echo base_url().UPLOAD_VIDEO_IMG.'/305X225_'.$row->filename; ?>" alt=""></a>
							<div class="time small-time">
								<p><?php echo $row->duration; ?></p>
							</div>
							<div class="clck small-clck">
								<i class="fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
						<div class="resent-grid-info recommended-grid-info video-info-grid">
							<h5><a href="<?php echo base_url('video/single/'.$row->id); ?>" class="title"><?php if($this->session->userdata('bangla')=='bangla'){ echo $row->title_bn; }else{ echo $row->title_en; } ?></a></h5>
							<ul>
								<li><p class="author author-info"><a href="#" class="author"><?php echo $row->fullname; ?></a></p></li>
								<li class="right-list"><p class="views views-info"><?php echo $this->d_lib->number_format($row->total_view); ?> <?php echo $this->lang->line('views'); ?></p></li>
							</ul>
						</div>
					</div>
					<?php } ?>
					<div class="clearfix"> </div>
				</div>
			</div>
			
		</div>
			
	</div>
</div>
