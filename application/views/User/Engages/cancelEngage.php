<?php


                    if(isset($_GET["engage_id"]))
    {                    $engage_id = $_GET["engage_id"];      
                         $query = $this->db->query("SELECT * FROM permanent_engages WHERE id = '".$engage_id."'" );
                          if($query->num_rows() >0){                          
                          foreach ($query->result() as $row) {                           
                         
                          
                          $description = $row->description;                          
                          $day = $row->day;
                          $startTimeST = $row->start_time;
                          $endTimeST = $row->end_time;
                          $engage_type = $row->engage_type;
                                      
                        
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
            <form onsubmit="return RemoveMsg(this)" action="<?php echo base_url('AddPermenentEngagesUser/removeEngage')?>" method="post" role="form">
         </div>
         <table class="table table-bordered" >
         <label><h3>Engage Description: <?php  if (isset($description)){echo $description;} ?></h3></label>
          <thead>
          <tr style="background-color:LightGrey" >
         <th scope="col">Day</th>
         <th scope="col">Start Time</th>
         <th scope="col">End Time</th>
         <th scope="col">Engage Type</th>
         </tr>  
         </thead>
          <tbody>
            
            <?php

                   $startTime = date('g:i a', strtotime($startTimeST));
                   $endTime = date('g:i a', strtotime($endTimeST));
                   if(!isset($startTime)){ $startDateTime = "";}
                   if(!isset($endTime)){ $endDateTime = "";}



                  echo "<tr>";
                  
                      
                  if(isset($day)){echo "<td>".$day."</td>";}            
                  if(isset($startTimeST)){echo "<td >".$startTime."</td>";}
                  if(isset($endTimeST)){echo "<td >".$endTime."</td>";}
                  if(isset($engage_type)){echo "<td >".$engage_type."</td>";}

                  echo "</tr>";

            ?>

         </tbody>
         </table>
         <div>
         <input type="hidden" value=<?php if(isset($engage_id)){ echo "$engage_id"; } ?> name="engage_id" />
         
         <h5>Note: You are about to remove the Above engage. Confirm?  
          
          <p align="right">
          <input type="submit"  class='btn btn-secondary' name="insert" value="Yes, Remove " />
          </p>
        </h5>
          </div>

          
            

         </form>




         <!-- /#page-wrapper -->
      </div>
   </body>
</html>


<script type="text/javascript">
function RemoveMsg(){
  
  window.alert("Engage Removed Successfully");
  return true;   

  

}
</script>