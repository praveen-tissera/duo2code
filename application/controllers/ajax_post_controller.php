<?php

//session_start(); //we need to start session in order to access it through CI

Class Ajax_Post_Controller extends CI_Controller {
public function __construct() {
		parent::__construct();

		$this->load->helper('form');
		//load url library
		$this->load->helper('url');

		// Load database
		$this->load->model('ajax_model');

		
	}
	// Show view Page
	public function index(){
	$this->load->view("ajax_post_view");
	}

	// This function call from AJAX to insert facts selected by user
	public function user_data_submit() {

	$data = array(
	'report_full_with_fact' => $this->input->post('name'),
	'report_id' => $this->input->post('report'),
	'user_id' => $this->input->post('user'),
	'subject_id' => $this->input->post('subjectid'),
	'auto_id' => $this->input->post('autoid'),
	
	
	);
	$data_fact = array(
		'fact_select_id' => $this->input->post('selectid'),
		'fact_id' => $this->input->post('factid'),
		'tbl_fact_user_select_auto_id' => $this->input->post('autoid'),
		);
	//check to update a record or insert new record
	if ($data['auto_id'] != 0) {
		
		$return = $this->ajax_model->updateText($data,$data_fact);
		echo $return;
	}
	else{
		
		$return = $this->ajax_model->insertText($data,$data_fact);

		echo $return;
	}
	//$json_data['text'] = json_encode($data);

	//echo json_encode($data);
	
	

	}
	//delete facts

	public function delete_fact(){
	$data = array(
	'report_full_with_fact' => $this->input->post('name'),
	'report_id' => $this->input->post('report'),
	'user_id' => $this->input->post('user'),
	'subject_id' => $this->input->post('subjectid'),
	'auto_id' => $this->input->post('autoid'),
	);


	$data_fact = array(
		'fact_select_id' => $this->input->post('selectid'),
		'tbl_fact_user_select_auto_id' => $this->input->post('autoid'),
		);
	$str = $this->input->post('factselectid');
			$fact_select_id = explode("#",$str);
	
	//check to update a record or insert new record
	if ($data['auto_id'] != 0) {
		
		$return = $this->ajax_model->updateText($data,$data_fact,$fact_select_id[1],'delete');
		echo $return;
	}
	

	}

	public function fact_note(){
		$data = array(
	'fact_select_id' => $this->input->post('factuserid'),
	'fact_note' => $this->input->post('factmsg'),
	
	);
		$return = $this->ajax_model->updatefactmsg($data);
	}
}

?>