<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table','form_validation'));
		$this->load->model('admin_model','',TRUE);
			
		if(!$this->session->userdata('user')){
			redirect("zadmin");	
		}
		
		$this->uid = $this->session->userdata('user')->uid;
    }
    
    public function category_list()
	{
		$data['title'] = 'Category List';
		
		$this->db->select('category.*,site_language.language');
		$this->db->join('site_language','site_language.id=category.language_id');
		if($_GET['language_id']){
			$this->db->where('category.language_id',$_GET['language_id']);
		}
		$this->db->order_by('category.id','desc');
        $data['rows'] = $this->db->get('category')->result(); 

		$data['content'] = $this->load->view('admin/category/category_list', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}

	public function category_add()
	{
		$data['title'] = 'Add New Category';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 

			$config['upload_path'] = UPLOAD_BG_IMAGE;      
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        $bg_image = '';
	        if ($this->upload->do_upload('bg_image'))
	        {
	          	$upload_data = $this->upload->data();
                $bg_image = $upload_data['file_name'];
	        } 
	        
	        $category_slug = $this->d_model->url_slug($post['category_name'],'category');
	        
			$add = array(
				'language_id' => $post['language_id'],
				'category_name' => $post['category_name'],
				'parent_id' => $post['parent_id'],
				'slug' => $category_slug,
				'bg_image' => $bg_image,
				'status' => $post['status']
		    );				
		    $this->d_model->add('category',$add);
		    $this->session->set_flashdata('success-message', 'Category has been added successfully.');
			redirect('admin/category_list');			
		} 	 	

		$data['content'] = $this->load->view('admin/category/category_add', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}

	public function category_update($id)
	{
		$data['title'] = 'Update Category';
           
        if ( $this->input->post('submit')) {
            $post = $this->input->post();   

			$config['upload_path'] = UPLOAD_BG_IMAGE;      
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        $bg_image = $post['bg_image1'];
	        if ($this->upload->do_upload('bg_image'))
	        {
	          	$upload_data = $this->upload->data();
                $bg_image = $upload_data['file_name'];
	        } 
	        
			$add = array(
				'language_id' => $post['language_id'],
				'category_name' => $post['category_name'],
				'parent_id' => $post['parent_id'],
				'bg_image' => $bg_image,
				'status' => $post['status']
		    );				
		    $this->d_model->edit('category','id',$id,$add);
		    $this->session->set_flashdata('success-message', 'Category has been updated successfully.');
			redirect('admin/category_list');		
		}else{
			$data['row'] = $this->d_model->table_row('category','id',$id)->row();
		}	 	

		$data['content'] = $this->load->view('admin/category/category_add', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}

	public function category_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('category'); 
		redirect('admin/category_list');		
	}
	
	
	public function tags($parem='')
	{
		$data['title'] = 'Tags';
        if ( $this->input->post('submit')) {
            $post = $this->input->post();
            
		    $add['tag_name'] = $post['tag_name'];
		    
		    if($parem==''){
				$this->d_model->add('tags',$add);		    
		    	$this->session->set_flashdata('success-message', 'Tag has been added successfully.');
			}else{
				$this->d_model->edit('tags','id',$parem,$add);    
		    	$this->session->set_flashdata('success-message', 'Tag has been updated successfully.');
			}	
		    
			redirect('admin/tags');			
		}
		if($parem){
			$data['c_row'] = $this->d_model->table_row('tags','id',$parem)->row();
		}
		
        $data['rows'] = $this->d_model->table_list('tags','id','desc')->result();

		$data['content'] = $this->load->view('admin/tags/tags_list', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function tag_delete($id)
	{
		$this->d_model->delete('tags','id',$id);  
		
		$this->session->set_flashdata('success-message', 'Tag has been deleted successfully.');   
		redirect('admin/tags');		
	}
	
	public function loadSubCategory($id)
	{
		$rows = $this->d_model->table_row('category','parent_id',$id)->result();
		$r = '<option value="">--Select a Sub Category--</option>';
		foreach($rows as $row){
			$r .= '<option value="'.$row->id.'">'.$row->category_name.'</option>';
		}
		echo $r;
	}
	
	
	public function post_list()
	{
		$data['title'] = 'Post List';
		
		if(isset($_GET['per_page'])){
			$offset = $_GET['per_page'];
		}else{	
			$offset = 0;
		}
		
		if(isset($_GET['sort_by'])){
			$sort_by = $_GET['sort_by'];
		}else{	
			$sort_by = 'id';
		}
		if(isset($_GET['order_by'])){
			$order_by = $_GET['order_by'];
		}else{	
			$order_by = 'desc';
		}
		
		if($_GET['limit']){
			$limit = $_GET['limit'];
		}else{
			$limit = 10;
		}
		
		$get = $_GET;
        $data['rows'] = $this->admin_model->post_list($get,$sort_by,$order_by,$offset,$limit)->result(); 
        
        $get1 = '';
		foreach($_GET as $key => $value)
		{
			if($key!='per_page'){
				$get1 .= $key.'='.$value.'&';
			}
		}
		$config['base_url'] = site_url("admin/post_list?$get1");
		$config['total_rows'] = $this->admin_model->post_list_all($get);
		$data['total_rows'] = $config['total_rows'];
		
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
        $config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';
	    $config['first_link'] = '&laquo; First';
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_link'] = 'Last &raquo;';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';
	    $config['next_link'] = 'Next &rarr;';
	    $config['next_tag_open'] = '<li class="next page">';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '&larr; Previous';
	    $config['prev_tag_open'] = '<li class="prev page">';
	    $config['prev_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li class="page">';
	    $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        $data['example_info'] = $this->d_lib->example_info($offset,$limit,$config['total_rows']);

		$data['content'] = $this->load->view('admin/post/post_list', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	

	public function post_add()
	{
		$data['title'] = 'Add New Post';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
            $config['upload_path'] = UPLOAD_FEATURED;      
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['min_width'] = '300';
			$config['min_height'] = '230';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        $featured_image = '';
	        if ($this->upload->do_upload('featured_image'))
	        {
	          	$upload_data = $this->upload->data();
                $featured_image = $upload_data['file_name'];
                $imagePath = UPLOAD_FEATURED.'/'.$upload_data['file_name'];	
				$this->d_model->resizeImage($imagePath, $upload_data['file_name'],300,230);
	        }  

			$post_slug = $this->d_model->url_slug($post['post_title'],'posts');

			$add['language_id'] = $post['language_id'];
			$add['featured_image'] = $featured_image; 
			$add['post_title'] = $post['post_title'];
			$add['slug'] = $post_slug;
			if($post['history']){
				$add['history'] = $post['history'];
			}else{
				$add['history'] = 'No';
			}
			if($post['do_you_know']){
				$add['do_you_know'] = $post['do_you_know'];
			}else{
				$add['do_you_know'] = 'No';
			}
			if($post['featured']){
				$add['featured'] = $post['featured'];
			}else{
				$add['featured'] = 'No';
			}
			$add['category_id'] = $post['category_id'];
			$add['sub_category_id'] = $post['sub_category_id'];
			$add['description'] = $post['description'];
			$add['youtube_video'] = $post['youtube_video'];
			$add['status'] = $post['status'];
			$add['created'] = date('Y-m-d H:i:s');
			$add['created_by'] = $this->uid;	
					
		    $post_id = $this->d_model->add('posts',$add);
		    
		    $tag_ids = '';
	        if($post['tags']){
				$tags = explode(',',$post['tags']);
				for($t=0; $t<count($tags); $t++){
					$tag_name = $tags[$t];
					$tag_id = $this->d_model->table_row('tags','tag_name',$tag_name)->row()->id;
					if(!$tag_id){
						$addTag['tag_name'] = $tag_name;
						$tag_id = $this->d_model->add('tags',$addTag);
					}
					
					$p_tag['post_id'] = $post_id;
					$p_tag['tag_id'] = $tag_id;
					$this->d_model->add('posts_tags',$p_tag);
				}
			}
		    
		    $this->session->set_flashdata('success-message', 'Post has been added successfully.');
			redirect('admin/post_update/'.$post_id);			
		} 	 	

		$data['content'] = $this->load->view('admin/post/post_add', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function post_update($post_id)
	{
		$data['title'] = 'Update Post';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
            
            $config['upload_path'] = UPLOAD_FEATURED;      
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['min_width'] = '300';
			$config['min_height'] = '230';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        $featured_image = $post['featured_image1'];
	        if ($this->upload->do_upload('featured_image'))
	        {
	          	$upload_data = $this->upload->data();
                $featured_image = $upload_data['file_name'];
                $imagePath = UPLOAD_FEATURED.'/'.$upload_data['file_name'];	
				$this->d_model->resizeImage($imagePath, $upload_data['file_name'],300,230);
	        }   
	        
	        $this->d_model->delete('posts_tags','post_id',$post_id);
	        if($post['tags']){
				$tags = explode(',',$post['tags']);
				for($t=0; $t<count($tags); $t++){
					$tag_name = $tags[$t];
					$tag_id = $this->d_model->table_row('tags','tag_name',$tag_name)->row()->id;
					if(!$tag_id){
						$addTag['tag_name'] = $tag_name;
						$tag_id = $this->d_model->add('tags',$addTag);
					}
					
					$p_tag['post_id'] = $post_id;
					$p_tag['tag_id'] = $tag_id;
					$this->d_model->add('posts_tags',$p_tag);
				}
			}
			
			$add['language_id'] = $post['language_id'];
			$add['featured_image'] = $featured_image;
			$add['post_title'] = $post['post_title'];
			if($post['history']){
				$add['history'] = $post['history'];
			}else{
				$add['history'] = 'No';
			}
			if($post['do_you_know']){
				$add['do_you_know'] = $post['do_you_know'];
			}else{
				$add['do_you_know'] = 'No';
			}
			if($post['featured']){
				$add['featured'] = $post['featured'];
			}else{
				$add['featured'] = 'No';
			}
			$add['category_id'] = $post['category_id'];
			$add['sub_category_id'] = $post['sub_category_id'];
			$add['description'] = $post['description'];
			$add['youtube_video'] = $post['youtube_video'];
			$add['status'] = $post['status'];
			$add['updated_by'] = $this->uid;	
					
		    $this->d_model->edit('posts','id',$post_id,$add);
		    
		    
		    $this->session->set_flashdata('success-message', 'Post has been updated successfully.');
			redirect('admin/post_update/'.$post_id);			
		} else {
			$data['row'] = $this->d_model->table_row('posts','id',$post_id)->row();
			$data['parts'] = $this->d_model->table_row('posts_parts','post_id',$post_id)->result();
		} 	

		$data['content'] = $this->load->view('admin/post/post_update', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function add_new_part($post_id)
	{
        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
            $add['post_id'] = $post_id;
			$add['part_title'] = $post['part_title'];
					
		    $part_id = $this->d_model->add('posts_parts',$add);
		    
		    $config['upload_path'] = UPLOAD_POST;      
            $config['allowed_types'] = '*';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
		    $number_of_files = sizeof($_FILES['image']['tmp_name']);
    		$files = $_FILES['image'];
			for ($i = 0; $i < $number_of_files; $i++) {
		        $_FILES['image']['name'] = $files['name'][$i];
		        $_FILES['image']['type'] = $files['type'][$i];
		        $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
		        $_FILES['image']['error'] = $files['error'][$i];
		        $_FILES['image']['size'] = $files['size'][$i];

		        if ($this->upload->do_upload('image'))
		        {
		          	$upload_data = $this->upload->data();
		          	
		          	$imagePath = UPLOAD_POST.'/'.$upload_data['file_name'];	
					$this->d_model->resizeImage($imagePath, $upload_data['file_name'],450,250);
	                $imagePath = UPLOAD_POST.'/'.$upload_data['file_name'];	
					$this->d_model->resizeImage($imagePath, $upload_data['file_name'],700,500);
		          	
		          	$add1['post_id'] = $post_id;
		          	$add1['post_part_id'] = $part_id;
		          	$add1['image'] = $upload_data['file_name'];
		          	//$add1['section_title_en'] = $post['section_title_en'][$i];
		          	//$add1['section_title_bn'] = $post['section_title_bn'][$i];
		          	//$add1['section_shot_description_en'] = $post['section_shot_description_en'][$i];
		          	//$add1['section_shot_description_bn'] = $post['section_shot_description_bn'][$i];
		          	$add1['section_description'] = $post['section_description'][$i];
		          	
		          	$this->d_model->add('posts_parts_sections',$add1);
		        }
		    }
		    
		    $this->session->set_flashdata('success-message', 'Part has been added successfully.');
			redirect('admin/post_update/'.$post_id);			
		} 			
	}
	
	public function part_update($post_id,$part_id)
	{
        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
			$add['part_title'] = $post['part_title'];
					
		    $this->d_model->edit('posts_parts','id',$part_id,$add);
		    
		    /*delete section this part*/
		    $this->d_model->delete('posts_parts_sections','post_part_id',$part_id);
		    
		    $config['upload_path'] = UPLOAD_POST;      
            $config['allowed_types'] = '*';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
		    $number_of_files = sizeof($_FILES['image']['tmp_name']);
    		$files = $_FILES['image'];
			for ($i = 0; $i < $number_of_files; $i++) {
		        $_FILES['image']['name'] = $files['name'][$i];
		        $_FILES['image']['type'] = $files['type'][$i];
		        $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
		        $_FILES['image']['error'] = $files['error'][$i];
		        $_FILES['image']['size'] = $files['size'][$i];

		        if ($this->upload->do_upload('image'))
		        {
		          	$upload_data = $this->upload->data();
					$image = $upload_data['file_name'];
					
					$imagePath = UPLOAD_POST.'/'.$upload_data['file_name'];	
					$this->d_model->resizeImage($imagePath, $upload_data['file_name'],450,250);
					$imagePath = UPLOAD_POST.'/'.$upload_data['file_name'];	
					$this->d_model->resizeImage($imagePath, $upload_data['file_name'],700,500);
		        }else{
					$image = $post['image1'][$i];
				}
		        
		        $add1['post_id'] = $post_id;
	          	$add1['post_part_id'] = $part_id;
	          	$add1['image'] = $image;
	          	//$add1['section_title_en'] = $post['section_title_en'][$i];
	          	//$add1['section_title_bn'] = $post['section_title_bn'][$i];
	          	//$add1['section_shot_description_en'] = $post['section_shot_description_en'][$i];
	          	//$add1['section_shot_description_bn'] = $post['section_shot_description_bn'][$i];
	          	$add1['section_description'] = $post['section_description'][$i];
	          	
	          	$this->d_model->add('posts_parts_sections',$add1);
		    }
		    
		    $this->session->set_flashdata('success-message', 'Part has been added successfully.');
			redirect('admin/post_update/'.$post_id);			
		} 			
	}
	
	public function post_summary_add($post_id)
	{
        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
            $config['upload_path'] = UPLOAD_SUMMARY;      
            $config['allowed_types']        = 'gif|jpg|png|jepg';
            $config['min_width']            = '160';
            $config['max_width']            = '200';
            $config['min_height']           = '210';
            $config['max_height']           = '270';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        if ($this->upload->do_upload('summary_image'))
	        {
	          	$upload_data = $this->upload->data();
				$summary_image = $upload_data['file_name'];
	        }else{
				$summary_image = $post['summary_image1'];
			}
	        
			$add['summary_image'] = $summary_image;
			$add['summary_name'] = $post['summary_name'];
					
		    $this->d_model->edit('posts','id',$post_id,$add);
		    
		    /*delete summary this post*/
		    $this->d_model->delete('posts_summary','post_id',$post_id);
		    
		    	        
    		$label = $post['label'];
			for ($i = 0; $i < count($label); $i++) {
		        
		        $add1['post_id'] = $post_id;
	          	$add1['label'] = $label[$i];
	          	$add1['description'] = $post['description'][$i];
	          	
	          	$this->d_model->add('posts_summary',$add1);
		    }
		    
		    $this->session->set_flashdata('success-message', 'Summary has been added successfully.');
			redirect('admin/post_update/'.$post_id);			
		} 			
	}
	
	public function post_delete($post_id)
	{
		$this->d_model->delete('posts','id',$post_id);  
		$this->d_model->delete('posts_parts','post_id',$post_id);
		$this->d_model->delete('posts_parts_sections','post_id',$post_id);
		$this->d_model->delete('posts_summary','post_id',$post_id);
		
		$this->session->set_flashdata('success-message', 'Post has been deleted successfully.');   
		redirect('admin/post_list');		
	}
	
	public function post_comment_list()
	{
		$data['title'] = 'Post Comment List';
		
		if(isset($_GET['per_page'])){
			$offset = $_GET['per_page'];
		}else{	
			$offset = 0;
		}
		
		if(isset($_GET['sort_by'])){
			$sort_by = $_GET['sort_by'];
		}else{	
			$sort_by = 'id';
		}
		if(isset($_GET['order_by'])){
			$order_by = $_GET['order_by'];
		}else{	
			$order_by = 'desc';
		}
		
		if($_GET['limit']){
			$limit = $_GET['limit'];
		}else{
			$limit = 15;
		}
		
		$get = $_GET;
        $data['rows'] = $this->admin_model->post_comment_list($get,$sort_by,$order_by,$offset,$limit)->result(); 
        
        $get1 = '';
		foreach($_GET as $key => $value)
		{
			if($key!='per_page'){
				$get1 .= $key.'='.$value.'&';
			}
		}
		$config['base_url'] = site_url("admin/post_comment_list?$get1");
		$config['total_rows'] = $this->admin_model->post_comment_list_all($get);
		$data['total_rows'] = $config['total_rows'];
		
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
        $config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';
	    $config['first_link'] = '&laquo; First';
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_link'] = 'Last &raquo;';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';
	    $config['next_link'] = 'Next &rarr;';
	    $config['next_tag_open'] = '<li class="next page">';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '&larr; Previous';
	    $config['prev_tag_open'] = '<li class="prev page">';
	    $config['prev_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li class="page">';
	    $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        $data['example_info'] = $this->d_lib->example_info($offset,$limit,$config['total_rows']);

		$data['content'] = $this->load->view('admin/post/comment_list', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function post_comment_delete($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('posts_comment'); 
		
		redirect('admin/post_comment_list');		
	}
	
	public function file_delete($post_id,$fid)
	{
		$this->d_model->delete('files','fid',$fid);  
		
		$this->session->set_flashdata('success-message', 'File has been deleted successfully.');   
		redirect('admin/post_update/'.$post_id);		
	}
	public function post_video_delete($post_id,$id)
	{
		$this->d_model->delete('video','id',$id);  
		
		$this->session->set_flashdata('success-message', 'Video has been deleted successfully.');   
		redirect('admin/post_update/'.$post_id);		
	}
	
	
	public function page_list()
	{
		$data['title'] = 'Page List';
		
		$this->db->select('page.*,site_language.language');
		$this->db->join('site_language','site_language.id=page.language_id');
		if($_GET['language_id']){
			$this->db->where('page.language_id',$_GET['language_id']);
		}
		$this->db->order_by('page.id','desc');
        $data['rows'] = $this->db->get('page')->result(); 

		$data['content'] = $this->load->view('admin/page/page_list', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	

	public function page_add()
	{
		$data['title'] = 'Add New Page';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 

			$add['language_id'] = $post['language_id'];
			$add['title'] = $post['title'];
			$add['description'] = $post['description'];
			$add['status'] = $post['status'];
			$add['created'] = date('Y-m-d H:i:s');
			$add['created_by'] = $this->uid;	
					
		    $this->d_model->add('page',$add);
		    
		    $this->session->set_flashdata('success-message', 'Page has been added successfully.');
			redirect('admin/page_list');			
		} 	 	

		$data['content'] = $this->load->view('admin/page/page_add', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function page_update($id)
	{
		$data['title'] = 'Update Page';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 

			$add['language_id'] = $post['language_id'];
			$add['title'] = $post['title'];
			$add['description'] = $post['description'];
			$add['status'] = $post['status'];
			$add['updated_by'] = $this->uid;	
					
		    $this->d_model->edit('page','id',$id,$add);
		    
		    
		    $this->session->set_flashdata('success-message', 'Page has been added successfully.');
			redirect('admin/page_update/'.$id);			
		} else {
			$data['row'] = $this->d_model->table_row('page','id',$id)->row();
		} 	

		$data['content'] = $this->load->view('admin/page/page_add', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function page_delete($id)
	{
		$this->d_model->delete('page','id',$id);  
		
		$this->session->set_flashdata('success-message', 'Page has been deleted successfully.');   
		redirect('admin/page_list');		
	}
	
	public function gallery_list()
	{
		$data['title'] = 'Gallery List';
		
        $data['rows'] = $this->d_model->table_list('gallery','id','desc')->result();

		$data['content'] = $this->load->view('admin/gallery/gallery_list', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	

	public function gallery_add()
	{
		$data['title'] = 'Add New Gallery';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
            $config['upload_path'] = UPLOAD_GALLERY;      
            $config['allowed_types'] = '*';
			$config['overwrite'] = TRUE;
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        $filename = '';
	        if ($this->upload->do_upload('filename'))
	        {
	          	$upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
	        }

			$add['title'] = $post['title'];
			$add['filename'] = $filename;
			$add['status'] = $post['status'];
			$add['created'] = date('Y-m-d H:i:s');
			$add['created_by'] = $this->uid;	
					
		    $this->d_model->add('gallery',$add);
		    
		    $this->session->set_flashdata('success-message', 'Gallery has been added successfully.');
			redirect('admin/gallery_list');			
		} 	 	

		$data['content'] = $this->load->view('admin/gallery/gallery_add', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function gallery_update($id)
	{
		$data['title'] = 'Update Gallery';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
            $config['upload_path'] = UPLOAD_GALLERY;      
            $config['allowed_types'] = '*';
			$config['overwrite'] = TRUE;
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        $filename = $post['filename1'];
	        if ($this->upload->do_upload('filename'))
	        {
	          	$upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
	        }

			$add['title'] = $post['title'];
			$add['filename'] = $filename;
			$add['status'] = $post['status'];
			$add['updated_by'] = $this->uid;	
					
		    $this->d_model->edit('gallery','id',$id,$add);
		    
		    
		    $this->session->set_flashdata('success-message', 'Gallery has been added successfully.');
			redirect('admin/gallery_list');			
		} else {
			$data['row'] = $this->d_model->table_row('gallery','id',$id)->row();
		} 	

		$data['content'] = $this->load->view('admin/gallery/gallery_add', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function gallery_delete($id)
	{
		$this->d_model->delete('gallery','id',$id);  
		
		$this->session->set_flashdata('success-message', 'Gallery has been deleted successfully.');   
		redirect('admin/gallery_list');		
	}
	
	public function subscribe_list()
	{
		$data['title'] = 'Subscribe List';
		
        $data['rows'] = $this->d_model->table_list('subscribe','id','desc')->result();
		$data['content'] = $this->load->view('admin/subscribe_list', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	
	public function video_category_list()
	{
		$data['title'] = 'Category List';
		
		$this->db->select('videos_category.*,site_language.language');
		$this->db->join('site_language','site_language.id=videos_category.language_id');
		if($_GET['language_id']){
			$this->db->where('videos_category.language_id',$_GET['language_id']);
		}
		$this->db->order_by('videos_category.id','desc');
        $data['rows'] = $this->db->get('videos_category')->result(); 

		$data['content'] = $this->load->view('admin/video/category_list', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function video_category_add()
	{
		$data['title'] = 'Add New Category';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 

			$slug = $this->d_model->url_slug($post['category_name'],'videos_category');
			
			$add = array(
				'language_id' => $post['language_id'],
				'category_name' => $post['category_name'],
				'slug' => $slug,
				'status' => $post['status']
		    );				
		    $this->d_model->add('videos_category',$add);
		    $this->session->set_flashdata('success-message', 'Category has been added successfully.');
			redirect('admin/video_category_list');			
		} 	 	

		$data['content'] = $this->load->view('admin/video/category_add', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}

	public function video_category_update($id)
	{
		$data['title'] = 'Update Category';
           
        if ( $this->input->post('submit')) {
            $post = $this->input->post();   

			$add = array(
				'language_id' => $post['language_id'],
				'category_name' => $post['category_name'],
				'status' => $post['status']
		    );				
		    $this->d_model->edit('videos_category','id',$id,$add);
		    $this->session->set_flashdata('success-message', 'Category has been updated successfully.');
			redirect('admin/video_category_list');		
		}else{
			$data['row'] = $this->d_model->table_row('videos_category','id',$id)->row();
		}	 	

		$data['content'] = $this->load->view('admin/video/category_add', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}

	public function video_category_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('videos_category'); 
		
		$this->db->where('category_id', $id);
		$this->db->delete('videos'); 
		
		redirect('admin/video_category_list');		
	}
	
	public function video_list()
	{
		$data['title'] = 'Video List';
		
		if(isset($_GET['per_page'])){
			$offset = $_GET['per_page'];
		}else{	
			$offset = 0;
		}
		
		if(isset($_GET['sort_by'])){
			$sort_by = $_GET['sort_by'];
		}else{	
			$sort_by = 'id';
		}
		if(isset($_GET['order_by'])){
			$order_by = $_GET['order_by'];
		}else{	
			$order_by = 'desc';
		}
		
		if($_GET['limit']){
			$limit = $_GET['limit'];
		}else{
			$limit = 15;
		}
		
		$get = $_GET;
        $data['rows'] = $this->admin_model->video_list($get,$sort_by,$order_by,$offset,$limit)->result(); 
        
        $get1 = '';
		foreach($_GET as $key => $value)
		{
			if($key!='per_page'){
				$get1 .= $key.'='.$value.'&';
			}
		}
		$config['base_url'] = site_url("admin/video_list?$get1");
		$config['total_rows'] = $this->admin_model->video_list_all($get);
		$data['total_rows'] = $config['total_rows'];
		
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
        $config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';
	    $config['first_link'] = '&laquo; First';
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_link'] = 'Last &raquo;';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';
	    $config['next_link'] = 'Next &rarr;';
	    $config['next_tag_open'] = '<li class="next page">';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '&larr; Previous';
	    $config['prev_tag_open'] = '<li class="prev page">';
	    $config['prev_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li class="page">';
	    $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        $data['example_info'] = $this->d_lib->example_info($offset,$limit,$config['total_rows']);

		$data['content'] = $this->load->view('admin/video/video_list', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function video_add()
	{
		$data['title'] = 'Add New Video';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
            $config['upload_path'] = UPLOAD_VIDEO_IMG;      
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['min_width'] = '640';
			$config['min_height'] = '426';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        $filename = '';
	        if ($this->upload->do_upload('filename'))
	        {
	          	$upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
                
                $imagePath = UPLOAD_VIDEO_IMG.'/'.$upload_data['file_name'];	
	            
				$this->d_model->resizeImage($imagePath, $upload_data['file_name'],640,426);
				$this->d_model->resizeImage($imagePath, $upload_data['file_name'],305,225);
				$this->d_model->resizeImage($imagePath, $upload_data['file_name'],320,180);
	        }

			$slug = $this->d_model->url_slug($post['title'],'videos');
			
			$add['language_id'] = $post['language_id'];
			$add['category_id'] = $post['category_id'];
			$add['title'] = $post['title'];
			$add['slug'] = $slug;
			$add['video_link'] = $post['video_link'];
			$add['duration'] = $post['hour'].':'.$post['minute'].':'.$post['second'];
			$add['des'] = $post['des'];
			$add['filename'] = $filename;
			$add['status'] = $post['status'];
			$add['created'] = date('Y-m-d H:i:s');
			$add['created_by'] = $this->uid;	
					
		    $this->d_model->add('videos',$add);
		    
		    $this->session->set_flashdata('success-message', 'Video has been added successfully.');
			redirect('admin/video_list');			
		} 	 	

		$data['content'] = $this->load->view('admin/video/video_add', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function video_update($id)
	{
		$data['title'] = 'Update Video';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 
            
            $config['upload_path'] = UPLOAD_VIDEO_IMG;      
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['min_width'] = '640';
			$config['min_height'] = '426';
	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);
	        
	        $filename = $post['filename1'];
	        if ($this->upload->do_upload('filename'))
	        {
	          	$upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
                
                $imagePath = UPLOAD_VIDEO_IMG.'/'.$upload_data['file_name'];	
	            
				$this->d_model->resizeImage($imagePath, $upload_data['file_name'],640,426);
				$this->d_model->resizeImage($imagePath, $upload_data['file_name'],305,225);
				$this->d_model->resizeImage($imagePath, $upload_data['file_name'],320,180);
	        }

			$add['language_id'] = $post['language_id'];
			$add['category_id'] = $post['category_id'];
			$add['title'] = $post['title'];
			$add['video_link'] = $post['video_link'];
			$add['duration'] = $post['hour'].':'.$post['minute'].':'.$post['second'];
			$add['des'] = $post['des'];
			$add['filename'] = $filename;
			$add['status'] = $post['status'];	
					
		    $this->d_model->edit('videos','id',$id,$add);
		    
		    $this->session->set_flashdata('success-message', 'Video has been updated successfully.');
			redirect('admin/video_list');			
		}else{
			$data['row'] = $this->d_model->table_row('videos','id',$id)->row();
		} 	

		$data['content'] = $this->load->view('admin/video/video_add', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function video_delete($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('videos'); 
		
		$this->db->where('video_id', $id);
		$this->db->delete('videos_comment'); 
		
		redirect('admin/video_list');		
	}
	
	public function video_comment_list()
	{
		$data['title'] = 'Video Comment List';
		
		if(isset($_GET['per_page'])){
			$offset = $_GET['per_page'];
		}else{	
			$offset = 0;
		}
		
		if(isset($_GET['sort_by'])){
			$sort_by = $_GET['sort_by'];
		}else{	
			$sort_by = 'id';
		}
		if(isset($_GET['order_by'])){
			$order_by = $_GET['order_by'];
		}else{	
			$order_by = 'desc';
		}
		
		if($_GET['limit']){
			$limit = $_GET['limit'];
		}else{
			$limit = 15;
		}
		
		$get = $_GET;
        $data['rows'] = $this->admin_model->video_comment_list($get,$sort_by,$order_by,$offset,$limit)->result(); 
        
        $get1 = '';
		foreach($_GET as $key => $value)
		{
			if($key!='per_page'){
				$get1 .= $key.'='.$value.'&';
			}
		}
		$config['base_url'] = site_url("admin/video_comment_list?$get1");
		$config['total_rows'] = $this->admin_model->video_comment_list_all($get);
		$data['total_rows'] = $config['total_rows'];
		
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
        $config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';
	    $config['first_link'] = '&laquo; First';
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_link'] = 'Last &raquo;';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';
	    $config['next_link'] = 'Next &rarr;';
	    $config['next_tag_open'] = '<li class="next page">';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '&larr; Previous';
	    $config['prev_tag_open'] = '<li class="prev page">';
	    $config['prev_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li class="page">';
	    $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        $data['example_info'] = $this->d_lib->example_info($offset,$limit,$config['total_rows']);

		$data['content'] = $this->load->view('admin/video/comment_list', $data, true);
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function video_comment_delete($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('videos_comment'); 
		
		redirect('admin/video_comment_list');		
	}
}

