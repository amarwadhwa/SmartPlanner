
<?php 

$abc = $_POST["title"];
  

?>
<!DOCTYPE html>
<html lang="en">
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Initiate Meeting</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Please give details
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-6">
                           <form action="<?php echo base_url('initiateMeeting/meetingScheduled')?>" method="post"role="form">
                              <article>
                                 <div class="demo">
                                    <h2>Date and Time </h2>
                                    <p id="datepairExample">
                                       <input type="text" class="date start" placeholder="Date"  name="start_date" />
                                       <input type="text" class="time start" placeholder="Time" name="start_time"/> to
                                       <input type="text" class="time end" placeholder="Date"   name="end_date" />
                                       <input type="text" class="date end" placeholder="Time" name="end_time" />
                                       <input type="hidden" value="<?php echo $abc; ?>" name="title" />

                                    </p>
                                 </div>
                                 <script>
                                    $('#datepairExample .time').timepicker({
                                        'showDuration': true,
                                        'timeFormat': 'g:ia'
                                    });
                                    
                                    $('#datepairExample .date').datepicker({
                                        'format': 'm/d/yyyy',
                                        'autoclose': true
                                    });
                                    
                                    $('#datepairExample').datepair();
                                 </script>
                              </article>
                              <div class="col-lg-3">
                              <button type="submit" name="submit" value="meeting "class="btn btn-default">Check Time </button>
                           </div>              
                           </form>
                        </div>
                        <div class="col-lg-12">
                           
                           <br>
                           <div class="progress" class="col-lg-9">
                              <div class="progress-bar" style="width:70%">70%</div>
                           </div>
                        </div>
                        <div>
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="panel panel-default">
                                    <div class="panel-heading">
                                       DataTables Advanced Tables
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                       <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                          <thead>
                                             <tr>
                                                <th>Meeting Tittle</th>
                                                <th>Starting Time</th>
                                                <th>Ending Time</th>
                                                <th>Pirority</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr class="odd gradeX">
                                                <td>ABC</td>
                                                <td>9:00 AM</td>
                                                <td>10:00 AM</td>
                                                <td class="center">High</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                 </div>
                                 <!-- /.panel -->
                              </div>
                           </div>
                        </div>
                        <!-- /.row (nested) -->
                     </div>
                     <!-- /.panel-body -->
                  </div>
                  <!-- /.panel -->
               </div>
               <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
         </div>
         <!-- /#page-wrapper -->
      </div>
      <!-- /#wrapper -->
   </body>
</html>



<?php



$start_time =  strtotime($_POST["start_date"] . " ". $_POST["start_time"]);
$start_timestamp =  date('Y-m-d H:i:s', $start_time);
$end_time =  strtotime($_POST["end_date"] . " ". $_POST["end_time"]);
$end_timestamp =  date('Y-m-d H:i:s', $end_time);


echo $start_timestamp;
echo "<br>";
echo $end_timestamp;
echo "<br>";

echo ($_POST['f']);



echo "<br>";

   echo $_POST["title"];
   echo $_POST["Faculty"];
   echo $_POST["description"];
   
       if(empty($_POST['Committee'])) 
       {
           echo("You didn't invited any commettie.");
   
       } 
     else
     {
       $commetties = $_POST['Committee'];
       $N = count($commetties);
   
       echo("You Invited $N Commetties: ");
       for($i=0; $i < $N; $i++)
       {
         echo($commetties[$i] . " ");
       }
     }
   
   ?>
<br>
<?php
   print_r($users);
   print_r($users["records"][0]->name);
   $totalUsers  = count($users["records"]);
   for($i=0; $i  < $totalUsers; $i++)
       {
       
           $users_com_id[$users["records"][$i]->id] = explode(",",$users["records"][$i]->commitee_id);     
       }
   
   print_r($users_com_id);
   //print_r (explode(",",$users["records"][0]->commitee_id));


//New Changes

if(isset($_POST["start_time"])) {

            echo $_POST["start_time"];
            //echo('<br /><br />'.$_POST['f']);
        }
        else{

            echo "not setcookie";

        }



 echo "<br>";
echo "<br>";

        foreach ($commetties as $commettie) {
            foreach ($users["records"] as $user) {
                 $user_commetties = explode(",",$user->commitee_id);    
                foreach ($user_commetties as $user_commettie) {
                   if ($commettie == $user_commettie) {
                       $invited_Users[] = $user;
                   }
                }

            }
        }
          
        print_r(array_map("unserialize", array_unique(array_map("serialize", $invited_Users))));

       // $_SESSION["title"] = $title;
            


   
   ?>


   <?php
        
        
        

        


        

        

       
   ?>