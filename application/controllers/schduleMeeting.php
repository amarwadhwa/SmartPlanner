<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class schduleMeeting extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function session_check(){

	if(!isset($_SESSION["user-type"]) && $_SESSION["user-type"] != "user"){
		redirect("Login");
	}
	}
	public function index()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/SchduleMeeting/schdulemeeting');
		$this->load->view('User/Partial/footer');
		$this->session_check();

  

//}


	}

	public function cancel()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/SchduleMeeting/cancelmeeting');
		$this->load->view('User/Partial/footer');
		$this->session_check();

	}



	public function edit()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/SchduleMeeting/editMeeting');
		$this->load->view('User/Partial/footer');
		$this->session_check();

	}

	public function deleteMeeting()
	{
		
		if(isset($_POST["meeting_id"])){

				//$meeting_id  = "'class'";
				$meeting_id  =  $_POST["meeting_id"];   
				$this->db->delete("temporary_engages", "meeting_id = ".$meeting_id);
				$this->db->delete("meeting_logs", "id = ".$meeting_id);				
				unset($_POST["meeting_id"]);
			
		}

		$this->load->view('User/Partial/header');
		$this->load->view('User/SchduleMeeting/schdulemeeting');
		$this->load->view('User/Partial/footer');
		$this->session_check();



	}


	public function editConform()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/SchduleMeeting/editMeeting2');
		$this->load->view('User/Partial/footer');
		$this->session_check();

	}

	public function setStatus($rowId = null, $status= null){
		echo $rowId ." ". $status;

		$this->db->where("id", "$rowId");
    	
    	$data = array( 
   		'status' => "$status"
		);

		$this->db->update("temporary_engages", $data);



	}





}
