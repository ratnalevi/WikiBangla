

<?php 
$ci = & get_instance();
$ci->load->model('front_model');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets-front/css/vedio.css" media="screen" >

<div class="row">
	<div class="col-md-9 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
		
		
		<div class="main-grids">
			<div class="top-grids">
				<div class="recommended-info">
					<h3><?php echo $this->lang->line('Recent Videos'); ?></h3>
				</div>
				<?php 
				$recent = $ci->front_model->video('recent','','id','desc','0','3')->result();
				foreach($recent as $row){ 
				?>
				<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
					<div class="resent-grid-img recommended-grid-img">
						<a href="<?php echo base_url('video/single/'.$row->id); ?>"><img src="<?php echo base_url().UPLOAD_VIDEO_IMG.'/640X426_'.$row->filename; ?>" alt=""></a>
						<div class="time">
							<p><?php echo $row->duration; ?></p>
						</div>
						<div class="clck">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
						</div>
					</div>
					<div class="resent-grid-info recommended-grid-info">
						<h3><a href="<?php echo base_url('video/single/'.$row->id); ?>" class="title title-info"><?php if($this->session->userdata('bangla')=='bangla'){ echo $row->title_bn; }else{ echo $row->title_en; } ?></a></h3>
						<ul>
							<li><p class="author author-info"><a href="#" class="author"><?php echo $row->fullname; ?></a></p></li>
							<li class="right-list"><p class="views views-info"><?php echo $this->d_lib->number_format($row->total_view); ?> <?php echo $this->lang->line('views'); ?></p></li>
						</ul>
					</div>
				</div>
				<?php } ?>
				<div class="clearfix"> </div>
			</div>
			
			
			<?php 
			$category = $ci->front_model->video_category()->result();
			foreach($category as $cat){
				$category_id = $cat->id;
				
				$video = $ci->front_model->video($category_id,'','id','desc','0','4')->result();
				if($video){
			?>
			<div class="recommended">
				<div class="recommended-grids">
					<div class="recommended-info">
						<h3><a href="<?php echo base_url('video/category/'.$cat->id); ?>"><?php if($this->session->userdata('bangla')=='bangla'){ echo $cat->category_bn; }else{ echo $cat->category_en; } ?></a></h3>
					</div>
					<?php foreach($video as $row){  ?>
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
			<?php 
				}
			} 
			?>
		</div>
			
	</div>
</div>
