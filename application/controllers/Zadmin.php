<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zadmin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table','form_validation'));
		$this->load->model('administrator_model','',TRUE);
    }
    
    public function access_denied(){
        $data['title'] = 'Access denied';  
         
        $data['content'] = $this->load->view('admin/users/access_denied', $data, true);		
		$this->load->view('admin/includes/index',$data);	             
    } 
    
	public function index()
	{
		$data=array();
        if($this->session->userdata('user')) {		
			redirect("dashboard");			
		} else {
		   	$data['title'] = 'Login';
			$this->load->view('admin/users/login',$data);		
		}		
	}
	
	public function user_login()
    {
	 	$data=array();
        $username = $this->input->post('email',true);
        $password = $this->input->post('password',true);
        $result = $this->administrator_model->user_login($username,$password);       
        if($result) {           
            $sesData['user']=$result;
            $this->session->set_userdata($sesData);	
            $user = $this->session->userdata('user');
            $data = array(
				'last_login' => date("Y-m-d H:i:s")
			);	
            $this->administrator_model->user_update($user->uid,$data); 
        } else {
			$data['title']='Login';
            $this->session->set_flashdata('warning-message', 'Email Or Password Invalid!');
        }
        redirect('zadmin');
    }
    
    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect("zadmin");
    }
    
    public function forgot_password()
	{
        if ( $this->input->post('submit')) {
            $post = $this->input->post(); 

			$row = $this->d_model->table_row('users','email',$post['email'])->row();
			if($row){
				
				$form = 'ziaur.sami@gmail.com';
				$to = $post['email'];
				$subject ='Woops. Did you forget your password?';

				$headers = "From: Wiki Bangla ".$form."\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				$message = '<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>
				<body style="background-color:#F7F7F7;">
				<table align="center" cellpadding="5px" cellspacing="0" width="80%" style="background-color:#FFF;">
				<tr style="background-color:#4EC67F; color:#FFF;">
				<th><img width="120" src="'.base_url().'images/logo.png" /></th>
				<th> Did you forget your password ?</th>
				</tr>
				<tr>
					<td colspan="2" style=" border-top: 1px solid #0F9; padding-top:10px;">
				    <p>Hi '.$row->fullname.',</p>
					<p>It looks like you`ve forgotten your password. We`ve decided to be really nice and let you create a new one!</p>
					<p>Please click on the button below to Reset Password.</p>
				    </td> 
				    <tr>
				    <td colspan="2" style="text-align:center;">
				   		 <span style="background-color: #4EC67F; text-align:center; padding:10px 20px;border-radius: 7px; color: white;">
						<a href="'.base_url().'zadmin/passwordreset?id='.$row->uid.'&email='.$row->email.'" >Reset Password</a>
						</span>
				    </td>
				    </tr>
				    <tr>
				    <td>
				   		Kind Regards       
				        <br/>
				        <br/>
				    </td>
				    </tr> 
				</table>
				</body>
				</html>';

				mail($to, $subject, $message, $headers);
				
				$this->session->set_flashdata('success-message', 'An email has been sent to you.'); 
			}else{
				$this->session->set_flashdata('warning-message', 'User with this Email doesn`t exists.'); 
		    }		
		     redirect('zadmin/forgot_password');	
		} 	 
		$this->load->view('admin/users/forgot_password',$data);			
	}
	
	public function passwordreset()
	{
		$data['title']='Reset password';

		if($this->input->post('submit')){
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$id = $this->input->post('uid');
			$email = $this->input->post('email');

			if($password==$confirm_password){
				$update = array(
					'password' => MD5($password)
				);
				$this->d_model->edit('users','uid',$id,$update);
				
				$this->session->set_flashdata('success-message', 'Your password has been changed successfully.');
				redirect('zadmin');
			}else{
				$this->session->set_flashdata('warning-message', 'Password not match.'); 
				redirect('zadmin/passwordreset?id='.$id.'&email='.$email);
			}
		}

		$this->load->view('admin/users/passwordreset',$data);
	}
}
