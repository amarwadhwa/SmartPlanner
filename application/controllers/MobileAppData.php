<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MobileAppData extends CI_Controller {

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


	public function MyMeetings()
	{
		
		
	  	//$this->load->model('Meetings');
		$currentUser = "INS-0006";	
		$query_str= "SELECT description as title , start_time as start , end_time as end FROM temporary_engages 
						 WHERE user_id = '$currentUser' AND status!='Rejected'";
		
		
		$query= $this->db->query($query_str);
        $dataTemp = $query->result();        
        $query_str= "SELECT description as title , start_time as start , end_time as end, day FROM permanent_engages 
        WHERE user_id = '$currentUser' ";
        $query= $this->db->query($query_str);
		$currentMonth = date("m",time());
	    $currentYear = date("Y");
	    $dataarray = array();
	    for ($i=1; $i<=date("t") ; $i++) { 
	    $str = $currentYear."-".$currentMonth."-".$i;
	    $timestamp = strtotime($str);
	    $day = date('l', $timestamp);
	    foreach ($query->result() as $row) {
	  	if ($row->day == $day) {
	  		$timeStart = date("H:i:s", strtotime($row->start));
	  		$date =  date('Y-m-d ', $timestamp);
	  		$timeDateStart = $date . " ".$timeStart;
			$timeDateStartFinal = date("Y-m-d H:i:s", strtotime($timeDateStart));
			$timeEnd = date("H:i:s", strtotime($row->end));
			$timeDateEnd = $date . " ". $timeEnd;
			$timeDateEndFinal = date("Y-m-d H:i:s", strtotime($timeDateEnd));
			$dataItems["title"] = $row->title;
			$dataItems["start"] = $timeDateStartFinal;
			$dataItems["end"] = $timeDateEndFinal;
			array_push($dataarray,(Object)$dataItems);
	  	}
	    }
		}

	  	$data['meetings']  = array_merge($dataTemp,$dataarray);
      //return $data;	


		//$data['meetings'] = $this->Meetings->view_all();
		$JSON_Data= json_encode($data['meetings']);
		echo $JSON_Data;

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
		//$this->load->view('User/Partial/header');
		//$this->load->view('User/MyMeetings/showmeetings',$JSON_Data);
		//$this->load->view('User/Partial/footer'	);
		
		//$this->Meetings->initiate('a','b','c','d','e','f','g'); 
		//$data['meetings'] = $this->Committee->view_all(); 
		//print_r($data['meetings']['records']['0']);
		//initiate($title, $status="pending", $initiater_id, $guest_id, $time , $start_time, $end_time, $description )
	}

public function userLogin($id,$pwd){
		
		
		$query_str= "SELECT * FROM users WHERE id = '".$id."' AND password = '".$pwd."'";
		$query= $this->db->query($query_str);
		$num = $query->num_rows();
		//$query= $this->db->query($query_str);
        //$dataTemp = $query->result();        
        

	  	//$data['meetings']  = array_merge($dataTemp,$dataarray);
		//$JSON_Data = json_encode($data['meetings']);
		

		if($num>0){
			$JSON_Data[]['login'] = true; 
			$JSON_Data[]['user_id'] = true; 

		}else{
			$JSON_Data[]['login'] = false; 
			$JSON_Data[]['user_id'] = false; 
			
		}
		$JSON_Data = json_encode($JSON_Data);
		echo $JSON_Data;

}






}
