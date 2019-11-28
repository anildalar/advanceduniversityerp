<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Base_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('customlib');
	}
	public function index()
	{
		$data['university_info'] = $this->university_info;		
		$this->load->view($this->current_theme.'/home',$data);
	}
}
