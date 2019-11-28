<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Base_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('customlib');
	}
	public function index()
	{
		//$this->customlib->setUserLog($username, $result[0]->role,$result[0]->school_id);
		$this->load->view($this->current_theme.'/home');
	}
}
