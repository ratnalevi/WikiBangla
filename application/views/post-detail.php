<?php
$ci =& get_instance();
$ci->load->model('front_model');
?>

<div class="main-row-page-fonts container">	

	<div class="row-last-part"> 	
    	<!-- Gallery , DETAILES DESCRIPTION-->
		<div class="col-sm-8 col-sm-offset-1 col-xs-12">
    
			<div class="ads post-menu text-center">
				<img class="img-responsive" src="<?php echo base_url(); ?>images/728X90.jpg" alt=""/>
			</div>
    
			<div class="post-1-part">
				<h2><?php echo $post->post_title; ?></h2>

				<nav class="navbar navbar-inverse scrollspy  hidden-xs">											
					<div class="followMeBar" id="myNavbar"> 
						<ul id="nav" class="bg-part nav navbar-nav" style="z-index:99999;">
							<li><?php echo count($parts); ?> Parts:</li>
							<?php foreach($parts as $part){ ?>
							<li><a href="#Parts_<?php echo $part->id; ?>"><?php echo $part->part_title; ?></a></li>
							<?php } ?>
						</ul>				
					</div>
				</nav>
	
				<div class="bg-part-2"><?php echo $post->description; ?></div>
			</div>
        
			<div class="col-md-10">
			    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			        <div class="carousel-inner">
			        <?php foreach($slider as $i => $slide){ ?>
						<div class="item <?php if($i==0){ ?>active<?php } ?>">
							<div class="cpamtion-text">
								<a href="#"><h2><?php echo $slide->part_title; ?></h2></a>
							</div>
							<img class="img-responsive" alt="<?php echo $slide->part_title; ?>" src="<?php echo base_url(UPLOAD_POST.'/'.$slide->image); ?>">
						</div>
					<?php } ?>
					</div>
									
					<div class="pull-right single-pageslide"> 
			        <!-- Controls -->
					<a class="left" href="#carousel-example-generic" role="button" data-slide="prev">
						 <span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
					</div>
			    </div>
			</div>
	
<div class="pull-left hidden-sm hidden-xs">
	<ul class="social">
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('p/'.$post_slug); ?>" class="tw js-facebook" title="Share this page!"><i class="fa fa-facebook"></i></a></li>
		<li><a href="https://twitter.com/share?url=<?php echo base_url('p/'.$post_slug); ?>" class="fb js-twitter" title="Share this page!"><i class="fa fa-twitter"></i></a></li>
		<li><a href="https://plus.google.com/share?url=<?php echo base_url('p/'.$post_slug); ?>" class="gp js-plus-google" title="Share this page!"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	
	
		<li><a onclick="postLike(<?php echo $post->id; ?>);" href="javascript:void(0);" id="like"><i class="fa fa-thumbs-o-up"></i><span> <?php echo $this->d_model->total_like_post($post->id); ?></span></a></li>
	
		<li><a href="javascript:void(0);"><i class="fa fa-eye"></i><span> <?php echo $this->d_model->total_view_post($post->id); ?></span></a>
		
		</li>
	</ul>
</div>

<script>
	function postLike(postid){
		jQuery.ajax({
			url: "<?php echo base_url(); ?>" + 'front/updateLike/' + postid,
			type: 'GET',
			success: function(data) 
			{	
				//alert(data);
				if(data=='login'){
					alert('Please first login.');
				}else if(data=='already'){
					alert('You have already like this post.');
				}else{
					$('#like').empty(); 
					$('#like').append('<i class="fa fa-thumbs-o-up"></i><span> '+data+ '</span>');
				}					
			},
		});
	}
</script>

    <!--DESCRIPTION STARTS -->
    
    
		<div class="all-post">
		<?php foreach($parts as $i => $part){ ?>
			<div class="total-post-home">
				<div id="Parts_<?php echo $part->id; ?>">
					<div class="">
						<h1 class="single-widget-title"><span class="part clearfix">Part <br/><?php echo $i+1; ?></span> <span class="part-text"><?php echo $part->part_title; ?></span></h1> 
					</div>
				</div>
				<?php
				$sections = $ci->front_model->post_part_sections($part->id)->result();
				foreach($sections as $j => $section){
				?>
				<div class="part-post-srial content-background">
					<div class="sligel-post-image"><img class="img-responsive" src="<?php echo base_url(UPLOAD_POST.'/'.$section->image); ?>" alt="<?php echo $part->part_title; ?>"/></div>
					<div class="posrt-drestic">
						<?php echo $section->section_description; ?>
					</div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>  
		</div>

    <!--DESCRIPTION ENDS -->
		<div class="part-last-part-last">
			<div class="coment-all-text">

				<?php if($post->youtube_video){ ?>
				<div class="total-post-home">
					<div class="video-part-single-page">
						<div class="embed-responsive embed-responsive-16by9">
						  	<iframe class="embed-responsive-item" src="<?php echo $post->youtube_video; ?>" allowfullscreen></iframe>
						</div>
					</div>
				</div>
				<?php } ?>




			<div class="total-post-home">
				<div class="Community Related-wikiHows">
					<div class=""><h2 class="Qustion-text">Related WikiBangla Posts </h2></div> 
					<div class="filder-text last-part">
					<?php foreach($related as $rel){ ?>
						<div class="col-sm-4 col-xs-6 images-box">
							<img class="img-responsive thumbnail" src="<?php echo base_url(UPLOAD_FEATURED.'/300X230_'.$rel->featured_image); ?>" alt="<?php echo $rel->post_title; ?>"/>
							<div class="option-realdeing">
								<a href="<?php echo base_url('p/'.$rel->slug); ?>" class="related-title"><span class="related-title-text"><?php echo $rel->post_title; ?></span></a>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>


	
				<div class="total-post-home">
					<div id="Community_qa">
						<div class="Community">
							
							<div class=""><h1 class="widget-title"><span>Community </span> </h1></div>
							<div class="filder-text">
								<h3>Ask a Question</h3>
							</div>
						</div>
					</div>
				</div>



	<div class="total-post-home">
  <h4>Source</h4>
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Source </a>
        </h3>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">
		<ul>
			<li>
				<a href="">WikiBangla</a>
				<a href="">Link</a>
				<a href="">Link</a>
				<a href=""></a>
				<a href=""></a>
			</li>
		</ul>
		</div>

      </div>
    </div>
  </div>

</div>
</div>

			<div class="total-post-home">
				<div class="Community">
					<div class=""><h2 class="Qustion-text">Article Info </h2></div>
					<div class="filder-text part-by-part">
						<h4><a href="<?php echo base_url('c/'.$post->category_id); ?>"> <?php echo $this->d_model->category_name($post->category_id); ?></a> <?php if($post->sub_category_id!='0'){ ?> <a href="<?php echo base_url('c/'.$post->sub_category_id); ?>"><?php echo $this->d_model->category_name($post->sub_category_id); ?></a><?php } ?></h4>
						<div class="col-sm-10">
						<li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i> Discuss</a></li>
						<li><a href="#"><i class="fa fa-print" aria-hidden="true"></i> Print</a></li>
						<li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>  Email</a></li>
						<li><a href="#"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></li>
						<li><a href="#"> <i class="fa fa-heart" aria-hidden="true"></i> Send fan mail to authors</a></li>
						</div>

					</div>
					<div class="syue-last">
						<h3>Did this article help you?</h3>
						<div class="cloin-part">
							<a href="#">Yes</a>
							<a href="#">No</a>
						</div>
					</div>
				</div>
			</div>
</div>
</div>


</div>


    <!-- col-md-9 -->


    <!--DETAILS SUMMARY-->
	
	<div id="single-sidebar" class="clearfix hidden-xs"> 
	<div class="col-sm-3 side-bar-main-page">
		<div class="panel-default">
		<h2 class="panel-heading">Summary</h2>
		</div>
			
			
			<div class="side-bar-wet">
				<div class="side-bar-wgt-up">
					<?php if($post->summary_name){ ?>
						<div class="col-sm-8"><h3><?php echo $post->summary_name; ?></h3></div>
					<?php } ?>
					
					<?php if($post->summary_image){ ?>
						<div class="col-sm-4"><img class="img-responsive" src="<?php echo base_url(UPLOAD_SUMMARY.'/'.$post->summary_image); ?>" alt="<?php echo $post->summary_name_en; ?>"/></div>
					<?php } ?>
				
					<div class="full-details-inf-o">
						<!---<li><b>Native Name</b> : <?php echo $post->summary_name; ?> (<?php echo $post->summary_name; ?>)</li>--->
						<?php foreach($summary as $sum){ ?>
							<li><b><?php echo $sum->label; ?></b> :	<?php echo $sum->description; ?></li>
						<?php } ?>
					</div>
				</div>


				<div class="side-bar-wgt-up">
					<div class="ads">

					</div>
				</div>

				<div class="side-bar-wgt-up">
					<?php require_once'modules/recent_popular_post.php'; ?> 
				</div>

				<div class="sidebarAD">
					<div class=" ads">
						<img class="img-responsive" src="" alt=""/>
					</div>
				</div>

			</div>
		</div>
	
	</div>



</div>
