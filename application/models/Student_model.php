<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends MY_Model {
    public function __construct() {
        parent::__construct();
		//$this->current_session = $this->setting_model->getCurrentSession();
       // $this->current_date = $this->setting_model->getDateYmd();
	}

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function getStudents($univid) { //$univid is formal Argument
		//2. Build The Query
		
        $this->db->select('student_name,stu_enroll_no')->from('students');
       
        $this->db->where('university_id', $univid);
        
		//3. Execute the query
        $query = $this->db->get();
		
		//4. Return the result
        return $query->result_array(); 
    }
	
	
	
	
	

}
