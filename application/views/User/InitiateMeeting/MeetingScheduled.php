<?php
$start_time =  strtotime($_POST["start_date"] . " ". $_POST["start_time"]);
$start_timestamp =  date('Y-m-d H:i:s', $start_time);
$end_time =  strtotime($_POST["end_date"] . " ". $_POST["end_time"]);
$end_timestamp =  date('Y-m-d H:i:s', $end_time);

echo "<br>";
echo $start_timestamp;
echo "<br>";
echo $end_timestamp;
echo "<br>";


echo "meething scheduled succeesfully";
echo "<br>";
echo "meeting title ";
echo "<br>";
echo $_POST["title"];
echo "<br>";
echo "Other Faculty Members";
echo "<br>";
echo $_POST["faculty"];
echo "<br>";
echo "meeting description ";
echo "<br>";
echo $_POST["description"];
echo "<br>";

$users = $_SESSION["users"];

$stringCommettee = implode(",",$_SESSION["commetties"]);

echo "<br>";
echo "<br>";
echo "<br>";

$data = array( 
   		'title' => $_POST["title"], 
        'status' => "scheduled",
        'initiater_id' => $_SESSION['id'], 
		'committee_id' =>$stringCommettee,
		'start_time' =>$start_timestamp,
		'end_time'  =>$end_timestamp,
		'description' => $_POST["description"]); 
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


	}
}
?>