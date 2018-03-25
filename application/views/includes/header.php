<header id="topmenu" class="">

<?php 
$user = $this->session->userdata('user'); 
?>
<div class="container-fluid"> 
    <nav class="navbar-fixed-top top-header">
	<div class="container-fluid">
		<div id="row">			
			<div class="navbar-header col-md-offset-1">
				<div class="">
					<a class="navbar-brand1 col-xs-3 col-sm-12" href="#">
						<img class="" src="<?php echo base_url(); ?>images/wikibangla.png" alt="wikibangla"/>
					</a>
	<div class="text-center hidden-sm hidden-md hidden-lg">

			<div class="col-xs-offset-1 col-xs-6">
	<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" />

	</div>

	</div> 					
				</div>
			</div>
			
			
			
			<div class="col-md-5 col-sm-4 hidden-xs">
				<form action="<?php echo base_url(); ?>search" class="top-search col-md-offset-3" method="get">
					<div class="input-group">
						<input class="form-control" type="text" placeholder="Search..." name="q" value="<?php echo $_GET['q']; ?>" id="query1">
						<span class="input-group-addon">
							<button class="search-button" type="submit" name="search"><i class="fa fa-search " aria-hidden="true"></i></button> 
						</span>
					</div>
				</form>
			</div> 
			
			<div class="col-md-4 top-button pull-right hidden-xs"> 

				<div class="btn-group navbar-nav1 navbar-right">
				  	<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Subscribe</button>
				<?php
				$suri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";	
				?>
				<?php if($user){ ?>
					<button class="btn btn-primary dropdown-toggle my-account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> MyWiki <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url('my-profile'); ?>"><?php echo $this->lang->line('My Profile'); ?></a></li>
						<li><a href="<?php echo base_url('change-password'); ?>"><?php echo $this->lang->line('Change Password'); ?></a></li>
					</ul>
					<a class="btn btn-primary" role="button" href="<?php echo base_url(); ?>logout?redirect=<?php echo $suri; ?>"><?php echo $this->lang->line('Logout'); ?></a>
				<?php }else{ ?>
					<a role="button" class="btn btn-primary" href=" <?php echo base_url();?>signup"><?php echo $this->lang->line('Signup'); ?></a>
					<a role="button" class="btn btn-primary" href="<?php echo base_url(); ?>login?redirect=<?php echo $suri; ?>"><?php echo $this->lang->line('Login'); ?></a>
				<?php } ?>
				  	
				<?php 
				if(SITE_LANG == '1'){		
				?>
					<a role="button" class="btn btn-primary" href="<?php echo base_url() ?>langSwitch/switchLanguage/2?redirect=<?php //echo $suri; ?>">English</a>
				<?php }else{ ?>
					<a role="button" class="btn btn-primary" href="<?php echo base_url() ?>langSwitch/switchLanguage/1?redirect=<?php //echo $suri; ?>">বাংলা</a>	
				<?php } ?>
				
					
				</div>
			</div>
		</div>
	</div>
</nav>


</div>

<!-- Modal -->
</header>



<nav id="constantSideMenu" class="navbar navbar-default hidden-xs sidebar">
    <div class="navbar-header">
      <button class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
		<li class="text-center"><a href="<?php echo base_url(); ?>" data-toggle="tooltip" data-placement="right" title="Home!"><i class="fa fa-home fa-2x " aria-hidden="true"></i>
		</a></li>    
		<li>
		<a  data-toggle="tooltip" data-placement="right" title="Book!"> <i class="fa fa-book fa-2x" aria-hidden="true"></i> </a>
		</li> 
		<li>	
		<a class="text-center" href="#" data-toggle="tooltip" data-placement="right" title="Video!"> <i class="fa fa-caret-square-o-right fa-2x" aria-hidden="true"></i></a>
		</li> 
		<li>	
		<a class="text-center" href="#" data-toggle="tooltip" data-placement="right" title="wiki learn!"> <i class="fa fa-graduation-cap fa-2x" aria-hidden="true"></i></a>
		</li>
		<li>	
		<a class="text-center" href="#" data-toggle="tooltip" data-placement="right" title="Business!"> <i class="fa fa-briefcase fa-2x" aria-hidden="true"></i></a>
		</li>
      </ul>
    </div>

</nav>

<!-- /.navbar -->

<!-- Header -->
<div class="container-fluid">
 <div class="row">

 
	<div id="header-background" 
	<?php if($sub_cat_info->bg_image){ ?>
		style="background-image: url(<?php echo base_url('uploads/bg_image/'.$sub_cat_info->bg_image); ?>);"
	<?php }elseif($cat_info->bg_image){ ?>
		style="background-image: url(<?php echo base_url('uploads/bg_image/'.$cat_info->bg_image); ?>);"
	<?php } ?>>


	<div class="layer">
		
		<?php if($this->uri->segment(1)=='c'){ ?>
		<div class="container">
			<div class="row">
				<div class="masthead-meta text-center">
					<ul class="list-inline logo">
						<li><img class="img-responsive" src="<?php echo base_url(); ?>images/wikibangla.png" alt="wikibangla"></li>
						<li><h1 class="text-center"><?php echo $title; ?></h1></li>
					</ul>		
					
				</div>			
			</div>
		</div>
		<div class="container">	
			<div role="banner" class="navbar navbar-inverse">
				<div class="navbar-header">
			
			<button type="button" class="navbar-toggle collapsed main-menu-toggle" data-toggle="collapse" data-target="#navbar-collapse-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
				</div>
				
				<div class="">
					<nav role="navigation" class="collapse navbar-collapse" id="navbar-collapse-2">
						<ul class="nav navbar-nav">
							<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('Home'); ?></a></li>
							<?php  
							$sub_cats = $this->d_model->category($cat_info->id);
							foreach($sub_cats as $cat){
								$m_link = base_url('c/'.$cat_info->slug.':'.$cat->slug);
							?>
								<li>
									<a href="<?php echo $m_link; ?>"><?php echo $cat->category_name; ?></a>
								</li>
							<?php 
							}
							?>	
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<?php }else{ ?>
		<?php
		$LatestPostSlug = $this->d_model->LatestPostSlug();
		?>
		<div class="container">
			<div class="row">
				<div class="masthead-meta text-center">
					<ul class="list-inline logo">
						<li class=""><img src="<?php echo base_url(); ?>images/wikibangla.png" alt="wikibangla"></li>
						<li><h1>WIKI BANGLA</h1></li>
					</ul>		
					<ul class="masthead-menu">
						<li class="hidden-xs"><a href="<?php echo base_url(); ?>"> <?php echo date('l, M d, Y'); ?></a></li>
						<li class="todays-paper"><a href="<?php echo base_url('p/'.$LatestPostSlug); ?>"><?php echo $this->lang->line('Latest Post'); ?></a></li>
						<?php if(!$user){ ?>
						<li><a href="<?php echo base_url(); ?>login?redirect=<?php echo $suri; ?>"><?php echo $this->lang->line('Login'); ?></a></li>
						<?php } ?>
						<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Subscribe</a></li>
						<li class="video"><a href="<?php echo base_url('video'); ?>" ><i class="icon sprite-icon"></i><?php echo $this->lang->line('All Wiki Bangla Videos'); ?></a></li>
						<li class="archive"><a href="<?php echo base_url('archive'); ?>" ><i class="icon sprite-icon"></i><?php echo $this->lang->line('Archive'); ?></a></li>
					</ul>
				</div>			
			</div>
		</div>
		
		<?php if($this->uri->segment(1)!='search'){ ?>			
		<div class="container">	
			<div class="navbar navbar-inverse">
				<div class="navbar-header">
			
			<button type="button" class="navbar-toggle collapsed main-menu-toggle" data-toggle="collapse" data-target="#navbar-collapse-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
				</div>
			
				<div class="text-center">
					<nav class="collapse navbar-collapse col-xs-offset-1" id="navbar-collapse-2">
						<ul class="nav navbar-nav">
							<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('Home'); ?></a></li>
							<?php  
							$cats = $this->d_model->category('0');
							foreach($cats as $cat){
								$m_link = base_url('c/'.$cat->slug);
								$s_cats = $this->d_model->category($cat->id);
							?>
								<?php if($s_cats){ ?>
								
								<li class="dropdown">
					<a href="<?php echo $m_link; ?>
					"><?php echo $cat->category_name; ?> </a>
					<a class="dropdown-toggle home-drowpdown hidden-xs" data-toggle="dropdown" href=""><b  class="caret "></b></a>
										
									<ul class="dropdown-menu">
									<?php 
									foreach($s_cats as $s_cat){ 
										$s_link = base_url('c/'.$cat->slug.':'.$s_cat->slug);
									?>
										<li>
											<a class="dropdown-item" href="<?php echo $s_link; ?>"><?php echo $s_cat->category_name; ?></a>
										</li>
									<?php } ?>
									</ul>
								</li>
								<?php }else{ ?>
								<li>
									<a href="<?php echo $m_link; ?>"><?php echo $cat->category_name; ?></a>
								</li>
								<?php } ?>
							<?php 
							}
							?>	
							<li><a href="<?php echo base_url('about-us'); ?>"><?php echo $this->lang->line('About us'); ?></a></li>
							<li><a href="<?php echo base_url('contact-us'); ?>"><?php echo $this->lang->line('Contact us'); ?></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php } ?>


	
	
	
	
	
	<?php if($this->uri->segment(1)==''){ ?>
	<div class="container hidden-xs">
		<div class="row "> 
			<div  class="main-search clearfix col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
				<div class="col-md-12 "> 
				<div class="search-wrapper no-gutter ">
					<form action="<?php echo base_url('front/home_search'); ?>" method="get">

							<div class="col-sm-5">
							
								<div class="select"> 
									<select name="category_id" class="" onchange="loadSubCategory(this.value);" required="">
										<option value=""><?php echo $this->lang->line('All'); ?></option>
										<?php 
										$cats = $this->d_model->category('0');
										foreach($cats as $cat){
											if($cat->id==$_GET['category_id']){
												$selected = 'selected=""';
											}else{
												$selected = '';
											}
											echo '<option '.$selected.' value="'.$cat->id.'">'.$cat->category_name.'</option>';
										}
										?>
									</select>
								
								</div>														
							</div>												
							<div class="col-sm-5 text-center">
								<div class="select"> 
									<select name="subcategory_id" id="sub_category_id" class="">
										<option value=""><?php echo $this->lang->line('All'); ?></option>
										<?php 
										$cats = $this->d_model->category($_GET['category_id']);
										foreach($cats as $cat){
											if($cat->id==$_GET['category_id']){
												$selected = 'selected=""';
											}else{
												$selected = '';
											}
											echo '<option '.$selected.' value="'.$cat->id.'">'.$cat->category_name.'</option>';
										}
										?>									
									</select>
								</div>
							</div>
  

							<div class="col-sm-2">
								<button type="submit" class="ghost-button"><i class="fa fa-search"></i> Search</button>
							</div>
						

					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	
	</div>
	</div>
 </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		<form action="<?php echo base_url(); ?>front/subscribe" method="post">
			<div class="modal-header">
				<button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Subscribe</h4>
			</div>
			<div class="modal-body">
				<input type="email" name="email" placeholder="Enter your email" required="" class="form-control" />
			</div>
			<div class="modal-footer">
				<input type="submit" name="submit" class="btn btn-primary" value="Submit">
				<input type="hidden" name="url" value="<?php echo $suri; ?>" />
			</div>
		</form>
		</div>
	</div>
</div>