<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Meeting extends CI_Controller {

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
		$this->load->view('User/Partial/header');
		$this->load->view('User/MyMeetings/showmeetings');
		$this->load->view('User/Partial/footer');
		

		/*

		$this->load->model('Meetings');
		


		$data['meetings'] = $this->Meetings->view_all();
		
		//print_r($data['meetings']['records']['0']);	

		print_r($data['meetings']['records']);




			
			foreach($data['meetings']['records'] as $records) {
  			 $title = $records->title;
  			 $start = $records->start_time;
  			 $end  =  $records->end_time;

			

			}

		
		echo "<br>";
		echo "<br>";
		echo json_encode($data['meetings']['records']);  

		*/


		//$this->Meetings->initiate('a','b','c','d','e','f','g'); 
		//$data['meetings'] = $this->Committee->view_all(); 
		//print_r($data['meetings']['records']['0']);
		//initiate($title, $status="pending", $initiater_id, $guest_id, $time , $start_time, $end_time, $description )


	}


		public function new()
	{
		$this->load->view('welcome_message');
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
