<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Schduled Meetings</h1>
            </div>
            <!-- /.col-lg-12 -->
            <form action="<?php echo base_url('schduleMeeting/edit')?>" method="post"role="form">
         </div>
         <table class="table table-bordered">
         <thead>
         <tr>
         <th scope="col">Meeting Title</th>
         <th scope="col">Comitties</th>
         <th scope="col">Members</th>
         <th scope="col">Meeting Initiated Time</th>
         <th scope="col">Meeting Start Time</th>
         <th scope="col">Meeting End Time</th>
         <th scope="col">Options</th>
        
         </tr>
         </thead>
         <tbody>
         <?php
         $query = $this->db->query("SELECT * FROM meeting_logs WHERE Initiater_id = '".$_SESSION["id"]."'"); 
         if($query->num_rows() >0){
           foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td>".$row->title."</td>";
            echo "<td>".$row->committee_id."</td>";
            echo "<td>".$row->guest_id."</td>";
            echo "<td>".$row->time."</td>";
            echo "<td>".$row->start_time."</td>";
            echo "<td>".$row->end_time."</td>";
            echo "<td><button type='submit' class='btn btn-primary'>Edit</button></td>";
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