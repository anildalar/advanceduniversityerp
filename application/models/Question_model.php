<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question_model extends MY_Model {
    public function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    
    public function add($data) {
		$data['school_id']=$this->school_id;	
		$this->db->insert('questions_paper',$data); 
		return $this->db->insert_id();
        
    }
	public function get(){
		$this->db->select()->from('questions_paper');
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get();
		return $query->result_array(); 
      
    }
	public function createQuestion($data){
		$data['school_id']=$this->school_id;
		$this->db->insert('questions',$data);
		return $this->db->insert_id();
	}
	
	public function getCountdata($id,$column,$table){
		$this->db->select("*")
		->from($table)
		->where($column,$id);
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get();
		return $query->num_rows(); // sin
	}
	public function getSumOfColumn($id){
		$this->db->select_sum('question_marks');
		$this->db->where('question_paper_id', $id);
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get('questions');   
		return $query->row_array();    
		   
	}
	public function getExamId($id){
		$this->db->select('exam,paper_name')->from('questions_paper')->where('id',$id);
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function getQuestion($id){
		$this->db->select("*")
		->from("questions")
		->where('question_paper_id',$id);
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get();
		return $query->result_array(); 	
	}
	public function onlineAttempt($class_id,$section_id){
		$this->db->select();    
		$this->db->from('questions_paper');
		$this->db->where('class',$class_id);
		$this->db->where('section',$section_id);
		$this->db->where('questions_paper.school_id',$this->school_id);
		$this->db->where('questions_paper.session_id',$this->current_session);
		$query = $this->db->get();
		return $query->result_array(); 
		
	}
	public function getQuestions($id){
		
		$this->db->select();
		$this->db->from('questions_paper');
		$this->db->join('questions','questions_paper.id=questions.question_paper_id');
		$this->db->where('questions_paper.id',$id);
		$this->db->where('questions_paper.school_id',$this->school_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function insertAnswers($data){
		$data['school_id']=$this->school_id;
		$this->db->insert('answers',$data); 
	}
	public function getPaperId($id){
		$this->db->select('questions_paper.school_id,questions_paper.id');
		$this->db->from('questions');
		$this->db->join('questions_paper','questions.question_paper_id=questions_paper.id');
		$this->db->where('questions.question_id',$id);
		$this->db->where('questions_paper.school_id',$this->school_id);
		$query = $this->db->get();
		return $query->row();
		
	}
}
