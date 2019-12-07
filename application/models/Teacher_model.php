<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
	
	/**
	* This funtion takes id as a parameter and will fetch the record.
	* If id is not provided, then it will fetch all the records form the table.
	* @param int $id
	* @return mixed
	*/
	
    public function getTeachers($uid) {
        $this->db->select('*')->from('faculties');
        
        $this->db->where('university_id',$uid);
		
		$query = $this->db->get();
		
        return $query->result_array();
    }
    
    /**
    * This function will delete the record based on the id
    * @param $id
    */
    /**
    * This function will take the post data passed from the controller
    * If id is present, then it will do an update
    * else an insert. One function doing both add and edit.
    * @param $data
    */

}
