<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examschedule_model extends MY_Model {

    public function __construct() {
        parent::__construct();
		$this->current_session = $this->setting_model->getCurrentSession();
    }

    public function getDetailbyClsandSection($class_id, $section_id, $exam_id) {
        $query = $this->db->query("SELECT exam_schedules.*,subjects.name,subjects.type FROM exam_schedules,teacher_subjects,exams,class_sections,subjects WHERE exam_schedules.teacher_subject_id = teacher_subjects.id and exam_schedules.exam_id =exams.id and class_sections.id =teacher_subjects.class_section_id and teacher_subjects.subject_id=subjects.id and class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and exam_id =" . $this->db->escape($exam_id) . " and exam_schedules.session_id=" . $this->db->escape($this->current_session));
        return $query->result_array(); 
    }
	
    public function getExamByClassandSection($class_id, $section_id) {
        $sql= "SELECT * FROM exams INNER JOIN (SELECT exam_schedules.*,teacher_subjects.class_id,teacher_subjects.class_name ,teacher_subjects.section_id,teacher_subjects.section_name FROM `exam_schedules` INNER JOIN (SELECT teacher_subjects.*,classes.id as `class_id`,classes.class as `class_name` ,sections.id as `section_id`,sections.section as `section_name` FROM `class_sections` 
        INNER JOIN teacher_subjects on teacher_subjects.class_section_id=class_sections.id
        INNER JOIN classes on classes.id=class_sections.class_id
        INNER JOIN sections on sections.id=class_sections.section_id
        WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and teacher_subjects.session_id=".$this->db->escape($this->current_session).") as teacher_subjects on teacher_subjects.id=teacher_subject_id group by exam_schedules.exam_id) as exam_schedules on exams.id=exam_schedules.exam_id"; 
		$query = $this->db->query($sql);
		return $query->result_array(); 
    }
    public function s_getExamSchedules($class_id = null,$section_id=null,$exam_id = null) {
        $this->db->select('p_exam_timetable.*,exams.name as `exam_name`,classes.class as `class_name`,sections.section as `section_name`,group_concat(subjects.name) as subjects,group_concat(p_exam_timetable.date) as exam_date,group_concat(p_exam_timetable.written_marks) as w_marks,group_concat(p_exam_timetable.practical_marks) as p_marks')->from('p_exam_timetable');
        $this->db->join('exams', 'p_exam_timetable.exam_id = exams.id');
        $this->db->join('classes', 'p_exam_timetable.class_id = classes.id');
        $this->db->join('sections', 'sections.id = p_exam_timetable.section_id');
        $this->db->join('teacher_subjects', 'teacher_subjects.id = p_exam_timetable.teacher_subject_id');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        
        $this->db->where('p_exam_timetable.session_id', $this->current_session);
		$this->db->where('p_exam_timetable.school_id',$this->school_id);
        if ($class_id !=null) {
            $this->db->where('p_exam_timetable.class_id', $class_id);
        }
        if ($section_id !=null) {
            $this->db->where('p_exam_timetable.section_id', $section_id);
        }
        if ($exam_id != null) {
            $this->db->where('p_exam_timetable.exam_id', $exam_id);   
        }
		$this->db->group_by('p_exam_timetable.exam_id');
		$query = $this->db->get();
        //var_dump($this->db->last_query());die;
        return $query->result_array(); 
    }
    
    public function s_getExmSchSingleSub($data){
        $this->db->select('p_exam_timetable.exam_id,p_exam_timetable.teacher_subject_id,p_exam_timetable.written_marks,p_exam_timetable.practical_marks,p_exam_timetable.exam_type,subjects.name as `sub_name`')->from('p_exam_timetable');
        $this->db->join('teacher_subjects', 'teacher_subjects.id = p_exam_timetable.teacher_subject_id');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        $this->db->where('p_exam_timetable.id',$data['id']);
        
		$query = $this->db->get();
		
		//echo $this->db->last_query();die;
        return $query->row_array(); 
    }
    
    public function get_std_recorded_marks($data){
        $this->db->select('p_exam_timetable.exam_id,p_exam_timetable.teacher_subject_id,p_exam_timetable.written_marks,p_exam_timetable.practical_marks,p_exam_timetable.exam_type,p_recorded_marks.id as `p_recorded_marks_id`,p_recorded_marks.p_exam_timetable_id,p_recorded_marks.std_session_id as `student_session_id`,p_recorded_marks.is_absent,p_recorded_marks.written_mrks as `written_marks`,p_recorded_marks.practical_mrks as `practical_marks`,students.firstname,students.lastname')->from('p_recorded_marks');
        $this->db->join('p_exam_timetable', 'p_exam_timetable.id = p_recorded_marks.p_exam_timetable_id');
        $this->db->join('student_session', 'student_session.id = p_recorded_marks.std_session_id');
        $this->db->join('students', 'student_session.student_id = students.id');
        $this->db->join('transfer_certificate','students.id=transfer_certificate.student_id','left');
        $this->db->where('p_recorded_marks.p_exam_timetable_id',$data['id']);
        $this->db->where('transfer_certificate.student_id IS NULL');
        
		$query = $this->db->get();
		
		//echo $this->db->last_query();die;
        return $query->result_array(); 
    }
    
    public function s_save_std_record_marks($data){
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('p_recorded_marks', $data); 
        } else {
            $this->db->insert('p_recorded_marks', $data); 
            return $this->db->insert_id();
        }
    }
    
    public function get_std_obs_marks($data){
        $this->db->select('p_record_obs_marks.id as `p_record_obs_marks_id`,p_record_obs_marks.std_session_id as `student_session_id`,p_record_obs_marks.exam_id,p_record_obs_marks.section_id,p_record_obs_marks.class_id,p_record_obs_marks.work_edu,p_record_obs_marks.art_craft,p_record_obs_marks.health_phy_activity,students.firstname,students.lastname')
        ->from('p_record_obs_marks');
        $this->db->join('student_session', 'student_session.id = p_record_obs_marks.std_session_id');
        $this->db->join('students', 'student_session.student_id = students.id');
        $this->db->where('p_record_obs_marks.exam_id',$data['exam_id']);
        $this->db->where('p_record_obs_marks.class_id',$data['class_id']);
        $this->db->where('p_record_obs_marks.section_id',$data['section_id']);
        
		$query = $this->db->get();
		
		//echo $this->db->last_query();die;
        return $query->result_array(); 
    }
    public function get_std_obs_marks2($data){
        $this->db->select('p_record_obs_marks2.id as `p_record_obs_marks_id`,p_record_obs_marks2.std_session_id as `student_session_id`,p_record_obs_marks2.section_id,p_record_obs_marks2.class_id,p_record_obs_marks2.marks,p_record_obs_marks2.marks_2,students.firstname,students.lastname')
        ->from('p_record_obs_marks2');
        $this->db->join('student_session', 'student_session.id = p_record_obs_marks2.std_session_id');
        $this->db->join('students', 'student_session.student_id = students.id');
        $this->db->join('transfer_certificate','students.id=transfer_certificate.student_id');
        $this->db->where('p_record_obs_marks2.session_id',$this->current_session);
        $this->db->where('p_record_obs_marks2.class_id',$data['class_id']);
        $this->db->where('p_record_obs_marks2.section_id',$data['section_id']);
        $this->db->where('p_record_obs_marks2.ob_id',$data['ob_id']);
        $this->db->where('transfer_certificate.student_id IS NULL');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array(); 
    }
    
    public function s_save_std_obs_marks($data){
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('p_record_obs_marks', $data); 
        } else {
            $this->db->insert('p_record_obs_marks', $data); 
            return $this->db->insert_id();
        }
    }
    public function s_save_std_obs_marks2($data){
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('p_record_obs_marks2', $data); 
        } else {
            $data['session_id'] = $this->current_session;
            $this->db->insert('p_record_obs_marks2', $data); 
            return $this->db->insert_id();
        }
    }
    //For Marksheet Start
    //Get Std By SESSION
    public function get_std_by_stdsessid($student_sessid){
        $this->db->select('*')->from('student_session');
        $this->db->join('students', 'student_session.student_id = students.id');
        $this->db->where('student_session.id',$student_sessid);
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->row_array();    
    }
    
    //Get Subs Group By Exm
    public function s_getExamSubjs($data) {
        $this->db->select('p_exam_timetable.*,exams.name as `exam_name`,classes.class as `class_name`,sections.section as `section_name`,group_concat(subjects.name) as subjects,group_concat(p_exam_timetable.date) as exam_date,group_concat(p_exam_timetable.written_marks) as w_marks,group_concat(p_exam_timetable.practical_marks) as p_marks')->from('p_exam_timetable');
        $this->db->join('exams', 'p_exam_timetable.exam_id = exams.id');
        $this->db->join('classes', 'p_exam_timetable.class_id = classes.id');
        $this->db->join('sections', 'sections.id = p_exam_timetable.section_id');
        $this->db->join('teacher_subjects', 'teacher_subjects.id = p_exam_timetable.teacher_subject_id');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        
        $this->db->where('p_exam_timetable.session_id', $this->current_session);
		$this->db->where('p_exam_timetable.school_id',$this->school_id);
		$this->db->where('p_exam_timetable.class_id',$data['class_id']);
		$this->db->where('p_exam_timetable.section_id',$data['section_id']);
		
		$this->db->group_by('p_exam_timetable.exam_id');
		$query = $this->db->get();
        return $query->result_array(); 
    }
    //GET MARKS
    public function get_std_sub_mrks2($data){//For Marksheet WITH OBSERVATIONAL MARKS For Single Exam
        //$this->db->select('p_exam_timetable.*,exams.name as `exam_name`,classes.class as `class_name`,sections.section as `section_name`,group_concat(subjects.name) as subjects,group_concat(p_exam_timetable.date) as exam_date,group_concat(p_exam_timetable.written_marks) as w_marks,group_concat(p_exam_timetable.practical_marks) as p_marks, group_concat(p_recorded_marks.is_absent) as is_absent, group_concat(p_recorded_marks.written_mrks) as std_written, group_concat(p_recorded_marks.practical_mrks) as std_practical')->from('p_exam_timetable');
        $this->db->select('p_exam_timetable.*,exams.name as `exam_name`,classes.class as `class_name`,sections.section as `section_name`,group_concat(subjects.name) as subjects,group_concat(p_exam_timetable.date) as exam_date,group_concat(p_exam_timetable.written_marks) as w_marks,group_concat(p_exam_timetable.practical_marks) as p_marks, group_concat(p_recorded_marks.is_absent) as is_absent, group_concat(p_recorded_marks.written_mrks) as std_written, group_concat(p_recorded_marks.practical_mrks) as std_practical,p_record_obs_marks.work_edu as obs_work_edu ,p_record_obs_marks.art_craft as obs_art_craft,p_record_obs_marks.health_phy_activity as obs_health_phy_activity')->from('p_exam_timetable');
        $this->db->join('exams', 'p_exam_timetable.exam_id = exams.id');
        $this->db->join('classes', 'p_exam_timetable.class_id = classes.id');
        $this->db->join('sections', 'sections.id = p_exam_timetable.section_id');
        $this->db->join('teacher_subjects', 'teacher_subjects.id = p_exam_timetable.teacher_subject_id');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        $this->db->join('p_recorded_marks', 'p_recorded_marks.p_exam_timetable_id = p_exam_timetable.id','left');
        $this->db->join('p_record_obs_marks', 'p_record_obs_marks.exam_id = p_exam_timetable.exam_id','left');
        
        
        $this->db->where('p_exam_timetable.session_id', $this->current_session);
		$this->db->where('p_exam_timetable.school_id',$this->school_id);
		$this->db->where('p_exam_timetable.exam_id',$data['exam_id']);
		$this->db->where('p_exam_timetable.class_id',$data['class_id']);
		$this->db->where('p_exam_timetable.section_id',$data['section_id']);
		$this->db->where('p_recorded_marks.std_session_id',$data['student_id']);
		$this->db->where('p_record_obs_marks.std_session_id',$data['student_id']);
		
		$this->db->group_by('p_exam_timetable.exam_id');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->row_array();    
    }
    
    public function get_std_sub_mrks($data){//For Marksheet WITH OBSERVATIONAL MARKS 
        $this->db->select('p_exam_timetable.*,exams.name as `exam_name`,classes.class as `class_name`,sections.section as `section_name`,group_concat(subjects.name order by subjects.id) as subjects,group_concat(p_exam_timetable.date order by subjects.id) as exam_date,group_concat(p_exam_timetable.written_marks order by subjects.id) as w_marks,group_concat(p_exam_timetable.practical_marks order by subjects.id) as p_marks, group_concat(p_recorded_marks.is_absent order by subjects.id) as is_absent, group_concat(p_recorded_marks.written_mrks order by subjects.id) as std_written, group_concat(p_recorded_marks.practical_mrks order by subjects.id) as std_practical,p_record_obs_marks.work_edu as obs_work_edu ,p_record_obs_marks.art_craft as obs_art_craft,p_record_obs_marks.health_phy_activity as obs_health_phy_activity')->from('p_exam_timetable');
        $this->db->join('exams', 'p_exam_timetable.exam_id = exams.id');
        $this->db->join('classes', 'p_exam_timetable.class_id = classes.id');
        $this->db->join('sections', 'sections.id = p_exam_timetable.section_id');
        $this->db->join('teacher_subjects', 'teacher_subjects.id = p_exam_timetable.teacher_subject_id');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        $this->db->join('p_recorded_marks', 'p_recorded_marks.p_exam_timetable_id = p_exam_timetable.id','left');
        $this->db->join('p_record_obs_marks', 'p_record_obs_marks.exam_id = p_exam_timetable.exam_id','left');
        
        
        $this->db->where('p_exam_timetable.session_id', $this->current_session);
		$this->db->where('p_exam_timetable.school_id',$this->school_id);
		$this->db->where('p_exam_timetable.class_id',$data['class_id']);
		$this->db->where('p_exam_timetable.section_id',$data['section_id']);
		$this->db->where('p_recorded_marks.std_session_id',$data['student_id']);
		$this->db->where('p_record_obs_marks.std_session_id',$data['student_id']);
		
		$this->db->group_by('p_exam_timetable.exam_id');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
	//	var_dump($this->db->last_query());die;
        return $query->result_array();    
    }
    public function get_std_sub_mrks3($data){   //For Marksheet WITHOUT OBSERVATIONAL MARKS
        $this->db->select('p_exam_timetable.*,exams.name as `exam_name`,classes.class as `class_name`,sections.section as `section_name`,group_concat(subjects.name) as subjects,group_concat(p_exam_timetable.date) as exam_date,group_concat(p_exam_timetable.written_marks) as w_marks,group_concat(p_exam_timetable.practical_marks) as p_marks, group_concat(p_recorded_marks.is_absent) as is_absent, group_concat(p_recorded_marks.written_mrks) as std_written, group_concat(p_recorded_marks.practical_mrks) as std_practical')->from('p_exam_timetable');
        $this->db->join('exams', 'p_exam_timetable.exam_id = exams.id');
        $this->db->join('classes', 'p_exam_timetable.class_id = classes.id');
        $this->db->join('sections', 'sections.id = p_exam_timetable.section_id');
        $this->db->join('teacher_subjects', 'teacher_subjects.id = p_exam_timetable.teacher_subject_id');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        $this->db->join('p_recorded_marks', 'p_recorded_marks.p_exam_timetable_id = p_exam_timetable.id','left');
        
        
        $this->db->where('p_exam_timetable.session_id', $this->current_session);
		$this->db->where('p_exam_timetable.school_id',$this->school_id);
		$this->db->where('p_exam_timetable.class_id',$data['class_id']);
		$this->db->where('p_exam_timetable.section_id',$data['section_id']);
		$this->db->where('p_recorded_marks.std_session_id',$data['student_id']);
		
		$this->db->group_by('p_exam_timetable.exam_id');
		$query = $this->db->get();
		echo $this->db->last_query();die;
        return $query->result_array();    
    }
    function test(){
        $this->db->select('p_exam_timetable.*,subjects.name,exams.name');
        $this->db->from('p_exam_timetable');
        $this->db->join('exams','p_exam_timetable.exam_id = exams.id');
        $this->db->join('classes', 'p_exam_timetable.class_id = classes.id');
        $this->db->join('sections', 'sections.id = p_exam_timetable.section_id');
        $this->db->join('teacher_subjects', 'teacher_subjects.id = p_exam_timetable.teacher_subject_id');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        $this->db->join('p_recorded_marks', 'p_recorded_marks.p_exam_timetable_id = p_exam_timetable.id');
        $this->db->group_by('p_exam_timetable.exam_id');
		$query = $this->db->get();
		echo '<pre>';var_dump($query->result_array());echo '</pre>';die;
		echo $this->db->last_query();die;
    }
    public function get_school($id = null){
         $this->db->select('*')->from('schools');
         $this->db->join('sch_settings','sch_settings.school_id = schools.school_id');
        if ($id != null) {
            $this->db->where('schools.school_id', $id);
        } else {
            $this->db->order_by('school_id');
        }
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
        
    }
    public function save_marksheet_pdf($data){
        $this->db->select('*')->from('p_std_marksheet');
        $this->db->where('std_id',$data['std_id']);
        $this->db->where('std_session_id',$data['std_session_id']);
        $this->db->where('school_id',$data['school_id']);
        $this->db->where('session_id',$data['session_id']);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $num = $query->num_rows();
        if($num == '0'){
            $this->db->insert('p_std_marksheet',$data);
        }else{
            $row = $query->row_array(); 
            $file = $row['pdf_path'];
            if (file_exists($file)){
                unlink($file);   
            }
            $this->db->where('id', $row['id']);
            $this->db->update('p_std_marksheet', $data); 
        }
    }
    //For Marksheet End
    public function getresultByStudentandExam($exam_id, $student_id) {
        $query = $this->db->query("SELECT exam_schedules.id as `exam_schedule_id`,exam_schedules.full_marks,exam_schedules.exam_id as `exam_id`,
            exam_schedules.passing_marks,exam_results.attendence,exam_results.get_marks,exam_results.note, subjects.name,subjects.code,subjects.type  FROM `exam_schedules` INNER JOIN teacher_subjects ON teacher_subjects.id=exam_schedules.teacher_subject_id  INNER JOIN exam_results ON exam_results.exam_schedule_id=exam_schedules.id INNER JOIN subjects ON teacher_subjects.subject_id=subjects.id  WHERE exam_schedules.exam_id=" . $this->db->escape($exam_id) . " and teacher_subjects.session_id=" . $this->db->escape($this->current_session) . " and exam_results.student_id=" . $this->db->escape($student_id) . " and teacher_subjects.session_id=" . $this->db->escape($this->current_session));
        return $query->result_array(); 
    }

    public function getclassandsectionbyexam($exam_id) {
        $query = $this->db->query("SELECT exam_schedules.exam_id,classes.id as `class_id`,sections.id as `section_id`,classes.class as `class`,sections.section as `section` FROM `exam_schedules`,`teacher_subjects`,`class_sections`,classes,sections WHERE exam_schedules.teacher_subject_id = teacher_subjects.id and class_sections.id =teacher_subjects.class_section_id and class_sections.class_id =classes.id and class_sections.section_id=sections.id and exam_schedules.exam_id=" . $this->db->escape($exam_id) . " and exam_schedules.session_id=" . $this->db->escape($this->current_session) . " group by exam_schedules.exam_id");
        return $query->result_array();
    }
	// pratyush 
	public function getExamSchedule($id){
		$this->db->select('*')->from('exam_schedules')->where('exam_id',$id);
		$query = $this->db->get();
		return $query->row_array();
		
	}
	//pratyush 
	public function getExamOnline($exam_id){
		$query = $this->db->query("select * from exams where id=".$exam_id."");
		return $query->result_array(); 
	}
    public function s_getExmSchSubj($data){
        $this->db->select('p_exam_timetable.*,subjects.name as `sub_name`')->from('p_exam_timetable');
        $this->db->join('teacher_subjects', 'teacher_subjects.id = p_exam_timetable.teacher_subject_id');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        $this->db->where('p_exam_timetable.exam_id',$data['exam_id']);
        $this->db->where('p_exam_timetable.section_id',$data['section_id']);
        $this->db->where('p_exam_timetable.class_id',$data['class_id']);
		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result_array(); 
    }

}
