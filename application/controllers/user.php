<?php

//session_start(); //we need to start session in order to access it through CI

Class User extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		//load url library
		$this->load->helper('url');

		// Load database
		$this->load->model('user_model');
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
	}

	// Show login page
	public function index() {
			
			// add breadcrumbs
				$this->breadcrumbs->push('Home', '/');
				$this->breadcrumbs->push('dashboard', '/page');
				echo $bread =  $this->breadcrumbs->show();
	//$this->load->view('ajax_post_view'); 
	$data['course_details'] = $this->user_model->read_course_details();	
	$this->load->view('dashboard',$data);
	
	}

	// Show registration page
	public function register() {
	$this->load->view('register');
	$this->load->view('menu');
	}

	// Validate and store registration data in database
	public function newregistration() {

		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha');
		
		$this->form_validation->set_rules('email_value', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('register');
			$this->load->view('menu');
		} 
		else {
			$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'age' => $this->input->post('age'),
			'email' => $this->input->post('email_value'),
			'password' => sha1($this->input->post('password'))
			);
			$result = $this->user_model->registration_insert($data);
			if ($result == TRUE) {
				$data['success_message_display'] = 'Registration Successfully! Activation Mail Sent.';
				$this->load->view('register', $data);
			} 
			else {
				$data['error_message_display'] = 'Email Address Already Exist!';
				$this->load->view('register', $data);
			}
		}
	}

	// Check for user login process
	public function login() {

		//$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('log_email', 'Email', 'trim|required');
		$this->form_validation->set_rules('log_password', 'Password', 'trim|required|min_length[8]');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['userinfo'])){
				$this->load->view('dashboard');
				$this->load->view('menu');
			}
			else{
				$this->load->view('register');
				$this->load->view('menu');
			}
		} 
		else {
			$data = array(
			'email' => $this->input->post('log_email'),
			'password' => sha1($this->input->post('log_password'))
			);
			$result = $this->user_model->login($data);
			if ($result == TRUE) {

				
				$result = $this->user_model->read_user_information($this->input->post('log_email'));
				if ($result != false) {

					$session_data = array(
					'user_id' => $result[0]->user_id,
					'login' => TRUE,
					);
					// Add user data in session
					$this->session->set_userdata('userinfo', $session_data);
					redirect('/user/dashboard');
					//$this->load->view('dashboard');
				}
				else{
					$data = array(
					'error_loginmessage_display' => 'Invalid Username or Password'
					);
					$this->load->view('register', $data);
				}
			} 
			else {
				$data = array(
				'error_loginmessage_display' => 'Invalid Username or Password'
				);
				$this->load->view('register', $data);
				$this->load->view('menu');
			}
		}
	}

	// Logout from user page
	public function logout() {

		// Removing session data
		
		$this->session->unset_userdata('userinfo');
		
		$this->load->view('register');
		$this->load->view('menu');
		}

	public function dashboard() {
			$data['course_details'] = $this->user_model->read_course_details();	
			$this->load->view('dashboard',$data);
			$this->load->view('menu');

			// add breadcrumbs
				$this->breadcrumbs->push('Home', '/');
				$this->breadcrumbs->push('Dashboard', '/user/dashboard');
				
				echo $bread =  $this->breadcrumbs->show();


		}

	public function selectCourse($courseid) {
			
			$result = $this->user_model->read_course_details($courseid);
			

			$data['select_course_details'] = $this->user_model->read_select_course_details($courseid);
			
				// add breadcrumbs
				$this->breadcrumbs->push('Home', '/');
				$this->breadcrumbs->push('Dashboard', '/user/dashboard');
				$this->breadcrumbs->push("{$result[0]->course_name}", '/course');
				echo $bread =  $this->breadcrumbs->show();

			if($data['select_course_details'] != false){	
			$this->load->view('mycourse',$data);
			$this->load->view('menu');
			}
			else{
				$data['select_course_details'] = 'No Level found for this course';
				$this->load->view('mycourse',$data);
				$this->load->view('menu');
			}
		}
	public function courseSubject($levelid) {


			$data['select_subject_details'] = $this->user_model->read_select_course_subject_details($levelid);
			
			// add breadcrumbs
				$result = $this->user_model->read_course_details($data['select_subject_details'][0]->course_id);
				$result_level = $this->user_model->course_level($levelid);
				
				$this->breadcrumbs->push('Home', '/');
				$this->breadcrumbs->push('Dashboard', '/user/dashboard');
				$this->breadcrumbs->push("{$result[0]->course_name}", "/user/selectCourse/{$data['select_subject_details'][0]->course_id}");
				$this->breadcrumbs->push("{$result_level[0]->level_name}", '/user/tt');

				echo $bread =  $this->breadcrumbs->show();



			if($data['select_subject_details'] != false){	
			$this->load->view('mysubject',$data);
			$this->load->view('menu');
			}
			else{
				$data['select_subject_details'] = 'No Subjects found for selected level';
				$this->load->view('mysubject',$data);
				$this->load->view('menu');
			}
		}
	public function subjectCase($subjectid) {
			//creating bredcrumb
			$result_subject = $this->user_model->get_subject($subjectid);
			
				$result = $this->user_model->read_course_details($result_subject[0]->course_id);
				$result_level = $this->user_model->course_level($result_subject[0]->level_id);
				
				$this->breadcrumbs->push('Home', '/');
				$this->breadcrumbs->push('Dashboard', '/user/dashboard');
				$this->breadcrumbs->push("{$result[0]->course_name}", "/user/selectCourse/{$result_subject[0]->course_id}");
				$this->breadcrumbs->push("{$result_level[0]->level_name}", "user/courseSubject/{$result_subject[0]->level_id}");
				$this->breadcrumbs->push("{$result_subject[0]->subject_name}",'tt');

				echo $bread =  $this->breadcrumbs->show();

				//end of breadcrumb


			$data['select_case_details'] = $this->user_model->read_select_course_subject_case_details($subjectid);
			
			if($data['select_case_details'] != false){	
				$data['subjectid'] = $subjectid; 
				$this->load->view('mycaseses',$data);
				$this->load->view('menu');
			}
			else{
				$data['select_case_details'] = 'No Case found for selected Subject';
				$this->load->view('mycaseses',$data);
			}
		}

	public function mycase($reportid,$subjectid) {
	

			$data['select_case_report'] = $this->user_model->read_select_course_subject_case_details_report($reportid,$this->session->userdata('userinfo')['user_id'],$subjectid);
			//print_r($data['select_case_report']['facts']);
			foreach ($data['select_case_report']['facts'] as $key => $value) {
				
				$result_fact_details = $this->user_model->getFacts($value->fact_id);
				//$result_fact_name = $this->user_model->getFacts($value->fact_name);
				//print_r($result_fact_details[0]->fact_name);
				//array_push($value, $result_fact_color);
				$value->fact_color=$result_fact_details[0]->fact_color;
				$value->fact_name=$result_fact_details[0]->fact_name;
				//print_r($value);
			}
			$data['facts'] = $this->user_model->getFacts();
			if($data['select_case_report'] != false && $data['facts'] != false){	
				$data['subjectid'] = $subjectid;
				
				$this->load->view('ajax_post_view',$data);
				$this->load->view('menu');
			}
			else{
				$data['select_case_report'] = 'No Case found for selected Subject';
				
				$this->load->view('ajax_post_view',$data);
				$this->load->view('menu');
			}


			//creating bredcrumb
			$result_subject = $this->user_model->get_subject($subjectid);
			
				$result = $this->user_model->read_course_details($result_subject[0]->course_id);

				$result_level = $this->user_model->course_level($result_subject[0]->level_id);
				
				$result_report = $this->user_model->get_report($reportid);
				$this->breadcrumbs->push('Home', '/');
				$this->breadcrumbs->push('Dashboard', '/user/dashboard');
				$this->breadcrumbs->push("{$result[0]->course_name}", "/user/selectCourse/{$result_subject[0]->course_id}");
				$this->breadcrumbs->push("{$result_level[0]->level_name}", "user/courseSubject/{$result_subject[0]->level_id}");
				$this->breadcrumbs->push("{$result_subject[0]->subject_name}","user/subjectCase/{$result_subject[0]->subject_id}");
				$this->breadcrumbs->push("{$result_report[0]->report_title}",'tt');

				echo $bread =  $this->breadcrumbs->show();

				//end of breadcrumb





		}

		//create report full brief 
		public function viewbrief($fact_user_select_autoid) {
			//echo $fact_user_select_autoid;
			$result_facts = $this->user_model->getFacts();
			$data['result_report']= $this->user_model->get_report_with_facts($fact_user_select_autoid);
			$data['facts'] = $this->user_model->getFacts();
			
			//print_r($data['result_report']);
			//split into array each wrap by span tag
			foreach ($data['result_report'] as $key => $report_value) {

						$select_start_text = strpos($report_value->report_full_with_fact, '<span');
						if($select_start_text == 0){
								$select_start_text;
						}
						while ( $select_start_text >= 1)  {

							$select_end_text = strpos($report_value->report_full_with_fact, '</span');
							$range = $select_end_text - $select_start_text; 
							$span[] = substr($report_value->report_full_with_fact, $select_start_text, $range+7 );
					$report_value->report_full_with_fact = substr($report_value->report_full_with_fact, $select_end_text+4);
							$select_start_text = strpos($report_value->report_full_with_fact, '<span');
							//echo $select_start_text. '<br>';
						}
						//print_r($span);
						//get fact id and pure text user select for the brief
						
							//echo $value->fact_color;
							foreach ($span as $spankey => $spanvalue) {

								foreach ($result_facts as $key => $value) {

									//echo $spanvalue  . '<hr>';
									 $search_class = 'class='."\"{$value->fact_color}\"";
									 stripos($spanvalue, $search_class);
									if (stripos($spanvalue, $search_class) !== false) {
										
										$base_start_text = strpos($spanvalue, '>');
										$base_end_text = strpos($spanvalue, '</span>');
										$base_text_range = $base_end_text - $base_start_text;
										$base_text = substr($spanvalue, $base_start_text+1, $base_text_range-1);
																			
										$id_start = strpos($spanvalue, 'id="');
										$id_end = strpos($spanvalue, '">');
										$id_range = $id_end - $id_start-4;
										$id = substr($spanvalue, $id_start + 4 ,$id_range);
										$result_user_fact = $this->user_model->get_user_fatcs_selectid($id);
										
    									//echo "True";
    									//selected text, fact_select_id
    									if(isset($data[$value->fact_color])){
    										$data[$value->fact_color][$id] = array(
	    										'base_text'=> $base_text,
	    										'user_facts' => $result_user_fact,
	    										);
    									}
    									else{
    										$data[$value->fact_color] = array();
    										$data[$value->fact_color][$id] = array(
	    										'base_text'=> $base_text,
	    										'user_facts' => $result_user_fact,
	    										);
    									}
									
									}
									
							}
						}
					
					//print_r($data);
			}
					
					
			//print_r($data);

			//$data['result_facts'] = $this->user_model->get_user_fatcs($fact_user_select_autoid);
			//$data['result_report']= $this->user_model->get_report_with_facts($fact_user_select_autoid);
			
			//if($data['result_facts'] != false){
				$this->load->view('full_brief',$data);
				$this->load->view('menu');
				
			//}
			

			//creating bredcrumb

				$result_subject_id= $this->user_model->get_report_with_facts($fact_user_select_autoid);
				$result_subject = $this->user_model->get_subject($result_subject_id[0]->subject_id);
			
				$result = $this->user_model->read_course_details($result_subject[0]->course_id);

				$result_level = $this->user_model->course_level($result_subject[0]->level_id);
				
				$result_report = $this->user_model->get_report($result_subject_id[0]->report_id);
				$this->breadcrumbs->push('Home', '/');
				$this->breadcrumbs->push('Dashboard', '/user/dashboard');
				$this->breadcrumbs->push("{$result[0]->course_name}", "/user/selectCourse/{$result_subject[0]->course_id}");
				$this->breadcrumbs->push("{$result_level[0]->level_name}", "user/courseSubject/{$result_subject[0]->level_id}");
				$this->breadcrumbs->push("{$result_subject[0]->subject_name}","user/subjectCase/{$result_subject[0]->subject_id}");
				$this->breadcrumbs->push("{$result_report[0]->report_title}",'tt');

				echo $bread =  $this->breadcrumbs->show();

				//end of breadcrumb



		}




}

?>