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
            //$email->header =  "";
            $mail->Body    = 'Here is meeting details<b> <h1> Options </h1> <br> <br> <a href="'.$acceptLink.'"> Interested</a> <br> <br> <a href="'. $rejectLink.'">Not Interested </a>';

            $mail->Body = "<head><style>


/*//////////////////////////////////////////////////////////////////
[ FONT ]*/


@font-face {
  font-family: Lato-Regular;
  src: url('../fonts/Lato/Lato-Regular.ttf'); 
}

@font-face {
  font-family: Lato-Bold;
  src: url('../fonts/Lato/Lato-Bold.ttf'); 
}

/*//////////////////////////////////////////////////////////////////
[ RESTYLE TAG ]*/
* {
    margin: 0px; 
    padding: 0px; 
    box-sizing: border-box;
}

body, html {
    height: 100%;
    font-family: sans-serif;
}

/* ------------------------------------ */
a {
    margin: 0px;
    transition: all 0.4s;
    -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
}

a:focus {
    outline: none !important;
}

a:hover {
    text-decoration: none;
}

/* ------------------------------------ */
h1,h2,h3,h4,h5,h6 {margin: 0px;}

p {margin: 0px;}

ul, li {
    margin: 0px;
    list-style-type: none;
}


/* ------------------------------------ */
input {
  display: block;
    outline: none;
    border: none !important;
}

textarea {
  display: block;
  outline: none;
}

textarea:focus, input:focus {
  border-color: transparent !important;
}

/* ------------------------------------ */
button {
    outline: none !important;
    border: none;
    background: transparent;
}

button:hover {
    cursor: pointer;
}

iframe {
    border: none !important;
}

/*//////////////////////////////////////////////////////////////////
[ Scroll bar ]*/
.js-pscroll {
  position: relative;
  overflow: hidden;
}

.table100 .ps__rail-y {
  width: 9px;
  background-color: transparent;
  opacity: 1 !important;
  right: 5px;
}

.table100 .ps__rail-y::before {
  content: "";
  display: block;
  position: absolute;
  background-color: #ebebeb;
  border-radius: 5px;
  width: 100%;
  height: calc(100% - 30px);
  left: 0;
  top: 15px;
}

.table100 .ps__rail-y .ps__thumb-y {
  width: 100%;
  right: 0;
  background-color: transparent;
  opacity: 1 !important;
}

.table100 .ps__rail-y .ps__thumb-y::before {
  content: "";
  display: block;
  position: absolute;
  background-color: #cccccc;
  border-radius: 5px;
  width: 100%;
  height: calc(100% - 30px);
  left: 0;
  top: 15px;
}


/*//////////////////////////////////////////////////////////////////
[ Table ]*/

.limiter {
  width: 1366px;
  margin: 0 auto;
}

.container-table100 {
  width: 100%;
  min-height: 100vh;
  background: #fff;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  padding: 33px 30px;
}

.wrap-table100 {
  width: 1170px;
}

/*//////////////////////////////////////////////////////////////////
[ Table ]*/
.table100 {
  background-color: #fff;
}

table {
  width: 100%;
}

th, td {
  font-weight: unset;
  padding-right: 10px;
}

.column1 {
  width: 33%;
  padding-left: 40px;
}

.column2 {
  width: 13%;
}

.column3 {
  width: 22%;
}

.column4 {
  width: 19%;
}

.column5 {
  width: 13%;
}

.table100-head th {
  padding-top: 18px;
  padding-bottom: 18px;
}

.table100-body td {
  padding-top: 16px;
  padding-bottom: 16px;
}

/*==================================================================
[ Fix header ]*/
.table100 {
  position: relative;
  padding-top: 60px;
}

.table100-head {
  position: absolute;
  width: 100%;
  top: 0;
  left: 0;
}

.table100-body {
  max-height: 585px;
  overflow: auto;
}


/*==================================================================
[ Ver1 ]*/

.table100.ver1 th {
  font-family: Lato-Bold;
  font-size: 18px;
  color: #fff;
  line-height: 1.4;

  background-color: #6c7ae0;
}

.table100.ver1 td {
  font-family: Lato-Regular;
  font-size: 15px;
  color: #808080;
  line-height: 1.4;
}

.table100.ver1 .table100-body tr:nth-child(even) {
  background-color: #f8f6ff;
}

/*---------------------------------------------*/

.table100.ver1 {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -o-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -ms-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
}

.table100.ver1 .ps__rail-y {
  right: 5px;
}

.table100.ver1 .ps__rail-y::before {
  background-color: #ebebeb;
}

.table100.ver1 .ps__rail-y .ps__thumb-y::before {
  background-color: #cccccc;
}


/*==================================================================
[ Ver2 ]*/

.table100.ver2 .table100-head {
  box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
  -o-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
  -ms-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
}

.table100.ver2 th {
  font-family: Lato-Bold;
  font-size: 18px;
  color: #fa4251;
  line-height: 1.4;

  background-color: transparent;
}

.table100.ver2 td {
  font-family: Lato-Regular;
  font-size: 15px;
  color: #808080;
  line-height: 1.4;
}

.table100.ver2 .table100-body tr {
  border-bottom: 1px solid #f2f2f2;
}

/*---------------------------------------------*/

.table100.ver2 {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -o-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -ms-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
}

.table100.ver2 .ps__rail-y {
  right: 5px;
}

.table100.ver2 .ps__rail-y::before {
  background-color: #ebebeb;
}

.table100.ver2 .ps__rail-y .ps__thumb-y::before {
  background-color: #cccccc;
}

/*==================================================================
[ Ver3 ]*/

.table100.ver3 {
  background-color: #393939;
}

.table100.ver3 th {
  font-family: Lato-Bold;
  font-size: 15px;
  color: #00ad5f;
  line-height: 1.4;
  text-transform: uppercase;
  background-color: #393939;
}

.table100.ver3 td {
  font-family: Lato-Regular;
  font-size: 15px;
  color: #808080;
  line-height: 1.4;
  background-color: #222222;
}


/*---------------------------------------------*/

.table100.ver3 {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -o-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
  -ms-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
}

.table100.ver3 .ps__rail-y {
  right: 5px;
}

.table100.ver3 .ps__rail-y::before {
  background-color: #4e4e4e;
}

.table100.ver3 .ps__rail-y .ps__thumb-y::before {
  background-color: #00ad5f;
}


/*==================================================================
[ Ver4 ]*/
.table100.ver4 {
  margin-right: -20px;
}

.table100.ver4 .table100-head {
  padding-right: 20px;
}

.table100.ver4 th {
  font-family: Lato-Bold;
  font-size: 18px;
  color: #4272d7;
  line-height: 1.4;

  background-color: transparent;
  border-bottom: 2px solid #f2f2f2;
}

.table100.ver4 .column1 {
  padding-left: 7px;
}

.table100.ver4 td {
  font-family: Lato-Regular;
  font-size: 15px;
  color: #808080;
  line-height: 1.4;
}

.table100.ver4 .table100-body tr {
  border-bottom: 1px solid #f2f2f2;
}

/*---------------------------------------------*/

.table100.ver4 {
  overflow: hidden;
}

.table100.ver4 .table100-body{
  padding-right: 20px;
}

.table100.ver4 .ps__rail-y {
  right: 0px;
}

.table100.ver4 .ps__rail-y::before {
  background-color: #ebebeb;
}

.table100.ver4 .ps__rail-y .ps__thumb-y::before {
  background-color: #cccccc;
}


/*==================================================================
[ Ver5 ]*/
.table100.ver5 {
  margin-right: -30px;
}

.table100.ver5 .table100-head {
  padding-right: 30px;
}

.table100.ver5 th {
  font-family: Lato-Bold;
  font-size: 14px;
  color: #555555;
  line-height: 1.4;
  text-transform: uppercase;

  background-color: transparent;
}

.table100.ver5 td {
  font-family: Lato-Regular;
  font-size: 15px;
  color: #808080;
  line-height: 1.4;

  background-color: #f7f7f7;
}

.table100.ver5 .table100-body tr {
  overflow: hidden; 
  border-bottom: 10px solid #fff;
  border-radius: 10px;
}

.table100.ver5 .table100-body table { 
  border-collapse: separate; 
  border-spacing: 0 10px; 
}
.table100.ver5 .table100-body td {
    border: solid 1px transparent;
    border-style: solid none;
    padding-top: 10px;
    padding-bottom: 10px;
}
.table100.ver5 .table100-body td:first-child {
    border-left-style: solid;
    border-top-left-radius: 10px; 
    border-bottom-left-radius: 10px;
}
.table100.ver5 .table100-body td:last-child {
    border-right-style: solid;
    border-bottom-right-radius: 10px; 
    border-top-right-radius: 10px; 
}

.table100.ver5 tr:hover td {
  background-color: #ebebeb;
  cursor: pointer;
}

.table100.ver5 .table100-head th {
  padding-top: 25px;
  padding-bottom: 25px;
}

/*---------------------------------------------*/

.table100.ver5 {
  overflow: hidden;
}

.table100.ver5 .table100-body{
  padding-right: 30px;
}

.table100.ver5 .ps__rail-y {
  right: 0px;
}

.table100.ver5 .ps__rail-y::before {
  background-color: #ebebeb;
}

.table100.ver5 .ps__rail-y .ps__thumb-y::before {
  background-color: #cccccc;
}

</style></head>You are invited for the following meeting, Meeting schedule is bieng conflicted with your current schedule. Below ar the Details.<br><br>Meeting scheduled Conflict with: <br><br>
        <div class='limiter'>
        <div class='container-table100'>
            <div class='wrap-table100'>
                <div class='table100 ver1 m-b-110'>
                    <div class='table100-head'>

        <table>
        <thead>
        <tr><th>Conflict Details</th></tr>
        <tr><th>Description</th><th>Start Time</th><th>End Time</th></tr>
        </thead>
        <tbody>".$details."
         
        </tbody>

        </table>
        
        <br><br>
        <table>
         <thead>
         <tr >
        <th class='cell100 column1'>Meeting Details</th>
         </tr>
         </thead>
         <tbody>
         <tr class='row100 head'>         
            <td>Title</td>            
            <td>".$_POST["title"]."</td>
            </tr>
            <tr>
            <td>Committee Invited.</td>            
            <td>".$commety."</td>
            </tr>
            
            
            <tr class='row100 head'>
            <td>Start Time</td>            
            <td>".$start."</td>
            </tr>

            <tr class='row100 head'>
            <td>End Time</td>            
            <td>".$end."</td>
            </tr>

            <tr class='row100 head'>
            <td>Description</td>            
            <td>".$_POST['description']."</td>
            </tr>

            <tr>
            <td>Venue</td>            
            <td>".$class_name."</td>
            </tr>
            
             
         </tbody>
         </table>
         

         <table>    
          </div></div></div>
          </div>
          <label>Meeting Participants</label>
         <thead>

         
         <tr>       
         <th>Name</th>
         <th>Designation</th>
         
         </tr>
         </thead>
         <tbody>".$TableData.          
         "</tbody>
         </table>
         </div></div></div></div>
         ";  



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
            
            $mail->Body = "
            <head>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' integrity='sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B' crossorigin='anonymous'></head>

            You are invited for the Meeting, Below are the Meeting Details.<br>
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
