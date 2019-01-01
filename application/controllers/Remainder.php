<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remainder extends CI_Controller {

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

		if(!isset($_SESSION["user-type"]) && $_SESSION["user-type"] != "admin"){
		redirect("Login");
		}
	}
	public function index()
	{
		
		$sql_select_query = "SELECT count FROM meetings WHERE title = 'cronjobtest'";
       		$query= $this->db->query($sql_select_query);
       		$result  = $query->result();
       		$count  =  $result[0]->count;
       		echo $count;
       		$count++;

       			$data = array('count' =>$count);
				$this->db->set($data); 
				$this->db->where("title", 'cronjobtest'); 
				$this->db->update("meetings", $data);

			echo "<br>Remainder";
			


	}

	public function send_remainderPrevious(){
			
			//$to = $user->email;
			$to = 'karansachrani.cs14@iba-suk.edu.pk';
			//$subject = $_POST['title'];
			$subject = 'Your Todays Engages';								
			$body = 'testing Email';								
			$headers = "";			
			$headers.= "From: Siba Smart Planner <info@sibasmartplanner.com> \r\n";
			$headers .= "Reply-To: No Reply <no-reply@sibasmartplanner.com> \r\n" ."X-Mailer: PHP/" . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";        
			$send=mail($to,$subject,$body,$headers);


	}

public function send_remainder(){
			
		$queryUsers = $this->db->query("SELECT id,email FROM users WHERE id != 'admin' AND id != 'program_officer' AND 
			email != ''");
		$users = $queryUsers->result();
		//print_r($users);		
		//echo time()+(60*60*5);
		$currentTime =  date("Y-m-d H:i:s",time()+(60*60*5));
		$todayEndTime = date("Y-m-d H:i:s",time()+(60*60*5)+(60*60*16));
		
		$currentTimePerm = "2000-01-01 ";
		$todayEndTimePerm = "2000-01-01 ";
		$currentTimePerm .=  date("H:i:s",time()+(60*60*5));
		$todayEndTimePerm .= date("H:i:s",time()+(60*60*5)+(60*60*16));
		$today = date("l",time()+(60*60*5)+(60*60*16));
		

		//echo "<br>".$currentTime."<br>".$todayEndTime."<br>";
		//echo "<br>".$currentTimePerm."<br>".$todayEndTimePerm."<br>";
		//echo $today;
		
		foreach($users as $user){

		$queryTemp = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '" . $user->id . "' AND 
			start_time >= '" . $currentTime . "' AND end_time <= '" . $todayEndTime . "' AND status != 'Rejected'");	
		$queryPerm = $this->db->query("SELECT * FROM permanent_engages WHERE user_id = '" . $user->id . "' AND 
			start_time >= '" . $currentTimePerm . "' AND end_time <= '" . $todayEndTimePerm . "' AND day = '" . $today . "'");


		$details = "";
		if(($queryTemp->num_rows() > 0) || ($queryPerm->num_rows() > 0)){

			if ($queryTemp->num_rows() > 0) {
            	foreach ($queryTemp->result() as $userDetails) {
                $startTime = date('h:ia ', strtotime($userDetails->start_time));
                $endTime   = date('h:ia ', strtotime($userDetails->end_time));
                $details .= '<tr><td>' . $userDetails->description . '</td><td>' . $startTime . '</td><td>' . $endTime . '</td><td>Meeting</td></tr>';
                //echo "done Temp <br>";
            	}
        	}
        	
        	if ($queryPerm->num_rows() > 0) {
            	foreach ($queryPerm->result() as $userDetails) {
            	$startTime = date('h:ia ', strtotime($userDetails->start_time));
            	$endTime   = date('h:ia ', strtotime($userDetails->end_time));
            	$details .= '<tr><td>' . $userDetails->description . '</td><td>' . $startTime . '</td><td>' . $endTime . '</td><td>' . $userDetails->engage_type . '</td></tr>';
            	 //echo "done Perm <br>";
            	}
        
        	}

        	$body = "<head><style>
table, th, td {
    border: 1px solid black;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;

}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #000000 ;
    color: white;
}
tr:hover {background-color: #f5f5f5;}
tr:nth-child(even) {background-color: #f2f2f2;}

.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    border-radius: 12px;
    font-size: 14px;
    

    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}
.button:hover {
    
    color: white;
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    opacity: 1;
  right: 0;
}
.button2{
     background-color: #FF6347; 

}
.wrapper {
    text-align: center;
}


</style></head>
        <div style='overflow-x:auto;'>
        <h2>Your Todays Engages</h2>
        <table>
        
        <thead>  
        <tr><th>Description</th><th>Start Time</th><th>End Time</th><th>Engage Type</th></tr>
        </thead>
        <tbody>" . $details . "</tbody>
        </table>";


        	
			
			//$to = 'karansachrani.cs14@iba-suk.edu.pk';
			$to = $user->email;
			//$subject = $_POST['title'];
			$Todaydate  = date('d-M h:ia D', time()+(60*60*5));
			$subject = 'Remainder: '.$Todaydate ;								
			//$body = 'testing Email';								
			$headers = "";			
			$headers.= "From: Siba Smart Planner <info@sibasmartplanner.com> \r\n";
			$headers .= "Reply-To: No Reply <no-reply@sibasmartplanner.com> \r\n" ."X-Mailer: PHP/" . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";        
			$send=mail($to,$subject,$body,$headers);
			//echo "done all";

		}//if or statement

}// foreach users					
}//function
}
