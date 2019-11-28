<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		$this->load->library('customlib');
	}
	public function index()
	{
		$this->customlib->setUserLog($username, $result[0]->role,$result[0]->school_id);
		$this->load->view('superadmin/login');
	}
}
