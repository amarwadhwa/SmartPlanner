<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InitiateMeeting extends CI_Controller {

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


		public function meetingScheduledWoring(){
		$this->session_check();
		$this->load->model('Committee');
		$data['Committies'] = $this->Committee->view_all();
		$Committies = $data['Committies'];


		require 'application_resources/PHPMailer/PHPMailerAutoload.php';
		$mail            = new PHPMailer();
		$start_time      = strtotime($_POST["start_date"] . " " . $_POST["start_time"]);
		$start_timestamp = date('Y-m-d H:i:s', $start_time);
		$end_time        = strtotime($_POST["end_date"] . " " . $_POST["end_time"]);
		$end_timestamp   = date('Y-m-d H:i:s', $end_time);	
		$startDay = date('l', $start_time);
		$endDay = date('l',$end_time);
		$startDate =  strtotime("2000-01-01" . " ". $_POST["start_time"]);
		$endDate = strtotime("2000-01-01" . " ". $_POST["end_date"]);
		$startDateTimestamp = date('Y-m-d H:i:s', $startDate);
		$endDateTimestamp = date('Y-m-d H:i:s', $endDate);
        

		$query = $this->db->query("SELECT name FROM users WHERE id = '" . $_SESSION['id'] . "'");
		foreach ($query->result() as $row) {
    		$reserved_by = $row->name;
		}


		$set_class = "";

		if($_POST["selected_class"]=="free_venue"){
    		$set_class = $_POST["selected_busy_class"];
		}else{
    		$set_class = $_POST["selected_class"];
		}

		$class_name = "";

		if($_POST["selected_class"]=="free_venue" && $_POST["selected_busy_class"]=="busy_venue"){
    		$class_name = "Will be Informed";
		}
		else{
    		$query = $this->db->query("SELECT class_name FROM classess WHERE class_id = '" . $set_class . "'");
        		foreach ($query->result() as $row) {
        		$class_name = $row->class_name;
        		}

        	$data = array(
        	'class_id' => $set_class,
        	'start_time' => $start_timestamp,
        	'end_time' => $end_timestamp,
        	'description' => $_POST["description"],
        	'reserved_by' => $reserved_by
        	);
        	$this->db->insert("exrta_busy_classes", $data);
		}

		$users = $_SESSION["users"];
		$stringCommettee = implode(",", $_SESSION["commetties"]);
		$data = array(
    		'title' => $_POST["title"],
    		'status' => "scheduled",
    		'initiater_id' => $_SESSION['id'],
    		'committee_id' => $stringCommettee,
    		'start_time' => $start_timestamp,
    		'end_time' => $end_timestamp,
    		'description' => $_POST["description"],
    		'venue' => $class_name
		);
		$this->db->insert("meeting_logs", $data);
		$lastIdMeetingLog = $this->db->insert_id();



		$count = count($Committies["records"]);
		for ($i = 0; $i < $count; $i++) {
    		foreach ($_SESSION["commetties"] as $comm_Array) {
        		if ($comm_Array == $Committies["records"][$i]->id) {
            	$commety = $Committies["records"][$i]->name;
            	break;
        	}
    	  }
		}

		$start = date('d-M-Y g:ia l', $start_time);
		$end   = date('d-M-Y g:ia l', $end_time);


		$busyUsers   = array();
		$freeUsers[] = array();
		foreach ($users as $user) {
    		$id    = $user->id;
    		$query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '" . $id . "' AND (start_time BETWEEN '" . $start_timestamp . "' AND '" . $end_timestamp . "' OR end_time BETWEEN '" . $start_timestamp . "' AND '" . $end_timestamp . "')");
    $query2 = $this->db->query("SELECT * FROM permanent_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$startDateTimestamp."' AND '".$endDateTimestamp."' OR end_time BETWEEN '".$startDate."' AND '".$endDate."' ) AND (day = '".$endDay."' OR day = '".$startDay."')");

    $TableData = "";
    foreach ($users as $user) {        
        $TableData .= '<tr><td >' . $user->name . '</td><td >' . $user->designation . '</td></tr>';   
    } 

    if ($query->num_rows() > 0 || $query2->num_rows() > 0) {
        $busyUsers[] = $user;
        $details     = "";
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $userDetails) {
                $startTime = date('d-M-Y g:ia l', strtotime($userDetails->start_time));
                $endTime   = date('d-M-Y g:ia l', strtotime($userDetails->end_time));
                $details .= '<tr><td>' . $userDetails->description . '</td><td>' . $startTime . '</td><td>' . $endTime . '</td></tr>';
            }
        }
        if ($query2->num_rows() > 0) {
            foreach ($query2->result() as $userDetails) {
            $startTime = date('g:ia l', strtotime($userDetails->start_time));
            $endTime   = date('g:ia l', strtotime($userDetails->end_time));
            $details .= '<tr><td>' . $userDetails->description . '</td><td>' . $startTime . '</td><td>' . $endTime . '</td></tr>';
            }
        
        }
        $data = array(
            'meeting_id' => $lastIdMeetingLog,
            'user_id' => $id,
            'description' => $_POST["description"],
            'start_time' => $start_timestamp,
            'end_time' => $end_timestamp
        );
        $this->db->insert("temporary_engages", $data);
        $acceptLink = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $this->db->insert_id() . "/Accepted";
        $rejectLink = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $this->db->insert_id() . "/";
        
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host       = 'sg2plcpnl0008.prod.sin2.secureserver.net'; // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'info@sibasmartplanner.com'; // SMTP username
        $mail->Password   = 'Y*/c#+P9*%2d4'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587; // TCP port to connect to
        
        $mail->setFrom('info@sibasmartplanner.com', 'Siba Smart Planner');
        $mail->addAddress($user->email, $user->name); // Add a recipient
        $mail->addReplyTo('no-reply@SmartPlanner.com', 'No Reply');
        $mail->isHTML(true); // Set email format to HTML
        
        $mail->Subject = $_POST['title'];
        //$email->header =  "";
        
        $mail->Body = "<head><style>
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


</style></head><label>".$Msg."Meeting schedule is bieng conflicted with your current schedule.<br><br>Meeting scheduled Conflict with:</label> <br><br>
        <div style='overflow-x:auto;'>
        <h2>Conflict Details</h2>
        <table>
        
        <thead>  
        <tr><th>Description</th><th>Start Time</th><th>End Time</th></tr>
        </thead>
        <tbody>" . $details . "</tbody>
        </table>
        <br><br>
        <h2>Meeting Details</h2>
        <table>
         <thead>
         </thead>
         <tbody>
         <tr>         
            <td 'background-color: #0000CD;'>Title</td>            
            <td>" . $_POST['title'] . "</td>
            </tr>
            <tr>
            <td 'background-color: #0000CD;' >Committee Invited.</td>            
            <td>" . $commety . "</td>
            </tr>
            
            
            <tr>
            <td 'background-color: #0000CD;' >Start Time</td>            
            <td>" . $start . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;' >End Time</td>            
            <td>" . $end . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Description</td>            
            <td>" . $_POST['description'] . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Venue</td>            
            <td>" . $class_name . "</td>
            </tr>
            
             
         </tbody>
         </table>
         <br><br>
         <h2>Meeting Participants</h2>
         <table>     
         <thead>

         
         <tr>       
         <th>Name</th>
         <th>Designation</th>
         
         </tr>
         </thead>
         <tbody>" . $TableData . "</tbody>
         </table></div>
         <br>
         <div class='wrapper'>
        
        <a class='button' target='_blank' rel='noopener noreferrer' href=" . $acceptLink . ">Accept Invitation </a>
        <a class='button button2' target='_blank' rel='noopener noreferrer' href=" . $rejectLink . ">Decline Invitation</a>      
        
        </div>";
        
        
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        
    } else {
        
        $freeUsers[] = $user;
        $data = array(
            'meeting_id' => $lastIdMeetingLog,
            'user_id' => $id,
            'description' => $_POST["description"],
            'start_time' => $start_timestamp,
            'end_time' => $end_timestamp
        );
        $this->db->insert("temporary_engages", $data);
        $acceptLink = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $this->db->insert_id() . "/Accepted";
        $rejectLink = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $this->db->insert_id() . "/";
        
        
        // mail for free users..
        
        
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host       = 'sg2plcpnl0008.prod.sin2.secureserver.net'; // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'info@sibasmartplanner.com'; // SMTP username
        $mail->Password   = 'Y*/c#+P9*%2d4'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587; // TCP port to connect to
        $mail->setFrom('info@sibasmartplanner.com', 'Siba Smart Planner');
        $mail->addAddress($user->email, $user->name); // Add a recipient
        $mail->addReplyTo('no-reply@SmartPlanner.com', 'No Reply');
        $mail->isHTML(true); // Set email format to HTML
        
        $mail->Subject = $_POST['title'];
        
        $mail->Body = "
            <head><style>
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


</style></head><label>You are invited for the meeting. Below are the Details.<br><br>
        <div style='overflow-x:auto;'>
        <h2>Meeting Details</h2>
        <table>
         <thead>
         </thead>
         <tbody>
         <tr>         
            <td 'background-color: #0000CD;'>Title</td>            
            <td>" . $_POST['title'] . "</td>
            </tr>
            <tr>
            <td 'background-color: #0000CD;' >Committee Invited.</td>            
            <td>" . $commety . "</td>
            </tr>
            
            
            <tr>
            <td 'background-color: #0000CD;' >Start Time</td>            
            <td>" . $start . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;' >End Time</td>            
            <td>" . $end . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Description</td>            
            <td>" . $_POST['description'] . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Venue</td>            
            <td>" . $class_name . "</td>
            </tr>
            
             
         </tbody>
         </table>
         <br><br>
         <h2>Meeting Participants</h2>
         <table>     
         <thead>
         <tr>       
         <th>Name</th>
         <th>Designation</th>
         
         </tr>
         </thead>
         <tbody>" . $TableData . "</tbody>
         </table></div>
         <br>
         <div class='wrapper'>
        
        <a class='button' target='_blank' rel='noopener noreferrer' href=" . $acceptLink . ">Accept Invitation </a>
        <a class='button button2' target='_blank' rel='noopener noreferrer' href=" . $rejectLink . ">Decline Invitation</a>      
        
        </div>";
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }   
    }

    
}










		//$this->load->view('User/Partial/header');
		//$this->load->view('User/Partial/timedateheader');
		//$this->load->view('User/InitiateMeeting/MeetingScheduled',$data);
		//$this->load->view('User/Partial/footer');		
	}


	public function meetingDetails()
	{
		$this->session_check();
		$this->load->model('Committee');
		$data['Committies'] = $this->Committee->view_all();
		$this->load->view('User/Partial/header');
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/InitiateMeeting/meetingDetails',$data);
		$this->load->view('User/Partial/footer');
	}










public function meetingScheduled(){
		$this->session_check();

        if($_POST["editCheck2"]=="editEmail"){

                 if(isset($_SESSION['deleteMeetingId'])){
                        $this->db->delete("temporary_engages", "meeting_id = ".$_SESSION['deleteMeetingId']);
                        $this->db->delete("meeting_logs", "id = ".$_SESSION['deleteMeetingId']);             
                        unset($_SESSION['deleteMeetingId']);
                 }

                 
                 $Msg = "<b>Following meeting has been Updated.</b> ";  



                 //$startDate = date('m/d/Y',strtotime($_SESSION["startTimeStamp"]));
                 //$startTime = date('g:ia',strtotime($_SESSION["startTimeStamp"]));
                 //$editCheck2 = true;
        }else{

            $Msg = "You are invited for the meeting. "; 
        }



		$this->load->model('Committee');
		$data['Committies'] = $this->Committee->view_all();
		$Committies = $data['Committies'];
		

		
		$start_time      = strtotime($_POST["start_date"] . " " . $_POST["start_time"]);
		$start_timestamp = date('Y-m-d H:i:s', $start_time);
		$end_time        = strtotime($_POST["end_date"] . " " . $_POST["end_time"]);
		$end_timestamp   = date('Y-m-d H:i:s', $end_time);	
		$startDay = date('l', $start_time);
		$endDay = date('l',$end_time);
		$startDate =  strtotime("2000-01-01" . " ". $_POST["start_time"]);
		$endDate = strtotime("2000-01-01" . " ". $_POST["end_date"]);
		$startDateTimestamp = date('Y-m-d H:i:s', $startDate);
		$endDateTimestamp = date('Y-m-d H:i:s', $endDate);
        

		$query = $this->db->query("SELECT name FROM users WHERE id = '" . $_SESSION['id'] . "'");
		foreach ($query->result() as $row) {
    		$reserved_by = $row->name;
		}


		$set_class = "";

		if($_POST["selected_class"]=="free_venue"){
    		$set_class = $_POST["selected_busy_class"];
		}else{
    		$set_class = $_POST["selected_class"];
		}

		$class_name = "";
		

		if($_POST["selected_class"]=="free_venue" && $_POST["selected_busy_class"]=="busy_venue"){
    		$class_name = "Will be Informed";
    		$data['class_name'] = "Will be Informed";

		}
		else{
    		$query = $this->db->query("SELECT class_name FROM classess WHERE class_id = '" . $set_class . "'");
        		foreach ($query->result() as $row) {
        		$class_name = $row->class_name;
        		$data['class_name'] = $row->class_name;
        		}

        	$data = array(
        	'class_id' => $set_class,
        	'start_time' => $start_timestamp,
        	'end_time' => $end_timestamp,
        	'description' => $_POST["description"],
        	'reserved_by' => $reserved_by
        	);
        	$this->db->insert("exrta_busy_classes", $data);
		}

		$users = $_SESSION["users"];
		$stringCommettee = implode(",", $_SESSION["commetties"]);
		$data = array(
    		'title' => $_POST["title"],
    		'status' => "scheduled",
    		'initiater_id' => $_SESSION['id'],
    		'committee_id' => $stringCommettee,
    		'start_time' => $start_timestamp,
    		'end_time' => $end_timestamp,
    		'description' => $_POST["description"],
    		'venue' => $class_name
		);
		$this->db->insert("meeting_logs", $data);
		$lastIdMeetingLog = $this->db->insert_id();



		$count = count($Committies["records"]);
		for ($i = 0; $i < $count; $i++) {
    		foreach ($_SESSION["commetties"] as $comm_Array) {
        		if ($comm_Array == $Committies["records"][$i]->id) {
            	$commety = $Committies["records"][$i]->name;
            	break;
        	}
    	  }
		}

		$start = date('d-M-Y g:ia l', $start_time);
		$end   = date('d-M-Y g:ia l', $end_time);


		$TableData = "";
		foreach ($users as $user) {        
        $TableData .= '<tr><td >' . $user->name . '</td><td >' . $user->designation . '</td></tr>';   
    	} 


		$busyUsers   = array();
		$freeUsers[] = array();
	foreach ($users as $user) {
    		$id    = $user->id;
    		$query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '" . $id . "' AND (start_time BETWEEN '" . $start_timestamp . "' AND '" . $end_timestamp . "' OR end_time BETWEEN '" . $start_timestamp . "' AND '" . $end_timestamp . "') AND status!='Rejected'");
            
            /*
            $query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '" . $id . "' AND (start_time BETWEEN '" . $start_timestamp . "' AND '" . $end_timestamp . "' OR end_time BETWEEN '" . $start_timestamp . "' AND '" . $end_timestamp . "')");
            */

    $query2 = $this->db->query("SELECT * FROM permanent_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$startDateTimestamp."' AND '".$endDateTimestamp."' OR end_time BETWEEN '".$startDate."' AND '".$endDate."' ) AND (day = '".$endDay."' OR day = '".$startDay."')");

    /*
    $TableData = "";
    foreach ($users as $user) {        
        $TableData .= '<tr><td >' . $user->name . '</td><td >' . $user->designation . '</td></tr>';   
    } */

    if ($query->num_rows() > 0 || $query2->num_rows() > 0) {
        $busyUsers[] = $user;
        $details     = "";
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $userDetails) {
                $startTime = date('d-M-Y g:ia l', strtotime($userDetails->start_time));
                $endTime   = date('d-M-Y g:ia l', strtotime($userDetails->end_time));
                $details .= '<tr><td>' . $userDetails->description . '</td><td>' . $startTime . '</td><td>' . $endTime . '</td></tr>';
            }
        }
        if ($query2->num_rows() > 0) {
            foreach ($query2->result() as $userDetails) {
            //previous
            //$startTime = date('g:ia l', strtotime($userDetails->start_time));
            //$endTime   = date('g:ia l', strtotime($userDetails->end_time));
            $startTime = date('g:ia ', strtotime($userDetails->start_time));
            $endTime   = date('g:ia ', strtotime($userDetails->end_time));
            $details .= '<tr><td>' . $userDetails->description . '</td><td>' . $startTime . '</td><td>' . $endTime . '</td></tr>';
            }
        
        }
        $data = array(
            'meeting_id' => $lastIdMeetingLog,
            'user_id' => $id,
            'description' => $_POST["description"],
            'start_time' => $start_timestamp,
            'end_time' => $end_timestamp
        );
        $this->db->insert("temporary_engages", $data);
        $acceptLink = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $this->db->insert_id() . "/Accepted";
        $rejectLink = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $this->db->insert_id() . "/";
        
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


</style></head><label>".$Msg."<br>Meeting schedule is being conflicted with your current schedule.<br><br>
        <div style='overflow-x:auto;'>
        <h2>Conflict Details</h2>
        <table>
        
        <thead>  
        <tr><th>Description</th><th>Start Time</th><th>End Time</th></tr>
        </thead>
        <tbody>" . $details . "</tbody>
        </table>
        <br><br>
        <h2>Meeting Details</h2>
        <table>
         <thead>
         </thead>
         <tbody>
         <tr>         
            <td 'background-color: #0000CD;'>Title</td>            
            <td>" . $_POST['title'] . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;' >Initiator Name</td>            
            <td>" . $_SESSION["user-name"]  . "</td>
            </tr>
            


            <tr>
            <td 'background-color: #0000CD;' >Committee Invited</td>            
            <td>" . $commety . "</td>
            </tr>
            
            
            <tr>
            <td 'background-color: #0000CD;' >Start Time</td>            
            <td>" . $start . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;' >End Time</td>            
            <td>" . $end . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Description</td>            
            <td>" . $_POST['description'] . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Venue</td>            
            <td>" . $class_name . "</td>
            </tr>
            
             
         </tbody>
         </table>
         <br><br>
         <h2>Meeting Participants</h2>
         <table>     
         <thead>

         
         <tr>       
         <th>Name</th>
         <th>Designation</th>
         
         </tr>
         </thead>
         <tbody>" . $TableData . "</tbody>
         </table></div>
         <br>
         <div class='wrapper'>
    
        <a class='button' target='_blank' rel='noopener noreferrer' href=" . $acceptLink . ">Accept Invitation </a>
        <a class='button button2' target='_blank' rel='noopener noreferrer' href=" . $rejectLink . ">Decline Invitation</a>      
        
        </div>";

        	
        	//$to = $user->name.'<'.$user->email.'>';
        	$to = $user->email;
			$subject = $_POST['title'];								
			$headers = "";			
			$headers.= "From: Siba Smart Planner <info@sibasmartplanner.com> \r\n";
			$headers .= "Reply-To: No Reply <no-reply@sibasmartplanner.com> \r\n" ."X-Mailer: PHP/" . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";        
			$send=mail($to,$subject,$body,$headers);
			if($send)
			{
					//echo "mail sent to $to ";
			}
			else
			{	
				echo "mail could not sent to $to the address ";
			}
        
    } else {
        
        $freeUsers[] = $user;
        $data = array(
            'meeting_id' => $lastIdMeetingLog,
            'user_id' => $id,
            'description' => $_POST["description"],
            'start_time' => $start_timestamp,
            'end_time' => $end_timestamp
        );
        $this->db->insert("temporary_engages", $data);
        $acceptLink = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $this->db->insert_id() . "/Accepted";
        $rejectLink = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $this->db->insert_id() . "/";
        
        
        // mail for free users..
        	$body = "
            <head><style>
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


</style></head><label>".$Msg."<br><br>
        <div style='overflow-x:auto;'>
        <h2>Meeting Details</h2>
        <table>
         <thead>
         </thead>
         <tbody>
         <tr>         
            <td 'background-color: #0000CD;'>Title</td>            
            <td>" . $_POST['title'] . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;' >Initiator Name</td>            
            <td>" . $_SESSION["user-name"]  . "</td>
            </tr>


            <tr>
            <td 'background-color: #0000CD;' >Committee Invited.</td>            
            <td>" . $commety . "</td>
            </tr>
            
            
            <tr>
            <td 'background-color: #0000CD;' >Start Time</td>            
            <td>" . $start . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;' >End Time</td>            
            <td>" . $end . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Description</td>            
            <td>" . $_POST['description'] . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Venue</td>            
            <td>" . $class_name . "</td>
            </tr>
            
             
         </tbody>
         </table>
         <br><br>
         <h2>Meeting Participants</h2>
         <table>     
         <thead>
         <tr>       
         <th>Name</th>
         <th>Designation</th>
         
         </tr>
         </thead>
         <tbody>" . $TableData . "</tbody>
         </table></div>
         <br>
         <div class='wrapper'>
        
        <a class='button' target='_blank' rel='noopener noreferrer' href=" . $acceptLink . ">Accept Invitation </a>
        <a class='button button2' target='_blank' rel='noopener noreferrer' href=" . $rejectLink . ">Decline Invitation</a>      
        
        </div>";

        	
        	//$to = $user->name.'<'.$user->email.'>';
        	$to = $user->email;
			$subject = $_POST['title'];								
			$headers = "";			
			$headers.= "From: Siba Smart Planner <info@sibasmartplanner.com> \r\n";
			$headers .= "Reply-To: No Reply <no-reply@sibasmartplanner.com> \r\n" ."X-Mailer: PHP/" . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";        
			$send=mail($to,$subject,$body,$headers);
			if($send)
			{
					//echo "mail sent to $to ";
			}
			else
			{	
				echo " mail could not sent to $to the address ";
			}


   
    }

    
}




        if($_POST["editCheck2"]=="editEmail"){  $data['MeetingUpdated']  = "MeetingUpdated"; }
		$data['Committies'] = $this->Committee->view_all();
		$data['class_name'] = $class_name;
		
		$this->load->view('User/Partial/header');
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/InitiateMeeting/MeetingScheduled',$data);
		$this->load->view('User/Partial/footer');		
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
?>