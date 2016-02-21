<?php

Class Ajax_model extends CI_Model {




public function insertText($data){

// Query to insert data in database
$this->db->insert('tbl_fact_user_select', $data);
//return json_encode($data);
	if ($this->db->affected_rows() > 0) {
		return true;
				
	}
	else{
		return false;
	}

}

function updateText($data,$data_fact,$factid=0,$action='insert'){
$this->db->where('auto_id', $data['auto_id']);
$this->db->update('tbl_fact_user_select', $data);

	if ($this->db->affected_rows() == 1) {
		//this is for insertion only
		if($action == 'insert'){
			$this->db->insert('tbl_user_fact_details',$data_fact);

			if($this->db->affected_rows()==1){

				$datareturn = array(
					'msg' => $data_fact['fact_select_id'],

					);
				return json_encode($datareturn);
			}
			else{

				$datareturn = array(
					'msg' => 'inner not works',

					);
				return json_encode($datareturn);
			}
		}
		else if($action == 'delete'){
			$this->db->where('fact_select_id', $factid);
			$this->db->delete('tbl_user_fact_details');

			$datareturn = array(
				'msg' => 'delete',

				);

			return json_encode($datareturn);
		}

	}
	else{
			$datareturn = array(
				'msg' => $this->db->affected_rows(),

				);
			return json_encode($datareturn);
		}

}
function updatefactmsg($data){
	$this->db->where('fact_select_id', $data['fact_select_id']);
	$this->db->update('tbl_user_fact_details', $data);
	if ($this->db->affected_rows() == 1) {
		return true;
	}
	else{
		return false;
	}
}




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




}

?>