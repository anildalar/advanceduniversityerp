<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Librarian_model extends MY_Model {
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
        $this->db->select('librarians.*,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`');
        $this->db->from('librarians');
        $this->db->join('users', 'users.user_id = librarians.id', 'left'); 
        $this->db->where('users.role', 'librarian');
        if ($id != null) {
            $this->db->where('librarians.id', $id);
        } else {
            $this->db->order_by('librarians.id');
        }
		if($this->school_id != 0){
			$this->db->where('librarians.school_id', $this->school_id);
		}
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
        $this->db->delete('librarians');
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
            $this->db->update('librarians', $data); 
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('librarians', $data);
            return $this->db->insert_id();
        }
    }



}
