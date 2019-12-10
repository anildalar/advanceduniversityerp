<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Licence_Controller {
	//1. Property (Variable)
	public $domain_name;
	public $token;
	//2. Constructor
	public function __construct(){
		parent::__construct();
		$this->domain_name = $this->input->get('domain_name');
		$this->token = $this->input->get('token');
		
		$this->checkLicence($this->domain_name);
	}
	
	
	
	//3. Method (Function) Area
	public function index()
	{
	}
	
	public function getUniversity(){
		
		
		echo 'Hello';
	}
	public function getStudents(){
	
		
		$data = $this->Student_model->getStudents($this->univid);
		
		echo json_encode($data);
		
	}
	
}
