<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table','form_validation'));
		$this->load->model('user_model','',TRUE);
			
		if(!$this->session->userdata('user')){
			redirect("zadmin");	
		}
		
		$this->uid = $this->session->userdata('user')->uid;
    }
    
    public function check_username(){
		$get = $_GET;	
		$this->user_model->check_username($get);			
	}

	public function user_list()
	{
		$data['title'] = 'Users';
        $data['users'] = $this->user_model->user_list()->result(); 

		$data['content'] = $this->load->view('admin/users/user_list', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}

	

	public function user_add()
	{
		$data['title'] = 'Add New User';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 

			$data = array(
				'fullname' => $post['fullname'],
				//'username' => $post['username'],
				'rid' => $post['rid'],
				'password' => MD5($post['password']),
				'email' => $post['email'],
				'designation' => $post['designation'],
				'status' => $post['status']
		    );				
		    $id = $this->user_model->user_add($data);
		    $this->session->set_flashdata('success-message', 'User has been added successfully.');
			redirect('user/user_list/');			
		} 	 	

		$data['content'] = $this->load->view('admin/users/user_add', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}

	public function user_update($id)
	{
		$data['title'] = 'Update User';
           
        if ( $this->input->post('submit')) {
            $post = $this->input->post();   

			$data = array(
				'fullname' => $post['fullname'],
				'rid' => $post['rid'],
				//'email' => $post['email'],
				'designation' => $post['designation'],
				'status' => $post['status']
		    );				
		    $this->user_model->user_edit($id,$data);
		    $this->session->set_flashdata('success-message', 'User has been updated successfully.');
			redirect('user/user_list/');		
		}else{
			$data['user'] = $this->user_model->user_id($id)->row();
		}	 	

		$data['content'] = $this->load->view('admin/users/user_add', $data, true);		
		$this->load->view('admin/includes/index',$data);				
	}

	public function user_delete($id)
	{
		$this->db->where('uid', $id);
		$this->db->delete('users'); 
		redirect('user/user_list/');		
	}

	public function role_list()
	{
		$data['title'] = 'Roles';

        $data['roles'] = $this->user_model->role_list()->result(); 

		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/users/role_list', $data);
		$this->load->view('admin/includes/footer',$data);			
	}

	public function role_add()
	{
		$data['title'] = 'Role Add';

        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 

			$data = array(
				'role_name' => $post['role_name'],
				'status' => $post['status']
		    );				
		    $id = $this->user_model->role_add($data);
			redirect('user/role_list/');			
		} 

		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/users/role_add', $data);
		$this->load->view('admin/includes/footer',$data);			
	}

	public function role_update($id)
	{
		$data['title'] = 'Role Update';

        if ( $this->input->post('submit')) {
            $post = $this->input->post();   
			$data = array(
				'role_name' => $post['role_name'],
				'status' => $post['status']
		    );				
		    $this->user_model->role_update($id,$data);
			redirect('user/role_list/');		
		}else{
			$data['role'] = $this->user_model->role_id($id)->row();
		}	 	

		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/users/role_add', $data);
		$this->load->view('admin/includes/footer',$data);				
	}

	public function role_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('roles'); 
		redirect('user/role_list/');		
	}

	public function permission($rid)
	{
		$data['title'] = 'Manage Permission';
        $data['rid'] = $rid;
        $data['action'] = 'user/permission/' . $rid;    
        $data['controllers'] =  $this->config->item('admin_link');            
        $data['db_controllers'] = $this->user_model->permission_load_permission_only($rid);
        
        if ($this->input->post('submit')){        
            $post = $this->input->post();
            $rid = $post['rid'];
            //echo 'hi'; exit;
            foreach ($data['controllers'] as $controller=>$value) {  
                if (!empty($post["$controller"])){
                   foreach ($post["$controller"] as $op) {                             
                        //if (array_key_exists($op, $post[$controller])){
                            $insert[] = array(
                                'rid'=>$rid,
                                'perm'=> $controller,
                                'perm_url'=>$op
                            ); 
                        //}                                
                     }
               }
            }
              //print_r($insert); exit;       
            $this->user_model->permission_insert_batch($insert); 
            redirect ('user/permission/'.$rid);      
        } 
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/users/permission', $data);
		$this->load->view('admin/includes/footer',$data);			
	}

}

