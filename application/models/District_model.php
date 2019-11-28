<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class District_model extends MY_Model {
    public function __construct() {
        
	}

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
	public function getStudents($school_id=null,$gender=null,$rte=null){
		$this->db->select();
		$this->db->from('students');
		$this->db->where('school_id',$school_id);
		if ($gender != null) {
			$this->db->where('gender',$gender);
		}
		if ($rte != null) {
			$this->db->where('rte',$rte);
		}
		$result = $this->db->get();
		//return $this->db->last_query();
		return $result->result_array();

        
	}
	public function getCurrentSessionBySchoolId($school_id){
        return $this->db->select('session_id')->get_where('sch_settings',array('school_id'=>$school_id))->row()->session_id;
    }

	 public function searchByGenderRte($school_id,$session_id, $gender = null, $rte = null,$category = null) {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,students.permanent_address,students.category_id, categories.category,   students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.mother_name,students.mother_phone,students.rte,students.gender,students.bank_account_no,students.bank_name,students.ifsc_code,blood_group')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id','left');
        $this->db->join('classes', 'student_session.class_id = classes.id','left');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->where('student_session.session_id', $session_id);
        if ($gender != null) {
            $this->db->where('students.gender', $gender);
        }
        if ($rte != null) {
            $this->db->where('students.rte', $rte);
        }
        if ($category != null) {
            $this->db->where('students.category_id', $category);
        }
		$this->db->where('students.school_id', $school_id);
        $this->db->order_by('classes.id');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    public function getTeacherBySchoolid($school_id)
    {
    	$this->db->select();
    	$this->db->from('teachers');
    	$this->db->where('school_id',$school_id);
    	$query = $this->db->get();
    	return $query->result_array();
    }
	
	
}
