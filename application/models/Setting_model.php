<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_model extends MY_Model {
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

        $this->db->select('schools.fee_receipt_no,sch_settings.id,sch_settings.lang_id,sch_settings.is_rtl,sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.phone,languages.language,
          sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.session_id,sch_settings.image,sch_settings.theme,sch_settings.marksheet,sessions.session'
        );
        $this->db->from('sch_settings');
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');
        $this->db->join('schools', 'schools.school_id = sch_settings.school_id');
        if ($id != null) {
            $this->db->where('sch_settings.id', $id);
        } else {
            $this->db->where('sch_settings.school_id', $this->school_id);
            $this->db->order_by('sch_settings.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }
    public function getSchoolDetail(){
        $query = $this->db->select('*')->get_where('sch_settings',array('school_id'=>$this->school_id));
        return $query->row_array(); 
    }
    public function getSettings($school_id=null) {
        $this->db->select('sch_settings.id,sch_settings.lang_id,sch_settings.website,sch_settings.d_code,sch_settings.registration_code,sch_settings.is_rtl,sch_settings.timezone,
            sch_settings.name,sch_settings.email,sch_settings.phone,languages.language,
            sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.session_id,sch_settings.image,sch_settings.theme,sch_settings.marksheet,sessions.session,id_card'
        );
        $this->db->from('sch_settings');
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');
        if($school_id != null){
            $this->db->where('sch_settings.school_id',$school_id);
        }else{
            $this->db->where('sch_settings.school_id',$this->school_id);
        }
    
        $query = $this->db->get();
       return $query->result_array(); 
    }
    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->where('school_id', $this->school_id);
        $this->db->delete('sch_settings');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (isset($data['school_id'])) {
            $this->db->where('school_id', $data['school_id']);
            $this->db->update('sch_settings', $data);
        } else {
            $data['school_id']= $this->school_id;
            $this->db->insert('sch_settings', $data);
            return $this->db->insert_id();
        }
    }

    public function getCurrentSession() {
        $session_result = $this->get();
        return $session_result[0]['session_id'];
        
    }
    public function getCurrentSessionBySchoolId($school_id){
        return $this->db->select('session_id')->get_where('sch_settings',array('school_id'=>$school_id))->row()->session_id;
    }

    public function getCurrentSessionName() {
        $session_result = $this->get();
        return $session_result[0]['session'];
    }
    public function getCurrentSchoolName() {
        $s = $this->session->get_userdata('admin');
        echo  $s['admin']['school_name'];
    }
    /*  public function getCurrentSchoolId(){
    {
        $school_id = $this->school_id;
        return $school_id;
    }  */
    
    public function getCurrentSchoolSmsCredentials() {
        $d = array();
        $d[] = $this->sms_username;
        $d[] = $this->sms_password;
        $d[] = $this->sms_senderid;
        $d[] = $this->sms_gateway_id;
        $d[] = $this->sms_api_key;
        $d[] = $this->sms_portal_id;
        return $d;
    }

    public function getStartMonth() {
        $session_result = $this->get();
        return $session_result[0]['start_month'];
    }

    public function getCurrentSessiondata() {
        $session_result = $this->get();
        return $session_result[0];
    }

    public function getDateYmd() {
        return date('Y-m-d');    }

    public function getDateDmy() {
        return date('d-m-Y');
    }
    public function getCustomSmsDatabyId($id){
        $this->db->select('schooolis_sms.gateway_tokan,sms_config.url')->from('schooolis_sms');
        $this->db->join('sms_config','sms_config.id=schooolis_sms.gateway_id')->where('schooolis_sms.gateway_id',$id);
        $this->db->where('schooolis_sms.school_id',$this->school_id);
        $query=$this->db->get();
        return $query->row_array();
    }
    public function getDefualtGatwayId(){
        $this->db->select('sms_portal_id')->from('schools');
        $this->db->where('school_id',$this->school_id);
        $query=$this->db->get();
        return $query->row_array();
    }

}
