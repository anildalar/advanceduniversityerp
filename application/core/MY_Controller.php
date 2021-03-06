<?php
class Licence_Controller extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		
	}
	public function checkLicence($domain_name){
		$data = $this->University_model->getByDomain($domain_name);
		$cur_date = strtotime(date('Y-m-d'));
		$exp_date = strtotime($data['licence_expire_at']);//Unix Time Stamp
		if($cur_date > $exp_date){
			die;
		}
		
	}
}
class Base_Controller extends CI_Controller 
{
	public $user_id;
	public $current_domain;
	public $current_theme;
	public $university_info;
	
	function __construct()
	{
		parent::__construct();
		$lc = new Licence_Controller();
		//$lc->checkLicence($uid);
		
		$this->current_domain = $_SERVER['HTTP_HOST'];
		
		if( $this->MY_Model->checkValidDomain($this->current_domain) == false ){
			echo '<div style="text-align:center;">Site Not Activated. Please Contact to system Admin.</div>';die;
		}
		
		$theme = $this->MY_Model->getCurrentTheme($this->current_domain);
		$this->current_theme = $theme[0]->university_theme;
		$this->university_info = $theme[0];
		
	}
}
class Admin_Controller extends Base_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		
	}	
}

