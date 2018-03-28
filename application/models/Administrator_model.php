<?php 
class Administrator_model extends CI_Model {
	
	private $primary_key = 'uid';
	private $table_user = 'users';
	
	function __construct() {
		parent::__construct();
	}
	
	public function user_login($username,$password) {
        $this->db->where('email',$username);
        $this->db->where('password',md5($password));
		$this->db->where('rid','1');	
		$this->db->where('status','1');		
        return $this->db->get($this->table_user)->row();      
    }
    
    public function user_update($id,$data){
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_user,$data);
	}
	
}