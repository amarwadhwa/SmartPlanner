<?php 
  if(isset($_SESSION["startTimeStamp"])){
  $startDate = date('m/d/Y',strtotime($_SESSION["startTimeStamp"]));
  $startTime = date('g:ia',strtotime($_SESSION["startTimeStamp"]));
}

if(isset($_SESSION["endTimeStamp"])){
  $endDate = date('m/d/Y',strtotime($_SESSION["endTimeStamp"]));
  $endTime = date('g:ia',strtotime($_SESSION["endTimeStamp"]));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
  function showHint(oFormElement) {
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
  }

function submitClick(){
  document.getElementById("form1").submit();
  return true;
}
</script>
</head>
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
                        <div class="col-lg-10">
                           <form action="<?php echo base_url('initiateMeeting/meetingScheduled')?>" method="post" id="form1" 
                              onSubmit="return showHint(this);">
                              <article>
                                 <div class="demo">
                                    <h2>Date and Time </h2>
                                    <p id="datepairExample">
                                       <input type="text" class="date start" placeholder="Date"  name="start_date" autocomplete="off" value=<?php
                                      if(isset($startDate)){echo "$startDate";}

                                       ?> required />
                                       <input type="text" class="time start" placeholder="Time" name="start_time"  value=<?php
                                      if(isset($startTime)){echo "$startTime";}

                                       ?>  required /> to
                                       <input type="text" class="time end" placeholder="Time"   name="end_date" value=<?php
                                      if(isset($endTime)){echo "$endTime";}

                                       ?> required />
                                       <input type="text" class="date end" placeholder="Date" name="end_time"
                                         autocomplete="off" value=<?php if(isset($endDate)){echo "$endDate";
                                        unset($endDate);   
                                       } ?>
                                         required />
                                       <input type="hidden" value="<?php echo $_POST["title"]; ?>" name="title" />
                                       <input type="hidden" value="<?php echo $_POST["faculty"]; ?>" name="faculty" />
                                       <input type="hidden" value="<?php echo $_POST["description"]; ?>" name="description" />
                                       
                                       
                                       <input type="submit"   value="Check Availabilty" class="btn btn-default"/>
                                        </form>
                                        <button onclick="submitClick()" value="Schedule Anyway" id="ScheduleAnyway" class="btn btn-default" disabled>Schedule Meeting</button>
                                       
                                      </p>
                                 </div>
                                  <script type="text/javascript" src="datepair.js"></script>
                                  <script type="text/javascript" src="jquery.datepair.js"></script>
                                 <script>
                                    $('#datepairExample .time').timepicker({
                                        
                                        'minTime': '8:00am',
                                        'maxTime': '7:59am',
                                        'timeFormat': 'g:ia',                                        
                                        'scrollDefault': 'now'

                                    });


                                    $('#datepairExample').on('changeTime', function() {
                                                  
                                           // window.alert("Select event Working");     
                                          //Write code to disable the selecting previos tims
                                           //$('#datepairExample').timepicker('option', 'minTime', '2:00pm');

                                        });
                                    
                                    $('#datepairExample .date').datepicker({
                                        'format': 'm/d/yyyy',
                                        'autoclose': true
                                        //'todayBtn': true
                                    });
                                    
                                    $('#datepairExample').datepair();
                                 </script>
                              </article>
                              <div class="col-lg-8">
                              <p><span id="txtHint"></span></p>  
                               </div>              
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
                                       Meeting Details
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                       <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                          <thead> 
                                             <tr>
                                                <th>Meeting Tittle</th>
                                                <th>Committees Invited</th>
                                                <th>Guests</th>
                                                <th>Descrition</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr class="odd gradeX">
                                                <td><?php echo $_POST["title"]; ?></td>
                                                  <td><?php  if(empty($_POST['Committee'])) 
                                                     {
                                                         echo("You didn't invited any commettie.");
                                                 
                                                     } 
                                                   else
                                                   {
                                                     $commetties = $_POST['Committee'];
                                                     $N = count($commetties);
                                                     for($i=0; $i < $N; $i++)
                                                     {
                                                       $query = $this->db->query("SELECT * FROM committees WHERE id = $commetties[$i]");
                                                       if($query->num_rows() >0){
                                                       foreach ($query->result() as $row) {
                                                        echo $row->name ."<br>";
                                                      }

                                                       }
      


                                                     }
                                                   }
                                                  ?></td>
                                       <td>          <?php 
                                              
                                              foreach ($commetties as $commettie) {
                                                  foreach ($users["records"] as $user) {
                                                       $user_commetties = explode(",",$user->commitee_id);    
                                                      foreach ($user_commetties as $user_commettie) {
                                                         if ($commettie == $user_commettie) {
                                                             $invited_Users[] = $user;
                                                             echo $user->name.":".$user->id. "<br>";
                                                         }
                                                      }

                                                  }
                                              } ?>
      </td>
                                            <td>     <?php echo $_POST["description"]; ?></td>
                                       
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
        
        echo "<br>";
        echo "<br>";
        
        $invited_Users2 = array_map("unserialize", array_unique(array_map("serialize", $invited_Users)));
        print_r($invited_Users2);


        echo "<br>";
        echo "<br>";

        print_r(array_map("unserialize", array_unique(array_map("serialize", $invited_Users))));


        $_SESSION["users"] = array_map("unserialize", array_unique(array_map("serialize", $invited_Users)));
        $_SESSION["commetties"] = $commetties;

   
   ?>
