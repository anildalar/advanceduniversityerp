<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Base_Controller {
	//1. Property (Variable)
	
	//2. Constructor
	public function __construct(){
		parent::__construct();
		
	}
	
	//3. Method (Function) Area
	public function index()
	{
	}
	
	public function getUniversity(){
		
		
		echo 'Hello';
	}
	public function getStudents(){
		
		//echo $_GET['token'];
		$token =  $this->input->get('token');
		$univid = $this->input->get('university_id');
		
		$data = $this->Student_model->getStudents($univid);
		
		echo json_encode($data);
		
	}
	
}
