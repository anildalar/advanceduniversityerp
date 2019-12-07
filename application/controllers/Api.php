<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Base_Controller {
	//1. Property (Variable)
	
	//2. Constructor
	public function __construct(){
		parent::__construct();
		
	}
	
	//3. Method (Function) Area
	public function getTeachers()
	{
		$token = $this->input->get('token');
		$uid = $this->input->get('university_id');
		
		$data = $this->Teacher_model->getTeachers($uid);
		
		echo json_encode($data);
	}
}
