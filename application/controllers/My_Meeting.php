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

		public function checkConflict()
	{

		$start_time =  strtotime($_GET["start_date"] . " ". $_GET["start_time"]);
		$start_timestamp =  date('Y-m-d H:i:s', $start_time);
		$end_time =  strtotime($_GET["end_date"] . " ". $_GET["end_time"]);
		$end_timestamp =  date('Y-m-d H:i:s', $end_time);

		$users = $_SESSION["users"];
		print_r($users);
		echo "<br>";
		echo $start_timestamp .",". $end_timestamp;

		$busyUsers = array();
		foreach ($users as $user) {
		$id =$user->id;
		$query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' OR end_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' )");

			echo "<br> SELECT * FROM temporary_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' OR end_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' )";
			if($query->num_rows() >0){
			$busyUsers[] = $user->name;
			}
		}
		print_r($busyUsers);
		return json_encode($busyUsers);
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
