<?php 
class User_model extends CI_Model {
	
	private $table_user = 'users';
	private $table_roles = 'roles';
	private $table_perm = 'permissions';
	
	function __construct() {
		parent::__construct();
	}
	
	public function check_username($get) { 
		$username = $get['username'];
		$email = $get['email'];
		
		$this->db->select('username');
		$this->db->where('username', $username);
		if($get['user_id']){
			$this->db->where('uid != ', $get['user_id']);
		}
		$user = $this->db->get($this->table_user)->row();
		if($user)
		{
			$username1 = $user->username;
		}else{
			$username1 = '';
		}
		
		$this->db->select('email');
		$this->db->where('email', $email);
		if($get['user_id']){
			$this->db->where('uid != ', $get['user_id']);
		}
		$user1 = $this->db->get($this->table_user)->row();
		if($user1)
		{
			$email1 = $user1->email;
		}else{
			$email1 = '';
		}

		if($username1 == $username){
			echo '1';	
		}else if($email1 == $email){
			echo '2';
		}else {
			echo '0';
		}
	}
    
    public function user_add($data){
		$this->db->insert($this->table_user, $data);
		return $this->db->insert_id();
	}
	
	public function user_id($id){
		$this->db->where('uid', $id);
		return $this->db->get($this->table_user);  
	}
	
	public function user_edit($id,$data){
		$this->db->where('uid', $id);
		return $this->db->update($this->table_user,$data);  
	}
    public function user_list(){
	
    	$this->db->select('users.*,roles.role_name');
    	$this->db->join('roles', 'roles.id = users.rid','left');
    	$this->db->order_by('users.uid', 'DESC');
		return $this->db->get($this->table_user);  
	}
	
	public function role_load(){
		return $this->db->get('roles');  
	}	
	
	public function role_list(){
		return $this->db->get($this->table_roles);  
	}
	
	public function role_add($data){
		$this->db->insert($this->table_roles, $data);
		return $this->db->insert_id();
	}
	
	public function role_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->table_roles);  
	}
	
	public function role_update($id,$data){
		$this->db->where('id', $id);
		return $this->db->update($this->table_roles,$data);  
	}
	
	function permission_insert_batch($data){ 
        $this->db->delete($this->table_perm, array('rid' => $data[0]['rid'])); 
        $this->db->insert_batch($this->table_perm,$data);
        //echo $this->db->last_query();
	}
	
	function permission_load_permission_only($rid){
		$this->db->where('rid',$rid);
		$perms = $this->db->get($this->table_perm)->result();
                //print_r($perms); 
                $rows = null;
                foreach ($perms as $perm) {
                    $rows[$perm->perm_url] = $perm->rid;
                }
                return $rows;
                
	}
	
	function permission_has_permission($uri){
		//global $user;
		//echo $uri; 
		$user = $this->session->userdata('user');
		if($user){
			$perms = $this->permission_load_permission_only($user->role_id); 
                        //print_r($perms); exit;
			list($controller,$op) = explode('/', $uri);                         
			$return = FALSE;
			if(is_array($perms)){
				if (array_key_exists("$controller/$op", $perms)) $return = TRUE;
			}                     
			return $return;
		}else{
			redirect('welcome');
		}
	} 
	
}