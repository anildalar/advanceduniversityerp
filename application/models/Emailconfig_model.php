<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailconfig_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
		$this->db->select()->from('email_config');
        $this->db->order_by('id');
		$this->db->where('school_id',$this->school_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_emailbytype($email_type) {
        $this->db->select()->from('email_config');
        $this->db->where('email_type', $email_type);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_emailconfig($email_type) {
        $data = array(
            'smtp_username' => $this->input->post('smtp_username'),
            'smtp_password' => $this->input->post('smtp_password')
        );

        $this->db->where('email_type', $email_type);
        $this->db->update('email_config', $data);
    }

    public function add($data) {
		if (isset($data['id']) && !empty($data['id'])) {
            $this->db->where('id', $data['id']);
			$this->db->where('email_config.school_id', $this->school_id);
            $this->db->update('email_config', $data); 
        } else {
			if(empty($data['id']) && !isset($data['school_id'])){
				$data['school_id'] = $this->school_id;
			}			
            $this->db->insert('email_config', $data); 
            return $this->db->insert_id();
        }
    }

    public function getActiveEmail(){
        $this->db->select()->from('email_config');
        $this->db->where('is_active', 'yes');
		$this->db->where('school_id',$this->school_id);
        $query = $this->db->get();
        return $query->row();
    }

}
