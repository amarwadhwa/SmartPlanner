<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProgramOfficer extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Maps to the following URL Hello
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

		if(!isset($_SESSION["user-type"]) && $_SESSION["user-type"] != "program_officer"){
		redirect("Login");
		}
	}




	public function index()
	{

		$this->session_check();
		$this->load->view('ProgramOfficer/Partial/header');
		$this->load->view('Admin/Room/busyRooms');
		$this->load->view('ProgramOfficer/Partial/footer');
		
	}

	



	
	
	
}
