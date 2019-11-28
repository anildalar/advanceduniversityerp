<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Language_model extends MY_Model {

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
        $this->db->select()->from('languages');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('language asc');
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
        $this->db->delete('languages');
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
            $this->db->update('languages', $data); 
        } else {
            $this->db->insert('languages', $data); 
        }
    }
	public function record_count(){
		return $this->db->count_all('lang_keys');
	}
	public function getLanguageKeys($limit, $start){
		$this->db->limit($limit, $start);
		$query = $this->db->get("lang_keys");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	public function addLangKey($data){
		$this->db->insert('lang_keys', $data);
	}

}
