<?php
                    if(isset($_GET["meeting_id"]))
    {                    
                         $meeting_id = $_GET["meeting_id"];      
                         $query = $this->db->query("SELECT * FROM meeting_logs WHERE id = '".$meeting_id."'" );
                          if($query->num_rows()>0){                          
                          foreach ($query->result() as $row) {                           
                          $title = $row->title;
                          $initiated_time = date('M-d-Y g:ia l', strtotime($row->time));
                          $description = $row->description;
                          $commety  =$row->committee_id;
                          $commArray = explode(',', $row->committee_id);

                          
                                    $count = count($Committies["records"]);
                                    for($i=0; $i <$count; $i++){
                                 
                                                foreach ($commArray as $comm_Array) {
                                                    if($comm_Array==$Committies["records"][$i]->id ){ 
                                                      $commety = $Committies["records"][$i]->name ; 
                                                    }
                                                }
                                    }
                          $start_time = date('M-d-Y g:ia l', strtotime($row->start_time));
                          $end_time = date('M-d-Y g:ia l', strtotime($row->end_time));                        
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
               <h2 class="page-header">Meeting Details</h2>
            </div>

            <!-- /.col-lg-12 -->
            <form action="<?php echo base_url('schduleMeeting/edit')?>" method="post" role="form">

         </div>
        
         <table style="font-size: 12px;"class="table table-bordered" >
            
         <thead>
         <tr style="background-color:LightGrey" >
         
        <th scope="col">Meeting Details</th>
         </tr>
         </thead>
         <tbody>
         <?php


            echo "<tr>";         
            echo "<td width=12%  >Title</td>";            
            echo "<td width=12% >".$title."</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td width=12%>Committee Invited</td>";            
            echo "<td width=12% >".$commety."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td width=12%>Initiated Time</td>";            
            echo "<td width=12% >".$initiated_time."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td width=12%>Start Time</td>";            
            echo "<td width=12% >".$start_time."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td width=12%>End Time</td>";            
            echo "<td width=12% >".$end_time."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td width=12%>Description</td>";            
            echo "<td width=12% >".$description."</td>";
            echo "</tr>";

            
            
          ?>   
         </tbody>
         </table>
         

         <table style="font-size: 12px;"class="table table-bordered" >    
          
          <label>Meeting Participants</label>
         <thead>

         
         <tr style="background-color:LightGrey" >       
         <th scope="col">Name</th>
         <th scope="col">Invitation Status</th>
         <th scope="col">Reason</th>
         </tr>
         </thead>
         <tbody>
         <?php
                   $query = $this->db->query("SELECT name,status,reason FROM temporary_engages INNER JOIN users ON temporary_engages.user_id = users.id WHERE temporary_engages.meeting_id = '".$meeting_id."'" );
                        
                        foreach ($query->result() as $row) {                           
                          $name = $row->name;
                          $status = $row->status;
                          $reason = $row->reason;
                          echo "<tr>";
                          echo "<td >".$name."</td>";
                          echo "<td >".$status."</td>";            
                          echo "<td>".$reason."</td>";
                          echo "</tr>";
                        }
            
          ?>   
         </tbody>
         </table>

         
          <button float-right type='submit' formaction=/SmartPlanner/SchduleMeeting/ class='btn btn-primary btn pull-right'>Back</button>





         </form>
         <!-- /#page-wrapper -->
      </div>
   </body>
</html>

