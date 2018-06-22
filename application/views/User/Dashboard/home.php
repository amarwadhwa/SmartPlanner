<?php?>
<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-3 col-md-6">
               <div class="panel panel-primary">
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                           <div class="huge">
                              <?php 
                              
                              
                              $query = $this->db->query("SELECT * FROM meeting_logs WHERE Initiater_id = '".$_SESSION["id"]."'" );
                              $num = $query->num_rows();
                              echo $num;  
                           
                           ?>

                           </div>
                           <div>Initiate Meeting</div>
                        </div>
                     </div>
                  </div>
                  <a href="<?php echo base_url('initiateMeeting/index')?>">
                     <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                     </div>
                  </a>
               </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
               <div class="panel panel-green">
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                           <div class="huge"><?php 

                                 $t=time()+(60*60*3);
                                 $currentTime =  date("Y-m-d H:i:s",$t);

                              $query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$_SESSION["id"]."' AND start_time > ('$currentTime')");
                                   $num = $query->num_rows();
                                    echo $num;?></div>
                           <div>View Meetings</div>

                        </div>
                     </div>
                  </div>
                  <a href="<?php echo base_url('My_Meeting/index')?>">
                     <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="panel panel-yellow">
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                           <div class="huge">
                              <?php

                                 $t=time()+(60*60*3);
                                 $currentDay =  date("l",$t);

                              $query = $this->db->query("SELECT * FROM permanent_engages WHERE user_id = '".$_SESSION["id"]."' AND day = ('$currentDay')");
                                    $num = $query->num_rows();
                                    echo $num;

                                    ?>


                           </div>
                           <div>Engages</div>
                        </div>
                     </div>
                  </div>
                  <a href="<?php echo base_url('Engages/index')?>">
                     <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                     </div>
                  </a>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="panel panel-primary">
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                           <div class="huge"><?php 
                              
                              $t=time()+(60*60*3)+(60*30);
                              $t=time()+(60*60*3)+(60*30)-(60*60*24*30*12);
                              $currentTime =  date("Y-m-d H:i:s",$t);
                              $query = $this->db->query("SELECT * FROM meeting_logs WHERE Initiater_id = '".$_SESSION["id"]."' AND start_time > ('$currentTime')" );
                                 $num = $query->num_rows();
                                  echo $num;  
                           ?>
                              
                           </div>
                           <div>Scheduled Meetings</div>
                        </div>
                     </div>
                  </div>
                  <a href="<?php echo base_url('SchduleMeeting/index')?>">
                     <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <!-- /.panel -->
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <i class="fa fa-bar-chart-o fa-fw"></i> Meetings/Todays Personal Engages
                     <div class="pull-right">
                        <div class="btn-group">
                           <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                           Actions
                           <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu pull-right" role="menu">
                              <li><a href="#">Todays Meetings </a>
                              </li>
                              <!--<li><a href="#">Todays Engages/Classes</a>-->
                              </li>
                              <!--<li><a href="#">Monthly Meetings</a>-->
                              </li>
                              <li class="divider"></li>
                              <li><a href="#">Todays Engages/Classes</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="table-responsive">
                              <table class="table table-bordered table-hover table-striped">
                                 <thead>
                                    <tr>
                                       <th>Meeting Title</th>
                                       <th>Initiater Name</th>
                                       <th>Time</th>
                                       <th>Description</th>
                                       <th>Status</th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php
                                 $t=time()+(60*60*3);                                 
                                 $today =  date("Y-m-d",$t);
                                 $startDay = $today." 00:00:00"; ;
                                 $tillToday= $today." 23:59:59";                                                                   
                                 $query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$_SESSION["id"]."' AND (start_time >= '".$startDay."' AND start_time <= '".$tillToday."')");
                                 

                                 foreach ($query->result() as $row) {                 
               
                                       

                                       if($row->meeting_id!=-1){

                                          $query2 = $this->db->query("SELECT * FROM meeting_logs WHERE id = '".$row->meeting_id."'" );
                                          foreach ($query2->result() as $row2) {      
                                          $query3 = $this->db->query("SELECT name FROM users WHERE id = '".$row2->initiater_id."'" );
                                          foreach ($query3->result() as $row3) {
                                             $startT = date('g:i a', strtotime($row->start_time));
                                             $endT = date('g:i a', strtotime($row->end_time));
                                              echo "<tr><td>".$row2->title."</td><td>".$row3->name."</td><td>".$startT." To ".$endT."</td><td>".$row->description."</td><td>".$row->status."</td></tr>";
                                           }
                                          }
                                        } 
                                        else{
                                          $startT = date('g:i a', strtotime($row->start_time));
                                          $endT = date('g:i a', strtotime($row->end_time));
                                          echo "<tr><td>Busy</td><td>Self</td><td>".$startT." To ".$endT."</td><td>".$row->description."</td><td>".$row->status."</td></tr>";
                                        }  
                                    }                 
                                    ?>
                                 </tbody>
                              </table>

                              <table class="table table-bordered table-hover table-striped">
                                 <thead >
                                    <tr>
                                       <th border = "0">Todays Engages</th>
                                    
                                    </tr>
                                    <tr>
                                       <th>Description</th>
                                       <th>Time</th>
                                       <th>Engage Type</th>         
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                         
                                          $t=time()+(60*60*3);                                 
                                          $today =  date("l",$t);      

                                    $query = $this->db->query("SELECT * FROM permanent_engages WHERE user_id = '".$_SESSION["id"]."' AND day = '".$today."'");
                                    
                                    foreach ($query->result() as $row) {  
                                          

                                          $sTime =  date("g:i a ",strtotime($row->start_time));
                                          $eTime =  date("g:i a ",strtotime($row->end_time));

                                       echo "<tr><td>"."$row->description"."</td><td>"."$sTime"." to "."$eTime"."</td><td>"."$row->engage_type"."</td></tr>";

                                    }
                                    
                                    
                                    
                                    

                                    ?>
                                 </tbody>
                              </table>
                           </div>
                           <!-- /.table-responsive -->
                        </div>

                        <!-- /.col-lg-4 (nested) -->
                        <div class="col-lg-8">
                           <div id="morris-bar-chart"></div>
                        </div>
                        <!-- /.col-lg-8 (nested) -->
                     </div>
                     <!-- /.row -->
                  </div>
                  <!-- /.panel-body -->
               </div>
               <!-- /.panel -->
               <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
            <!-- /.panel .chat-panel -->
         </div>
         <!-- /.col-lg-4 -->
      </div>
      <!-- /.row -->
      </div>
      <!-- /#page-wrapper -->
      </div>
      <!-- /#wrapper -->
   </body>
</html>