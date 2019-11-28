<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification_model extends MY_Model {
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
        $this->db->select()->from('send_notification');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('publish_date', 'desc');
        }
		$this->db->where('school_id',$this->school_id);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array();
        }
    }

    public function getNotificationForStudent($studentid = null) {
        $date = date('Y-m-d');
        $query = $this->db->query("SELECT send_notification.id,send_notification.title,send_notification.publish_date,send_notification.date,send_notification.message,
				IF (read_notification.id IS NULL,'unread','read') as notification_id
				FROM send_notification
				LEFT JOIN read_notification ON send_notification.id = read_notification.notification_id and read_notification.student_id=".$this->db->escape($studentid)." where send_notification.visible_student='Yes'  and send_notification.school_id=".$this->db->escape($this->school_id)." order by send_notification.publish_date desc");
        return $query->result_array(); 
    }
	
    public function getNotificationForParent($parentid = null) {
       
        $date = date('Y-m-d');
        $query = $this->db->query("SELECT
				send_notification.id,send_notification.title,send_notification.publish_date,send_notification.date,send_notification.message,
				IF (read_notification.id IS NULL,'unread','read') as notification_id
				FROM send_notification
				LEFT JOIN read_notification ON send_notification.id = read_notification.notification_id and read_notification.parent_id=".$this->db->escape($parentid)." where send_notification.visible_parent='Yes' and send_notification.school_id=".$this->db->escape($this->school_id)." order by send_notification.publish_date desc");
				
        return $query->result_array(); 
    }
    
    public function getNotificationForParent2(){
        
    }

    public function countUnreadNotificationStudent($studentid = null) {
        $date = date('Y-m-d');
        $query = $this->db->query("select * from (SELECT  IF (read_notification.id IS NULL,'unread','read') as notification_id FROM send_notification LEFT JOIN read_notification ON send_notification.id = read_notification.notification_id and read_notification.student_id=".$this->db->escape($studentid)." where  send_notification.visible_student='Yes' and send_notification.school_id=".$this->db->escape($this->school_id).") final where notification_id ='unread'");
        return $query->num_rows(); 
    }

    public function countUnreadNotificationParent($parentid = null) {
        $date = date('Y-m-d');
        $query = $this->db->query("select * from (SELECT  IF (read_notification.id IS NULL,'unread','read') as notification_id FROM send_notification LEFT JOIN read_notification ON send_notification.id = read_notification.notification_id and read_notification.parent_id=".$this->db->escape($parentid)." where  send_notification.visible_parent='Yes' and send_notification.school_id=".$this->db->escape($this->school_id).") final where notification_id ='unread'");
        return $query->num_rows(); 
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
		$this->db->where('school_id',$this->school_id);
        $this->db->delete('send_notification');
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
			$this->db->where('school_id',$this->school_id);
            $this->db->update('send_notification', $data);
        } else {
			$data['school_id']=$this->school_id;
            $this->db->insert('send_notification', $data); 
            return $this->db->insert_id();
        }
    }

    public function updateStatus($notification_id, $studentid) {
        $this->db->where('notification_id', $notification_id);
        $this->db->where('student_id', $studentid);
		$this->db->where('school_id',$this->school_id);
        $q = $this->db->get('read_notification');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            $data = array(
                'notification_id' => $notification_id,
                'student_id' => $studentid
            );
			$data['school_id']= $this->school_id;
            $this->db->insert('read_notification', $data);
        }
    }

    public function updateStatusforParent($notification_id, $parentid) {
        $this->db->where('notification_id', $notification_id);
        $this->db->where('parent_id', $parentid);
		$this->db->where('school_id',$this->school_id);
        $q = $this->db->get('read_notification');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            $data = array(
                'notification_id' => $notification_id,
                'parent_id' => $parentid
            );
			$data['school_id']= $this->school_id;
            $this->db->insert('read_notification', $data);
        }
    }
    public function updateStatusforTeacher($notification_id, $teacher_id) {
        $this->db->where('notification_id', $notification_id);
        $this->db->where('teacher_id', $teacher_id);
		$this->db->where('school_id',$this->school_id);
        $q = $this->db->get('read_notification');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            $data = array(
                'notification_id' => $notification_id,
                'teacher_id' => $teacher_id,
                'student_id'=>'0'
            );
			$data['school_id']= $this->school_id;
            $this->db->insert('read_notification', $data);
        }
    }

    function add_exam_schedule($data) {
        $this->db->where('exam_id', $data['exam_id']);
        $this->db->where('teacher_subject_id', $data['teacher_subject_id']);
        $this->db->where('school_id',$this->school_id);
		$q = $this->db->get('exam_schedules');
        if ($q->num_rows() > 0) {
            $result = $q->row_array();
            $this->db->where('id', $result['id']);
            $this->db->update('exam_schedules', $data);
        } else {
			$data['school_id']= $this->school_id;
            $this->db->insert('exam_schedules', $data);
        }
    }
	
	function getData($class_id,$massage_to,$section_id){
		if($massage_to == 'student'){
			if($section_id == 'all'){
				$this->db->select('students.firstname,students.lastname,students.id');    
				$this->db->from('student_session');
				$this->db->join('students', 'student_session.student_id = students.id');
				$this->db->where('student_session.class_id',$class_id);
				$this->db->where('student_session.school_id',$this->school_id);
				$query = $this->db->get();
				return $query->result_array(); 
			}else{
				$this->db->select('students.firstname,students.lastname,students.id');    
				$this->db->from('student_session');
				$this->db->join('students', 'student_session.student_id = students.id');
				$this->db->where('student_session.class_id',$class_id);
				$this->db->where('student_session.section_id',$section_id);
				$this->db->where('student_session.school_id',$this->school_id);
				$query = $this->db->get();
				return $query->result_array(); 
			}
			
		}
		if($massage_to == 'parent'){
			if($section_id == 'all'){
				$this->db->select('students.father_name,students.id,students.firstname,students.lastname');    
				$this->db->from('student_session');
				$this->db->join('students', 'student_session.student_id = students.id');
				$this->db->where('student_session.class_id',$class_id);
				$this->db->where('student_session.school_id',$this->school_id);
				$query = $this->db->get();
				return $query->result_array(); 
			}else{
				$this->db->select('students.father_name,students.id,students.firstname,students.lastname');   
				$this->db->from('student_session');
				$this->db->join('students', 'student_session.student_id = students.id');
				$this->db->where('student_session.class_id',$class_id);
				$this->db->where('student_session.section_id',$section_id);
				$this->db->where('student_session.school_id',$this->school_id);
				$query = $this->db->get();
				return $query->result_array(); 
			}
		}
		if($massage_to == 'Teachers'){
			
			if($section_id != 'all'){
				$this->db->select('teachers.id,teachers.name');
				$this->db->from('class_sections');
				$this->db->join('teacher_subjects', 'class_sections.id = teacher_subjects.class_section_id');	
				$this->db->join('teachers', 'teacher_subjects.teacher_id = teachers.id');	
				$this->db->where('class_sections.class_id',$class_id);
				$this->db->where('class_sections.section_id',$section_id);
				$this->db->where('class_sections.school_id',$this->school_id);
				$query = $this->db->get();
				return  $query->result_array(); 
				 
			}
		}
	}
	function getRecords($class,$section_id,$from_this,$flagbit){
 
		if($flagbit == 'all_student'){
			$this->db->select('mobileno');
			$this->db->from('students');
			$this->db->where('school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array(); 
		}
		if($flagbit == 'student_with_class'){

			$this->db->select('students.mobileno');
			$this->db->from('student_session');
			$this->db->join('students', 'student_session.student_id = students.id');
			$this->db->where('student_session.class_id',$class);
			$this->db->where('student_session.school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'student_with_class_and_section'){
			$this->db->select('students.mobileno');
			$this->db->from('student_session');
			$this->db->join('students', 'student_session.student_id = students.id');
			$this->db->where('student_session.class_id',$class);
			$this->db->where('student_session.section_id',$section_id);
			$this->db->where('student_session.school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'student_with_class_and_section_student'){
			$this->db->select('firstname,mobileno');
			$this->db->from('students');
			$this->db->where_in('id',$from_this);
			$this->db->where('school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'all_parents'){
			$this->db->select('father_name,father_phone');
			$this->db->from('students');
			$this->db->where('school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'parent_with_class'){
			$this->db->select('students.father_name,father_phone');
			$this->db->from('student_session');
			$this->db->join('students', 'student_session.student_id = students.id');
			$this->db->where('student_session.class_id',$class);
			$this->db->where('student_session.school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'parent_with_class_and_section'){
                        
			$this->db->select('students.father_name,father_phone');
			$this->db->from('student_session');
			$this->db->join('students', 'student_session.student_id = students.id');
			$this->db->where('student_session.class_id',$class);
			$this->db->where('student_session.section_id',$section_id);
			$this->db->where('student_session.school_id', $this->school_id);
			$query = $this->db->get();

			return  $query->result_array();
		}
		if($flagbit == 'parent_with_class_and_section_parent'){
			$this->db->select('father_name,father_phone');
			$this->db->from('students');
			$this->db->where_in('id',$from_this);
			$this->db->where('school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'all_teacher'){
			$this->db->select('name,phone');
			$this->db->from('teachers');
			$this->db->where('school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array(); 
		}
		if($flagbit == 'all_teacher_with_class'){
			$this->db->select('teachers.name,phone');
			$this->db->from('class_sections');
			$this->db->join('teacher_subjects', 'class_sections.id = teacher_subjects.class_section_id');
			$this->db->join('teachers', 'teacher_subjects.teacher_id = teachers.id');
			$this->db->where('class_sections.class_id',$class);
			$this->db->where('class_sections.school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'all_teacher_with_class_section'){
			$this->db->select('teachers.name,phone');
			$this->db->from('class_sections');
			$this->db->join('teacher_subjects', 'class_sections.id = teacher_subjects.class_section_id');
			$this->db->join('teachers', 'teacher_subjects.teacher_id = teachers.id');
			$this->db->where('class_sections.class_id',$class);
			$this->db->where('class_sections.section_id',$section_id);
			$this->db->where('class_sections.school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'all_teacher_with_class_section_particuler'){
			$this->db->select('name,phone');
			$this->db->from('teachers');
			$this->db->where_in('id',$from_this);
			$this->db->where('school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		if($flagbit == 'all_students_parents'){
			$this->db->select();
			$this->db->from('students');
			$this->db->where('school_id', $this->school_id);
			$query = $this->db->get();
			return  $query->result_array();
		}
		
	}
	public function getStudentNotification($ids)
	{
		/*$this->db->select();
		$this->db->from('send_notification_2');
		$this->db->where(array('send_to'=>'all','class'=>'all','section'=>'all','receiver_id'=>'all'));
		$this->db->or_where(array('send_to'=>'student','class'=>'all','section'=>'all','receiver_id'=>'all'));*/
		$class_id = $ids['class_id'];
		$section_id = $ids['section_id'];
		$student_id = $ids['student_id'];
		$sql = "SELECT * FROM send_notification_2 WHERE send_to = 'all' AND class = 'all' AND section = 'all' AND receiver_id = 'all' and school_id = '$this->school_id' and is_active ='yes' OR send_to = 'student' AND class = 'all' AND section = 'all' AND receiver_id = 'all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'student' and class= '$class_id' and section = 'all' and receiver_id='all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'student' and class= '$class_id' and section = '$section_id' and receiver_id='all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'student' and class= '$class_id' and section = '$section_id' and FIND_IN_SET ('$student_id', receiver_id) and school_id = '$this->school_id' and is_active ='yes' order by id desc";
		$query = $this->db->query($sql);
		return $query->result_array();
		//var_dump($this->db->last_query());
	}
	
	public function getParentNotification($ids){
	    $class_id = $ids['class_id'];
		$section_id = $ids['section_id'];
		$student_id = $ids['student_id'];
		$sql = "SELECT * FROM send_notification_2 WHERE send_to = 'all' AND class = 'all' AND section = 'all' AND receiver_id = 'all' and school_id = '$this->school_id' and is_active ='yes' OR send_to = 'parent' AND class = 'all' AND section = 'all' AND receiver_id = 'all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'parent' and class= '$class_id' and section = 'all' and receiver_id='all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'parent' and class= '$class_id' and section = '$section_id' and receiver_id='all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'parent' and class= '$class_id' and section = '$section_id' and FIND_IN_SET ('$student_id', receiver_id) and school_id = '$this->school_id' and is_active ='yes' order by id desc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getTeacherNotification($classess,$sections,$teacherId)
	{
		$sql = "SELECT * FROM send_notification_2 WHERE send_to = 'all' AND class = 'all' AND section = 'all' AND receiver_id = 'all' and school_id = '$this->school_id' and is_active ='yes' OR send_to = 'Teachers' AND class = 'all' AND section = 'all' AND receiver_id = 'all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'Teachers' and class IN ('$classess') and section = 'all' and receiver_id='all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'Teachers' and class IN ('$classess') and section IN ('$sections') and receiver_id='all' and school_id = '$this->school_id' and is_active ='yes' or send_to = 'Teachers' and class IN ('$classess') and section IN ('$sections') and FIND_IN_SET ('$teacherId', receiver_id) and school_id = '$this->school_id' and is_active ='yes' order by id desc";
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	
	public function getTokens($msgTo,$class,$section,$from,$school_id= null){
	   $tokens = [];
	   if($school_id == null){
	       $school_id = $this->school_id;
	   }
	    if($msgTo == 'all' & $class == 'all' & $section == 'all' & $from[0] == 'all'){
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id'";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    // for student
	    
	    if($msgTo == 'student' & $class == 'all' & $section == 'all' & $from[0] == 'all'){
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='student'";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    if($msgTo == 'student' & $class != 'all' & $section == 'all' & $from[0] == 'all'){
	        $this->db->select('students.id');
			$this->db->from('student_session');
			$this->db->join('students', 'student_session.student_id = students.id');
			$this->db->where('student_session.class_id',$class);
			$this->db->where('student_session.school_id', $school_id);
			$query = $this->db->get();
			$Studentids =   $query->result_array();
			$ids ='';
			foreach($Studentids as $value){
			    $ids .= $value['id'].',';
			}
			$ids = rtrim($ids,',');
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='student' and user_id IN($ids)";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    if($msgTo == 'student' & $class != 'all' & $section != 'all' & $from[0] == 'all'){
	        $this->db->select('students.id');
			$this->db->from('student_session');
			$this->db->join('students', 'student_session.student_id = students.id');
			$this->db->where('student_session.class_id',$class);
			$this->db->where('student_session.section_id',$section);
			$this->db->where('student_session.school_id', $school_id);
			$query = $this->db->get();
			$Studentids =   $query->result_array();
			$ids ='';
			foreach($Studentids as $value){
			    $ids .= $value['id'].',';
			}
			$ids = rtrim($ids,',');
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='student' and user_id IN($ids)";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    if($msgTo == 'student' & $class != 'all' & $section != 'all' & $from[0] != 'all'){
	        $ids ='';
			foreach($from as $value){
			    $ids .= $value.',';
			}
			$ids = rtrim($ids,',');
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='student' and user_id IN($ids)";
	       $query = $this->db->query($sql);
	       
	       return $query->result_array();
	    }
	    // for  parent 
	    if($msgTo == 'parent' & $class == 'all' & $section == 'all' & $from[0] == 'all'){
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='parent'";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    if($msgTo == 'parent' & $class != 'all' & $section == 'all' & $from[0] == 'all'){
	        $this->db->select('students.id');
			$this->db->from('student_session');
			$this->db->join('students', 'student_session.student_id = students.id');
			$this->db->where('student_session.class_id',$class);
			$this->db->where('student_session.school_id', $this->school_id);
			$query = $this->db->get();
			$Studentids =   $query->result_array();
			$ids ='';
			foreach($Studentids as $value){
			    $ids .= $value['id'].',';
			}
			$ids = rtrim($ids,',');
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='parent' and user_id IN($ids)";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    if($msgTo == 'parent' & $class != 'all' & $section != 'all' & $from[0] == 'all'){
	        $this->db->select('students.id');
			$this->db->from('student_session');
			$this->db->join('students', 'student_session.student_id = students.id');
			$this->db->where('student_session.class_id',$class);
			$this->db->where('student_session.section_id',$section);
			$this->db->where('student_session.school_id', $school_id);
			$query = $this->db->get();
			$Studentids =   $query->result_array();
		    $ids ='';
			foreach($Studentids as $value){
			    $ids .= $value['id'].',';
			}
			$ids = rtrim($ids,',');
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='parent' and user_id IN($ids)";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    if($msgTo == 'parent' & $class != 'all' & $section != 'all' & $from[0] != 'all'){
	       $ids ='';
			foreach($from as $value){
			    $ids .= $value.',';
			}
			$ids = rtrim($ids,',');
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='parent' and user_id IN($ids)";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    // for teacher
	    if($msgTo == 'teacher' & $class == 'all' & $section == 'all' & $from[0] == 'all'){
	       $sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='teacher'";
	       $query = $this->db->query($sql);
	       return $query->result_array();
	    }
	    if($msgTo == 'teacher' & $class != 'all' & $section == 'all' & $from[0] == 'all'){
	        $this->db->select('teachers.id');
    		$this->db->from('class_sections');
    		$this->db->join('teacher_subjects', 'class_sections.id = teacher_subjects.class_section_id');
    		$this->db->join('teachers', 'teacher_subjects.teacher_id = teachers.id');
    		$this->db->where('class_sections.class_id',$class);
    		$this->db->where('class_sections.school_id', $school_id);
    		$query = $this->db->get();
    		$teacherIds =   $query->result_array();
    		$ids ='';
			foreach($teacherIds as $value){
			    $ids .= $value['id'].',';
			}
			$ids = rtrim($ids,',');
			$sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='teacher' and user_id IN($ids)";
	        $query = $this->db->query($sql);
	        return $query->result_array();
    		
	    }
	    if($msgTo == 'teacher' & $class != 'all' & $section != 'all' & $from[0] == 'all'){
	        $this->db->select('teachers.id');
    		$this->db->from('class_sections');
    		$this->db->join('teacher_subjects', 'class_sections.id = teacher_subjects.class_section_id');
    		$this->db->join('teachers', 'teacher_subjects.teacher_id = teachers.id');
    		$this->db->where('class_sections.class_id',$class);
    		$this->db->where('class_sections.section_id',$section);
    		$this->db->where('class_sections.school_id', $school_id);
    		$query = $this->db->get();
    		$teacherIds =   $query->result_array();
    		$ids ='';
			foreach($teacherIds as $value){
			    $ids .= $value['id'].',';
			}
			$ids = rtrim($ids,',');
			$sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='teacher' and user_id IN($ids)";
	        $query = $this->db->query($sql);
	        return $query->result_array();
    		
	    }
	    if($msgTo == 'teacher' & $class != 'all' & $section != 'all' & $from[0] == 'all'){
	        $ids ='';
			foreach($from as $value){
			    $ids .= $value.',';
			}
			$ids = rtrim($ids,',');
			$sql = "SELECT device_token FROM device_tokens WHERE school_id='$school_id' and role='teacher' and user_id IN($ids)";
	        $query = $this->db->query($sql);
	        return $query->result_array();
	    }
	   
	}

}
