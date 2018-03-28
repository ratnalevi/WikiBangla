<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		
		$this->rid = $this->session->userdata('user')->rid;
    }
    
    public function check_username(){
		$get = $_GET;	
		$this->user_model->check_username($get);			
	}
	
	public function my_profile()
	{
		$data['title'] = 'My Profile';
           
        if ( $this->input->post('submit')) {
            $post = $this->input->post();   

			$data = array(
				'fullname' => $post['fullname'],
				'username' => $post['username'],
				'email' => $post['email'],
				'designation' => $post['designation']
		    );				
		    $this->user_model->user_edit($this->uid,$data);
		    $this->session->set_flashdata('success-message', 'Profile has been updated successfully.');
			redirect('profile/my_profile/');		
		}else{
			$data['user'] = $this->user_model->user_id($this->uid)->row();
		}	 	

		$data['content'] = $this->load->view('admin/profile/my_profile', $data, true);		
		$this->load->view('admin/includes/index',$data);			
	}
	
	public function change_password()
	{
		$data['title'] = 'Change Password';

        if ( $this->input->post('submit')) {
            $old_password = $this->input->post('old_password');   
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            
            $user = $this->user_model->user_id($this->uid)->row();
            if($user->password==MD5($old_password)){
				$status_1 = 1;
			}else{
				$status_3 = 3;
			}
			if($new_password==$confirm_password){
				$status_2 = 2;
			}else{
				$status_4 = 4;
			}
			
			if($status_1==1 && $status_2==2){
				$data = array(
					'password' => MD5($new_password)
			    );				

			    $this->user_model->user_edit($this->uid,$data);
			    $this->session->set_flashdata('success-message', 'Password has been changed successfully.');		
			}else{
				if($status_3==3){
					$this->session->set_flashdata('warning-message', 'Old password wrong');
				}elseif($status_4==4){
					$this->session->set_flashdata('warning-message', 'Password not match');
				}
			}
			redirect('profile/change_password');	
		}
		
		$data['content'] = $this->load->view('admin/profile/change_password', $data, true);		
		$this->load->view('admin/includes/index',$data);
	}
	
	

}

