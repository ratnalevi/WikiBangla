<?php 
class Admin_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function post_list($get,$sort_by,$order_by,$offset,$limit){	
    	$this->db->select('posts.id,posts.post_title,posts.status,posts.featured,mcat.category_name as maincat,scat.category_name as subcat,users.fullname,site_language.language');
    	
    	$this->db->join('site_language','site_language.id=posts.language_id');
    	$this->db->join('category mcat','mcat.id=posts.category_id');
    	$this->db->join('category scat','scat.id=posts.sub_category_id','left');    	
    	$this->db->join('users','users.uid=posts.created_by','left');
 
 		if($get['language_id']){
			$this->db->where('posts.language_id',$get['language_id']);
		}
		if($get['category_id']){
			$this->db->where('posts.category_id',$get['category_id']);
		}
		if($get['sub_category_id']){
			$this->db->where('posts.sub_category_id',$get['sub_category_id']);
		}
		
		if($get['post_title']){
			$this->db->where('posts.post_title LIKE "%'.$get['post_title'].'%"');
		}		
		
    	$this->db->order_by('posts.'.$sort_by,$order_by);
    	$this->db->limit($limit,$offset);
		return $this->db->get('posts');  
	}
	
	public function post_list_all($get){
    	$this->db->select('COUNT(posts.id) as total');
    	
    	if($get['language_id']){
			$this->db->where('posts.language_id',$get['language_id']);
		}
		if($get['category_id']){
			$this->db->where('posts.category_id',$get['category_id']);
		}
		if($get['sub_category_id']){
			$this->db->where('posts.sub_category_id',$get['sub_category_id']);
		}
		
		if($get['post_title']){
			$this->db->where('posts.post_title LIKE "%'.$get['post_title'].'%"');
		}	
		
		return $this->db->get('posts')->row()->total;  
	}
	
	public function post_comment_list($get,$sort_by,$order_by,$offset,$limit){	
    	$this->db->select('posts_comment.*,posts.post_title,users.fullname');
    	
    	$this->db->join('posts','posts.id=posts_comment.post_id');
    	$this->db->join('users','users.uid=posts_comment.created_by');
 
		if($get['comment']){
			$this->db->where('posts_comment.comment LIKE "%'.$get['comment'].'%"');
		}		
		
    	$this->db->order_by('posts_comment.'.$sort_by,$order_by);
    	$this->db->limit($limit,$offset);  	
		return $this->db->get('posts_comment');  
		//echo $this->db->last_query();exit;
	}
	
	public function post_comment_list_all($get){
    	$this->db->select('COUNT(posts_comment.id) as total');
		
		if($get['comment']){
			$this->db->where('posts_comment.comment LIKE "%'.$get['comment'].'%"');
		}	
		
		return $this->db->get('posts_comment')->row()->total;  
	}
	
	
	public function video_list($get,$sort_by,$order_by,$offset,$limit){	
    	$this->db->select('videos.*,videos_category.category_name,users.fullname,site_language.language');
    	
    	$this->db->join('site_language','site_language.id=videos.language_id');
    	$this->db->join('videos_category','videos_category.id=videos.category_id');
    	$this->db->join('users','users.uid=videos.created_by');
 
 		if($get['language_id']){
			$this->db->where('videos.language_id',$get['language_id']);
		}
		if($get['category_id']){
			$this->db->where('videos.category_id',$get['category_id']);
		}
		
		if($get['title']){
			$this->db->where('( videos.title_bn LIKE "%'.$get['title'].'%" OR videos.title_en LIKE "%'.$get['title'].'%" )');
		}		
		
    	$this->db->order_by('videos.'.$sort_by,$order_by);
    	$this->db->limit($limit,$offset);  	
		return $this->db->get('videos');  
		//echo $this->db->last_query();exit;
	}
	
	public function video_list_all($get){
    	$this->db->select('COUNT(videos.id) as total');
    	
    	if($get['language_id']){
			$this->db->where('videos.language_id',$get['language_id']);
		}
    	if($get['category_id']){
			$this->db->where('videos.category_id',$get['category_id']);
		}
		
		if($get['title']){
			$this->db->where('( videos.title_bn LIKE "%'.$get['title'].'%" OR videos.title_en LIKE "%'.$get['title'].'%" )');
		}	
		
		return $this->db->get('videos')->row()->total;  
	}
	
	public function video_comment_list($get,$sort_by,$order_by,$offset,$limit){	
    	$this->db->select('videos_comment.*,videos.title,users.fullname');
    	
    	$this->db->join('videos','videos.id=videos_comment.video_id');
    	$this->db->join('users','users.uid=videos_comment.created_by');
 
		if($get['comment']){
			$this->db->where('videos_comment.comment LIKE "%'.$get['comment'].'%"');
		}		
		
    	$this->db->order_by('videos_comment.'.$sort_by,$order_by);
    	$this->db->limit($limit,$offset);  	
		return $this->db->get('videos_comment');  
		//echo $this->db->last_query();exit;
	}
	
	public function video_comment_list_all($get){
    	$this->db->select('COUNT(videos_comment.id) as total');
		
		if($get['comment']){
			$this->db->where('videos_comment.comment LIKE "%'.$get['comment'].'%"');
		}	
		
		return $this->db->get('videos_comment')->row()->total;  
	}
}