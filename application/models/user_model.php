<?php

Class User_model extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {

	// Query to check whether username already exist or not
	$condition = "email =" . "'" . $data['email'] . "'";
	$this->db->select('*');
	$this->db->from('tbl_user');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() == 0) {
		$data['reg_date'] = date('Y-m-d H:i:s');
		$data['state'] = 'pending';
		$data['email_url'] = sha1(time() . $data['email']);
		
		// Query to insert data in database
		$this->db->insert('tbl_user', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
	} 
	else {
		return false;
	}
}

// Read data using username and password
public function login($data) {

	$condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
	$this->db->select('*');
	$this->db->from('tbl_user');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();

	if ($query->num_rows() == 1) {
		return true;
	} 
	else {
		return false;
	}
}

// Read data from database to show data in admin page
public function read_user_information($username) {

	$condition = "email =" . "'" . $username . "' AND " . "state =" . "'active'";
	$this->db->select('user_id');
	$this->db->from('tbl_user');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();

	if ($query->num_rows() == 1) {
		return $query->result();
	} 
	else {
		return false;
	}
}


//get all courses details 
public function read_course_details($courseid = 0) {

	if($courseid == 0){
		$this->db->select('*');
		$this->db->from('tbl_course');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}
	}
	else{
		$condition = "course_id =" . "'" . $courseid . "'";
		$this->db->select('*');
		$this->db->from('tbl_course');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}



	}
}
//get selected course leveles or details
public function read_select_course_details($courseid) {

		$condition = "course_id =" . "'" . $courseid . "'";
		$this->db->select('*');
		$this->db->from('tbl_course_level');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}	
	
}


//get coruse level details if levelid provide
function course_level($levelid){
	$condition = "level_id =" . "'" . $levelid . "'";
	$this->db->select('*');
	$this->db->from('tbl_course_level');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}

}

//get course subject details if subjectiid provide
function get_subject($subjectid){
	$condition = "subject_id =" . "'" . $subjectid . "'";
	$this->db->select('*');
	$this->db->from('tbl_course_subject');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}

}
//get law report details if reportid submit
function get_report($reportid){
	$condition = "report_id =" . "'" . $reportid . "'" . " AND " . "state=" . "'active'";
	$this->db->select('*');
	$this->db->from('tbl_law_report');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}

}



//get selected course subjects or details
public function read_select_course_subject_details($levelid) {
	$condition = "level_id =" . "'" . $levelid . "'";
	$this->db->select('*');
	$this->db->from('tbl_course_subject');
	$this->db->where($condition);
	$query = $this->db->get();

	


	if ($query->num_rows() > 0) {
		return $query->result();
	} 
	else {
		return false;
	}	
}


//get selected course subjects or details
public function read_select_course_subject_case_details($subjectid) {
//SELECT * FROM `tbl_law_report` WHERE `report_id` IN (SELECT `report_id` FROM `tbl_law_report_course_join` WHERE `subject_id` = 1)
	$condition = "report_id IN(SELECT report_id FROM tbl_law_report_course_join WHERE subject_id =" . "'" . $subjectid . "')";
	//$condition = "level_id =" . "'" . $subjectid . "'";
	$this->db->select('*');
	$this->db->from('tbl_law_report');
	$this->db->where($condition);
	$query = $this->db->get();

	if ($query->num_rows() > 0) {
		return $query->result();
	} 
	else {
		return false;
	}	
}

//get selected case report
public function read_select_course_subject_case_details_report($reportid,$sessionid,$subjectid) {

	//get previous user created facts with the law report


$condition = "tbl_law_report.report_id = tbl_fact_user_select.report_id AND tbl_fact_user_select.report_id=" . "'" . $reportid . "' AND tbl_fact_user_select.user_id =" . "'" . $sessionid . "' AND tbl_fact_user_select.subject_id=" . "'" . $subjectid . "'";
$this->db->select('tbl_fact_user_select.auto_id,
					tbl_law_report.report_id, 
                   tbl_law_report.report_title, 
                   tbl_law_report.report_year, 
                   tbl_fact_user_select.report_full_with_fact,
                   tbl_fact_user_select.auto_id');
$this->db->from('tbl_law_report');
$this->db->join('tbl_fact_user_select', 'tbl_law_report.report_id= tbl_fact_user_select.report_id');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();





	if($query->num_rows() == 1){
		$condition = "tbl_fact_user_select_auto_id =" . "'" . $query->result()[0]->auto_id . "'";
		$this->db->select('*');
		$this->db->from('tbl_user_fact_details');
		$this->db->where($condition);
		$query_fact= $this->db->get();
		$result = array(
			'facts' => $query_fact->result(),
			'law_report' => $query->result(),
			'law_report_state' => 'old',
			);
		return $result;
	}
	else{
		//if no user select report found add new and refresh the process again
		$condition = "report_id =" . "'" . $reportid . "'";
		$this->db->select('report_full');
		$this->db->from('tbl_law_report');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		$data = array(
			'user_id'=> $sessionid,
			'report_id'=> $reportid,
			'subject_id' => $subjectid,
			'report_full_with_fact' => $query->result()[0]->report_full
			);
		

		$this->db->insert('tbl_fact_user_select', $data);
		if ($this->db->affected_rows() > 0) {
				$this -> read_select_course_subject_case_details_report($reportid,$sessionid,$subjectid);
		}
		
		/*
		$condition = "report_id =" . "'" . $reportid . "'";
		$this->db->select('*');
		$this->db->from('tbl_law_report');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			print_r($query->result());
			$result = array(
			'facts' => 0,
			'law_report' => $query->result(),
			'law_report_state' => 'new',
			);
			return $query->result();
		} 
		else {
			return false;
		}*/
	}

		
}
//get all the facts to view in ajax post 
	function getFacts($fact_id=0){

	
	
	if($fact_id != 0){
		$condition = "fact_id =" . "'" . $fact_id . "'";
		$this->db->select('*');
		$this->db->from('tbl_fact');
		$this->db->where($condition);
		$query = $this->db->get();
		}
	else{
		$this->db->select('*');
		$this->db->from('tbl_fact');
		$query = $this->db->get();

	}
	
	if ($query->num_rows() > 0) {
		return $query->result();
	}
	else{
		return false;
	}


	}

	function get_user_fatcs($auto_id){
		$condition = "tbl_fact_user_select_auto_id =" . "'" . $auto_id . "'";
		$this->db->select('*');
		$this->db->from('tbl_user_fact_details');
		$this->db->where($condition);

		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}	

	}


	function get_user_fatcs_selectid($fact_select_id){
		$condition = "fact_select_id =" . "'" . $fact_select_id . "'";
		$this->db->select('*');
		$this->db->from('tbl_user_fact_details');
		$this->db->where($condition);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}	

	}

	function get_report_with_facts($auto_id){
		$condition = "auto_id =" . "'" . $auto_id . "'";
		$this->db->select('*');
		$this->db->from('tbl_fact_user_select');
		$this->db->where($condition);
		$this->db->limit(1);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}

	}


}

?>