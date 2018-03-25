<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table','form_validation'));
		//$this->load->model('dashboard_model','',TRUE);
			
		if(!$this->session->userdata('user')){
			redirect("zadmin");	
		}
    }
    
    public function index()
	{
		$data['title'] = 'Dashboard';	

		$data['content'] = $this->load->view('admin/dashboard/dashboard', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}
}

