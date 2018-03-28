<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url', 'xml', 'text'));
    }
    
    public function index()
	{
		$data['feed_name'] = 'Wiki Bangla Publisher';
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = base_url();
        $data['page_description'] = 'Wiki Bangla wikibangla.info newspaper,news paper,bd newspaper, bangla news, bangla newspaper';
        $data['page_language'] = 'en-us';
        $data['creator_email'] = 'mail@wikibangla.info';
        
        $this->db->select('id,slug_b as slug,title_bn,description_bn,created,updated');
        $this->db->where('status','Publish');
        $this->db->order_by('id','desc');
    	$this->db->limit(15);
        $data['posts'] = $this->db->get('posts')->result(); 
        
        header("Content-Type: application/xml");
         
        $this->load->view('rssfeeds', $data);			
	}
	
}

