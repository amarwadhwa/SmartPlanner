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

print_r($_SESSION["users"]);
$users = $_SESSION["users"];


print_r($_SESSION["commetties"]);

echo "<br>";
echo "<br>";
echo "<br>";

$busyUsers = array();
foreach ($users as $user) {
	$id =$user->id;
	$query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$id."' AND (start_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' OR end_time BETWEEN '".$start_timestamp."' AND '".$end_timestamp."' )");

	if($query->num_rows() >0){
	$busyUsers[] = $user;	
	}
}
$users = array_diff($users, $busyUsers);
print_r($users);
print_r($busyUsers);
?>