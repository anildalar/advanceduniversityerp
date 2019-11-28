<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accountant_model extends MY_Model {
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

        $this->db->select('accountants.*,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`');
        $this->db->from('accountants');
        $this->db->join('users', 'users.user_id = accountants.id', 'left'); 
        $this->db->where('users.role', 'accountant');
        if ($id != null) {
            $this->db->where('accountants.id', $id);
        } else {
            $this->db->order_by('accountants.id');
        }
		if($this->school_id != 0){
			$this->db->where('accountants.school_id',$this->school_id);
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
        $this->db->select('image');
		$this->db->where('id', $id);
		$query = $this->db->get('accountants');
		$img = $query->row_array()['image'];
		$delfile=APPPATH.'../'.$img;
		unlink($delfile);
		$this->db->where('id', $id);
		$this->db->where('school_id',$this->school_id);
        $this->db->delete('accountants');
		$this->db->where(array('user_id'=>$id,'role'=>'accountant','school_id'=>$this->school_id));
        $this->db->delete('users');
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
            $this->db->update('accountants', $data); 
        } else {
			$data['school_id']= $this->school_id;
            $this->db->insert('accountants', $data);
            return $this->db->insert_id();
        }
    }
}
