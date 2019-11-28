<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Certificate_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function addcertificate($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->where('school_id', $this->school_id);
            $this->db->update('certificates', $data);
           
        } else {
            $data['school_id'] = $this->school_id;
            $this->db->insert('certificates', $data);
            return $this->db->insert_id();
        }
        
    }

    public function certificateList() {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('status = 1');
        $this->db->where('created_for = 2');
        $this->db->where('school_id',$this->school_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get($id) {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('status = 1');
        $this->db->where('id', $id);
        $this->db->where('school_id',$this->school_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('certificates');
        $this->db->where('school_id',$this->school_id);
    }

    public function getstudentcertificate() {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('created_for = 2');
        $this->db->where('school_id',$this->school_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function certifiatebyid($id) {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('id', $id);
        $this->db->where('school_id',$this->school_id);
        $query = $this->db->get();
        return $query->row();
    }

}

?>