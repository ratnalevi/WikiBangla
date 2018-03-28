<div class="container my-bg">

	<div class="row"> 
		<div id="data-content" class="col-md-9 inner-page-content">
		<?php 
		$i = 1;
		foreach($rows as $j => $row){ 
			$post_link = base_url('p/'.$row->slug);
			$img = base_url('uploads/featured/300X230_'.$row->featured_image);
			$title = $row->post_title; 
			$description = $row->description; 
			$category_name = $row->category_name; 
		?>
			<?php if($i==1){ ?><div class="content-background row-flex row-flex-wrap"><?php } ?>
				<div class="col-md-3 col-sm-6 col-xs-6 group-item col">
				  <div class="panel panel-default flex-col">
					<div class="flex-content catagory">
						<a class="" href="<?php echo $post_link; ?>">
							<img class="img-responsive" src="<?php echo $img; ?>" alt="<?php echo $title; ?>">
						</a>
					</div>
				   <header class="flex-post-title clearfix"><h1><a href="<?php echo $post_link; ?>"><?php echo $title; ?></a></h1></header>
				   <div class="flex-post-article flex-grow">
				   <p><?php echo $this->d_lib->get_def_word($description,40); ?> <a href="<?php echo $post_link; ?>"><i><b>Continue...</b></i></a>
				   </p>
				   </div>
				   <footer>
					<ul class="list-inline">
						<li class="Pull-left"><a href="#"><i class="fa fa-user " aria-hidden="true"></i> By</a></li>
						<li class="text-center"> <i class="fa fa-list-alt" aria-hidden="true"> <?php echo $category_name; ?></i></li>
						<li class="text-center"> <i class="fa fa-bookmark-o" aria-hidden="true"></i></li>
						<li class="pull-right"> <a href="" data-toggle="dropdown"><i class="fa fa-share"></i> </a>
							<ul class="list-inline dropdown-menu pull-right">
								<li> <a class="js-twitter" href="https://twitter.com/share?url=<?php echo $post_link; ?>" data-original-title="Twitter"> <i class="fa fa-twitter"></i></a></li>
								<li><a class="js-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_link; ?>" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>					
								<li><a class="js-plus-google" data-original-title="Google+" href="https://plus.google.com/share?url=<?php echo $post_link; ?>"><i class="fa fa-google-plus"></i></a></li>
							</ul>	
						</li>
					</ul>
   
				   </footer>
				   </div>
				</div>
			<?php if($i==3 || $j==count($rows)-1){ ?></div><?php $i = 1; }else{ $i++; } ?>
			
				<?php if($j==2){ ?>

				<?php } ?>
			<?php
			}
			?>
			
			<div class="net-priv-menu-pation">
				<?php echo $pagination; ?>
			</div>
		</div>
			


		<div class="col-md-3 inner-page-content">
			<div class="row content-background clearfix"> 
			<header class="sidebar-head text-center"> <span> Heading</span> </header>
				<ul class="list-group bmd-list-group-sm">
					
					<li class="list-group-item ">
						<div class="bmd-list-group-col list-inline">
							<p class="list-group-item-heading"><strong> Most watched</strong></p>
							<?php  
							$sub_cats = $this->d_model->category($cat_info->id);
							foreach($sub_cats as $cat){
							?>
							<a href="<?php echo base_url('c/'.$cat_info->slug.':'.$cat->slug); ?>" class="list-group-item-text"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo $cat->category_name; ?></a>
							<?php } ?>
							
							<a href="#" class="list-group-item-text"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <b> view all</b></a>
						</div>	  
					</li>

				</ul>

				<aside> 
  <header class="sidebar-head text-center"> <span>  Archive </span> </header>

<div class="sidebar-content"> 
  <div class="panel panel-default-small sidebar-text">		
	<div class="sidebarPanelHeading">
		<div class="panel-title">
		<div class="archive-home clearfix">
		  <a data-toggle="collapse" href="#menu3PanelListGroup2">
 <b>Archive</b> <i class="fa fa-angle-down pull-right"></i> </a> 
		</div>                  
		</div>
	</div>
	
			
			
            <ul class="list-group collapse in toggle-panel" id="menu3PanelListGroup2">
           
                <li class="list-group-item archive-home">
				
                    	<a data-toggle="collapse" href="#month-list" > 2014 <i class="fa fa-angle-down pull-right"></i> </a>
						<ul class="list-group list-inline collapse toggle-panel" id="month-list">
						<li> <a class="" href="">JAN</a></li>
						<li> <a class="" href="">FEB</a></li>
						<li> <a class="" href="">MAR</a></li>
						<li> <a class="" href="">APR</a></li>
						<li> <a class="" href="">MAY</a></li>
						<li> <a class="" href="">JUN</a></li>
						<li> <a class="" href="">JUL</a></li>
						<li> <a class="" href="">AUG</a></li>
						<li> <a class="" href="">SEP</a></li>
						<li> <a class="" href="">OCT</a></li>
						<li> <a class="" href="">NOV</a></li>
						<li> <a class="" href="">DEC</a></li>
						</ul>
								  
                </li>
				
                <li class="list-group-item archive-home ">
                   <a data-toggle="collapse" href="#month-list2" > 2015 <i class="indicator fa fa-angle-down pull-right"></i> </a>
						<ul class="list-group list-inline collapse toggle-panel" id="month-list2">
						<li> <a class="" href="">JAN</a></li>
						<li> <a class="" href="">FEB</a></li>
						<li> <a class="" href="">MAR</a></li>
						<li> <a class="" href="">APR</a></li>
						<li> <a class="" href="">MAY</a></li>
						<li> <a class="" href="">JUN</a></li>
						<li> <a class="" href="">JUL</a></li>
						<li> <a class="" href="">AUG</a></li>
						<li> <a class="" href="">SEP</a></li>
						<li> <a class="" href="">OCT</a></li>
						<li> <a class="" href="">NOV</a></li>
						<li> <a class="" href="">DEC</a></li>
						</ul>
                </li>    
            </ul>
			
			
			
			
        
    </div>

 </div>
 
 </aside> 
				 

									 


<aside class="side-bar-wgt-up"> 

<div class="ads">
<img class="img-responsive" src="<?php echo base_url(); ?>ads/ads-1.gif" alt="">
</div>


	</aside>



<aside class=""> 
	<div class="panel panel-default"> 	           	
		<div class="sidebar-content"> 	
	 		<header class="sidebar-head text-center"> <span> Populer Catagory</span> </header>
						
			<div class="sidebar-text"> 
				<?php require_once'modules/popular_category.php'; ?>  
			</div>
		</div>
	</div>
</aside>

</div>

    </div>  

	
	
	
</div>	


	</div>