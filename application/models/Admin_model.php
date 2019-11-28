<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends MY_Model {
    public function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
        $this->current_session_name = $this->setting_model->getCurrentSessionName();
        $this->start_month = $this->setting_model->getStartMonth();
	}

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
	public function get(){
        $this->db->from('users');
		$this->db->where('role','admin');
		$this->db->where('school_id',$this->school_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	 /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('admin');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
	
    public function add($data,$pass) {
		
        if (isset($data['id'])) {	
            $this->db->where('id', $data['id']);
            $this->db->where('school_id', $this->school_id);
            $this->db->update('admin', $data);
			$this->db->where('user_id', $data['id']);
            $this->db->where('school_id', $this->school_id);
			
			$data2 = array(
				'username' => $data['username'],
                'email' => $data['email'],
                'password' => $pass,
                'role' => 'admin',
                'is_active' => 'yes',
				'school_id' => $this->school_id
			);
			
            $this->db->update('users', $data2);
			
        } else {
			
			$data['school_id'] = $this->school_id;
            
			$this->db->insert('admin', $data);
			
			$insert_id = $this->db->insert_id();
			
			$data2 = array(
				'user_id' => $insert_id,
				'username' => $data['username'],
                'password' => $pass,
                'role' => 'admin',
                'is_active' => 'yes',
				'school_id' => $this->school_id
			);
			$this->db->insert('users', $data2);
			
        }
    }

	public function checkIfExists($admin_email){
        $this->db->from('admin');
		$this->db->where('username',$admin_email);
		$query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
	}
	public function getSuperAdminUsers(){
		$this->db->select('username, password,school_id');
        $this->db->from('users');
		$this->db->where('role','superadminuser');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function createUsers($data){
		$plainpass = $data['plainpassword'];
		unset($data['plainpassword']);
		$this->db->insert('admin',$data);
		$insert_id = $this->db->insert_id();
		unset($data['email']);
		$data['password']= $plainpass;
		$data['user_id']=$insert_id;
		$data['school_id']=0;
		$this->db->insert('users',$data);
	}
    public function checkLogin($data) { 
        
        $this->db->select('id, username, password');
        $this->db->from('admin');
        $this->db->where('email', $data['username']);
        $this->db->where('password', MD5($data['password']));
        $this->db->limit(1);
        $query = $this->db->get();
        
       
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read_user_information($email) {
        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
	public function readByEmail($email) {
        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateVerCode($data) {
        $this->db->where('id', $data['id']);
        $query = $this->db->update('admin', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdminByCode($ver_code) {
        $condition = "verification_code =" . "'" . $ver_code . "'";
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function change_password($data) {
        $condition = "id =" . "'" . $data['id'] . "'";
        $this->db->select('password');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkOldPass($data) {
        $this->db->where('id', $data['user_id']);
        $this->db->where('password', $data['current_pass']);
        $this->db->where('email', $data['user_email']);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function saveNewPass($data) {
        $this->db->where('id', $data['id']);
        $query = $this->db->update('admin', $data); 
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function saveNewNextPass($data) {
        //var_dump($data);die;
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('school_id',$this->school_id);
        $this->db->where('role','admin');
        $query = $this->db->update('users', $data); 
        if ($query) {
        	//echo $this->db->last_query(); die;
            return true;
        } else {
            return false;
        }
    }

    public function addReceipt($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('fee_receipt_no', $data);
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('fee_receipt_no', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }

    public function getMonthlyCollection() {
        $data = explode("-", $this->current_session_name);
        $data_first = $data[0];
        $data_second = substr($data_first, 0, 2) . $data[1];
        $this->start_month;
        $sql = "SELECT SUM(amount+amount_fine-amount_discount) as amount,MONTH(date) as month ,YEAR(date) as year FROM student_fees where YEAR(date) BETWEEN " . $this->db->escape($data_first) . " and " . $this->db->escape($data_second) . " and school_id=".($this->school_id)." GROUP BY MONTH(date)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getMonthlyExpense() {
        $data = explode("-", $this->current_session_name);
        $data_first = $data[0];
        $data_second = substr($data_first, 0, 2) . $data[1];
        $this->start_month;
        $sql = "SELECT SUM(amount) as amount,MONTH(date) as month ,YEAR(date) as year FROM expenses where YEAR(date) BETWEEN " . $this->db->escape($data_first) ." and " . $this->db->escape($data_second) . " and school_id=" . ($this->school_id) . " GROUP BY MONTH(date)";
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }

    public function getCollectionbyDay($date) {
        $sql = 'SELECT SUM(amount+amount_fine-amount_discount) as amount FROM student_fees where date=' . $this->db->escape($date).' and school_id='.$this->school_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getExpensebyDay($date) {
        $sql = 'SELECT SUM(amount) as amount FROM expenses where date=' . $this->db->escape($date).' and school_id='.$this->school_id;
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }
	// create Transaction 
	
    public function createTransaction($data,$id = null){
		if($id!=''){
			$this->db->where('transaction_id',$id);
			$this->db->update('superAccounts', $data);
		}else{
			$this->db->insert('superAccounts', $data);
		}
		
		
	}
	// create ebook boards model code from pratyush
	public function createEbook($data,$id = null){
		if($id!=''){
			$this->db->where('ebook_board_id',$id);
			$this->db->update('ebook_boards', $data);
		}else{
			$this->db->insert('ebook_boards', $data);
		}
		
	}
	// create ebook subject
	public function createSubject($data,$id = null){
		if($id!=''){
			$this->db->where('ebook_subject_id',$id);
			$this->db->update('ebook_subjects', $data);
		}else{
			$this->db->insert('ebook_subjects', $data);
		}
		
	}
	// get ebook boards 
	public function getBoards($id = null){
		
		$this->db->select()->from('ebook_boards');
		if($id!=''){
			$this->db->where('ebook_board_id',$id);
		}
		$query = $this->db->get();
		return $query->result_array(); 
	}
	// get classess
	
	public function getClass($id = null){
		$this->db->select()->from('ebook_classes');
		if($id!=''){
			$this->db->where('ebook_class_id',$id);
		}
		$query = $this->db->get();
		return $query->result_array(); 
	}
	// get subject 
	public function getSubject($id = null){
		$this->db->select('ebook_subject_id,ebook_subject_name,ebook_subject_desc,ebook_class_name,ebook_subject_class_id')->from('ebook_subjects');
		$this->db->join('ebook_classes', 'ebook_subjects.ebook_subject_class_id = ebook_classes.ebook_class_id');
		if($id!=''){
			$this->db->where('ebook_subject_id',$id);
		}
		$query = $this->db->get();
		return $query->result_array(); 
	}
	// get chapters
	public function getChapters($id = null){
		$this->db->select('ebook_chapter_id,ebook_chapter_number,ebook_chapter_name	,ebook_chapter_desc,ebook_class_name,ebook_chapter_class_id')->from('ebook_chapters');
		$this->db->join('ebook_classes', 'ebook_chapters.ebook_chapter_class_id = ebook_classes.ebook_class_id');
		if($id!=''){
			$this->db->where('ebook_chapter_id',$id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	// create ebook question data
	// create ebook question data
	function createEbookQuestion($data,$id){
		if($id!=''){
			$this->db->where('ebook_question_id',$id);
			$this->db->update('ebook_questions', $data);
			return $id;
		}else{
			$this->db->insert('ebook_questions', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}	
	}
	// create ebook classess 
	public function createClass($data,$id = null){
		if($id != ''){
			
			$this->db->where('ebook_class_id',$id);
			$this->db->update('ebook_classes', $data);
		}else{
			$this->db->insert('ebook_classes', $data);
		}
		
	}
	// create ebook chapter
	public function createChapter($data,$id = null){
		if($id!=''){
			$this->db->where('ebook_chapter_id',$id);
			$this->db->update('ebook_chapters', $data);
		}else{
			$this->db->insert('ebook_chapters', $data);
		}
		
	}
	
	
	// code by pratyush
	public function getTransaction($data){
		//var_dump($data);
		//die;
		if($data['school_id'] == 'all'){
			$this->db->select('superaccounts.*,schools.school_name');
			$this->db->from('superaccounts');
			$this->db->join('schools','superaccounts.school_id=schools.school_id');
			if($data['from']!=''){
				$form = date('Y-m-d',strtotime($data['from']));
				$this->db->where('date >=', $form);
			}
			if($data['to']!=''){
				$to = date('Y-m-d',strtotime($data['to']));
				$this->db->where('date <=', $to);
			}
		}else{
			$this->db->select('superaccounts.*,schools.school_name');
			$this->db->from('superaccounts');
			$this->db->join('schools','superaccounts.school_id=schools.school_id');
			if($data['id']!=''){
				$this->db->where('transaction_id',$data['id']);
			}
		
			if($data['school_id']!=''){
				$this->db->where('superaccounts.school_id',$data['school_id']);
			}
			
			if($data['from']!=''){
				$form = date('Y-m-d',strtotime($data['from']));
				$this->db->where('date >=', $form);
			}
			if($data['to']!=''){
				$to = date('Y-m-d',strtotime($data['to']));
				$this->db->where('date <=', $to);
			}
		}
		
		
		$query = $this->db->get();
		return $query->result_array();
	}
	function getTotalIncomeModel()
	{	
		$this->db->select_sum('amount');
		$this->db->from('superaccounts');
		$this->db->where('transaction_type',2);
		$query = $this->db->get();
		return $query->row_array();
	}
	function getTotalExepence()
	{	
		$this->db->select_sum('amount');
		$this->db->from('superaccounts');
		$this->db->where('transaction_type',1);
		$query = $this->db->get();
		return $query->row_array();
	}
	function getTotalStudents(){
		$query = $this->db->query('SELECT * FROM students');
		return $query->num_rows();
	}
	
	function getTotalSchools(){
		$query = $this->db->query('SELECT * FROM schools');
		return $query->num_rows();
	}
	
	function getMarketingUsers(){
        $this->db->from('users');
		$this->db->where('role','suadmarketing');
		$query = $this->db->get();
		return $query->result_array();
	}
	function getEbookUserLists(){
        $this->db->from('users');
		$this->db->where('role','suadebook');
		$query = $this->db->get();
		return $query->result_array();
	}
}
