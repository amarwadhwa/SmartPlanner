<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h3 class="page-header">Upcoming Scheduled Meetings</h3>
            </div>
            <!-- /.col-lg-12 -->
            <form action="<?php echo base_url('schduleMeeting/edit')?>" method="post" role="form">
         </div>
        
         <table style="font-size: 12px;"class="table table-bordered" >
            
         <thead>
         <tr style="background-color:LightGrey" >
         
         <th scope="col">Meeting Title </th>
         <th scope="col">Committee Invited</th>
         
         
         <th scope="col">Initiated Time</th>
         <th scope="col">Start Time</th>
         <th scope="col">End Time</th>
         <th scope="col">Description</th>
         <th scope="col">Edit</th>
         <th scope="col">Cancel</th>
        <th scope="col">Meeting Details</th>
         </tr>
         </thead>
         <tbody>
         <?php

         $t=time()+(60*60*3)+(60*30);
         $currentTime =  date("Y-m-d H:i:s",$t);
         $query = $this->db->query("SELECT * FROM meeting_logs WHERE Initiater_id = '".$_SESSION["id"]."' AND start_time > ('$currentTime')" );




         if($query->num_rows() >0){
           foreach ($query->result() as $row) {                 
               
               $commetteesString = ""; 
               $commArray = explode(',', $row->committee_id);
               foreach($commArray as $comm_Array){               
               $comQuery = $this->db->query("SELECT name FROM committees WHERE id = '".$comm_Array."'");  
               $result = $comQuery->result();
               $commetteesString .=$result[0]->name.", <br>";
               }

               
               $guestString = "";    
               $guest = $this->db->query("SELECT user_id FROM temporary_engages WHERE meeting_id = '".$row->id."' AND status != 'reject'"); 
               $guestresult = $guest->result();               
               
               foreach ($guestresult as $guest_result) {
                  
                   $guestStringQuery = $this->db->query("SELECT name FROM users WHERE id = '".$guest_result->user_id."'"); 
                   $guestStringQuery = $guestStringQuery->result();                  
                   $guestString .=$guestStringQuery[0]->name."-".$guest_result->user_id.", <br>";                  
               }
              
             $guestString = substr($guestString, 0, -6);
             $commetteesString = substr($commetteesString, 0, -6);


             $startDateTime = date('M-d-Y g:ia l', strtotime($row->start_time));
             $endDateTime = date('M-d-Y g:ia l', strtotime($row->end_time));
             $initiatedTime = date('M-d-Y g:ia l', strtotime($row->time));
              if(!isset($startDateTime)){ $startDateTime = "";}
              if(!isset($endDateTime)){ $endDateTime = "";}
              if(!isset($initiatedTime)){ $initiatedTime = "";}
            
            echo "<tr>";
           // echo "<td>".$row->id."</td>";
            echo "<td width=12%>".$row->title."</td>";            
            echo "<td width=12%>".$commetteesString."</td>";
            //echo "<td >".$guestString."</td>";
            echo "<td >".$initiatedTime."</td>";            
            echo "<td>".$startDateTime."</td>";
            echo "<td >".$endDateTime."</td>";
            echo "<td>".$row->description."</td>";
            echo "<td><button type='submit' formaction=/initiateMeeting/?meeting_id=$row->id class='btn btn-primary'  >Edit</button></td>";
            echo "<td><button type='submit' formaction=/SchduleMeeting/cancel?meeting_id=$row->id class='btn btn-danger'>Cancel</button></td>";
            echo "<td><button type='submit' formaction=/initiateMeeting/meetingDetails/?meeting_id=$row->id class='btn btn-success'>View Details</button></td>";
            echo "</tr>";
            }
          }?>   
         </tbody>
         </table>
         </font>
         </form>
         <!-- /#page-wrapper -->
      </div>
   </body>
</html>

<script>
document.getElementById("myBtn").addEventListener("click", displayDate);

function displayDate() {
    alert("done");
}
</script>