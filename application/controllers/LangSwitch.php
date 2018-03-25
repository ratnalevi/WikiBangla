<?php
class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'path'));
		$this->load->library('session');
    }
 
    function switchLanguage_old($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('bangla', $language);
		redirect($_GET['redirect']);
    }
    
    function switchLanguage($language_id) {
        $this->session->set_userdata('site_language', $language_id);
        redirect($_GET['redirect']);
    }
	  
}