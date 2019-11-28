<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam_model extends MY_Model {
    public function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select()->from('exams');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
		$this->db->where('school_id', $this->school_id);
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
    public function remove($id) {
        $this->db->where('id', $id);
		$this->db->where('school_id',$this->school_id);
        $this->db->delete('exams');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
			$this->db->where('school_id',$this->school_id);
            $this->db->update('exams', $data); 
        } else {
			$data['school_id']=$this->school_id;
			$data['sesion_id']= $this->current_session;
            $this->db->insert('exams', $data); 
            return $this->db->insert_id();
        }
    }

    function add_exam_schedule($data) {       
        $this->db->where('exam_id', $data['exam_id']);
        $this->db->where('teacher_subject_id', $data['teacher_subject_id']);
        $this->db->where('school_id',$this->school_id);
		$q = $this->db->get('exam_schedules');
        if ($q->num_rows() > 0) {
            $result = $q->row_array();
            $this->db->where('id', $result['id']);
			$this->db->where('school_id',$this->school_id);
            $this->db->update('exam_schedules', $data);
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('exam_schedules', $data);
        }
    }
	function getSchedule($id){
		
		$this->db->select();
		$this->db->from('questions_paper');
		$this->db->where('id',$id);
		$q = $this->db->get();
		$result = $q->row_array();
		$rows = $q->num_rows();
		
		if($rows!=0){
			
			return $result;
		}
		
	}
	function addPdfPath($exam_pdf,$exam_id,$teacher_subject_id,$session_id){

		$this->db->select('class_section_id');
        $this->db->from('teacher_subjects');
        $this->db->where('id',$teacher_subject_id);
        $query = $this->db->get();
        $teacherSubId = $query->row_array();
        $this->db->select();
        $this->db->from('exam_pdf');
        $this->db->where(array('exam_id'=>$exam_id,'class_session_id'=>$teacherSubId['class_section_id'],'session_id'=>$session_id,'school_id'=>$this->school_id));
        $q = $this->db->get();
        $num_rows = $q->num_rows();
        if($num_rows == 0){
             $arrayName = array('exam_id'=>$exam_id,'class_session_id'=>$teacherSubId['class_section_id'],'pdf_link'=>$exam_pdf['exam_pdf'],'school_id'=>$this->school_id,'session_id'=>$session_id);
            $this->db->insert('exam_pdf',$arrayName);
        }else{
            $id = $q->row_array();
            $this->db->set('pdf_link',$exam_pdf['exam_pdf']);
            $this->db->where('id',$id['id']);
            $this->db->update('exam_pdf');
        }
	}
	function getExamGroups($id = null){ 
	    $this->db->select()->from('exam_groups');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
		$this->db->where('school_id', $this->school_id);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
	}
	function addExamGroups($data){
	    if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
			$this->db->where('school_id',$this->school_id);
            $this->db->update('exam_groups', $data); 
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('exam_groups', $data); 
            return $this->db->insert_id();
        }
	}
	//
	function getObGroup($id = null){ 
	    $this->db->select()->from('op_groups');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
		$this->db->where('school_id', $this->school_id);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
	}
	function addObGroup($data){
	    if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
			$this->db->where('school_id',$this->school_id);
            $this->db->update('op_groups', $data); 
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('op_groups', $data); 
            return $this->db->insert_id();
        }
	}
	
	
}
