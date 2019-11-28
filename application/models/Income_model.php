<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Income_model extends MY_Model {
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
    public function search($text = null, $start_date = null, $end_date = null,$head = null) {
        
		if (!empty($text)) {
            $this->db->select('income.id,income.date,income.name,income.amount,income.documents,income.note,income_head.income_category,income.inc_head_id')->from('income');
            $this->db->join('income_head', 'income.inc_head_id = income_head.id');

            $this->db->like('income.name', $text);
			$this->db->where('school_id', $this->school_id);
            $query = $this->db->get();
			
            return $query->result_array();
        }
        elseif(!empty($head)){
            $this->db->select('income.id,income.date,income.name,income.amount,income.documents,income.note,income_head.income_category,income.inc_head_id')->from('income');
            $this->db->join('income_head', 'income.inc_head_id = income_head.id');
            $this->db->where('inc_head_id',$head);
			$this->db->where('income.school_id', $this->school_id);
            $query = $this->db->get();
			return $query->result_array();
        }
        else {
            $this->db->select('income.id,income.date,income.name,income.amount,income.documents,income.note,income_head.income_category,income.inc_head_id')->from('income');
            $this->db->join('income_head', 'income.inc_head_id = income_head.id');
            $this->db->where('income.date >=', $start_date);
            $this->db->where('income.date <=', $end_date);
			$this->db->where('income.school_id', $this->school_id);
            $query = $this->db->get();
			return $query->result_array();
        }
        
    }

    public function get($id = null) {
	
		$this->db->select('income.id,income.date,income.name,income.amount,income.documents,income.note,income.school_id,income_head.income_category,income.inc_head_id')->from('income');
        $this->db->join('income_head', 'income.inc_head_id = income_head.id');
        if ($id != null) {
            $this->db->where('income.id', $id);
        } else {
            $this->db->order_by('income.id', 'DESC');
        }
			
        $this->db->where('income.school_id', $this->school_id);
		$this->db->limit('20');
        
		$query = $this->db->get();
		//var_dump($this->db->last_query());die;
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
		$this->db->where('school_id', $this->school_id);
        $this->db->delete('income');
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
			$this->db->where('school_id', $this->school_id);
            $this->db->update('income', $data);
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('income', $data);
            return $this->db->insert_id();
        }
    }

    public function check_Exits_group($data) {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('session_id', $this->current_session);
        $this->db->where('feetype_id', $data['feetype_id']);
        $this->db->where('class_id', $data['class_id']);
		$this->db->where('school_id', $this->school_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getTypeByFeecategory($type, $class_id) {
        $this->db->select('income.id,income.session_id,income.amount,income.documents,income.note,income_head.class,feetype.type')->from('income');
        $this->db->join('income_head', 'income.class_id = income_head.id');
        $this->db->join('feetype', 'income.feetype_id = feetype.id');
        $this->db->where('income.class_id', $class_id);
        $this->db->where('income.feetype_id', $type);
        $this->db->where('income.session_id', $this->current_session);
        $this->db->order_by('income.id');
		$this->db->where('school_id', $this->school_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTotalExpenseBydate($date) {
        $query = 'SELECT sum(amount) as `amount` FROM `income` WHERE date=' . $this->db->escape($date) .' AND school_id='.$this->school_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    public function getTotalExpenseBwdate($date_from, $date_to) {
        $query = 'SELECT sum(amount) as `amount` FROM `income` WHERE date between ' . $this->db->escape($date_from) . ' AND ' . $this->db->escape($date_to).' AND school_id='.$this->school_id;

        $query = $this->db->query($query);
        return $query->row();
    }

}
