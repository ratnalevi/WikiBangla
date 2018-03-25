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
						$r .= '<label class="col-sm-3 control-label">Part Title (English)<span class="required">*</span></label>';
						$r .= '<div class="col-sm-7">';
							$r .= '<input type="text" name="part_title_en" class="form-control" value="" required=""/>';
						$r .= '</div>';
					$r .= '</div>';
					$r .= '<div class="form-group">';
						$r .= '<label class="col-sm-3 control-label">Part Title (Bangla)</label>';
						$r .= '<div class="col-sm-7">';
							$r .= '<input type="text" name="part_title_bn" class="form-control" value=""/>';
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
					$r .= '<label class="col-sm-3 control-label">Section Title (English)<span class="required">*</span></label>';
					$r .= '<div class="col-sm-7">';
						$r .= '<input type="text" name="section_title_en[]" class="form-control" value="" required=""/>';
					$r .= '</div>';
				$r .= '</div>';
				$r .= '<div class="form-group">';
					$r .= '<label class="col-sm-3 control-label">Section Title (Bangla)</label>';
					$r .= '<div class="col-sm-7">';
						$r .= '<input type="text" name="section_title_bn[]" class="form-control" value=""/>';
					$r .= '</div>';
				$r .= '</div>';
				$r .= '<div class="form-group">';
					$r .= '<label class="col-sm-3 control-label">Shot Description (English)</label>';
					$r .= '<div class="col-sm-7">';
						$r .= '<textarea type="text" name="section_shot_description_en[]" class="form-control"></textarea>';
					$r .= '</div>';
				$r .= '</div>';
				$r .= '<div class="form-group">';
					$r .= '<label class="col-sm-3 control-label">Shot Description (Bangla)</label>';
					$r .= '<div class="col-sm-7">';
						$r .= '<textarea type="text" name="section_shot_description_bn[]" class="form-control"></textarea>';
					$r .= '</div>';
				$r .= '</div>';
				$r .= '<div class="form-group">';
					$r .= '<label class="col-sm-3 control-label">Description (English)</label>';
					$r .= '<div class="col-sm-9">';
						$r .= '<textarea type="text" id="section_description_en'.$rowCount.'" name="section_description_en[]" class="form-control ckeditor"></textarea>';
					$r .= '</div>';
				$r .= '</div>';
				$r .= '<div class="form-group">';
					$r .= '<label class="col-sm-3 control-label">Description (Bangla)</label>';
					$r .= '<div class="col-sm-9">';
						$r .= '<textarea type="text" id="section_description_bn'.$rowCount.'" name="section_description_bn[]" class="form-control ckeditor"></textarea>';
					$r .= '</div>';
				$r .= '</div>';
			$r .= '</div>';
		$r .= '</div>';
		
		$r .= '<script>';
		$r .= 'CKEDITOR.replace( "section_description_en'.$rowCount.'" );';
		$r .= 'CKEDITOR.replace( "section_description_bn'.$rowCount.'" );';
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
}

