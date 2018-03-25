<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table','form_validation'));
		$this->load->model('front_model','',TRUE);
    }
    
    public function index()
	{
		$data['title']='Video';

		$data['content'] = $this->load->view('video', $data, true);	
		$this->load->view('index',$data);		
	}
	
	public function category($category_id)
	{
		$category = $this->d_model->table_row('videos_category','id',$category_id)->row();
		$data['title'] = ($this->session->userdata('bangla')=='bangla')? $category->category_bn:$category->category_en;
		
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
			$limit = 16;
		}
		
		$get = $_GET;
        $data['rows'] = $this->front_model->video($category_id,$get,$sort_by,$order_by,$offset,$limit)->result(); 
        
        $get1 = '';
		foreach($_GET as $key => $value)
		{
			if($key!='per_page'){
				$get1 .= $key.'='.$value.'&';
			}
		}
		$config['base_url'] = site_url("video/category/$category_id?$get1");
		$config['total_rows'] = $this->front_model->video_all($category_id,$get);
		
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

		$data['content'] = $this->load->view('video_category', $data, true);	
		$this->load->view('index',$data);			
	}
	
	public function single($id)
	{
		$this->db->query('UPDATE videos SET total_view = total_view + 1 WHERE id = '.$id);
	    
		$data['row'] = $this->front_model->video_single($id)->row();
		
		$data['up_next'] = $this->front_model->up_next($data['row']->category_id,$id)->result();
		
		$data['comments'] = $this->front_model->video_comments($id)->result();
		
		$data['title'] = ($this->session->userdata('bangla')=='bangla')? $data['row']->title_bn:$data['row']->title_en;
		
		$data['url'] = base_url('video/single/'.$id);
		$data['type'] = base_url();
		$data['description'] = ($this->session->userdata('bangla')=='bangla')? $this->d_lib->get_def_word($data['row']->des_bn,10) : $this->d_lib->get_def_word($data['row']->des_en,10);
		$data['image'] = base_url().UPLOAD_VIDEO_IMG.'/640X426_'.$data['row']->filename;

		$data['content'] = $this->load->view('video_single', $data, true);	
		$this->load->view('index',$data);
	}
	
	
	public function add_comment()
	{
		$add = array(
			'video_id' => $_GET['video_id'],
			'comment' => $_GET['comment'],
			'created' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('fuser')->uid,
			'status' => 'publish'
	    );				
	    $this->d_model->add('videos_comment',$add);
	    
	    echo '<div class="media"><h5>'.$this->session->userdata('fuser')->fullname.'</h5><div class="media-body"><p>'.$_GET['comment'].'</p></div></div>';
	}
}

