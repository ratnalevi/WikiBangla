<?php 
class D_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
    
    public function add($table,$data){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
	public function table_row($table,$table_id,$id){
		$this->db->where($table_id, $id);
		return $this->db->get($table);  
	}
	
	public function edit($table,$table_id,$id,$data){
		$this->db->where($table_id, $id);
		return $this->db->update($table,$data);  
	}
	
	public function table_list($tbl_name,$sort_by='',$order_by='',$where_field='',$where_value=''){	
    	if($where_field && $where_value){
			$this->db->where($where_field, $where_value);
		}
		if($sort_by && $order_by){
			$this->db->order_by($sort_by, $order_by);
		}
		return $this->db->get($tbl_name);  
	}
	
	public function delete($table,$table_id,$id){
		$this->db->where($table_id, $id);
		return $this->db->delete($table); 
	}
	
	
	public function filename($f_id){
		$this->db->where('fid', $f_id);
		return $this->db->get('files')->row()->filename;  
	}
	
	public function get_featured_photo($post_id,$type=''){
		if($type=='one'){
			$this->db->where('post_id', $post_id);
			$this->db->limit(1);
			$filename = $this->db->get('files')->row()->filename; 
			return base_url('uploads/post/'.$filename);
		}else{
			$this->db->where('post_id', $post_id);
			return $this->db->get('files')->result(); 
		} 
	}
	
	public function category($id){
		$this->db->where('parent_id', $id);
		$this->db->where('status', 'publish');
		$this->db->where('language_id', SITE_LANG);
		return $this->db->get('category')->result();
	}
	
	public function country_name($id){
		$this->db->where('id', $id);
		return $this->db->get('countries')->row()->country_name;
	}
	
	public function tag_name($id){
		$this->db->where('id', $id);
		return $this->db->get('tags')->row()->tag_name;
	}
	
	public function category_name($id){
		$this->db->where('slug', $id);
		return $this->db->get('category')->row()->category_name; 
	}
	
	public function LatestPostSlug(){
		$this->db->where('language_id', SITE_LANG);
		$this->db->where('status', 'Publish');
		$this->db->order_by('id','desc');
		return $this->db->get('posts')->row()->slug; 
	}
	
	public function implode($array_val)
	{ 	
		if($array_val){
			return implode(',',$array_val); 
		}else{
			return ''; 
		}
	}
	
	public function explode($tbl_name,$field,$w_field,$val)
	{ 
		$this->db->select($field);		
		$this->db->where_in($w_field, explode(',',$val));
		$rows = $this->db->get($tbl_name)->result(); 
		
		$r = '';
		foreach($rows as $i => $row){
			if($i==count($rows)-1){
				$r .= $row->$field;
			}else{
				$r .= $row->$field.',';
			}
		}
		return $r;
	}
	
	
	public function resizeImage($imagePath,$filename,$width,$height){
		$this->load->library('image_lib');
		
        $config['image_library'] = 'gd2';
		$config['source_image']	= $imagePath;
		$config['create_thumb'] = FALSE;
		$config['new_image'] = $width.'X'.$height.'_'.$filename;
		$config['maintain_ratio'] = FALSE;
		$config['width']	= $width;
		$config['height']	= $height;

		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
    }
    
    public function total_like_post($post_id){
		$this->db->select('COUNT(id) as total');
		$this->db->where('post_id',$post_id);
		return $this->db->get('posts_like')->row()->total;
    }
    public function total_view_post($post_id){
		$this->db->select('COUNT(id) as total');
		$this->db->where('post_id',$post_id);
		return $this->db->get('posts_view')->row()->total;
    }
    
    public function total_posts($type,$peram='',$peram1=''){
		$this->db->select('COUNT(id) as total');
		if($type=='category'){
			if($peram){
				$this->db->where('category_id',$peram);
			}
			if($peram1){
				$this->db->where('sub_category_id',$peram1);
			}
		}elseif($type=='year'){
			if($peram){
				$this->db->where('created LIKE "%'.$peram.'%"');
			}
		}
		$this->db->where('language_id',SITE_LANG);
		$this->db->where('status','Publish');
		return $this->db->get('posts')->row()->total;
    }
    
    public function load_site_language($language_id='')
	{ 
		$this->db->select("id,language");
		$this->db->where('status', 'Active');
		$rows = $this->db->get('site_language')->result(); 
		$r = '<option value="">--Select a Language--</option>';
		foreach($rows as $row){
			$seelcted = '';
			if($row->id==$language_id){
				$seelcted = 'selected=""';
			}
			$r .= '<option '.$seelcted.' value="'.$row->id.'">'.$row->language.'</option>';
		}
		return $r;
	}
	
	public function load_category($language_id,$cat_id='',$peram='')
	{ 
		$this->db->select("id,category_name");
		$this->db->where('status', 'Publish');
		$this->db->where('language_id', $language_id);
		$this->db->where('parent_id', '0');
		$this->db->order_by('id', 'desc');
		$rows = $this->db->get('category')->result(); 
		if($peram=='root'){
			$r = '<option value="0">Root</option>';
		}else{
			$r = '<option value="">--Select a Category--</option>';
		}
		foreach($rows as $row){
			$seelcted = '';
			if($row->id==$cat_id){
				$seelcted = 'selected=""';
			}
			$r .= '<option '.$seelcted.' value="'.$row->id.'">'.$row->category_name.'</option>';
		}
		return $r;
	}
	
	public function load_video_category($language_id,$cat_id='')
	{ 
		$this->db->select("id,category_name");
		$this->db->where('status', 'publish');
		$this->db->where('language_id', $language_id);
		$this->db->order_by('id', 'desc');
		$rows = $this->db->get('videos_category')->result(); 
		$r = '<option value="">--Select a Category--</option>';
		foreach($rows as $row){
			$seelcted = '';
			if($row->id==$cat_id){
				$seelcted = 'selected=""';
			}
			$r .= '<option '.$seelcted.' value="'.$row->id.'">'.$row->category_name.'</option>';
		}
		return $r;
	}
	
	public function url_slug($string,$type='',$id='')
	{ 	
		$text = preg_replace('/\s+/', '-', $string);
		$text = str_replace('?', '', $text);
		
		if($type=='category'){
			$this->db->where('slug',$text);
			$row = $this->db->get('category')->row();
		}elseif($type=='posts'){
			if($id){
				$this->db->where('id != ',$id);
			}
			$this->db->where('slug',$text);
			$row = $this->db->get('posts')->row();
		}elseif($type=='videos_category'){
			$this->db->where('slug',$text);
			$row = $this->db->get('videos_category')->row();
		}elseif($type=='videos'){
			$this->db->where('slug',$text);
			$row = $this->db->get('videos')->row();
		}
		
		if($row){
			$text = $text.'-'.$this->generate_number(4);	
		}
		return $text;
	}
	public function generate_number($length)
	{
		$pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

	    for($i=0; $i < $length; $i++) {
	        $key .= $pool[mt_rand(0, count($pool) - 1)];
	    }
	    return $key;
	}
}