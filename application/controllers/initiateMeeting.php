<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class initiateMeeting extends CI_Controller {

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
		$this->session_check();

		$this->load->model('Committee');
		$data['Committies'] = $this->Committee->view_all();
		$this->load->view('User/Partial/header');
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/InitiateMeeting/initiatemeeting',$data);
		$this->load->view('User/Partial/footer');
	}

		public function initiateMeetingPage2()
	{
		$this->session_check();
		$this->load->model('User');
		$data2['users'] = $this->User->view_all();
		
		$this->load->view('User/Partial/header');
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/InitiateMeeting/initiatemeetingPage2',$data2);
		$this->load->view('User/Partial/footer');
		
	}


		public function meetingScheduled(){
		$this->session_check();	
		$this->load->view('User/InitiateMeeting/MeetingScheduled');		
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
