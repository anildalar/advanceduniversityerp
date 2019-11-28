<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class School_model extends MY_Model {
    public function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
		$this->load->library('customsms');
		$this->load->model('emailconfig_model');
    }
	public function index(){
		//
	}

	public function getTotalSms(){
		return $this->customsms->getSmsBalance();//100;
	}
	
	public function record_count(){
		return $this->db->count_all('schools');
	}
	
	public function getSchools($limit, $start,$search_text=''){
		$this->db->limit($limit, $start);
		if($search_text != ''){
			$this->db->like('school_name', $search_text, 'both');
		}		
		$this->db->limit($limit, $start);
        $query = $this->db->get("schools");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function createSchool($data,$data2,$session_id=1){
		
		$query = $this->db->select('id')->get_where('languages',array('language'=>'English'));
		$data['language_id'] = $query->result()[0]->id;	
		//$this->db->select('id');
		//$query = $this->db->get_where('sms_config',array('is_active'=>'enabled'));
		//$smsGateway = $query->result();
		$data['sms_portal_id'] =0;
		$this->db->insert('schools', $data);
		$school_id = $this->db->insert_id();
		//create school directory
		echo 'okmodel';
		$upload_dirs = ['accountant_images','librarian_images','inventory_items','school_content','school_income','student_documents','student_images','teacher_images'];
		foreach($upload_dirs as $upload_dir){
			if($upload_dir == 'school_content'){
				$contents = ['logo','material'];
				foreach($contents as $content){
					$image_path = realpath(APPPATH . '../uploads/'.$upload_dir).'/'.$content.'/'.$school_id;					

                                                if (!file_exists($image_path)){
						mkdir($image_path, 0777, true);
					}
				}
			}else{
				$image_path = realpath(APPPATH . '../uploads/'.$upload_dir).'/'.$school_id;
				if (!file_exists($image_path)){
					mkdir($image_path, 0777, true);
				}
			}	
		}
		
		$data_attendence = array(
			'do_not_send' => 'true',
			'school_id' => $school_id
		);
		$this->db->insert('attendence_sms_settings',$data_attendence);
		
		//insert into school setting table
		$sch_data = array(
			'name' => $data['school_name'],
			'email' => $data2['admin_email'],
			'phone' => $data['contact_no'],
			'address' => $data['school_address'],
			'lang_id' => $data['language_id'],
			'dise_code' => $data['school_code'],
			'date_format' => 'd/m/Y',
			'currency' => 'INDIAN RUPEE',
			'currency_symbol' => 'Rs',
			'is_rtl' => 'disabled',
			'timezone' => 'Asia/Kolkata',
			'session_id' => $session_id,
			'start_month' => '4',
			'image' => 'images.png',
			'is_active' => 'no',
			'created_at' => date('Y-m-d H:i:s'),
			'school_id' => $school_id
		);
		$this->db->insert('sch_settings',$sch_data);

		if($school_id){
			$admin_data = array(
					'username' => $data2['admin_email'],
					'role' => 'admin',
					'email' => $data2['admin_email'],
					'password' => md5($data2['admin_password']),
					'is_active' => 'no',
					'school_id' => $school_id
				);
			$this->db->insert('admin', $admin_data);
			$user_id = $this->db->insert_id();
			$d = array(
				'user_id' => $user_id,
				'username' => $data2['admin_email'],
				'password' => $data2['admin_password'],
				'role' => 'admin',
				'is_active' => 'no',
				'school_id' => $school_id
			);
			$this->db->insert('users', $d);
		}

		$types=['student_admission','exam_result','fee_submission','absent_attendence','login_credential'];
		
		foreach ($types as $type) {
			$data_insert = array(
				'type' => $type,
				'is_mail' => 0,
				'is_sms' => 1,
				'school_id' => $school_id
			);
			$this->notificationsetting_model->add($data_insert);
		}
		// 2. 
		 $data_insert = array(
			'email_type' => 'sendmail',
			'is_active' => 'yes',
			'school_id' => $school_id
		);
		$this->emailconfig_model->add($data_insert);
		return true;
		
	}
	public function updateSchool($data,$data2,$school_id,$session_id){
		$this->db->where('school_id', $school_id);
		$this->db->update('schools', $data);
		
		$sid['session_id']= $session_id;
		$this->db->where('school_id', $school_id);
		$this->db->update('sch_settings', $sid);
		
		if(!empty($data2)){
			$admin_data = array(
					'password' => md5($data2['admin_password']),
					'school_id' => $school_id
			);
			$this->db->where('school_id', $school_id);
			
			$this->db->update('admin', $admin_data);	
			$d = array(
				'password' => $data2['admin_password'],
				'school_id' => $school_id
			);
            $this->db->where('role','admin');
			$this->db->where('school_id', $school_id);
			$this->db->update('users', $d );
		}
		return true;
	}
	public function getResultPattern(){
		return $this->db->select('result_pattern')->get_where('schools',array('school_id'=>$this->school_id))->row()->result_pattern;
	}
	public function add($data){
        if (isset($data['school_id'])) {
            $this->db->where(array('school_id'=>$data['school_id']));
            $this->db->update('schools', $data); 
        } else {
			//$data['school_id']=$this->school_id;
			//$this->db->insert('schools', $data); 
			//return $this->db->insert_id();
        }
    }
}
