<?php
class MY_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
    }
	
	public function checkValidDomain($domain) {
		
        $this->db->select('university_name');
        $this->db->from('universities');
        $this->db->where('domain_name', $domain);
        $this->db->where('is_active', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
	public function getCurrentTheme($domain) {
		
        $this->db->select('*');
        $this->db->from('universities');
        $this->db->where('domain_name', $domain);
        $this->db->where('is_active', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}

?>
