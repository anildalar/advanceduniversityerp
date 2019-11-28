<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Incomehead_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select()->from('income_head');
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
		$this->db->where('school_id', $this->school_id);
        $this->db->delete('income_head');
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
            $this->db->update('income_head', $data);
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('income_head', $data);
        }
    }

}
