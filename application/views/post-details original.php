<?php
$ci =& get_instance();
$ci->load->model('front_model');
$session = $this->session->userdata('bangla');
?>

<div class="main-row-page-fonts container">	
	<div class="row-last-part"> 	
    	<!-- Gallery , DETAILES DESCRIPTION-->
		<div class="col-md-7 col-md-offset-1">
    
			<div class="ads post-menu text-center">
				<img class="img-responsive" src="<?php echo base_url(); ?>images/728X90.jpg" alt=""/>
			</div>
    
			<div class="post-1-part">
				<h2><?php if($session=='bangla'){ echo $post->title_bn; }else{ echo $post->title_en; } ?></h2>

				<nav class="navbar navbar-inverse">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
						</button>
				
					</div>
							
				
					<div class="followMeBar collapse navbar-collapse"> 
						<ul class="bg-part clearfix">
							<li><?php echo count($parts); ?> Parts:</li>
							<?php foreach($parts as $part){ ?>
							<li><a href="#Parts_<?php echo $part->id; ?>"><?php if($session=='bangla'){ echo $part->part_title_bn; }else{ echo $part->part_title_en; } ?></a></li>
							<?php } ?>
						</ul>				
					</div>
				</nav>
				
	
				

				
				
				<div class="bg-part-2"><?php if($session=='bangla'){ echo $post->description_bn; }else{ echo $post->description_en; } ?></div>
			</div>
        
			<div class="slider">
			    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			        <div class="carousel-inner">
			        <?php foreach($slider as $i => $slide){ ?>
						<div class="item <?php if($i==0){ ?>active<?php } ?>">
							<div class="cpamtion-text">
								<a href="#"><h2><?php if($session=='bangla'){ echo $slide->part_title_bn; }else{ echo $slide->part_title_en; } ?></h2></a>
							</div>
							<img class="img-responsive" alt="<?php if($session=='bangla'){ echo $slide->part_title_bn; }else{ echo $slide->part_title_en; } ?>" src="<?php echo base_url(UPLOAD_POST.'/'.$slide->image); ?>">
						</div>
					<?php } ?>
					</div>
									
			        <!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						 <span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>

					</a>
			    </div>
			</div>





	
<div data-spy="affix" class="pull-left hidden-sm hidden-xs" 
style="margin-left: -65px;">
	<ul class="social">
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('p/'.$post->slug); ?>" target="_blank" class="tw" title="Tweet this page!"><i class="fa fa-facebook"></a></i></li>
		<li><a href="https://twitter.com/share?url=<?php echo base_url('p/'.$post->slug); ?>" class="fb" target="_blank" title="Share this page!"><i class="fa fa-twitter"></i></a></li>
		<li><a href="https://plus.google.com/share?url=<?php echo base_url('p/'.$post->slug); ?>" class="gp" target="_blank" title="Share this page!"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	
	</ul>
	
	
	<ul> 
		<li><a onclick="postLike(<?php echo $post->id; ?>);" href="javascript:void(0);" id="like"><i class="fa fa-thumbs-o-up"></i><span> <?php echo $this->d_model->total_like_post($post->id); ?></span></a></li>
	
		<li><i class="fa fa-eye"></i><span> <?php echo $this->d_model->total_view_post($post->id);; ?></span></li>
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
						<h1 class="widget-title"><span class="part clearfix">Part <br/><?php echo $i+1; ?></span> <span class="part-text"><?php if($session=='bangla'){ echo $part->part_title_bn; }else{ echo $part->part_title_en; } ?></span></h1> 
					</div>
				</div>
				<?php
				$sections = $ci->front_model->post_part_sections($part->id)->result();
				foreach($sections as $j => $section){
				?>
				<div class="part-post-srial content-background">
					<div class="sligel-post-image"><img class="img-responsive" src="<?php echo base_url(UPLOAD_POST.'/'.$section->image); ?>" alt="<?php if($session=='bangla'){ echo $part->part_title_bn; }else{ echo $part->part_title_en; } ?>"/></div>
					<div class="posrt-drestic">
						<span><b><?php echo $j+1; ?></b></span><?php if($session=='bangla'){ echo $section->section_description_bn; }else{ echo $section->section_description_en; } ?>
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
					<div id="Community_qa">
						<div class="Community">
							
							<div class=""><h1 class="widget-title"><span><i class="fa fa-question" aria-hidden="true"></i></span> <span>Community Q&A</span> </h1></div>
							<div class="filder-text">
								<h3>Ask a Question</h3>
								<input type="text" placeholder="What do you need to know? We'll do our best to find the answer." maxlength="200" id="qa_asked_question">
								<a class="button primary" id="qa_submit_button">Submit</a>
							</div>
						</div>
					</div>
				</div>



<div class="total-post-home">
<div class="Community Qustion">
<div class=""><h2 class="Qustion-text"> Can you answer these readers' questions? <a href="#"><i class="fa fa-undo" aria-hidden="true"></i> Refresh</a></h2></div>
<div class="filder-text">
<div class="post-number-blog">
<div class="col-sm-3 img-post-qustion"><img class="img-responsive" src="<?php echo base_url(); ?>Qustion-images/Qustion-images-1.jpg" alt=""/></div>
<div class="col-sm-9 qustio-part">
<h3><span>On</span> <b>How to Relieve Back Pain Through Reflexology,</b> a reader asks:</h3>
<div class="authree">
<i class="fa fa-user" aria-hidden="true"></i> <input class="text-qution" type="text" placeholder="How do I know if the reflex point are working?" maxlength="200" id="qa_asked_question">

</div>
<div class="replying">
<div class="just-my-xon">
					<textarea placeholder="Your answer..." class="qab_input qab_answer"></textarea>
					<input type="text" placeholder="Email address (optional)" class="qab_email qab_input">
					<input type="button" value="Reply" class="qab_submit button primary">
</div>
</div>
</div>
</div>
</div>

<div class="filder-text">
<div class="post-number-blog">
<div class="col-sm-3 img-post-qustion"><img class="img-responsive" src="<?php echo base_url(); ?>Qustion-images/Qustion-images-2.jpg" alt=""/></div>
<div class="col-sm-9 qustio-part">
<h3><span>On</span> <b>How to Write Policies and Procedures for Your Business,</b> a reader asks:</h3>
<div class="authree">
<i class="fa fa-user" aria-hidden="true"></i> <input class="text-qution" type="text" placeholder="How do I write policy for a residential home care business?" maxlength="200" id="qa_asked_question">

</div>
<div class="replying">
<div class="just-my-xon">
					<textarea placeholder="Your answer..." class="qab_input qab_answer"></textarea>
					<input type="text" placeholder="Email address (optional)" class="qab_email qab_input">
					<input type="button" value="Reply" class="qab_submit button primary">
</div>
</div>
</div>
</div>
</div>

<div class="filder-text">
<div class="post-number-blog">
<div class="col-sm-3 img-post-qustion"><img class="img-responsive" src="<?php echo base_url(); ?>Qustion-images/Qustion-images-3.jpg" alt=""/></div>
<div class="col-sm-9 qustio-part">
<h3><span>On</span> <b>How to Register a Domain Name With Google,</b>a reader asks:</h3>
<div class="authree">
<i class="fa fa-user" aria-hidden="true"></i> <input class="text-qution" type="text" placeholder="I just registered my domain name and I realized I made a mistake. How can I change it?" maxlength="200" id="qa_asked_question">

</div>
<div class="replying">
<div class="just-my-xon">
					<textarea placeholder="Your answer..." class="qab_input qab_answer"></textarea>
					<input type="text" placeholder="Email address (optional)" class="qab_email qab_input">
					<input type="button" value="Reply" class="qab_submit button primary">
</div>
</div>
</div>
</div>
</div>

</div>
</div>


			<div class="total-post-home">
				<div class="Community Related-wikiHows">
					<div class=""><h2 class="Qustion-text"> Related wikiHows </h2></div> 
					<div class="filder-text last-part">
					<?php foreach($related as $rel){ ?>
						<div class="col-sm-6 images-box">
							<img class="img-responsive" src="<?php echo base_url(UPLOAD_FEATURED.'/300X230_'.$rel->featured_image); ?>" alt="<?php if($session=='bangla'){ echo $rel->title_bn; }else{ echo $rel->title_en; } ?>"/>
							<div class="option-realdeing">
								<a href="<?php echo base_url('p/'.$rel->slug); ?>" class="related-title"><span class="related-title-text"><p>How to </p><?php if($session=='bangla'){ echo $rel->title_bn; }else{ echo $rel->title_en; } ?></span></a>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>



<div class="total-post-home">
<div class="Community">
<div class=""><h2 class="Qustion-text"> Sources and Citations </h2></div>
<div class="filder-text part-by-part">
<li>1.<a href="#">? https://www.healthlinkbc.ca/healthlinkbc-files/unpasteurized-fruit-juice-health-risk</a></li>
<li>2.<a href="#">? http://extension.oregonstate.edu/gardening/take-care-fresh-apple-juice-and-cider</a></li>
<li>3.<a href="#">? https://www.healthlinkbc.ca/healthlinkbc-files/unpasteurized-fruit-juice-health-risk </a></li>
<div class="more-linker">
<div class="some-more">Some More Links</div>
<div class="some-more-2"><li>4.<a href="#">? http://extension.oregonstate.edu/gardening/take-care-fresh-apple-juice-and-cider</a></li>
<li>5.<a href="#">? https://www.epicurious.com/recipes/food/views/to-sterilize-jars-and-lids-for-preserving-102234</a></li>
<li>6.<a href="#">? https://www.epicurious.com/recipes/food/views/to-sterilize-jars-and-lids-for-preserving-102234</a></li>
<li>7.<a href="#">? https://www.epicurious.com/recipes/food/views/to-sterilize-jars-and-lids-for-preserving-102234</a></li>
<li>8.<a href="#">? https://www.epicurious.com/recipes/food/views/to-sterilize-jars-and-lids-for-preserving-102234</a></li>
<li>9.<a href="#">? https://www.healthlinkbc.ca/healthlinkbc-files/unpasteurized-fruit-juice-health-risk </a></li></div>
</div>
</div>
</div>

</div>
</div>

			<div class="total-post-home">
				<div class="Community">
					<div class=""><h2 class="Qustion-text">Article Info </h2></div>
					<div class="filder-text part-by-part">
						<h4> Categories:<a href="<?php echo base_url('posts/'.$post->category_id); ?>"> <?php echo $this->d_model->category_name($post->category_id); ?></a> <?php if($post->sub_category_id!='0'){ ?>| <a href="<?php echo base_url('posts/'.$post->sub_category_id); ?>"><?php echo $this->d_model->category_name($post->sub_category_id); ?></a><?php } ?></h4>
						<div class="col-sm-10">
						<li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i> Discuss</a></li>
						<li><a href="#"><i class="fa fa-print" aria-hidden="true"></i> Print</a></li>
						<li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>  Email</a></li>
						<li><a href="#"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></li>
						<li><a href="#"> <i class="fa fa-heart" aria-hidden="true"></i> Send fan mail to authors</a></li>
						</div>
						<div class="col-sm-2">
							<?php if($post->featured=="Yes"){ ?><img class="img-responsive" src="<?php echo base_url(); ?>images/article_sprite.png" alt=""> Featured Article<?php } ?>
						</div>
					</div>
					<div class="syue-last">
						<b>Thanks to all authors for creating a page that has been read 1,870,501 times.</b>
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

		<div class="col-sm-4 side-bar-main-page">

			<h2 class="widget-title">Summary</h2>
			<div class="side-bar-wet">
				<div class="side-bar-wgt-up">
					<?php if($post->summary_name_en){ ?><div class="col-sm-8"><h3><?php echo $post->summary_name_en; ?><br/><?php echo $post->summary_name_bn; ?></h3></div><?php } ?>
					<?php if($post->summary_image){ ?><div class="col-sm-4"><img class="img-responsive" src="<?php echo base_url(UPLOAD_SUMMARY.'/'.$post->summary_image); ?>" alt="<?php echo $post->summary_name_en; ?>"/></div><?php } ?>
					<?php if($post->summary_name_en){ ?>
					<div class="full-details-inf-o">
						<li><b>Native Name</b> : <?php echo $post->summary_name_en; ?> (<?php echo $post->summary_name_bn; ?>)</li>
						<?php foreach($summary as $sum){ ?>
							<li><b><?php echo $sum->label; ?></b> :	<?php echo $sum->description; ?></li>
						<?php } ?>
					</div>
					<?php } ?>
				</div>


				<div class="side-bar-wgt-up">
					<div class="ads">
						<img class="img-responsive" src="<?php echo base_url(); ?>ads/ads-1.gif" alt=""/>
					</div>
				</div>

				<div class="side-bar-wgt-up">
					<?php require_once'modules/recent_popular_post.php'; ?> 
				</div>

				<div class="sidebarAD">
					<div class=" ads">
						<img class="img-responsive" src="http://www.zaptones.com/assets/ad300600.jpg" alt=""/>
					</div>
				</div>

			</div>
		</div>


</div>
