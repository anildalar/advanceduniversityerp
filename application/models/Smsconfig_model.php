<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Smsconfig_model extends MY_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get($id = null) {
		$this->db->select()->from('sms_config');
		if ($id != null) {
		  $this->db->where('id', $id);
		} else {
		  $this->db->order_by('id');
		}
		$query = $this->db->get();
		if ($id != null) {
		  return $query->row_array(); 
		} else {
		  return $query->result_array(); 
		}
	}
	/// this function taken one parameter and give the record according to parametor
	public function getRecordById($id){
		$query=$this->db->select()->from('sms_config')->where('id',$id)->get();
		return $query->row_array();
	}
	public function activateSmsGateway($smsgatewayid){
		$query=$this->db->get_where('sms_config',array('id' =>$smsgatewayid))->row();
		if($query->status=='1'){
			$data=array('status'=>'0');
		}else{
			$data=array('status'=>'1');
		}
		$this->db->where('id', $smsgatewayid);
		$this->db->update('sms_config', $data);
	}

	public function add($data) {
		if($data['id']==''){
			$this->db->insert('sms_config',$data);
			return 'Save';
		}else{
			$id=$data['id'];
			unset($data['id']);
			$data['updated_at']=date('Y-m-d H:i');
			$this->db->where('id',$id);
			$this->db->update('sms_config',$data);
			return 'Update';
		}
	}

	public function getActiveSMS() {
		$this->db->select()->from('sms_config');
		$this->db->where('is_active', 'enabled');
		$query = $this->db->get();
		return $query->row(); 
	}
	public function setSchoolSmsGetway($id,$data,$sid){
		$mydata=$this->db->get_where('schooolis_sms', array('gateway_id =' =>$id,'school_id ='=>$sid))->row();
		if(!empty($mydata)){
			$this->db->set('gateway_tokan',$data);
			$this->db->where('gateway_id',$id);
			$this->db->where('school_id',$sid);
			$this->db->update('schooolis_sms');
			return false;
		}else{
			$myary=[
				'gateway_id'=>$id,
				'gateway_tokan'=>$data,
				'school_id'=>$sid,
			];
			$this->db->insert('schooolis_sms', $myary);
			return true;
		}
	}
	public function getSchoolsSMSGateways($sid){
		$this->db->select('schooolis_sms.*,sms_config.name,sms_config.gateways_type')->from('schooolis_sms');
		$this->db->join('sms_config','sms_config.id=schooolis_sms.gateway_id');
		$this->db->where('school_id',$sid);
		$query=$this->db->get();
		return $query->result_array();
	}


}
