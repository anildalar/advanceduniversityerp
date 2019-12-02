<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends Base_Controller {
	//1. Property (Variable)
	
	//2. Constructor
	public function __construct(){
		parent::__construct();
		//$this->load->library('customlib');
		//$this->load->model('News_model');
	}
	
	//3. Method (Function) Area
	public function getTeachers()
	{
		echo 'Hello Good Morning';
	}
}
