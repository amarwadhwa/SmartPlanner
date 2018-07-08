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
		$first = true;
		$start_time =  strtotime($_POST["start_date"] . " ". $_POST["start_time"]);
		$start_timestamp =  date('Y-m-d H:i:s', $start_time);
		$startDay = date('l', $start_time);
		$end_time =  strtotime($_POST["end_date"] . " ". $_POST["end_time"]);
		$end_timestamp =  date('Y-m-d H:i:s', $end_time);
		$endDay = date('l',$end_time);
		$startDate =  strtotime("2000-01-01" . " ". $_POST["start_time"]);
		$endDate = strtotime("2000-01-01" . " ". $_POST["end_date"]);
		$startDateTimestamp = date('Y-m-d H:i:s', $startDate);
		$endDateTimestamp = date('Y-m-d H:i:s', $endDate);
		$users = $_SESSION["users"];
		
		foreach ($users as $user) {
		$id =$user->id;
		$query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' OR end_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' )");
			if($query->num_rows() >0){
				// busy users..
				if ($first) {
				echo "<h2> Busy Users:</h2>";
				echo "<h4> Description  and Time <h4>";
				$first = false; }
				echo "<h5 style='color:red'> $user->name </h5>";				
		        $row = $query->result();		        
				foreach ($query->result() as $row)
				{
				$startTime = date('g:ia', strtotime($row->start_time));				
				$endTime = date('g:ia', strtotime($row->end_time));	
        		echo "<h6>". $row->description."---<i>".$startTime."  To  ".$endTime. "</i><h6>";
        		}
        	}
				$query = $this->db->query("SELECT * FROM permanent_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$startDateTimestamp."' AND '".$endDateTimestamp."' OR end_time BETWEEN '".$startDate."' AND '".$endDate."' ) AND (day = '".$endDay."' OR day = '".$startDay."')");
			    if($query->num_rows() >0){
				// busy users..
				if ($first) {
				echo "<h2> Busy Users:</h2>";
				echo "<h4> Description  and Time <h4>";
				$first = false; }
				echo "<bold> <u>$user->name </u></bold>";				
		        $row = $query->result();		        
				foreach ($query->result() as $row)
				{
				$startTime = date('g:ia', strtotime($row->start_time));				
				$endTime = date('g:ia', strtotime($row->end_time));	
        		echo "<h6>". $row->description."---<i>".$startTime."  To  ".$endTime. "</i><h6>";
        		}

			}
	
			}
		echo "";

	}


	public function checkFreeClasses()
	{
		$start_time =  strtotime($_POST["start_date"] . " ". $_POST["start_time"]);
		$start_timestamp =  date('Y-m-d H:i:s', $start_time);
		$startDay = date('l', $start_time);
		$end_time =  strtotime($_POST["end_time"] . " ". $_POST["end_date"]);
		$end_timestamp =  date('Y-m-d H:i:s', $end_time);
		$endDay = date('l',$end_time);
		$startDate =  strtotime("2000-01-01" . " ". $_POST["start_time"]);
		$endDate = strtotime("2000-01-01" . " ". $_POST["end_date"]);
		$startDateTimestamp = date('Y-m-d H:i:s', $startDate);
		$endDateTimestamp = date('Y-m-d H:i:s', $endDate);
		$query = $this->db->get("classess"); 
        foreach ($query->result() as $class) {
		$id =$class->class_id;
		$query = $this->db->query("SELECT * FROM busy_classes WHERE class_id = '".$id."' AND (start_time BETWEEN '".$startDateTimestamp."' AND '".$endDateTimestamp."' OR end_time BETWEEN '".$startDateTimestamp."' AND '".$endDateTimestamp."' ) AND (day = '".$endDay."' OR day = '".$startDay."')");
			if($query->num_rows() == 0){
				echo "<option value='".$id."'>".$class->class_name."</option>";		        
			}

			}
		echo "";
	}

	public function index()
	{
		$this->session_check();

		
	  	$this->load->model('Meetings');

		$data['meetings'] = $this->Meetings->view_all();
		$JSON_Data['json'] = json_encode($data['meetings']);
		
		/*
		Following is the Required JSON Format by the Calender API

		$a['json'] = "[{
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

echo $a['json'];

*/
		$this->load->view('User/Partial/header');
		$this->load->view('User/MyMeetings/showmeetings',$JSON_Data);
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
