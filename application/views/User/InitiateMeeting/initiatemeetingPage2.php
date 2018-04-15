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
                           <form action="<?php echo base_url('User/initiateMeetingPage2')?>" method="post"role="form">
                              <article>
                                 <div class="demo">
                                    <h2>Date and Time </h2>
                                    <p id="datepairExample">
                                       <input type="text" class="date start" placeholder="Enter Starting Date" />
                                       <input type="text" class="time start" placeholder="Enter Starting Time"/> to
                                       <input type="text" class="time end" placeholder="Enter Ending Date"/>
                                       <input type="text" class="date end" placeholder="Enter Ending Time"/>
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
                           </form>
                        </div>
                        <div class="col-lg-12">
                           <div class="col-lg-3">
                              <button type="submit" name="submit" value="meeting "class="btn btn-default">Check Time </button>
                           </div>
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
   
   ?>