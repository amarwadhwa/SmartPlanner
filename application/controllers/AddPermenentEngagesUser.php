<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddPermenentEngagesUser extends CI_Controller {

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
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/PermanentEngages/AddPermanentEngages');
		$this->load->view('User/Partial/footer');
	}



	public function cancel()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/Engages/cancelEngage');
		$this->load->view('User/Partial/footer');
	}


	public function removeEngage()
	{


	if(isset($_POST["engage_id"])){

				//$meeting_id  = "'class'";
				$engage_id  =  $_POST["engage_id"];   
				$this->db->delete("permanent_engages", "id = ".$engage_id);
				//$this->db->delete("meeting_logs", "id = ".$meeting_id);				
				unset($_POST["engage_id"]);
			
			
		}
		

		$this->load->view('User/Partial/header');
		$this->load->view('User/Engages/PermanentEngages');
		$this->load->view('User/Partial/footer');
		$this->session_check();
	}




	
	public function edit()
	{
		$this->load->view('welcome_message');
	}
	public function save()
	{
		$this->load->view('welcome_message');
	}

}
