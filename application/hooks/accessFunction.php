<?php
class AccessFunction
{
	function initialize(){

	    $ci =& get_instance();
	    /*getting the uri*/
	    $uri = $ci->uri->segment(1)."/".$ci->uri->segment(2);

	    /*getting permissions*/
	    $ci->config->load('permission');
	    $permissions =  $ci->config->item('admin_link');

	    /*is this page under permission?*/
	    $under_permisison = false;
	    foreach($permissions as $perm){
	        if(array_key_exists($uri,$perm)){
	            $under_permisison = true;
	        }
	    }
	    
	    if($under_permisison){
	       /*getting the logged in user's role*/
	       if(!$ci->session->userdata('user')){
	           //$this->output->set_status_header('401','access denied');
	           //echo "access denied";
	           //exit;
	           redirect('administrator/access_denied');
	       }
	       $role = $ci->session->userdata('user')->rid;
	       /*does this role have permission to this url?*/
	        $res = $ci->db->get_where('permissions',array('rid'=>$role, 'perm_url'=>$uri),0,1)->row();
	        if(is_null($res)){
	            //$ci->output->set_status_header('401','access denied');
	            //echo "access denied";
	            //exit;
	            redirect('administrator/access_denied');
	        }
	    }
	}
}