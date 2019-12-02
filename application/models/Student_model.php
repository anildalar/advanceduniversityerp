<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends MY_Model {
    public function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
	}

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function getStudents() {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.blood_group,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->join('users', 'users.user_id = students.id', 'left'); 
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('users.role', 'student');
        $this->db->where('users.role', 'student');
		if($this->school_id != 0){
			$this->db->where('users.school_id',$this->school_id);
		}
        $this->db->order_by('students.id');
        
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function getRecentRecord($id = null) {
        $this->db->select('classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
        }
        $this->db->order_by('students.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select('student_session.transport_fees,student_session.vehroute_id,student_session.id as `student_session_id`,student_session.fees_discount,student_session.last_session_fee,classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion, students.cast,    students.dob ,students.current_address, students.previous_school,
            students.guardian_is,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is,students.rte,students.guardian_photo,blood_group')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            $this->db->order_by('students.id', 'desc');
        }
		$this->db->where('students.school_id', $this->school_id);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }
    
	public function testingGet($id = null) {
		$this->db->select('student_session.transport_fees,student_session.vehroute_id,student_session.id as `student_session_id`,student_session.fees_discount,student_session.last_session_fee,classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion, students.cast,    students.dob ,students.current_address, students.previous_school,
                    students.guardian_is,
                    students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is,students.rte,students.guardian_photo,blood_group,transfer_certificate.student_id')->from('students');
		$this->db->join('student_session', 'student_session.student_id = students.id');
		$this->db->join('classes', 'student_session.class_id = classes.id');
		$this->db->join('sections', 'sections.id = student_session.section_id');
		$this->db->join(' transfer_certificate','students.id=transfer_certificate.student_id','left');
		$this->db->where('student_session.session_id', $this->current_session);
		$this->db->where('transfer_certificate.student_id IS NULL');
		
		if ($id != null) {
			$this->db->where('students.id', $id);
		} else {
			$this->db->order_by('students.id', 'desc');
		}
		
		$this->db->where('students.school_id', $this->school_id);
		$query = $this->db->get();
		
		if ($id != null) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
    }

    public function search_student() {
        $this->db->select('classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            $this->db->order_by('students.id');
        }
		$this->db->where('students.school_id', $this->school_id);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }

    public function getstudentdoc($id) {
        $this->db->select()->from('student_doc');
        $this->db->where('student_id', $id);
        $this->db->where('school_id', $this->school_id);
		$query = $this->db->get();
        return $query->result_array();
    }

    public function searchByClassSection($class_id = null, $section_id = null) {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,student_session.vehroute_id as vehroute_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->join('transfer_certificate','students.id=transfer_certificate.student_id','left');
        $this->db->where(array('student_session.session_id'=>$this->current_session,'students.school_id'=>$this->school_id));
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->where('transfer_certificate.student_id IS NULL');
		$this->db->where('students.school_id', $this->school_id);
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    public function getTcStudent($class_id = null, $section_id = null) {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,student_session.vehroute_id as vehroute_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        
        $this->db->where(array('student_session.session_id'=>$this->current_session,'students.school_id'=>$this->school_id));
        if ($class_id != null) {
        $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
        $this->db->where('student_session.section_id', $section_id);
        }
       
        $this->db->where('students.school_id', $this->school_id);
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getStudentSessionids($class_id,$section_id){
        $studentSesIds = $this->db->select('id')->from('student_session')->where(array('school_id'=>$this->school_id,'session_id'=>$this->current_session,'class_id'=>$class_id,'section_id'=>$section_id))->get()->result_array();
        return $studentSesIds;
    }
    
    public function transportsearchByClassSection($class_id = null, $section_id = null,$route_id = null) {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,std_transport_fee.amount as `transport_submit_amount`,std_transport_fee.amount_data as `transport_fee_data`,student_session.transport_fees as `transport_fee`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->join('std_transport_fee', 'students.id = std_transport_fee.student_id','left');
        $this->db->where(array('student_session.session_id'=>$this->current_session,'students.school_id'=>$this->school_id));
        $this->db->where('std_transport_fee.student_session_id',$this->current_session);
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        if ($route_id != null) {
            //var_dump($route_id);die;
            $this->db->where('student_session.vehroute_id', $route_id);
        }
		$this->db->where('students.school_id', $this->school_id);
        $this->db->order_by('students.id');
        $query = $this->db->get();
        //var_dump($this->db->last_query());die;
        return $query->result_array(); 
    }
	public function searchByClassSectionExport($class_id = null, $section_id = null) {
        $this->db->select('classes.class,sections.section,students.admission_no ,students.roll_no,students.admission_date,students.firstname,students.lastname,students.mobileno, students.email ,students.state ,students.city,students.pincode,students.religion,students.cast,students.dob,students.gender,students.current_address,students.current_address, students.permanent_address,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name,students.father_phone,students.father_occupation,students.mother_name, students.mother_phone , students.mother_occupation,students.guardian_name,students.guardian_relation,students.guardian_phone,students.guardian_occupation,students.guardian_address,students.previous_school')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->where(array('student_session.session_id'=>$this->current_session,'students.school_id'=>$this->school_id));
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
		$this->db->where('students.school_id', $this->school_id);
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function searchByClassSectionCategoryGenderRte($class_id = null, $section_id = null, $category = null, $gender = null, $rte = null) {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,students.permanent_address,students.category_id, categories.category,   students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.mother_name,students.mother_phone,students.rte,students.gender,students.bank_account_no,students.bank_name,students.ifsc_code,blood_group')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id','left');
        $this->db->join('classes', 'student_session.class_id = classes.id','left');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->join(' transfer_certificate','students.id=transfer_certificate.student_id','left');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($class_id != null) {
			
			$this->db->where_in('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        if ($category != null) {
            $this->db->where('students.category_id', $category);
        }
        if ($gender != null) {
            $this->db->where('students.gender', $gender);
        }
        if ($rte != null) {
            $this->db->where('students.rte', $rte);
        }
        $this->db->where('transfer_certificate.student_id IS NULL');
		$this->db->where('students.school_id', $this->school_id);
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function searchFullText($searchterm) {
        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno,students.father_phone, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id,student_session.transport_fees as `transport_fee`,std_transport_fee.amount as `transport_submit_amount`,std_transport_fee.amount_data as `transport_fee_data`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');        
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->join('std_transport_fee', 'students.id = std_transport_fee.student_id','left');
        $this->db->join(' transfer_certificate','students.id=transfer_certificate.student_id','left');
        $this->db->where(array('student_session.session_id'=> $this->current_session,'students.school_id'=>$this->school_id));
        $this->db->where('transfer_certificate.student_id IS NULL');
        $this->db->group_start();
        $this->db->like('students.firstname', $searchterm);
        $this->db->or_like('students.lastname', $searchterm);
        $this->db->or_like('students.guardian_name', $searchterm);
        $this->db->or_like('students.adhar_no', $searchterm);
        $this->db->or_like('students.samagra_id', $searchterm);
        $this->db->or_like('students.roll_no', $searchterm);
        $this->db->or_like('students.admission_no', $searchterm);
        $this->db->or_like('students.religion', $searchterm);
        $this->db->or_like('categories.category', $searchterm);
        $this->db->group_end();
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    public function getTranByRoute($class_id = '',$section_id = '',$route_id = '') {
        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno,students.father_phone, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id,student_session.transport_fees as `transport_fee')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');        
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->where(array('student_session.session_id'=>$this->current_session,'students.school_id'=>$this->school_id));
        if ($class_id != '') {
            $this->db->where('student_session.class_id',$class_id);
        }
        if ($section_id != '') {
            $this->db->where('student_session.class_id',$section_id);
        }
        if ($route_id != '') {
            $this->db->where('student_session.vehroute_id',$route_id);
        }
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array(); 
    }
	
	public function getStudentListBYStudentsessionID($array) {
        $array = implode(',', $array);
        $sql = ' SELECT students.* FROM students INNER join (SELECT * FROM `student_session` WHERE `student_session`.`id` IN (' . $array . ')) as student_session on students.id=student_session.student_id';
        $query = $this->db->query($sql);
        return $query->result();
    }
	
    public function remove($id) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('students');
        $this->db->where('student_id', $id);
        $this->db->delete('student_session');
        $this->db->where('user_id', $id);
        $this->db->where('role', 'student');
        $this->db->delete('users');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }else{
            return true;
        }

    }

    public function doc_delete($id,$student_id) {
        //get name
		$this->db->select('doc');
		$this->db->where('id',$id);
		$file = $this->db->get('student_doc')->row_array();
		$this->db->where('id',$id);
        $this->db->delete('student_doc');
		//remove the file from filesystem
		$delfile = realpath(APPPATH . '../uploads/student_documents').'/'.($this->school_id).'/'.$student_id.'/'.$file['doc'];
		unlink($delfile);
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
	 
    public function add($data) {	
		if (isset($data['id'])) {
            $this->db->where('id',$data['id']);
            $this->db->update('students', $data); 
        } else {
			$data['school_id'] = $this->school_id; 
			$this->db->insert('students', $data); 
            return $this->db->insert_id();
        }
    }
	public function add_student_session($data) {
        $this->db->where('session_id', $data['session_id']);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('student_session');
        if ($q->num_rows() > 0) {
            $rec = $q->row_array();
            $this->db->where('id',$rec['id']);
            $this->db->update('student_session', $data);
           
        } else {
			$data['school_id'] = $this->school_id;
            $this->db->insert('student_session', $data);
             
             $this->db->insert_id();
        }
    }
	
    public function add_student_sibling($data_sibling) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_sibling', $data_sibling); 
        } else {
            $this->db->insert('student_sibling', $data_sibling); 
            return $this->db->insert_id();
        }
    }

   

    public function add_student_session_update($data) {
        $this->db->where('session_id', $data['session_id']);
        $q = $this->db->get('student_session');
        if ($q->num_rows() > 0) {
            $this->db->where('session_id', $student_session);
            $this->db->update('student_session', $data);
        } else {
            $this->db->insert('student_session', $data); 
            return $this->db->insert_id();
        }
    }

    public function adddoc($data) {
        $data['school_id']= $this->school_id;
		$this->db->insert('student_doc', $data); 
        return $this->db->insert_id();
    }

    public function read_siblings_students($ids_comma) {
        $query = $this->db->query('select * from students WHERE id in (' . $ids_comma . ')');
        return $query->result_array(); 
    }

    public function getAttedenceByDateandClass($date) {
        $sql = "SELECT IFNULL(student_attendences.id, 0) as attencence FROM `student_session`left JOIN student_attendences on student_attendences.student_session_id=student_session.id and student_attendences.date=".$this->db->escape($date)." and student_attendences.attendence_type_id != 2 where student_session.class_id=7 and student_session.session_id=$this->current_session";
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }


    public function searchCurrentSessionStudents() {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->where('student_session.session_id', $this->current_session);

        $this->db->order_by('students.firstname','asc');

        $query = $this->db->get();
        return $query->result_array(); 
    }


    public function searchLibraryStudent($class_id = null, $section_id = null) {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,
           IFNULL(libarary_members.id,0) as `libarary_member_id`,
           IFNULL(libarary_members.library_card_no,0) as `library_card_no`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id','left');
        $this->db->join('libarary_members', 'libarary_members.member_id = students.id and libarary_members.member_type = "student"','left');


        $this->db->where('student_session.session_id', $this->current_session);
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->order_by('students.id');
        
        $query = $this->db->get();
        return $query->result_array(); 
    }
    public function getStudentsByArray($array) {
        //var_dump($array);die;
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address ,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.blood_group, students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.mother_name,students.updated_at,students.father_name,students.rte,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('student_session.school_id',$this->school_id);
        $this->db->where('users.role', 'student');
        $this->db->where_in('students.id', $array);
        $this->db->order_by('students.id');

        $query = $this->db->get();
                          //var_dump($this->db->last_query());die;
        return $query->result();
    }
    function getMarksheet($data){
		$this->db->select('marksheet_data');
		$this->db->where($data);
		$result = $this->db->get('marksheets');
		return $result->row_array();
	}
   function getTC($data){
		$this->db->select('tc_data');
		$this->db->where($data);
		$result = $this->db->get('transfer_certificate');
		
		return $result->row_array();
	}

}
