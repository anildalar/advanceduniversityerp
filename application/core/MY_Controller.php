<?php
class Base_Controller extends CI_Controller 
{
	public $user_id;
	public $current_domain;
	
	function __construct()
	{
		parent::__construct();
		$this->current_domain = $_SERVER['HTTP_HOST'];
		
		if( $this->MY_Model->checkValidDomain($this->current_domain) == false ){
			echo '<div style="text-align:center;">Site Not Activated. Please Contact to system Admin.</div>';die;
		}
	}
}
class Admin_Controller extends Base_Controller 
{
	
	function __construct()
	{
		parent::__construct();
	}	
}
