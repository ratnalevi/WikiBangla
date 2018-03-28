<div class="container my-bg">
	<div class="row"> 
		<h2 class="text-center">Top Collections at the Archive</h2>

		<div id="data-content" class="col-sm-9 inner-page-content clearfix">
			<div class="no-gutter"> 
			<?php 
			foreach($rows as $row){
				if($row->parent_id=='0'){
					$cat_id = $row->id;
					$sub_cat_id = '';
				}else{
					$cat_id = $row->parent_id;
					$sub_cat_id = $row->id;
				}
				
				$link = base_url('archive/detail?cid='.$cat_id.'&scid='.$sub_cat_id);
				$total_items = $this->d_model->total_posts('category',$cat_id,$sub_cat_id);
			?>
				<div class="col-sm-4">
				  <div class="card">
					<div class="">
						<a href="<?php echo $link; ?>">
							<img class="img-responsive" src="<?php echo base_url('images/arch.png'); ?>">
						</a>
					</div>
				   	<div class="text-center"><a href="<?php echo $link; ?>"><h4><?php echo $row->cat_name; ?></h4></a>
				   		<p>Internet Archive is a non-profit library of millions of free books </p>
				   
				   		<hr />
				   		<span class="Pull-left"> <i class="fa fa-list-alt" aria-hidden="true"></i></span>
					
						<span class="text-center"> <?php echo $total_items; ?> items</span>		   
				   	</div>
				   </div>
				</div>	
			<?php } ?>	
				
				
				<div class="text-center">
					<img src="http://www.thinkingtech.in/wp-content/uploads/2017/08/Conti-728x90-banner-ad-REV.gif" alt="" />
				</div>	

			</div>	
		</div>

		
		<div class="col-sm-3 inner-page-content"> 
			<div class="row"> 
				<div class="row content-background"> 

					<div class="panel panel-default"> 	           	
						<div class="sidebar-content"> 	
							<header class="sidebar-head text-center"> <span> Populer Catagory</span> </header>						
							<div class="sidebar-text"> 
								<?php require_once'modules/popular_category.php'; ?>  
							</div>	
						</div>
					</div>

					<aside class="side-bar-wgt-up" id="leftCol"> 
						<div class="" id="sidebar">
							<img class="img-responsive" src="https://wpquads.com/wp-content/uploads/2016/10/Half-page-300x600.png">
						</div>
					</aside>

		    	</div>  

			</div>
		</div>	
	</div>

</div>