<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table','form_validation'));
		//$this->load->model('ajax_model','',TRUE);

		$this->uid = $this->session->userdata('user')->uid;
		$this->rid = $this->session->userdata('user')->rid;
		
		$this->language = $this->session->userdata('bangla');
    }
    
    function modal($page_name = '' , $page_title = '' , $param2 = '' , $param3 = '' , $param4 = '')
	{
		$page_data['title']		    =	$page_title;
		$page_data['param2']		=	$param2;
		$page_data['param3']		=	$param3;
		$page_data['param4']		=	$param4;		
		$page_data['content'] = $this->load->view('admin/modal/'.$page_name.'.php',$page_data, true);
		$this->load->view('admin/includes/modal_index',$page_data);
	}
	
	public function LoadAutoWord()
	{ 
		$query = urldecode($_GET['query']);
		if($this->language=='bangla'){
			$this->db->select('title_bn as title');
			$this->db->where('title_bn LIKE "%'.$query.'%"');
		}else{
			$this->db->select('title_en as title');
			$this->db->where('title_en LIKE "%'.$query.'%"');
		}
		$rows = $this->db->get('posts')->result();	
		
		$r = '[';
		foreach($rows as $i => $row){
			if($i==count($rows)-1){
				$r .= '"'.$row->title.'"';
			}else{
				$r .= '"'.$row->title.'",';
			}
		}
		$r .= ']';	
		echo $r;
	}
	public function loadVideoCategory($lang_id)
	{
		echo $this->d_model->load_video_category($lang_id);
	}
	
	public function loadCategory($lang_id)
	{
		echo $this->d_model->load_category($lang_id,'','root');
	}
	public function loadCategory1($lang_id)
	{
		echo $this->d_model->load_category($lang_id);
	}
	public function loadSubCategory($id)
	{
		$rows = $this->d_model->table_row('category','parent_id',$id)->result();
		$r = '<option value="">'.$this->lang->line('All').'</option>';
		foreach($rows as $row){
			if($this->session->userdata('bangla')=='bangla'){ 
				$ccc = $row->category_name_bn; 
			}else{ 
				$ccc = $row->category_name; 
			}
			$r .= '<option value="'.$row->id.'">'.$ccc.'</option>';
		}
		echo $r;
	}
	
	public function loadPart($post_id)
	{ 
		$r = '';
		$r .= '<div class="panel panel-primary">';
			$r .= '<div class="panel-heading">';
				$r .= '<h3 class="panel-title">';
					$r .= 'Add New Part';
				$r .= '</h3>';
			$r .= '</div>';
			$r .= '<div class="panel-body form-horizontal">';
				$r .= '<div class="form-group">';
					$r .= '<div class="col-sm-7">';
						$r .= '<input type="button" class="btn btn-info btn-xs" value="Add Section" onclick="loadSection(0);"/>';
					$r .= '</div>';
				$r .= '</div>';
				$r .= '<form action="'.base_url('admin/add_new_part/'.$post_id).'" method="post" enctype="multipart/form-data">';
					$r .= '<div class="form-group">';
						$r .= '<label class="col-sm-3 control-label">Part Title</label>';
						$r .= '<div class="col-sm-7">';
							$r .= '<input type="text" name="part_title" class="form-control" value=""/>';
						$r .= '</div>';
					$r .= '</div>';
					$r .= '<div id="load_section_0">';
						
					$r .= '</div>';
					$r .= '<div class="form-group">';
						$r .= '<label class="col-sm-3 control-label"></label>';
						$r .= '<div class="col-sm-7">';
							$r .= '<input type="submit" class="btn btn-primary" name="submit" value="Submit">';
						$r .= '</div>';
					$r .= '</div>';
				$r .= '</form>';
			$r .= '</div>';
		$r .= '</div>';
			
		echo $r;
	}
	
	public function loadSection($part_id,$rowCount)
	{ 
		$r = '';
		$r .= '<div class="panel panel-primary">';
			$r .= '<div class="panel-heading">';
				$r .= '<div class="caption">';
					$r .= 'Section '.$rowCount; 
				$r .= '</div>';
				$r .= '<div class="tools">';
					$r .= '<a class="accordion-toggle" data-toggle="collapse" href="#section_'.$rowCount.'"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>';
				$r .= '</div>';
			$r .= '</div>';
			$r .= '<div id="section_'.$rowCount.'" class="panel-body form-horizontal in">';
				$r .= '<div class="form-group">';
					$r .= '<label class="col-sm-3 control-label">Image (Min 900X700px)<span class="required">*</span></label>';
					$r .= '<div class="col-sm-7">';
						$r .= '<input type="file" name="image[]" required=""/>';
					$r .= '</div>';
				$r .= '</div>';
				$r .= '<div class="form-group">';
					$r .= '<label class="col-sm-3 control-label">Description</label>';
					$r .= '<div class="col-sm-9">';
						$r .= '<textarea type="text" id="section_description'.$rowCount.'" name="section_description[]" class="form-control ckeditor"></textarea>';
					$r .= '</div>';
				$r .= '</div>';
			$r .= '</div>';
		$r .= '</div>';
		
		$r .= '<script>';
		$r .= 'CKEDITOR.replace( "section_description'.$rowCount.'" );';
		$r .= '</script>';
			
		echo $r;
	}
	
	public function deleteSection($section_id)
	{ 
		$this->d_model->delete('posts_parts_sections','id',$section_id);
		echo 1;
	}
	public function deletePart($part_id)
	{ 
		$this->d_model->delete('posts_parts','id',$part_id);
		$this->d_model->delete('posts_parts_sections','post_part_id',$part_id);
		echo 1;
	}
	
	public function checkCategorySlug()
	{ 
		$cat_id = $_GET['cat_id'];
		$slug = $_GET['slug'];
		$slug_b = $_GET['slug_b'];
		
		$this->db->where('slug',$slug);
		$this->db->where('slug_b',$slug_b);
		if($cat_id){
			$this->db->where('id != ',$cat_id);
		}
		$row = $this->db->get('category')->row();	
		if($row){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	public function checkPostSlug()
	{ 
		$post_id = $_GET['post_id'];
		$slug = $_GET['slug'];
		$slug_b = $_GET['slug_b'];
		
		$this->db->where('slug',$slug);
		$this->db->where('slug_b',$slug_b);
		if($post_id){
			$this->db->where('id != ',$post_id);
		}
		$row = $this->db->get('posts')->row();	
		if($row){
			echo 1;
		}else{
			echo 0;
		}
	}
}

