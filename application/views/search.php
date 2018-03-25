<div class="container">	
<div class="row">
	<div class="row-last-part"> 
		<div class="col-md-8 col-md-offset-1">	
			
			<div class="ads post-menu text-center">
				<img class="img-responsive" src="images/728X90.jpg">
			</div>	

			<div class="serach-post-main">
				<p class="ads-serach">Search</p>

<form class="form-inline" method="get" action="">
	<div class="form-group">
		<label for="">Question</label>
		<input type="text" name="q" class="form-control" value="<?php echo $_GET['q']; ?>" placeholder="Search...">
	</div>
	<div class="form-group">
		<label for="">Sort By</label>
		<select name="sort_by" class="form-control">
			<option <?php if($_GET['sort_by']=='new'){ echo 'selected=""'; } ?> value="new">New</option>
			<option <?php if($_GET['sort_by']=='old'){ echo 'selected=""'; } ?> value="old">Old</option>
			<option <?php if($_GET['sort_by']=='view'){ echo 'selected=""'; } ?> value="view">View</option>
			<option <?php if($_GET['sort_by']=='like'){ echo 'selected=""'; } ?> value="like">Like</option>
			<option <?php if($_GET['sort_by']=='comment'){ echo 'selected=""'; } ?> value="comment">Comment</option>
		</select>
	</div>
	<input type="submit" name="search" class="btn btn-default" value="Search">
</form>
			</div>  
			
			<div class="serach-post-main">
				<p class="ads-serach">Ads</p>

				<h3> <img class="img-responsive" src="<?php echo base_url(); ?>search-images/default.png"/> The #1 Affiliate Program - Exclusive Offers Make Money | whalecash.com</h3>
				<a href="#">www.whalecash.com</a>
				<p>Over 400 Exclusive Offers to Promote. Experience The Highest Conversions Ever! Expert Advice?</p>
			</div>  
    
    		<?php 
    		//print_r($rows);
    		$session = $this->session->userdata('bangla');
    		foreach($rows as $row){ 
	    		$post_link = base_url('p/'.$row->slug);
				$img = base_url('uploads/featured/300X230_'.$row->featured_image);
				$title = $row->post_title; 
    		?>
			<div class="post-resch-slingle">
    
				<div class="col-sm-4 serach-single-images"><img class="img-responsive" src="<?php echo $img; ?>" alt="<?php echo $title; ?>"/></div>
				<div class="col-sm-8 serach-single-images">
					<h3><a href="<?php echo $post_link; ?>"><?php echo $title; ?></a></h3>
					<ul>
						<li> <img class="img-responsive" src="<?php echo base_url(); ?>images/1.png" alt=""/> <?php echo $this->d_model->total_view_post($row->id); ?> views</li>
						<li> <img class="img-responsive" src="<?php echo base_url(); ?>images/2.png" alt="" /> Updated <?php echo $this->d_lib->time_elapsed_string($row->created); ?></li>
					</ul>
					<ul>
						<li> <img class="img-responsive" src="<?php echo base_url(); ?>images/3.png" alt=""/> Expert Reviewed</li>
					</ul>
				</div>
			</div>
			<?php } ?>

			<div class="net-priv-menu-pation">
				<?php echo $pagination; ?>
			</div>

		</div>
	</div>


    <!-- col-md-9 -->


    <!--DETAILS SUMMARY-->
	<div class="col-md-3 side-bar-main-page">
	<div class="row">
		<h2 class="">What's You Want</h2>
		<div class="side-bar-wet">

			<div class="side-bar-wet2">
				<div class="col-sm-6">
					<a href="#"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
					Start write a article</a>
				</div>
				<div class="col-sm-6">
					<a href="#"><i class="fa fa-building-o fa-2x" aria-hidden="true"></i>
					Create Your company profile</a>
				</div>
				<div class="col-sm-6">
					<a href="#"><i class="fa fa-user fa-2x" aria-hidden="true"></i>
					Create Your Personal profile</a>
				</div>
				<div class="col-sm-6">
					<a href="#"><i class="fa fa-globe fa-2x" aria-hidden="true"></i>
					Known Whole world</a>
				</div>
			</div>


			<div class="side-bar-wgt-up">
				<div class="ads">
					<img class="img-responsive" src="<?php echo base_url(); ?>ads/ads-1.gif" alt=""/>
				</div>
			</div>

			<div class="side-bar-wgt-up">
				<?php require_once'modules/recent_popular_post.php'; ?>  
			</div>
		</div>
				
		<div class="ad-300*600">
			<a href=""><img src="https://dcassetcdn.com/design_img/285948/115270/115270_2606391_285948_thumbnail.jpg" alt="" /></a>
		</div>
		
		
		
	</div>
	 
	 </div>
</div>
</div>