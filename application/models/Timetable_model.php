<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timetable_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
		$this->db->where('school_id',$this->school_id);
        $this->db->delete('timetables');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (($data['id']) != 0) {
            $this->db->where('id', $data['id']);
            $this->db->where('school_id',$this->school_id);
			$this->db->update('timetables', $data); // update the record
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('timetables', $data); // insert new record
            return $this->db->insert_id();
        }
    }

    public function get($data) {
        $query = $this->db->get_where('timetables', $data);
		//$this->db->where('school_id',$this->school_id);
        return $query->result_array();
    }

}
