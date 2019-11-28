<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stuattendence_model extends MY_Model {
    public function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
	}

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select()->from('student_attendences');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
		$this->db->where('school_id',$this->school_id);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }
    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
			$this->db->where('school_id',$this->school_id);
            $this->db->update('student_attendences', $data); 
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('student_attendences', $data); 
        }
    }
    public function searchAttendenceClassSection($class_id, $section_id, $date) {
		$sql="select student_sessions.attendence_id,students.firstname,student_sessions.date,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students  LEFT JOIN transfer_certificate on students.id=transfer_certificate.student_id  ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id  where student_sessions.student_id=students.id and  transfer_certificate.student_id IS NULL";
		$query = $this->db->query($sql);
        return $query->result_array(); 
    }
    public function searchAttendenceClassSectionPrepare($class_id, $section_id, $date) {
		$sql = "select student_sessions.attendence_id,students.firstname,students.admission_no,student_sessions.date,students.roll_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` RIGHT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=". $this->db->escape($date) ." where  student_session.session_id=". $this->db->escape($this->current_session) ." and student_session.class_id=". $this->db->escape($class_id) ." and student_session.section_id=". $this->db->escape($section_id) .") as student_sessions where student_sessions.student_id=students.id";
		$query = $this->db->query($sql);
		return $query->result_array(); 
    }
	// code by pratyush for get num for sms 
	public function getSmsnum($student_session_id){
		$this->db->select('guardian_phone');    
		$this->db->from('student_session');
		$this->db->join('students', 'student_session.student_id = students.id');
		$this->db->where('student_session.id',$student_session_id);
		$query = $this->db->get();
		return $query->row_array(); 
	}
	public function getSetting(){
		$this->db->select('*');
		$this->db->from('attendence_sms_settings');
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function updateSetting($data,$id){
		$this->db->where('setting_id',$id);
		$this->db->where('school_id',$this->school_id);
        $this->db->update('attendence_sms_settings', $data);
		
	}
	public function getSmsStatus($column_name){
		$this->db->select($column_name);
		$this->db->from('attendence_sms_settings');
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get();
		return $query->row_array(); 
	}
}
