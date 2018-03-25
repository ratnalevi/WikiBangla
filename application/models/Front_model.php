<?php 
class Front_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		
		
	}
	
	public function featured_post($limit,$offset,$type=''){	
	 	$this->db->select('posts.id,posts.slug,posts.category_id,post_title,description,featured_image,category.category_name,category.slug as c_slug');
    	
    	$this->db->join('category','category.id=posts.category_id');
    	
    	$this->db->where('posts.language_id',SITE_LANG);
    	$this->db->where('posts.status','Publish');
    	
    	if($type=='featured'){
			$this->db->where('posts.featured','Yes');
		}elseif($type=='history'){
			$this->db->where('posts.history','Yes');
		}elseif($type=='do_you_know'){
			$this->db->where('posts.do_you_know','Yes');
		}		
		
		$this->db->order_by('posts.id','desc');
    	$this->db->limit($limit,$offset);
		return $this->db->get('posts');  
	}
	
	public function top_weekly_post($limit,$offset,$type=''){
		$this->db->select('posts.id,posts.slug,posts.category_id,post_title,description,featured_image,category.category_name,category.slug as c_slug,COUNT(posts_view.id) as total');
		
    	$this->db->join('posts','posts.id=posts_view.post_id');
    	$this->db->join('category','category.id=posts.category_id');
    	
    	$this->db->where('posts.language_id',SITE_LANG);
    	$this->db->where('posts.status','Publish');
    	
    	if($type=='top_weekly'){
			$friday = date( 'Y-m-d', strtotime( 'friday this week' ) );
			$saturday = date( 'Y-m-d', strtotime('-6 day', strtotime($friday)));
			
			$this->db->where('posts_view.date >= ', $saturday);
			$this->db->where('posts_view.date <= ', $friday);
		}    			
		
		$this->db->order_by('total','desc');
		$this->db->group_by('posts_view.post_id');
    	$this->db->limit($limit,$offset);
		return $this->db->get('posts_view');  
	}
	
	public function home_video($limit,$offset){	
    	$this->db->select('id,video_link,title,des,filename,fullname');
    	
    	$this->db->join('users','users.uid=videos.created_by','left');
    	
    	$this->db->where('videos.language_id',SITE_LANG);
    	$this->db->where('videos.status','publish');  		
		
		$this->db->order_by('videos.id','desc');
    	$this->db->limit($limit,$offset);
		return $this->db->get('videos');  
	}
	public function video_category(){	
    	$this->db->select('videos_category.*');
    	
    	$this->db->where('videos_category.language_id',SITE_LANG);
    	$this->db->where('videos_category.status','publish');  		
		
		$this->db->order_by('videos_category.id','desc');
		return $this->db->get('videos_category');  
	}
	
	public function count_video_comment($video_id){	
    	$this->db->select('COUNT(id) as total');
    	$this->db->where('video_id',$video_id); 
		return $this->db->get('videos_comment')->row()->total;  
	}
	
	
	public function post_list($cat_id,$sub_cat_id,$get,$sort_by,$order_by,$offset,$limit){	
		$this->db->select('posts.id,posts.slug,posts.created,posts.category_id,post_title,description,featured_image,c.category_name,c.slug as c_slug');
		
    	$this->db->join('category c','c.id=posts.category_id');  	
    	$this->db->join('category s','s.id=posts.sub_category_id','left');
    	
    	$this->db->where('posts.language_id',SITE_LANG);
    	$this->db->where('posts.status','Publish');
 	
 		if($cat_id){
			$this->db->where('c.slug',$cat_id);
		}
		if($sub_cat_id){
			$this->db->where('s.slug',$sub_cat_id);
		}
		
		if($get['title']){
			$this->db->where('posts.post_title LIKE "%'.$get['title'].'%"');
		}		
		
    	$this->db->order_by('posts.'.$sort_by,$order_by);
    	$this->db->limit($limit,$offset);
		return $this->db->get('posts');  
	}
	
	public function post_list_all($cat_id,$sub_cat_id,$get){
    	$this->db->select('COUNT(posts.id) as total');
    	
    	$this->db->join('category c','c.id=posts.category_id');
    	$this->db->join('category s','s.id=posts.sub_category_id','left');
    	
    	$this->db->where('posts.language_id',SITE_LANG);
    	$this->db->where('posts.status','Publish');
    	if($cat_id){
			$this->db->where('c.slug',$cat_id);
		}
		if($sub_cat_id){
			$this->db->where('s.slug',$sub_cat_id);
		}		
		
		return $this->db->get('posts')->row()->total;  
	}
	
	public function post_slider($post_id){	
    	$this->db->select('posts_parts_sections.image,posts_parts.part_title');
    	$this->db->join('posts_parts','posts_parts.id=posts_parts_sections.post_part_id');
    	
		$this->db->where('posts_parts_sections.post_id',$post_id);
		
    	$this->db->group_by('posts_parts_sections.post_part_id');	
    	//$this->db->order_by('posts_parts_sections.id','asc');	
		return $this->db->get('posts_parts_sections');
	}
	
	public function post_part_sections($part_id){	
    	$this->db->select('posts_parts_sections.image,posts_parts_sections.section_description');
		$this->db->where('posts_parts_sections.post_part_id',$part_id);
		return $this->db->get('posts_parts_sections');
	}
	
	public function post_related($category_id,$post_id){	
		$this->db->select('posts.id,posts.slug,post_title,featured_image');
    	
    	$this->db->where('posts.status','Publish');
 		$this->db->where('posts.category_id',$category_id);
 		$this->db->where('posts.id != ',$post_id);
 					
    	$this->db->order_by('posts.id','desc');
    	$this->db->limit(8);
		return $this->db->get('posts');  
	}
	
	public function search_list($get,$sort_by,$order_by,$offset,$limit){
		$this->db->select('posts.id,posts.slug,posts.created,posts.category_id,post_title,description,featured_image,category.category_name,category.slug as c_slug,COUNT(posts_view.id) as total_view,COUNT(posts_like.id) as total_like,COUNT(posts_comment.id) as total_comment');	
    	
    	$this->db->join('category','category.id=posts.category_id');
    	$this->db->join('posts_tags','posts_tags.post_id=posts.id','left');
    	$this->db->join('tags','tags.id=posts_tags.tag_id','left');
    	
    	$this->db->join('posts_view','posts_view.post_id=posts.id','left');
    	$this->db->join('posts_like','posts_like.post_id=posts.id','left');
    	$this->db->join('posts_comment','posts_comment.post_id=posts.id','left');
    	
    	$this->db->where('posts.language_id',SITE_LANG);
    	$this->db->where('posts.status','Publish');
		
		if($get['q']){
			$q = $get['q'];
			$this->db->where(' (posts.post_title LIKE "%'.$q.'%" OR tags.tag_name LIKE "%'.$q.'%") ');
			
			//$this->db->where('posts.title_en LIKE "%'.$get['title'].'%"');
			//$this->db->or_where('posts.title_bn LIKE "%'.$get['title'].'%"');
		}		
		
		//$this->db->group_by('posts.id');
		$this->db->group_by('posts_view.post_id');
		$this->db->group_by('posts_like.post_id');
		$this->db->group_by('posts_comment.post_id');
		
		if($sort_by=='new'){
			$this->db->order_by('posts.id','desc');
		}elseif($sort_by=='old'){
			$this->db->order_by('posts.id','asc');
		}elseif($sort_by=='view'){
			$this->db->order_by('total_view','desc');
		}elseif($sort_by=='like'){
			$this->db->order_by('total_like','desc');
		}elseif($sort_by=='comment'){
			$this->db->order_by('total_comment','desc');
		}else{
			$this->db->order_by('posts.'.$sort_by,$order_by);
		}
    	
    	$this->db->limit($limit,$offset);
		return $this->db->get('posts');  
	}
	
	public function search_list_all($get){
    	$this->db->select('COUNT(posts.id) as total');	
		
		$this->db->join('posts_tags','posts_tags.post_id=posts.id','left');
    	$this->db->join('tags','tags.id=posts_tags.tag_id','left');
    	
    	$this->db->where('posts.language_id',SITE_LANG);
		$this->db->where('posts.status','Publish');
		
		if($get['q']){
			$q = $get['q'];
			$this->db->where(' (posts.post_title LIKE "%'.$q.'%" OR tags.tag_name LIKE "%'.$q.'%") ');
			
			//$this->db->where('posts.title_en LIKE "%'.$get['title'].'%"');
			//$this->db->or_where('posts.title_bn LIKE "%'.$get['title'].'%"');
		}
		
		//$this->db->group_by('posts.id');
		return $this->db->get('posts')->row()->total;  
	}
	
	public function archive_category($limit=''){
		$this->db->select('category.id,category.parent_id,category.category_name as cat_name');	
    	
    	$this->db->where('category.language_id',SITE_LANG);
    	$this->db->where('category.status','publish');
    	if($limit){
			$this->db->limit($limit);
		}
		return $this->db->get('category');  
	}
	
	public function archive_detail($get,$sort_by,$order_by,$offset,$limit){		
		$this->db->select('posts.id,posts.slug,posts.created,post_title,description,featured_image,cat.category_name as cat_name,subcat.category_name as subcat_name,cat.slug as c_slug,subcat.slug as sc_slug,COUNT(posts_view.id) as total_view,COUNT(posts_like.id) as total_like,COUNT(posts_comment.id) as total_comment,users.fullname');	
    	
    	$this->db->join('users','users.uid=posts.created_by');
    	$this->db->join('category cat','cat.id=posts.category_id');
    	$this->db->join('category subcat','subcat.id=posts.sub_category_id','left');
    	
    	$this->db->join('posts_view','posts_view.post_id=posts.id','left');
    	$this->db->join('posts_like','posts_like.post_id=posts.id','left');
    	$this->db->join('posts_comment','posts_comment.post_id=posts.id','left');
    	
    	$this->db->where('posts.language_id',SITE_LANG);	
    	$this->db->where('posts.status','Publish');	
    	
    	if($get['cid']){
			$this->db->where('posts.category_id',$get['cid']);	
		}
		if($get['scid']){
			$this->db->where('posts.sub_category_id',$get['scid']);	
		}
		if($get['year']){
			$this->db->where('posts.created LIKE "%'.$get['year'].'%"');
		}	
		if($get['start_date']){
			$this->db->where('posts.created >= ', $this->d_lib->insert_date($get['start_date']));
		}
		if($get['end_date']){
			$this->db->where('posts.created <= ', $this->d_lib->insert_date($get['end_date']));
		}
		
		//$this->db->group_by('posts.id');
		$this->db->group_by('posts_view.post_id');
		$this->db->group_by('posts_like.post_id');
		$this->db->group_by('posts_comment.post_id');
		
		if($sort_by=='new'){
			$this->db->order_by('posts.id','desc');
		}elseif($sort_by=='old'){
			$this->db->order_by('posts.id','asc');
		}elseif($sort_by=='view'){
			$this->db->order_by('total_view','desc');
		}elseif($sort_by=='like'){
			$this->db->order_by('total_like','desc');
		}elseif($sort_by=='comment'){
			$this->db->order_by('total_comment','desc');
		}else{
			$this->db->order_by('posts.'.$sort_by,$order_by);
		}
    	
    	$this->db->limit($limit,$offset);
		return $this->db->get('posts');  
	}	
	public function archive_detail_all($get){
    	$this->db->select('COUNT(posts.id) as total');	
    	
    	$this->db->where('posts.language_id',SITE_LANG);	
		$this->db->where('posts.status','Publish');	
    	
    	if($get['cid']){
			$this->db->where('posts.category_id',$get['cid']);	
		}
		if($get['scid']){
			$this->db->where('posts.sub_category_id',$get['scid']);	
		}
		if($get['year']){
			$this->db->where('posts.created LIKE "%'.$get['year'].'%"');
		}	
		if($get['start_date']){
			$this->db->where('posts.created >= ', $this->d_lib->insert_date($get['start_date']));
		}
		if($get['end_date']){
			$this->db->where('posts.created <= ', $this->d_lib->insert_date($get['end_date']));
		}
		
		//$this->db->group_by('posts.id');
		return $this->db->get('posts')->row()->total;  
	}
	
	
	
	
	
	
	
	
	
	
	public function post_comments($post_id){	
    	$this->db->select('posts_comment.*,users.fullname');
    	$this->db->join('users','users.uid=posts_comment.created_by');
    	
		$this->db->where('posts_comment.status','publish');	
		$this->db->where('posts_comment.post_id',$post_id);
		
    	$this->db->order_by('posts_comment.id','asc');	
		return $this->db->get('posts_comment');
	}	
	
	public function login($email,$password) {
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
		//$this->db->where('rid','2');	
		$this->db->where('status','1');		
        return $this->db->get('users')->row();      
    }
    
    public function video($category_id,$get,$sort_by,$order_by,$offset,$limit){	
    	$this->db->select('videos.*,users.fullname');
    	
    	$this->db->join('users','users.uid=videos.created_by');
    	
    	if($category_id!='recent'){
			$this->db->where('videos.category_id',$category_id);	
		}
		$this->db->where('videos.status','publish');	
		
    	$this->db->order_by('videos.'.$sort_by,$order_by);
    	$this->db->limit($limit,$offset);  	
		return $this->db->get('videos');  
		//echo $this->db->last_query();exit;
	}
	
	public function video_all($category_id,$get){	
    	$this->db->select('videos.id');
    	
    	if($category_id!='recent'){
			$this->db->where('videos.category_id',$category_id);	
		}
		$this->db->where('videos.status','publish');	
		 	
		return count($this->db->get('videos')->result());  
	}
	
	public function video_single($id){	
    	$this->db->select('videos.*,videos_category.category_en,videos_category.category_bn');
    	$this->db->join('videos_category','videos_category.id=videos.category_id');
   
		$this->db->where('videos.id',$id);	  	
		return $this->db->get('videos');  
		//echo $this->db->last_query();exit;
	}
	
	public function up_next($category_id,$id){	
    	return $this->db->query("SELECT `videos`.*, `users`.`fullname` 
    						FROM `videos` 
    						JOIN `users` ON `users`.`uid`=`videos`.`created_by` 
    						WHERE `videos`.`category_id` = '$category_id' 
    						AND `videos`.`id` > '$id'
    						AND `videos`.`status` = 'publish' 
    						ORDER BY id ASC 
    						LIMIT 10");  
		//echo $this->db->last_query();exit;
	}
	
	public function video_comments($video_id){	
    	$this->db->select('videos_comment.*,users.fullname');
    	$this->db->join('users','users.uid=videos_comment.created_by');
    	
		$this->db->where('videos_comment.status','publish');	
		$this->db->where('videos_comment.video_id',$video_id);
		
    	$this->db->order_by('videos_comment.id','asc');	
		return $this->db->get('videos_comment');
	}
	
	
	
	
}