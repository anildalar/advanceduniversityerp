<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
	//1. Property
	
	
	
	//2. Constructor Area
	public function __construct(){
		parent::__construct();
		
		$this->load->model('University_model');
	}
	
	
	//3. Method
	public function index()
	{
		//echo 'GM';
		$data['total_universities'] = $this->University_model->get();
		
		$this->load->view('layouts/backend/header',$data);
		$this->load->view('layouts/backend/aside_superadmin',$data);
		$this->load->view('superadmin/dashboard',$data);
		$this->load->view('layouts/backend/footer',$data);
	}
}
