<?php
class LanguageLoader
{

    function initialize() {
    	$ci =& get_instance();
        $ci->load->helper('language');
        
        if(!$ci->session->userdata('site_language')){
			$ci->session->set_userdata('site_language','1');	
		}
        $site_lang = $ci->session->userdata('site_language');
        
        define('SITE_LANG', $site_lang);
        
        if($site_lang=='1') {
			$ci->lang->load('language','bangla');
        }else{
			$ci->lang->load('language','english');
        }
    }
}