
<link rel="stylesheet" href="<?php echo base_url(); ?>css/vedio.css" media="screen" >

<div class="row">	
		
		<div class="show-top-grids">
			<div class="col-sm-8 single-left">
				<div class="song">
					<div class="song-info">
						<h3><?php echo $title; ?></h3>	
					</div>
					<div class="video-grid">
						<?php echo $row->video_link; ?>
					</div>
				</div>
				<div class="song-grid-right">
					<div class="share">
						<h5>Share this</h5>
						<ul>
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" class="icon fb-icon" target="_blank">Facebook</a></li>
							<li><a href="#" class="icon dribbble-icon">Dribbble</a></li>
							<li><a href="https://twitter.com/share?url=<?php echo $url; ?>" class="icon twitter-icon" target="">Twitter</a></li>
							<li><a href="#" class="icon pinterest-icon">Pinterest</a></li>
							<li><a href="#" class="icon whatsapp-icon">Whatsapp</a></li>
							<li><a href="#" class="icon like">Like</a></li>
							<li><a href="#all-comments" class="icon comment-icon">Comments</a></li>
							<li class="view"><?php echo $this->d_lib->number_format($row->total_view); ?> Views</li>
						</ul>
					</div>
				</div>
				<div class="clearfix"> </div>
				<div class="published">
					<div class="load_more">	
						<ul id="myList">
							<li>
								<h4>Published on <?php echo date('d F Y',strtotime($row->created)); ?></h4>
								<?php if($this->session->userdata('bangla')=='bangla'){ echo $row->des_bn; }else{ echo $row->des_en; } ?>
							</li>
							<li>
								<div class="load-grids">
									<div class="load-grid">
										<p><?php echo $this->lang->line('Category'); ?></p>
									</div>
									<div class="load-grid">
										<a href="<?php echo base_url('video/category/'.$row->category_id); ?>"><?php if($this->session->userdata('bangla')=='bangla'){ echo $row->category_bn; }else{ echo $row->category_en; } ?></a>
									</div>
									<div class="clearfix"> </div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="all-comments" id="all-comments">
					<div class="all-comments-info">
						<a href="#"><?php echo $this->lang->line('All Comments'); ?> (<?php echo $this->d_lib->number_format(count($comments)); ?>)</a>
						<div class="box">
							<div class="error">
								
							</div>
							<div>
							<?php if($this->session->userdata('fuser')){ ?>
								<textarea id="text-comment" placeholder="<?php echo $this->lang->line('Comment'); ?>"></textarea>
								<input id="submit-comment" type="submit" value="<?php echo $this->lang->line('SEND'); ?>">
								<input id="video-id" type="hidden" value="<?php echo $row->id; ?>">
							<?php }else{ ?>
								<?php echo $this->lang->line('Please login first'); ?> > 
								<a href="<?php echo base_url("front/login?url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" style="color: #21deef;"><?php echo $this->lang->line('Login'); ?></a>
							<?php } ?>
								<div class="clearfix"> </div>
							</div>
						</div>
						<!---<div class="all-comments-buttons">
							<ul>
								<li><a href="#" class="top">Top Comments</a></li>
								<li><a href="#" class="top newest">Newest First</a></li>
								<li><a href="#" class="top my-comment">My Comments</a></li>
							</ul>
						</div>-->
					</div>
					<div class="media-grids">
					<?php foreach($comments as $comment){ ?>
						<div class="media">
							<h5><?php echo $comment->fullname; ?></h5>
							<div class="media-body">
								<p><?php echo $comment->comment; ?></p>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-md-4 single-right">
				<h3><?php echo $this->lang->line('Up Next'); ?></h3>
				<div class="single-grid-right">
					<?php foreach($up_next as $row){ ?>
					<div class="single-right-grids">
						<div class="col-md-4 single-right-grid-left">
							<a href="<?php echo base_url('video/single/'.$row->id); ?>"><img src="<?php echo base_url().UPLOAD_VIDEO_IMG.'/320X180_'.$row->filename; ?>" alt=""></a>
						</div>
						<div class="col-md-8 single-right-grid-right">
							<a href="<?php echo base_url('video/single/'.$row->id); ?>" class="title"><?php if($this->session->userdata('bangla')=='bangla'){ echo $this->d_lib->get_def_word($row->title_bn,3); }else{ echo $this->d_lib->get_def_word($row->title_en,3); } ?></a>
							<p class="author"><a href="#" class="author"><?php echo $row->fullname; ?></a></p>
							<p class="views"><?php echo $this->d_lib->number_format($row->total_view); ?> <?php echo $this->lang->line('views'); ?></p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<?php } ?>
				</div>
			</div>
			
			<div class="clearfix"> </div>
		</div>
			
</div>

<script>
	$(function() {
		$('#submit-comment').click(function() {
			comment = $('#text-comment').val();
			video_id = $('#video-id').val();

			if(comment==''){
				$('.error').empty();
				$('.error').append('<p style="color:red;"><?php echo $this->lang->line("Comment box empty."); ?></p>');
				
				$('#text-comment').css('border','1px solid red');
			}else{
				
				jQuery.ajax({
					url: "<?php echo base_url(); ?>" + 'video/add_comment?video_id='+ video_id + '&comment=' + comment,
					type: 'GET',
					success: function(data) 
					{	
						$('.error').empty();
						$('.error').append('<p style="color:blue;"><?php echo $this->lang->line("Comment has been added successfully."); ?></p>');
						
						$('#text-comment').css('border','1px solid #d4d3d3');
						$('#text-comment').val('');		
						
						$('.media-grids	').append(data);			
					},
				});
				
			}
		});
	});
</script>
