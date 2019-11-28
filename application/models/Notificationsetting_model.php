<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notificationsetting_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        $this->db->select()->from('notification_setting');
        if ($id != null) {
            $this->db->where('notification_setting.id', $id);
        } else {
            $this->db->order_by('notification_setting.id');
        }
		$this->db->where('notification_setting.school_id', $this->school_id);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row();
        } else {
            return $query->result();
        }
    }
    public function add($data) {
		if (!isset($data['school_id'])) {
            $this->db->where('type', $data['type']);
            $this->db->update('notification_setting', $data); 
        } else {
            $this->db->insert('notification_setting', $data); 
        }
    }

}
