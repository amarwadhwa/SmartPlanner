<?php
require 'application_resources/PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$start_time =  strtotime($_POST["start_date"] . " ". $_POST["start_time"]);
$start_timestamp =  date('Y-m-d H:i:s', $start_time);
$end_time =  strtotime($_POST["end_date"] . " ". $_POST["end_time"]);
$end_timestamp =  date('Y-m-d H:i:s', $end_time);


$query = $this->db->query("SELECT name FROM users WHERE id = '".$_SESSION['id']."'");

foreach ($query->result() as $row) {
    $reserved_by = $row->name;
}




$data = array( 
      'class_id' => $_POST["selected_class"], 
    'start_time' =>$start_timestamp,
    'end_time'  =>$end_timestamp,
    'description' => $_POST["description"],
    'reserved_by'=> $reserved_by); 
    $this->db->insert("exrta_busy_classes", $data);

$query = $this->db->query("SELECT class_name FROM classess WHERE class_id = '".$_POST["selected_class"]."'");

foreach ($query->result() as $row) {
    $class_name = $row->class_name;
}


$users = $_SESSION["users"];

$stringCommettee = implode(",",$_SESSION["commetties"]);

$data = array( 
   		'title' => $_POST["title"], 
        'status' => "scheduled",
        'initiater_id' => $_SESSION['id'], 
		'committee_id' =>$stringCommettee,
		'start_time' =>$start_timestamp,
		'end_time'  =>$end_timestamp,
		'description' => $_POST["description"],
    'venue'=>$class_name); 
		$this->db->insert("meeting_logs", $data);
		$lastIdMeetingLog =  $this->db->insert_id();



     $count = count($Committies["records"]);
                                    for($i=0; $i <$count; $i++){
                                 
                                                foreach ($_SESSION["commetties"] as $comm_Array) {
                                                    if($comm_Array==$Committies["records"][$i]->id ){ 
                                                      $commety= $Committies["records"][$i]->name ; 
                                                      break;
                                                    }
                                                }
                                    }

$start = date('d-M-Y g:ia l', $start_time);
$end = date('d-M-Y g:ia l', $end_time);


$busyUsers = array();
$freeUsers[] = array();
foreach ($users as $user) {
	$id =$user->id;
	$query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' OR end_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."')");


  $TableData = "";
                        foreach ($users as $user) {                           
                          
                          $TableData .= '<tr><td >'.$user->name.'</td><td >'.$user->designation.'</td></tr>'; 
                          
                        }


	if($query->num_rows() >0){
	$busyUsers[] = $user;	
        $details ="";

      foreach ($query->result() as $userDetails) {
            

          $startTime = date('d-M-Y g:ia l', strtotime($userDetails->start_time));
          $endTime =   date('d-M-Y g:ia l', strtotime($userDetails->end_time));
          $details.= '<tr><td>'.$userDetails->description.'</td><td>'.$startTime.'</td><td>'.$endTime.'</td></tr>';
      }


		$data = array( 
   		'meeting_id' =>  $lastIdMeetingLog,
   		'user_id' => $user->id,
   		'description' => $_POST["description"], 
		'start_time' =>$start_timestamp,
		'end_time'  =>$end_timestamp,);
		$this->db->insert("temporary_engages", $data);

		$acceptLink =  "http://localhost/SmartPlanner/schduleMeeting/setStatus/".$this->db->insert_id()."/accept";
		$rejectLink =  "http://localhost/SmartPlanner/schduleMeeting/setStatus/".$this->db->insert_id()."/Not Interested";

		echo "$acceptLink <br> <br>";
		echo "$rejectLink <br> <br>";

    //Extra Content Karan



                        

                            




    //End Extra Content







			// mail for busy users...
		
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'localhostlocal4';                 // SMTP username
            $mail->Password = '4localhostlocal';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            $mail->setFrom('localhostlocal4gmail.com', 'Meeting Scheduled');
            $mail->addAddress($user->email, $user->name);     // Add a recipient
            $mail->addReplyTo('no-reply@SmartPlanner.com', 'No Reply');
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Meeting Invitation';
            //$email->header =  "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>";
            $mail->Body    = 'Here is meeting details<b> <h1> Options </h1> <br> <br> <a href="'.$acceptLink.'"> Interested</a> <br> <br> <a href="'. $rejectLink.'">Not Interested </a>';

            $mail->Body = "You are invited for the meeting, Meeting schedule is bieng conflicted with your current schedule.<br>Your scheduled engage: <br><table border='1'>
        <thead>
        <tr><th>Conflict Details</th></tr>
        <tr><th>Description</th><th>Start Time</th><th>End Time</th></tr>
        </thead>
        <tbody>".$details."
         
        </tbody>
        </table><br><br>
            <table style='font-size: 12px'; class='table table-bordered' >
            
         <thead>
         <tr style='background-color:LightGrey'>
        <th scope='col'>Meeting Details</th>
         </tr>
         </thead>
         <tbody>
         <tr>         
            <td width=12% >Title</td>            
            <td width=12% >".$_POST["title"]."</td>;
            </tr>;
            

            <tr>
            <td width=12%>Committee Invited.</td>            
            <td width=12% >".$commety."</td>
            </tr>
            
            
            <tr>
            <td width=12%>Start Time</td>            
            <td width=12% >".$start."</td>
            </tr>

            <tr>
            <td width=12%>End Time</td>            
            <td width=12% >".$end."</td>
            </tr>

            <tr>
            <td width=12%>Description</td>            
            <td width=12% >".$_POST['description']."</td>
            </tr>

            <tr>
            <td width=12%>Venue</td>            
            <td width=12% >".$class_name."</td>
            </tr>
            
             
         </tbody>
         </table>
         

         <table style='font-size: 12px;' class='table table-bordered' >    
          
          <label>Meeting Participants</label>
         <thead>

         
         <tr style='background-color:LightGrey' >       
         <th scope='col'>Name</th>
         <th scope='col'>Designation</th>
         
         </tr>
         </thead>
         <tbody>".$TableData.          
         "</tbody>
         </table>";  



            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } 

	}
	else {
		$freeUsers[] = $user;

		$data = array( 
   		'meeting_id' =>  $lastIdMeetingLog,
   		'user_id' => $user->id,
   		'description' => $_POST["description"], 
		'start_time' =>$start_timestamp,
		'end_time'  =>$end_timestamp,);
		$this->db->insert("temporary_engages", $data);

		$acceptLink =  "http://localhost/SmartPlanner/schduleMeeting/setStatus/".$this->db->insert_id()."/accept";
		$rejectLink =  "http://localhost/SmartPlanner/schduleMeeting/setStatus/".$this->db->insert_id()."/Not Interested";

		echo "$acceptLink <br> <br>";
		echo "$rejectLink <br> <br>";






		// mail for free users..


            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'localhostlocal4';                 // SMTP username
            $mail->Password = '4localhostlocal';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            $mail->setFrom('localhostlocal4gmail.com', 'Meeting Scheduled');
            $mail->addAddress($user->email, $user->name);     // Add a recipient
            $mail->addReplyTo('no-reply@SmartPlanner.com', 'No Reply');
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Meeting Invitation';
            $mail->Body    = 'Here is meeting details<b> <h1> Options </h1> <br> <br> <a href="'.$acceptLink.'"> Interested</a> <br> <br> <a href="'. $rejectLink.'">Not Interested </a>';
            
            $mail->Body = "You are invited for the Meeting, Below are the Meeting Details.<br>
        </table><br><br>
            <table style='font-size: 12px'; class='table table-bordered' >
            
         <thead>
         <tr style='background-color:LightGrey'>
        <th scope='col'>Meeting Details</th>
         </tr>
         </thead>
         <tbody>
         <tr>         
            <td width=12% >Title</td>            
            <td width=12% >".$_POST["title"]."</td>;
            </tr>;
            

            <tr>
            <td width=12%>Committee Invited.</td>            
            <td width=12% >".$commety."</td>
            </tr>
            
            
            <tr>
            <td width=12%>Start Time</td>            
            <td width=12% >".$start."</td>
            </tr>

            <tr>
            <td width=12%>End Time</td>            
            <td width=12% >".$end."</td>
            </tr>

            <tr>
            <td width=12%>Description</td>            
            <td width=12% >".$_POST['description']."</td>
            </tr>

            <tr>
            <td width=12%>Venue</td>            
            <td width=12% >".$class_name."</td>
            </tr>
            
             
         </tbody>
         </table>
         

         <table style='font-size: 12px;' class='table table-bordered' >    
          
          <label>Meeting Participants</label>
         <thead>

         
         <tr style='background-color:LightGrey' >       
         <th scope='col'>Name</th>
         <th scope='col'>Designation</th>
         
         </tr>
         </thead>
         <tbody>".$TableData.          
         "</tbody>
         </table>"; 

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } 



	}
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h2 class="page-header">Meeting scheduled successfully</h2>
            </div>
            <!-- /.col-lg-12 -->
            <form action="<?php echo base_url('initiateMeeting/index')?>" method="post" role="form">

         </div>
         
         

         
    

      <table style="font-size: 12px;"class="table table-bordered" >
            
         <thead>
         <tr style="background-color:LightGrey" >
         
        <th scope="col">Meeting Details</th>
         </tr>
         </thead>
         <tbody>
         <?php
                    $count = count($Committies["records"]);
                                    for($i=0; $i <$count; $i++){
                                 
                                                foreach ($_SESSION["commetties"] as $comm_Array) {
                                                    if($comm_Array==$Committies["records"][$i]->id ){ 
                                                      $commety= $Committies["records"][$i]->name ; 
                                                      break;
                                                    }
                                                }
                                    }



            echo "<tr>";         
            echo "<td width=12%  >Title</td>";            
            echo "<td width=12% >".$_POST["title"]."</td>";
            echo "</tr>";
            

            echo "<tr>";
            echo "<td width=12%>Committee Invited</td>";            
            echo "<td width=12% >".$commety."</td>";
            echo "</tr>";
            
            $start = date('d-M-Y g:ia l', $start_time);
            $end = date('d-M-Y g:ia l', $end_time);
            echo "<tr>";
            echo "<td width=12%>Start Time</td>";            
            echo "<td width=12% >".$start."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td width=12%>End Time</td>";            
            echo "<td width=12% >".$end."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td width=12%>Description</td>";            
            echo "<td width=12% >".$_POST["description"]."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td width=12%>Venue</td>";            
            echo "<td width=12% >".$class_name."</td>";
            echo "</tr>";
            
          ?>   
         </tbody>
         </table>
         

         <table style="font-size: 12px;"class="table table-bordered" >    
          
          <label>Meeting Participants</label>
         <thead>

         
         <tr style="background-color:LightGrey" >       
         <th scope="col">Name</th>
         <th scope="col">Designation</th>
         
         </tr>
         </thead>
         <tbody>
         <?php
                   
                        
                        foreach ($users as $user) {                           
                          
                          echo "<tr>";
                          echo "<td >".$user->name."</td>";
                          echo "<td >".$user->designation."</td>";
                          echo "</tr>";
                        }
            
          ?>   
         </tbody>
         </table>

         
          <button float-right type='submit' class='btn btn-primary btn pull-right'>Back</button>
          <br>
          <br>
          <br>
          <br>
          <br>

            </form>

      </div>


   </body>
</html>
