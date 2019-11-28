<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parent_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get() {
		if($this->school_id == 0){
			$sql = "SELECT * FROM `users` WHERE role='parent' order by id desc";
		}else{
			$sql = "SELECT * FROM `users` WHERE role='parent' and school_id='".($this->school_id)."' order by id desc";
		}
        
        $query = $this->db->query($sql);
        $parents=$query->result(); 
        foreach ($parents as $pr_key => $pr_value) {
            $pr_value->siblings= $this->student_model->read_siblings_students($pr_value->childs);
        }
        return $parents;
    }


}
