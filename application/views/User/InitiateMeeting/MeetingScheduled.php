<?php
require 'application_resources/PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$start_time =  strtotime($_POST["start_date"] . " ". $_POST["start_time"]);
$start_timestamp =  date('Y-m-d H:i:s', $start_time);
$end_time =  strtotime($_POST["end_date"] . " ". $_POST["end_time"]);
$end_timestamp =  date('Y-m-d H:i:s', $end_time);


$data = array( 
      'class_id' => $_POST["selected_class"], 
    'start_time' =>$start_timestamp,
    'end_time'  =>$end_timestamp,
    'description' => $_POST["description"]); 
    $this->db->insert("exrta_busy_classes", $data);

$query = $this->db->query("SELECT class_name FROM classess WHERE class_id = '".$_POST["selected_class"]."'");

foreach ($query->result() as $row) {
    $class_name = $row->class_name;
}

echo $_POST["title"];
echo $_POST["description"];


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




$busyUsers = array();
$freeUsers[] = array();
foreach ($users as $user) {
	$id =$user->id;
	$query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' OR end_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' )");

	if($query->num_rows() >0){
	$busyUsers[] = $user;	

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

            $mail->Subject = 'Meeting Scheduled';
            $mail->Body    = 'Here is meeting details<b> <h1> Options </h1> <br> <br> <a href="'.$acceptLink.'"> Interested</a> <br> <br> <a href="'. $rejectLink.'">Not Interested </a>';

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

            $mail->Subject = 'Meeting Scheduled';
            $mail->Body    = 'Here is meeting details<b> <h1> Options </h1> <br> <br> <a href="'.$acceptLink.'"> Interested</a> <br> <br> <a href="'. $rejectLink.'">Not Interested </a>';

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
            
         </div>
         <div><h4>Meeting Details</h4></div>
                Meeting Title : <?php echo $_POST["title"]; ?><br>
                Committees Invited : <?php echo "$stringCommettee" ; ?> <br>
                Guests :  <br>
                Start time: <?php echo $_POST["start_time"]." ".$_POST["start_date"];?> <br>
                End time:<?php echo $_POST["end_date"] . " ". $_POST["end_time"];?> <br>
                Description:<?php echo $_POST["description"]; ?> <br>
                Venue: <?php echo $_POST["selected_class"]; ?>
         

         
         <!-- /#page-wrapper -->
      </div>
   </body>
</html>
