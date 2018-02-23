<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->view('User/home');
		$this->load->view('User/Partial/footer');
		$this->session_check();

	}
	public function initiateMeeting()
	{

		
		//update($prev_name,$name="",$des="");
		//$this->load->model("Committee");
		//$this->Committee->update("Karan","Karann","abc");
		//$this->Committee->save("Senate","for Departement");
		//$this->Committee->save("Higher Level","for CS");
		//$this->Committee->save("lower","for EE");
		//$this->Committee->update("lower","h","");
		$this->session_check();
		$this->load->view('User/Partial/header');
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/initiatemeeting');
		$this->load->view('User/Partial/footer');
		
	
	}
	
	public function showMeeting()
	{
		$this->session_check();
		$this->load->view('User/Partial/header');
		$this->load->view('User/showmeetings');
		$this->load->view('User/Partial/footer');
		
	}

}
