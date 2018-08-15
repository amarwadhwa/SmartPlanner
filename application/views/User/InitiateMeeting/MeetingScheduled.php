<?php

//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
//require 'application_resources/PHPMailer/PHPMailerAutoload.php';
//$mail            = new PHPMailer();
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
//$_SESSION['id'] 
  if(isset($MeetingUpdated)){
      if($MeetingUpdated=="MeetingUpdated"){
      $Msg = "Meeting Updated successfully";
      }

  }else{
      $Msg = "Meeting scheduled successfully";
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
               <h2 class="page-header"><?php echo $Msg; ?></h2>
            </div>
            <!-- /.col-lg-12 -->
            <form action="<?php
echo base_url('initiateMeeting/index');
?>" method="post" role="form">

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
for ($i = 0; $i < $count; $i++) {
    
    foreach ($_SESSION["commetties"] as $comm_Array) {
        if ($comm_Array == $Committies["records"][$i]->id) {
            $commety = $Committies["records"][$i]->name;
            break;
        }
    }
}



echo "<tr>";
echo "<td width=12%  >Title</td>";
echo "<td width=12% >" . $_POST["title"] . "</td>";
echo "</tr>";


echo "<tr>";
echo "<td width=12%>Committee Invited</td>";
echo "<td width=12% >" . $commety . "</td>";
echo "</tr>";

$start = date('d-M-Y g:ia l', $start_time);
$end   = date('d-M-Y g:ia l', $end_time);
echo "<tr>";
echo "<td width=12%>Start Time</td>";
echo "<td width=12% >" . $start . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td width=12%>End Time</td>";
echo "<td width=12% >" . $end . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td width=12%>Description</td>";
echo "<td width=12% >" . $_POST["description"] . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td width=12%>Venue</td>";
echo "<td width=12% >" . $class_name . "</td>";
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

$users = $_SESSION["users"];
foreach ($users as $user) {
    
    echo "<tr>";
    echo "<td >" . $user->name . "</td>";
    echo "<td >" . $user->designation . "</td>";
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
