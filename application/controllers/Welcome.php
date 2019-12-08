<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Base_Controller {
	//1. Property (Variable)
	
	//2. Constructor
	public function __construct(){
		parent::__construct();
		$this->load->library('customlib');
		$this->load->model('News_model');
	}
	
	//3. Method (Function) Area
	public function index()
	{
		//echo '<pre>';
		
		$data['university_info'] = $this->university_info;
		$data['university_info']->domain_type;
		$data['university_news'] = $this->News_model->get();
		
		$this->load->view($data['university_info']->domain_type.'/'.$this->current_theme.'/home',$data);
	}
}
