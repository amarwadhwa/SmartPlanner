<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Permamnent Engages</title>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Engages</h1>
            </div>
            <!-- /.col-lg-12 -->
            <form action="<?php echo base_url('schduleMeeting/edit')?>" method="post"role="form">
         </div>
         <table class="table table-bordered">
         <thead>
         <tr>
         <th scope="col">Day</th>
         <th scope="col">Description</th>
         <th scope="col">Start time</th>
         <th scope="col">End time</th>
         <th scope="col">Engage Type</th>
         <th scope="col">Edit/Cancel</th>

         
         
         </tr>
         </thead>
         <tbody>

         <?php
         $query = $this->db->query("SELECT * FROM permanent_engages WHERE user_id = '".$_SESSION["id"]."'" );
         
         if($query->num_rows() >0){


           for($i = 1; $i <= 7; $i++){
               foreach ($query->result() as $row) {
                        

                     //$day   = date('N', strtotime($row->start_time));
                     $day = date('N', strtotime($row->day));
                     
                    


                     if($day==$i){
                        $startTime  = date('g:i a', strtotime($row->start_time));
                        $endTime  =   date('g:i a', strtotime($row->end_time));                        
                        echo "<td>".$row->day."</td>";
                        echo "<td>".$row->description."</td>";
                        echo "<td>".$startTime."</td>";
                        echo "<td>".$endTime."</td>";
                        echo "<td>".$row->engage_type."</td>";
                        echo "<td><button type='submit' formaction=/SmartPlanner/AddPermenentEngagesUser/?engage_id=$row->id name = 'submit' value = $row->id class='btn btn-primary'>Edit</button>&nbsp&nbsp<button type='submit' formaction=/SmartPlanner/AddPermenentEngagesUser/cancel?engage_id=$row->id name = 'submit' value = $row->id class='btn btn-primary'>Delete</button></td>";
                        echo "</tr>";
                     }

               }

         }


          }?>   
         </tbody>
         </table>
         </form>



      </div>
   </body>
</html>
<?php 

$day = date('N', strtotime("2017-04-24 00:00:00"));



echo $day."<br>";

$day = date('j', strtotime("2017-04-24 00:00:00"));
$month = date('n', strtotime("2017-04-24 00:00:00"));
$year  = date('Y', strtotime("2017-04-24 00:00:00"));

echo $day."<br>";
echo $month."<br>";
echo $year."<br>";

$jd=gregoriantojd($month,$day,$year);
echo jddayofweek($jd,1);

?>
