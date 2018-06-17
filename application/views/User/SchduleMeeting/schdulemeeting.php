<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h2 class="page-header">Upcoming Scheduled Meetings Status > 30 mins</h2>
            </div>
            <!-- /.col-lg-12 -->
            <form action="<?php echo base_url('schduleMeeting/edit')?>" method="post" role="form">
         </div>
         <table class="table table-bordered" >
            
         <thead>
         <tr style="background-color:LightGrey">
         
         <th scope="col">Meeting Title </th>
         <th scope="col">Committees Invited</th>
         <th scope="col">Guests Accepted/Pending Invitation</th>
         <th scope="col">Initiated Time</th>
         <th scope="col">Start Time</th>
         <th scope="col">End Time</th>
         <th scope="col">Description</th>
         <th scope="col">Edit</th>
         <th scope="col">Cancel</th>
         </tr>
         </thead>
         <tbody>
         <?php

         $t=time()+(60*60*3)+(60*30);
         $t=time()+(60*60*3)+(60*30)-(60*60*24*30*12);
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

             

            echo "<tr>";
           // echo "<td>".$row->id."</td>";
            echo "<td>".$row->title."</td>";            
            echo "<td width=20%>".$commetteesString."</td>";
            echo "<td>".$guestString."</td>";
            echo "<td width=10%>".$row->time."</td>";            
            echo "<td width=10%>".$row->start_time."</td>";
            echo "<td width=10%>".$row->end_time."</td>";
            echo "<td>".$row->description."</td>";
            echo "<td><button type='submit' formaction=/SmartPlanner/initiateMeeting/?meeting_id=$row->id class='btn btn-secondary'>Edit</button></td>";
            echo "<td><button type='submit' class='btn btn-secondary'>Cancel</button></td>";
            echo "</tr>";
            }
          }?>   
         </tbody>
         </table>
         </form>
         <!-- /#page-wrapper -->
      </div>
   </body>
</html>
