<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Papersetting_model extends MY_Model {
    public function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    public function add($data) {
		
			$this->db->insert('question_add',$data);
			return $this->db->insert_id();
			
    }
	public function update($data) {
			$this->db->update('question_add',$data);
			
    }
	public function getBoards(){
		//$sid=$this->session->userdata['admin']['school_id'];
		$this->db->select('board_name')->from('boards');
		//$this->db->where('school_id',$sid);
		$query = $this->db->get();
		return $query->result_array();
		//die;
	}
	public function getClasses(){
		
		$this->db->select()->from('question_classes');
		
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function getSubjects(){
		
		$this->db->select()->from('question_subjects');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function getChapter(){
		
		$this->db->select()->from('question_chapter');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function getTypes($class_id,$subject_id,$chapter_id){
		//$sql = "SELECT id,que_type FROM `question_type` WHERE FIND_IN_SET('$class_id',`class`) and FIND_IN_SET('$subject_id',`subjects`)";
		//$this->db->select()->from('question_type');
		//$this->db->where('FIND_IN_SET("$class_id",`class`) and FIND_IN_SET("$subject_id",`subjects`)');
		//$this->db->where('chapter_id',1);
		$query = $this->db->query($sql);
		
		var_dump( $query->result_array()); 
	}
	public function getPaper(){
		$this->db->select()->from('question_add');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function getQuestion($qid){
		//var_dump($dt2);die;
		$this->db->select('que_id,questions')->from('question_add');
		
		$this->db->where('que_id',$qid);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function searchBypaperque($dt) {
		//echo 'ok';die;
		//var_dump($dt);die;
		$this->db->select('question_add.*,question_classes.id,question_subjects.id,question_chapter.id')->from('question_add');
		
		
		$this->db->join('question_classes','question_classes.id=question_add.que_classes');
		$this->db->join('question_subjects','question_subjects.id=question_add.que_subjects');
		$this->db->join('question_chapter','question_chapter.id=question_add.que_chapters');
		
		$this->db->where('question_add.que_classes',$dt['que_classes']);
		$this->db->where('question_add.que_subjects',$dt['que_subjects']);
		$this->db->where('question_add.que_chapters',$dt['que_chapters']);
		
		//var_dump($dt['Que_classes']);
		$query = $this->db->get();
		//echo 'ok';die;
		//$data = $query->result_array();
		return $query->result_array();
		//echo '<pre>';
			//var_dump($data);die;
		//echo '</pre>';
		//die;
    }
	
	public function getUpdate($dt){
		//echo '<pre>';
		//var_dump($dt);die;
		$this->db->where('que_id',$dt['que_id']);
		$this->db->update('question_add',$dt);
		
	}
	
	function save_question(){
        $data = array(
                'exam_id'  => $this->input->post('exam'), 
                'class_id'  => $this->input->post('class'), 
                'subject_id' => $this->input->post('subjects'), 
                'chapter_id' => $this->input->post('chapter'), 
                'quepaper_id' => $this->input->post('que'), 
            );
        $result=$this->db->insert('question_paperset',$data);
        return $result;
    }
	 public function addmodule($dt) {
			$data['school_id'] = $this->school_id;
			$res = $this->db->insert('question_papermodule',$dt);
			//var_dump($dt);
			return $res;
    }
	
	public function getPaperModule() {
		//echo 'ok';die;
		$this->db->select('question_papermodule.*,question_exam.exam,question_classes.class_name,question_subjects.subject_name');
		$this->db->from('question_papermodule');
		$this->db->join('question_exam','question_exam.id=question_papermodule.examid');
		$this->db->join('question_classes','question_classes.id=question_papermodule.class');
		$this->db->join('question_subjects','question_subjects.id=question_papermodule.subject');
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get();
		//var_dump($query);die;
		return $query->result_array();
    }
	public function paperview($dataview,$dt){
		//$id = $data['quemodule_id'];
			//var_dump($id);die;
		$this->db->select('question_papermodule.*,question_exam.exam,question_classes.class_name,question_subjects.subject_name');
		$this->db->from('question_papermodule');
		$this->db->join('question_exam','question_exam.id=question_papermodule.examid');
		$this->db->join('question_classes','question_classes.id=question_papermodule.class');
		$this->db->join('question_subjects','question_subjects.id=question_papermodule.subject');
		$this->db->where('quemodule_id',$dataview['quemodule_id']);
		$query = $this->db->get();
		//json_encode($query);
		return $query->result_array();
	}
	
	public function getExam(){
		$this->db->select()->from('question_exam');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getSection(){
		$this->db->select()->from('question_sections');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function searchByques($dt){
		//echo 'ok';die;
		//var_dump($dt);die;
		$this->db->select('question_add.*,question_classes.id,question_subjects.id,question_chapter.id,question_type.id')->from('question_add');
		
		$this->db->join('question_classes','question_classes.id=question_add.que_classes');
		$this->db->join('question_subjects','question_subjects.id=question_add.que_subjects');
		$this->db->join('question_chapter','question_chapter.id=question_add.que_chapters');
		$this->db->join('question_type','question_type.id=question_add.que_type');
		
		$this->db->where('question_add.que_classes',$dt['que_classes']);
		$this->db->where('question_add.que_subjects',$dt['que_subjects']);
		$this->db->where('question_add.que_chapters',$dt['que_chapters']);
		$this->db->where('question_add.que_type',$dt['que_type']);
		
		//var_dump($dt['Que_classes']);
		$query = $this->db->get();
		//echo 'ok';die;
		//$data = $query->result_array();
		return $query->result_array();
		//echo '<pre>';
		//var_dump($data);die;
		//echo '</pre>';
		//die;
    }
	
	public function getQue($id){
		//var_dump($dataview);die;
		//GROUP_CONCAT(ts.student_name SEPARATOR ',')
		/* $this->db->select('question_paperset.*'); // <-- There is never any reason to write this line!
		$this->db->from('question_paperset');
		//$this->db->join('question_add', 'question_paperset.question_id = question_add.que_id');
		$this->db->where_in('question_id',$ids);
		$query = $this->db->get();
		return $query->result_array(); */
		/*$sendData = array();
		foreach($ids as $id){
			$this->db->select()
			 ->from('question_paperset')
			 ->where("FIND_IN_SET('$id',question_id) !=",0)
			 ->order_by('q_id','desc');
			$query = $this->db->get();
			$data = $query->result_array();
			foreach($data as $row=>$value){
				$sendData[] = $data[$row];
			}
		}
		return $sendData;*/
		/*
		$this->db->select()
			 ->from('question_paperset')
			 ->where('q_id',$id);
			$query = $this->db->get();
			$data = $query->row_array();
			$idsAry = explode(",",$data['question_id']);
			$sendData = $this->papersetting_model->getQuestionDet($idsAry);
			return $sendData;
			
		$this->db->select()
			 ->from('question_add')
			 ->where_in('que_id',$ids)
			 ->order_by('que_id','asc');
			$query = $this->db->get();
			$data = $query->result_array();
			return $data;
			*/
		$this->db->select('question_paperset.*, question_add.questions,question_add.answer'); // <-- There is never any reason to write this line!
		$this->db->from('question_paperset');
		$this->db->join('question_add', 'question_add.que_id = question_paperset.question_id');
		
		//$this->db->where_in('question_id',$dataview);
		//$this->db->where('question_add.que_id','implode(",",question_paperset.question_id)');
		//$this->db->GROUP_BY('question_add.que_id');
		$query = $this->db->get();
		//$data = $query->result_array();
		return $query->result_array();
		//echo '<pre>';
		//var_dump($data);die;
		//echo '</pre>';
		//die;
		
	}
	public function getQuestionDet($ids){
		$this->db->select()
			 ->from('question_add')
			 ->where_in('que_id',$ids);
			$query = $this->db->get();
			$data = $query->result_array();
			return $data;
	}
}
?>