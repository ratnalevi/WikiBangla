<?php
$ci =& get_instance();
$ci->load->model('front_model');

$rows = $ci->front_model->featured_post(4,0,'featured')->result();

$session = $this->session->userdata('bangla');
?>

<div class="content-background"> 
	<div class="feature-slider clearfix inner-page-content"> 
		<div id="carousel-example-generic" class="carousel slide carousel-fade">	
			<div class="social-share">
				<div id="socialHolder">
					<header  class=" panel panel-info"> 
						<div class="panel-heading"><b>Feature</b>
							<div class="btn-group featureShare share-group pull-right"> 
							
							
							
							<a href="" data-toggle="dropdown" class="pull-right"> <span><i class="fa fa-share"></i></span></a> <!-- <a href="" class="pull-right">View All</a> -->
							<ul class="dropdown-menu list-inline">
								<li> <a href="#" data-original-title="Twitter"> <i class="fa fa-twitter"></i></a></li>
								<li><a href="#"  data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>					
								<li><a data-original-title="Google+"  href="#" ><i class="fa fa-google-plus"></i></a></li>
								<li><a data-original-title="LinkedIn"  href="#" ><i class="fa fa-linkedin"></i></a></li>
								<li><a data-original-title="Pinterest" ><i class="fa fa-pinterest"></i></a>
								</li>
								<li><a  data-original-title="Email"   class="btn btn-mail" data-placement="left"><i class="fa fa-envelope"></i></a></li>
							</ul>
							</div>
						</div>
					</header>
				</div> <!--socialHolder-->
			</div> <!--social-share-->

			<!-- Indicators -->
			<ol class="carousel-indicators">
			<?php foreach($rows as $i => $row){ ?>
				<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0){ echo 'active'; } ?>"></li>					
			<?php } ?>
			</ol>
				
				
			<div class="recent-featured hidden-xs"> 
				<ul class="list-inline"> 
					<li><i>Recent featured:</i></li>
					<?php foreach($rows as $i => $row){ ?>
					<li><a href="<?php echo base_url('c/'.$row->c_slug); ?>" title=""><i><?php echo $row->category_name; ?><?php if($i!=3){ echo ','; } ?></i></a></li>
					<?php } ?>
				</ul>
			</div>
			
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<!-- Item 1 -->
				<?php 
				foreach($rows as $i => $row){ 
					$description = $row->description; 
				?>
				<div class="item <?php if($i==0){ echo 'active'; } ?>">
					<div class="row"> 
					<div class="col-md-4 col-sm-4 col-xs-12">   
						<figure> <a href="<?php echo base_url('p/'.$row->slug); ?>"><img class="img-responsive" src="<?php echo base_url('uploads/featured/300X230_'.$row->featured_image); ?>" alt="" /></a></figure>
					</div>

					<div class="col-sm-8">
						<header> <h4><a href="<?php echo base_url('p/'.$row->slug); ?>"><b><?php echo $row->post_title; ?></b></a> </h4></header>				
						<p><?php echo $this->d_lib->get_def_word($description,60); ?> <a href="<?php echo base_url('p/'.$row->slug); ?>"><b><i>Continue..</i></b></a></p> 
					</div>
					</div>
				</div>
				<?php } ?>			
			</div>						
			<!-- End Wrapper for slides-->
		</div> <!--carousel-example-generic-->		
	</div> <!--feature-slider-->

</div> <!--content-background-->