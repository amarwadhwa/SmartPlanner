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

print_r($_SESSION["commetties"]);

?>