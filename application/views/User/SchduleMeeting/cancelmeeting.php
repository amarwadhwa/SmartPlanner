<?php


                    if(isset($_GET["meeting_id"]))
    {                    $meeting_id = $_GET["meeting_id"];      
                         $query = $this->db->query("SELECT * FROM meeting_logs WHERE id = '".$meeting_id."'" );
                          if($query->num_rows() >0){                          
                          foreach ($query->result() as $row) {                           
                         
                          
                          $title = $row->title;                          
                          $initiatedTime = $row->time;
                          $startTimeST = $row->start_time;
                          $endTimeST = $row->end_time;
                          $description = $row->description;
                          

                          $commetteesString = ""; 
                          $commArray = explode(',', $row->committee_id);
                          foreach($commArray as $comm_Array){               
                          $comQuery = $this->db->query("SELECT name FROM committees WHERE id = '".$comm_Array."'");  
                          $result = $comQuery->result();
                            if(isset($result[0]->name)){
                            $commetteesString .=$result[0]->name."<br>";
                            }
                          }          


                          $guestString = "";    
                          $guest = $this->db->query("SELECT user_id FROM temporary_engages WHERE meeting_id = '".$meeting_id."'"); 
                          $guestresult = $guest->result();               
                          
                          foreach ($guestresult as $guest_result) {
                            $guestStringQuery = $this->db->query("SELECT name FROM users WHERE id = '".$guest_result->user_id."'"); 
                            $guestStringQuery = $guestStringQuery->result();
                            
                            if(isset($guestStringQuery[0]->name)){
                              $guestString .=$guestStringQuery[0]->name."-".$guest_result->user_id."<br>";
                            }                  
                            
                            
                          }


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
               <h2 class="page-header">Please Confirm </h2>
            </div>
            <!-- /.col-lg-12 -->
            <form onsubmit="return CancelMsg(this)" action="<?php echo base_url('schduleMeeting/deleteMeeting')?>" method="post" role="form">
         </div>
         <table class="table table-bordered" >
         <label><h3>Meeting Title: <?php  if (isset($title)){echo $title;} ?></h3></label>
          <thead>
          <tr style="background-color:LightGrey" >
         <th scope="col">Committees Invited</th>
         <th scope="col">Guests Accepted/Pending Invitation</th>
         <th scope="col">Initiated Time</th>
         <th scope="col">Start Time</th>
         <th scope="col">End Time</th>
         <th scope="col">Description</th> 
         </tr>  
         </thead>
          <tbody>
            
            <?php

                   $startDateTime = date('M-d-Y g:ia l', strtotime($startTimeST));
                   $endDateTime = date('M/d/Y g:ia l', strtotime($endTimeST));
                    $initiatedTimeNew = date('M-d-Y g:ia l', strtotime($initiatedTime));
                   if(!isset($startDateTime)){ $startDateTime = "";}
                   if(!isset($endDateTime)){ $endDateTime = "";}
                   if(!isset($initiatedTimeNew)){ $initiatedTimeNew = "";}



                  echo "<tr>";
                  // echo "<td>".$row->id."</td>";
                  
                  if(isset($commetteesString)){echo "<td >".$commetteesString."</td>";}
                  if(isset($guestString)){echo "<td width=30%>".$guestString."</td>";}
                  if(isset($initiatedTime)){echo "<td width=12%>".$initiatedTimeNew."</td>";}            
                  if(isset($startTimeST)){echo "<td width=11%>".$startDateTime."</td>";}
                  if(isset($endTimeST)){echo "<td width=11%>".$endDateTime."</td>";}
                  if(isset($description)){echo "<td>".$description."</td>";}

                  echo "</tr>";

            ?>

         </tbody>
         </table>
          <input type="hidden" value=<?php if(isset($meeting_id)){ echo "$meeting_id"; } ?> name="meeting_id" />
         <div>
         
         
         <h5>Note: You are about to cancel the Above meeting, Meeting status will be sent to each participant. Confirm?  
          
          <p align="right">
          <input type="submit"  class='btn btn-secondary' name="insert" value="Yes, Cancel " />
          </p>
        </h5>
          </div>

          
            

         </form>




         <!-- /#page-wrapper -->
      </div>
   </body>
</html>


<script type="text/javascript">
  /*function showHint(oFormElement) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                document.getElementById("ScheduleAnyway").disabled = false;
                if (this.responseText != "") {document.getElementById("ScheduleAnyway").innerHTML = "Schedule Anyway"; }
              }
        };
        xmlhttp.open("POST", "http://localhost/SmartPlanner/My_Meeting/checkConflict", true);
        xmlhttp.send(new FormData (oFormElement));
        return false;
  }*/

function CancelMsg(){
  
  window.alert("Meeting Canceled Successfully");
  return true;   

  

}
</script>