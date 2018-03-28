<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table','form_validation'));
		$this->load->model('front_model','',TRUE);
		
		$this->language = $this->session->userdata('bangla');
    }
    
    public function index()
	{
		$data['title'] = 'Home';
		
		$data['content'] = $this->load->view('home', $data, true);		
		$this->load->view('index',$data);			
	}
	
	public function home_search()
	{
		if($this->language=='bangla'){
			$cat = $this->db->get_where('category',array('id' => $_GET['category_id']))->row()->slug_b;
			$sub_cat = '';
			if($_GET['subcategory_id']){
				$sub_cat = ':'.$this->db->get_where('category',array('id' => $_GET['subcategory_id']))->row()->slug_b;
			}
		}else{
			$cat = $this->db->get_where('category',array('id' => $_GET['category_id']))->row()->slug;
			$sub_cat = '';
			if($_GET['subcategory_id']){
				$sub_cat = ':'.$this->db->get_where('category',array('id' => $_GET['subcategory_id']))->row()->slug;
			}
		}
		
		redirect("c/$cat$sub_cat");
	}
	
	public function post($cats)
	{
		$cats = explode(':',urldecode($cats));
		//print_r($cats);
		$cat_id = $cats[0];
		$sub_cat_id = $cats[1];
		//echo $cat_id;
		
		$cat_lang_id = $this->db->get_where('category',array('slug' => $cat_id))->row()->language_id; 
		if(SITE_LANG!=$cat_lang_id){
			$this->session->set_userdata('site_language',$cat_lang_id);	
			if($sub_cat_id){
				$sub_cat_id = ':'.$sub_cat_id;
			}
			redirect("c/$cat_id$sub_cat_id");
		}
		
		$data['cat_info'] = $this->db->get_where('category',array('slug' => $cat_id))->row();
		$data['sub_cat_info'] = $this->db->get_where('category',array('slug' => $sub_cat_id))->row();
		$this->db->query("UPDATE category SET total_view = total_view + 1 WHERE slug = '$cat_id'");
		if($sub_cat_id){
			$this->db->query("UPDATE category SET total_view = total_view + 1 WHERE slug = '$sub_cat_id'");
		}
		
		if($sub_cat_id){
			$data['title'] = $this->d_model->category_name($sub_cat_id);
		}else{
			$data['title'] = $this->d_model->category_name($cat_id);
		}
		
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
			$limit = 9;
		}
		
		$get = $_GET;
        $data['rows'] = $this->front_model->post_list($cat_id,$sub_cat_id,$get,$sort_by,$order_by,$offset,$limit)->result(); 
        
        $get1 = '';
		foreach($_GET as $key => $value)
		{
			if($key!='per_page'){
				$get1 .= $key.'='.$value.'&';
			}
		}
		$config['base_url'] = site_url("c/$cat_id:$sub_cat_id?$get1");
		$config['total_rows'] = $this->front_model->post_list_all($cat_id,$sub_cat_id,$get);
		$data['total_rows'] = $config['total_rows'];
		
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
        $config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';
	    $config['first_link'] = '&laquo; '.$this->lang->line('First');
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_link'] = $this->lang->line('Last').' &raquo;';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';
	    $config['next_link'] = $this->lang->line('Next').' &rarr;';
	    $config['next_tag_open'] = '<li class="next page">';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '&larr; '.$this->lang->line('Previous');
	    $config['prev_tag_open'] = '<li class="prev page">';
	    $config['prev_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li class="page">';
	    $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
		
		$data['content'] = $this->load->view('posts', $data, true);		
		$this->load->view('index',$data);			
	}
	
	public function post_detail($post_id)
	{
		$data['post_slug'] = $post_id;
		$data['post'] = $this->d_model->table_row('posts','slug',urldecode($post_id))->row();
		
		if(SITE_LANG!=$data['post']->language_id){
			$this->session->set_userdata('site_language',$post_lang_id);	
			redirect('p/'.$post_id);
		}
		
		$post_id = $data['post']->id;
		
		$add['post_id'] = $post_id;
		$add['date'] = date('Y-m-d');
		$this->d_model->add('posts_view',$add);
		
		$data['title'] = $data['post']->post_title;
		
		$data['parts'] = $this->d_model->table_row('posts_parts','post_id',$post_id)->result();
		
		$data['slider'] = $this->front_model->post_slider($post_id)->result();
		
		$data['related'] = $this->front_model->post_related($data['post']->category_id,$post_id)->result();
		$data['summary'] = $this->d_model->table_row('posts_summary','post_id',$post_id)->result();

		$data['comments'] = $this->front_model->post_comments($post_id)->result();
		
		/*--Facebook Share--*/
		$description = $data['post']->description; 
		
		$data['og_url'] = base_url('p/'.$data['post_slug']);
		$data['og_type'] = base_url();
		$data['og_title'] = 'Wiki Bangla | '.$data['title'];
		$data['og_site_name'] = 'Wiki Bangla';
		$data['og_description'] = $description;
		$data['og_image'] = base_url('uploads/featured/'.$data['post']->featured_image);
		/*--End Facebook Share--*/

		$this->db->select('tag_name');
		$this->db->join('tags','tags.id=posts_tags.tag_id');
		$this->db->where('post_id',$data['post']->id);
		$tag_active = $this->db->get('posts_tags')->result();
		$tag_list_active = '';
		foreach($tag_active as $t => $tag_ac){
			if($t==COUNT($tag_active)-1){
				$tag_list_active .= $tag_ac->tag_name;
			}else{
				$tag_list_active .= $tag_ac->tag_name.",";
			}
		}
		$data['keywords'] = $tag_list_active;
        $data['sub_cats'] = $this->db->get('category')->result();

        $userAgent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$userAgent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($userAgent,0,4))) {
            $data['content'] = $this->load->view('amp/post-detail', $data, true);
            $this->load->view('amp/index',$data);
        } else{
            $data['content'] = $this->load->view('post-detail', $data, true);
            $this->load->view('index',$data);
        }
	}
	
	public function add_comment()
	{
		$add = array(
			'post_id' => $_GET['post_id'],
			'comment' => $_GET['comment'],
			'created' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('user')->uid,
			'status' => 'publish'
	    );				
	    $this->d_model->add('posts_comment',$add);
	    
	    echo '<div class="media"><h5>'.$this->session->userdata('user')->fullname.'</h5><div class="media-body"><p>'.$_GET['comment'].'</p></div></div>';
	}
	
	public function updateLike($post_id)
	{
		if($this->session->userdata('user')){
			$user_id = $this->session->userdata('user')->uid;
			
			$this->db->where('user_id',$user_id);
			$this->db->where('post_id',$post_id);
			$row = $this->db->get('posts_like')->row();
			if($row){
				$r = 'already';
			}else{
				$add = array(
					'post_id' => $post_id,
					'user_id' => $user_id
			    );				
			    $this->d_model->add('posts_like',$add);
			    
			    $this->db->select('COUNT(id) as total');
				$this->db->where('post_id',$post_id);
				$r = $this->db->get('posts_like')->row()->total;
			}
		}else{
			$r = 'login';
		}
		echo $r;
	}
	
	
	public function page($page_id)
	{
		$data['row'] = $this->d_model->table_row('page','id',$page_id)->row();
		$data['title'] = ($this->session->userdata('bangla')=='bangla')? $data['row']->title_bn:$data['row']->title;
		
		$data['content'] = $this->load->view('page_detail_view', $data, true);	
		$this->load->view('index',$data);			
	}
	
	public function search()
	{
		$data['title'] = $this->lang->line('Search');
		
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
			$limit = 9;
		}
		
		$get = $_GET;
        $data['rows'] = $this->front_model->search_list($get,$sort_by,$order_by,$offset,$limit)->result(); 
        
        $get1 = '';
		foreach($_GET as $key => $value)
		{
			if($key!='per_page'){
				$get1 .= $key.'='.$value.'&';
			}
		}
		$config['base_url'] = site_url("search?$get1");
		$config['total_rows'] = $this->front_model->search_list_all($get);
		$data['total_rows'] = $config['total_rows'];
		
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
        $config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';
	    $config['first_link'] = '&laquo; '.$this->lang->line('First');
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_link'] = $this->lang->line('Last').' &raquo;';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';
	    $config['next_link'] = $this->lang->line('Next').' &rarr;';
	    $config['next_tag_open'] = '<li class="next page">';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '&larr; '.$this->lang->line('Previous');
	    $config['prev_tag_open'] = '<li class="prev page">';
	    $config['prev_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li class="page">';
	    $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
		
		$data['content'] = $this->load->view('search', $data, true);		
		$this->load->view('index',$data);			
	}
	
	public function about_us()
	{
		$data['title'] = $this->lang->line('About us');
		
		$data['content'] = $this->load->view('about_us', $data, true);	
		$this->load->view('index',$data);			
	}
	public function contact_us()
	{
		$data['title'] = $this->lang->line('Contact us');
		
		$data['content'] = $this->load->view('contact_us', $data, true);	
		$this->load->view('index',$data);			
	}
	
	public function subscribe()
	{
		if($_POST['submit']){
			$row = $this->d_model->table_row('subscribe','email',$_POST['email'])->row();
			if($row){
				$this->session->set_flashdata('success-message', 'You have already subscribed.');
			}else{
				$data['email'] = $_POST['email'];
				$this->d_model->add('subscribe',$data);
				
				$this->session->set_flashdata('success-message', 'Your email has been submitted successfully.');
			}
			
			redirect($_POST['url']);
		}else{
			redirect();
		}		
	}
	
	public function signup()
	{
		if($this->session->userdata('user')){
			redirect();
		}
		$data['title'] = 'Signup';
		
		if($_POST['submit']){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];
			
			$row = $this->d_model->table_row('users','email',$email)->row();
			if($row){
				$this->session->set_flashdata('warning-message', 'Email already taken.');
			}else if($password!=$confirm_password){
				$this->session->set_flashdata('warning-message', 'Password not match.');
			}else{
				$add['rid'] = '2';
				$add['status'] = '1';
				$add['fullname'] = $name;
				$add['email'] = $email;
				$add['password'] = MD5($password);
				$this->d_model->add('users',$add);
				
				$this->session->set_flashdata('success-message', 'Registration successful, please log in.');
				redirect('front/login?url=');
			}
		}
		
		$data['content'] = $this->load->view('signup', $data, true);	
		$this->load->view('index',$data);			
	}
	
	public function login()
    {
    	if($this->session->userdata('user')){
			redirect();
		}
    	$data['title']='Login';
    	
    	if($this->input->post('login')){
	        $email = $this->input->post('email',true);
	        $password = $this->input->post('password',true);
	        $result = $this->front_model->login($email,$password);       
	        if($result) {           
	            $sesData['user']=$result;
	            $this->session->set_userdata($sesData);	
	            $user = $this->session->userdata('user');
	            $data = array(
					'last_login' => date("Y-m-d H:i:s")
				);	
	            $this->d_model->edit('users','uid',$user->uid,$data); 
	            redirect($this->input->post('url'));
	        } else {
	            $this->session->set_flashdata('warning-message', 'Email Or Password Invalid!');
	        }
        }
        
        $data['content'] = $this->load->view('login', $data, true);	
		$this->load->view('index',$data);
    }
    
    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect($_GET['url']);
    }
    
    public function forgot_password()
	{
		$data['title']='Forgot Password';
		
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
						<a href="'.base_url().'front/passwordreset?id='.$row->uid.'&email='.$row->email.'" >Reset Password</a>
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
		     redirect('front/forgot_password');	
		} 	 
		
		$data['content'] = $this->load->view('forgot_password', $data, true);	
		$this->load->view('index',$data);	
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
				redirect('front/login?url=');
			}else{
				$this->session->set_flashdata('warning-message', 'Password not match.'); 
				redirect('front/passwordreset?id='.$id.'&email='.$email);
			}
		}

		$data['content'] = $this->load->view('passwordreset', $data, true);	
		$this->load->view('index',$data);
	}
	
	public function profile()
	{
		if(!$this->session->userdata('user')){
			redirect();
		}
		$data['title']='My Profile';
		
		$user = $this->session->userdata('user');

		$data['row'] = $this->d_model->table_row('users','uid',$user->uid)->row();

		$data['content'] = $this->load->view('profile', $data, true);	
		$this->load->view('index',$data);
	}
	
	public function change_password()
	{
		if(!$this->session->userdata('user')){
			redirect();
		}
		
		$data['title']='Change Password';
		
		if($this->input->post('submit')){
			$user = $this->session->userdata('user');
			
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$uid = $user->uid;

			if($password==$confirm_password){
				$update = array(
					'password' => MD5($password)
				);
				$this->d_model->edit('users','uid',$uid,$update);
				
				$this->session->set_flashdata('success-message', 'Your password has been changed successfully.');
			}else{
				$this->session->set_flashdata('warning-message', 'Password not match.'); 
			}
			redirect('front/change_password');
		}

		$data['content'] = $this->load->view('change_password', $data, true);	
		$this->load->view('index',$data);
	}
	
	public function privacy_policy()
	{
		$data['title']='Privacy Policy';

		$data['content'] = $this->load->view('privacy_policy', $data, true);	
		$this->load->view('index',$data);
	}
	
	public function archive()
	{
		$data['title'] = $this->lang->line('Archive');
		
		$get = $_GET;
        $data['rows'] = $this->front_model->archive_category()->result(); 
		
		$data['content'] = $this->load->view('archive', $data, true);		
		$this->load->view('index',$data);			
	}	
	public function archive_detail()
	{
		$data['title'] = $this->lang->line('Archive Details');
		
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
			$limit = 12;
		}
		
		$get = $_GET;
        $data['rows'] = $this->front_model->archive_detail($get,$sort_by,$order_by,$offset,$limit)->result(); 
        
        $get1 = '';
		foreach($_GET as $key => $value)
		{
			if($key!='per_page'){
				$get1 .= $key.'='.$value.'&';
			}
		}
		$config['base_url'] = site_url("archive/detail?$get1");
		$config['total_rows'] = $this->front_model->archive_detail_all($get);
		$data['total_rows'] = $config['total_rows'];
		
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
        $config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';
	    $config['first_link'] = '&laquo; '.$this->lang->line('First');
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_link'] = $this->lang->line('Last').' &raquo;';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';
	    $config['next_link'] = $this->lang->line('Next').' &rarr;';
	    $config['next_tag_open'] = '<li class="next page">';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '&larr; '.$this->lang->line('Previous');
	    $config['prev_tag_open'] = '<li class="prev page">';
	    $config['prev_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li class="page">';
	    $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
		
		$data['content'] = $this->load->view('archive_detail', $data, true);		
		$this->load->view('index',$data);			
	}
	
}

