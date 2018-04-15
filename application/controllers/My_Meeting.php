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

		
	  	$this->load->model('Meetings');

		$data['meetings'] = $this->Meetings->view_all();
		
		



		//print_r($data);

		//echo "<br>";
		//echo "<br>";

		//echo json_encode($data['meetings']['records']); 
		$a['json'] =  json_encode($data['meetings']['records']); 
		


		$data['json'] = "[{
          title: 'All of Event',
          start: '2018-02-01',
          	
        },
        {
          title: 'Long Event',
          start: '2018-02-07',
          end: '2018-02-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-02-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-02-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2018-02-11',
          end: '2018-02-13'
        },
        {
          title: 'Meeting',
          start: '2018-02-12T10:30:00',
          end: '2018-02-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2018-02-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2018-02-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2018-02-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2018-02-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2018-02-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2018-02-28'
        }
      
]";
		$this->load->view('User/Partial/header');
		$this->load->view('User/MyMeetings/showmeetings',$data);
		$this->load->view('User/Partial/footer'	);
		
		//$this->Meetings->initiate('a','b','c','d','e','f','g'); 
		//$data['meetings'] = $this->Committee->view_all(); 
		//print_r($data['meetings']['records']['0']);
		//initiate($title, $status="pending", $initiater_id, $guest_id, $time , $start_time, $end_time, $description )
	}

	public function get_meetings(){

		//$this->load->model('Meetings');

		//$data['meetings'] = $this->Meetings->view_all();
		
		//echo json_encode($data['meetings']['records']);  
		
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
