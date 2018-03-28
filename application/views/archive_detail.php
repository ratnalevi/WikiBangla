<?php 
$ci =& get_instance();
$ci->load->model('front_model');
?>
<style>
@media (min-width: 979px) {
  #sidebar.affix-top {
    position: static;
  } 
  #sidebar.affix-bottom {
    position: relative;
  }
  #sidebar.affix {
    position: fixed;
    top:40px;
    width:170px;
  }
}
</style>
<div class="containr-fluid">
    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="col-md-2">
	  			<!---<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="-1" data-offset-bottom="550">--->
	  			<ul class="nav nav-pills nav-stacked" id="sidebar_affix">
	                <h2><?php echo $this->d_model->total_posts('total'); ?> Items</h2>

	                <div class="panel panel-info">
	                    <div class="panel-heading">
	                        <h4>Year</h4>
	                    </div>
	                    <div class="panel-body">
	                        <form>
							<?php
							$start = date('Y');
							$end = date("Y",strtotime("-4 year"));
							$years = $this->d_lib->range($start,$end);
							for($i=0; $i<count($years); $i++){
								$year = $years[$i];
								$year_total_items = $this->d_model->total_posts('year',$year);
								
								$get1 = '';
								foreach($_GET as $key => $value)
								{
									if($key!='year'){
										$get1 .= $key.'='.$value.'&';
									}
								}
								
								$link = base_url('archive/detail?'.$get1.'year='.$year);
							?>
	                            <div class="checkbox">
	                                <label><input <?php if($_GET['year']==$year){ echo 'checked=""'; } ?> onclick="archiveUrl('<?php echo $link; ?>');" type="checkbox" value=""><?php echo $year; ?></label>
	                                <label for="" class="pull-right"> <?php echo $year_total_items; ?> </label>
	                            </div>
	                        <?php } ?>
	                            <!-- Trigger the modal with a button -->
	                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">More</button>

	                            <!-- Modal -->
	                            <div class="modal fade" id="myModal2" role="dialog">
	                                <div class="modal-dialog modal-lg">
	                                    <div class="modal-content">
	                                        <div class="modal-header">
	                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                            <h4 class="modal-title">Years</h4>
	                                        </div>
	                                        <div class="modal-body">
	                                            <p>
	                                            <?php
												$start = date('Y');
												$end = 2016;
												$years = $this->d_lib->range($start,$end);
												for($i=0; $i<count($years); $i++){
													$year = $years[$i];
													$year_total_items = $this->d_model->total_posts('year',$year);
													$get1 = '';
													foreach($_GET as $key => $value)
													{
														if($key!='year'){
															$get1 .= $key.'='.$value.'&';
														}
													}
													
													$link = base_url('archive/detail?'.$get1.'year='.$year);
												?>
	                                                <div class="checkbox">
	                                                    <label><input <?php if($_GET['year']==$year){ echo 'checked=""'; } ?> onclick="archiveUrl('<?php echo $link; ?>');" type="checkbox" value=""><?php echo $year; ?></label>
	                                                    <label for="" class="pull-right"> <?php echo $year_total_items; ?> </label>
	                                                </div>
	                                            <?php } ?>
	                                            </p>
	                                        </div>
	                                        <div class="modal-footer">
	                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </form>


	                    </div>
	                </div>
	                <div class="panel panel-info">
	                    <div class="panel-heading">
	                        <h4>Category</h4>
	                    </div>
	                    <div class="panel-body">
	                        <form>
	                        <?php 
							$cats = $this->front_model->archive_category(5)->result(); 
							foreach($cats as $cat){
								if($cat->parent_id=='0'){
									$cat_id = $cat->id;
									$sub_cat_id = '';
								}else{
									$cat_id = $cat->parent_id;
									$sub_cat_id = $cat->id;
								}
								$cat_items = $this->d_model->total_posts('category',$cat_id,$sub_cat_id);
								
								$get1 = '';
								foreach($_GET as $key => $value)
								{
									if($key!='cid' && $key!='scid'){
										$get1 .= $key.'='.$value.'&';
									}
								}
								$link = base_url('archive/detail?'.$get1.'cid='.$cat_id.'&scid='.$sub_cat_id);
							?>
	                            <div class="checkbox">
	                                <label><input <?php if($_GET['cid']==$cat->id || $_GET['scid']==$cat->id){ echo 'checked=""'; } ?> onclick="archiveUrl('<?php echo $link; ?>');" type="checkbox" value=""><?php echo $cat->cat_name; ?></label>
	                                <label for="" class="pull-right"> <?php echo $cat_items; ?> </label>
	                            </div>
	                        <?php } ?>
	                            <!-- Trigger the modal with a button -->
	                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3">More</button>

	                            <!-- Modal -->
	                            <div class="modal fade" id="myModal3" role="dialog">
	                                <div class="modal-dialog modal-lg">
	                                    <div class="modal-content">
	                                        <div class="modal-header">
	                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                            <h4 class="modal-title">Category</h4>
	                                        </div>
	                                        <div class="modal-body">
	                                            <p>
	                                            <?php 
												$cats = $this->front_model->archive_category()->result(); 
												foreach($cats as $cat){
													if($cat->parent_id=='0'){
														$cat_id = $cat->id;
														$sub_cat_id = '';
													}else{
														$cat_id = $cat->parent_id;
														$sub_cat_id = $cat->id;
													}
													$cat_items = $this->d_model->total_posts('category',$cat_id,$sub_cat_id);
													$get1 = '';
													foreach($_GET as $key => $value)
													{
														if($key!='cid' && $key!='scid'){
															$get1 .= $key.'='.$value.'&';
														}
													}
													$link = base_url('archive/detail?'.$get1.'cid='.$cat_id.'&scid='.$sub_cat_id);
												?>
	                                                <div class="checkbox">
	                                                    <label><input <?php if($_GET['cid']==$cat->id || $_GET['scid']==$cat->id){ echo 'checked=""'; } ?> onclick="archiveUrl('<?php echo $link; ?>');" type="checkbox" value=""><?php echo $cat->cat_name; ?></label>
	                                                    <label for="" class="pull-right"> <?php echo $cat_items; ?> </label>
	                                                </div>
	                                            <?php } ?>
	                                            </p>
	                                        </div>
	                                        <div class="modal-footer">
	                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </form>
	                    </div>
	                </div>
					
	                <div class="panel panel-info">
	                    <div class="panel-heading">
	                        <h4>Date Range</h4>
	                    </div>
	                    <div class="panel-body">
	                        <form method="get" action="">
	                            <div class="input">
	                                <label><input type="text" class="form-control date" name="start_date" value="<?php echo $_GET['start_date']; ?>" placeholder="Start Date" required=""></label>
	                            </div>
	                            <div class="input">
	                                <label><input type="text" class="form-control date" name="end_date" value="<?php echo $_GET['end_date']; ?>" placeholder="End Date" required=""></label>
	                            </div>
	                            <input type="hidden" name="cid" value="<?php echo $_GET['cid']; ?>"/>
	                            <input type="hidden" name="scid" value="<?php echo $_GET['scid']; ?>"/>
	                            <input type="hidden" name="year" value="<?php echo $_GET['year']; ?>"/>
	                            <button type="submit" class="btn btn-info">Search</button>
	                        </form>
	                    </div>
	                </div>
  				</ul>
            </div>


            <div id="data-content" class="col-md-9 inner-page-content">
                <div class="well well-sm">
                    <small>Sort By</small>
                    <div class="sortby">
                        <a href="">VIEW</a>
                        <a href="">DATE</a>
                        <a href="">LIKE</a>
                        <a href="">COMMENT</a>
                    </div>
                </div>

                <div id="products" class="row list-group">
                <?php
                foreach($rows as $row){
                	$img = base_url('uploads/featured/300X230_'.$row->featured_image);
                	$post_link = base_url('p/'.$row->slug);
                	if($row->subcat_name){
						$cat_link = base_url('c/'.$row->c_slug.':'.$row->sc_slug);
						$cat_name = $row->subcat_name;
					}else{
						$cat_link = base_url('c/'.$row->c_slug);
						$cat_name = $row->cat_name;
					}
                	
                ?>
                    <div class="item col-md-3">
                        <div class="thumbnail">
                            <a href="<?php echo $post_link; ?>"><img class="group list-group-image" src="<?php echo $img; ?>" alt="" /></a>
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading">
                                    <?php echo $row->post_title; ?></h4>
                                <small>By&ensp;&ensp; <strong><?php echo $row->fullname; ?></strong></small>
                                <hr/>
                                <div class="text-center">
                                    <ul class="list-inline">
                                        <li class=""> <a href="<?php echo $cat_link; ?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
                                            <p><a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a></p>
                                        </li>
                                        <li class=""><a href=""><i class="fa fa-star" aria-hidden="true"></i></a>
                                            <p><a href=""><?php echo $row->total_like; ?></a></p>
                                        </li>
                                        <li class=""><a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <p><a href=""><?php echo $row->total_view; ?></a></p>
                                        </li>
                                        <li class=""><a href=""><i class="fa fa-comments-o" aria-hidden="true"></i></a>
                                            <p><a href=""><?php echo $row->total_comment; ?></a></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php } ?>
				<div class="net-priv-menu-pation">
					<?php echo $pagination; ?>
				</div>
                </div>
            </div>
        </div>

        <header class="clearfix ad-widget-title text-center">
            <img class="" src="https://dummyimage.com/728x90/0fbfc2/fff.jpg&text=AD" alt="" />
        </header>
    </div>
</div>