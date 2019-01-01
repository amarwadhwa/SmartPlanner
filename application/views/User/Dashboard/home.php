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
                           <div >Created Meetings</div>
                        </div>
                     </div>
                  </div>
                  <a href="<?php echo base_url('initiateMeeting/index')?>">
                     <div class="panel-footer">
                        <span class="pull-left" title="Click here to create new meeting">Create Meeting</span>
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
                              $query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$_SESSION["id"]."' AND start_time > '".$currentTime."' AND status!='Rejected'");
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
                              $query = $this->db->query("SELECT * FROM permanent_engages WHERE user_id = '".$_SESSION["id"]."' AND day = '".$currentDay."'");
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
                              $currentTime =  date("Y-m-d H:i:s",$t);
                              $query = $this->db->query("SELECT * FROM meeting_logs WHERE Initiater_id = '".$_SESSION["id"]."' AND start_time > '".$currentTime."'" );
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
                     <i class="fa fa-bar-chart-o fa-fw"></i>Todays Meetings/Personal Engages
                     <div class="pull-right">
                        <div class="btn-group" title="View Todays,Weekly and Monthly Meetings">
                           <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                           Actions
                           <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu pull-right" role="menu">
                              <li><a href="<?php echo base_url('User/index/today');?>">Todays Meetings </a>
                              </li>
                              <li class="divider"></li>
                              <li><a href="<?php echo base_url('User/index/weekly');?>">Weekly Meetings</a>
                              </li>
                              <li class="divider"></li>
                              <li><a href="<?php echo base_url('User/index/monthly');?>">Monthly Meetings</a>
                              </li>
                              
                              
                           </ul>
                        </div>
                     </div>
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body ">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="table-responsive " >
                              <table style="font-size: 12px;" class="table table-bordered table-hover table-striped" >
                                 <thead >
                                    <tr>
                                       <th  border = "0" bgcolor="#D5D5D9">Meetups</th>
                                       
                                    </tr>
                                    <tr>
                                       <th>Meeting Title</th>
                                       <th>Description</th>
                                       <th>Time</th>
                                       <th>Date</th>
                                       <th>Initiater Name</th>
                                       <th>Invitation Status</th>
                                       <th>Reason</th>
                                       <th>Action/Decline</th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php
                                 $t=time()+(60*60*5);                                
                                 $today =  date("Y-m-d",$t);
                                 $start = $today." 00:00:00";
                                 
                                
                                 if($ShowMeetings=='today'){
                                    $end=$today." 23:59:59";  
                                 }
                                 else if($ShowMeetings=='weekly'){
                                    $end=date('Y-m-d H:i:s', strtotime($start. ' + 7 days'));
                                    
                                 }
                                 else{
                                    $end=date('Y-m-d H:i:s', strtotime($start. ' + 30 days'));
                                       
                                    }
                                 




                                 $query = $this->db->query("SELECT * FROM temporary_engages WHERE user_id = '".$_SESSION["id"]."' AND (start_time >= '".$start."' AND start_time <= '".$end."')");
                                 

                                 foreach ($query->result() as $row) {

                                       if($row->meeting_id!=-1){

                                          $link = "";
                                          $Text = "";
                                       if($row->status!="Rejected"){
                                          $link = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $row->id . "/";
                                          $linkR = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $row->id . "/";
                                          $linkA = "http://sibasmartplanner.com/schduleMeeting/setStatus/".$row->id ."/Accepted";
                                          //$link = "http://localhost/SmartPlanner/schduleMeeting/setStatus/" . $row->id . "/";
                                          $Text = "Decline";
                                          }else if($row->status!="Accepted"){
                                        $link = "http://sibasmartplanner.com/schduleMeeting/setStatus/".$row->id ."/Accepted";
                                        $linkR = "http://sibasmartplanner.com/schduleMeeting/setStatus/" . $row->id . "/";
                                        $linkA = "http://sibasmartplanner.com/schduleMeeting/setStatus/".$row->id ."/Accepted";
                                        //$link = "http://localhost/SmartPlanner/schduleMeeting/setStatus/".$row->id ."/Accepted";        
                                          $Text = "Accept";      
                                          }




                                          $query2 = $this->db->query("SELECT * FROM meeting_logs WHERE id = '".$row->meeting_id."'" );
                                          foreach ($query2->result() as $row2) {      
                                          $query3 = $this->db->query("SELECT name FROM users WHERE id = '".$row2->initiater_id."'" );
                                          foreach ($query3->result() as $row3) {
                                             $colour = "";
                                             if($Text=="Accept"){
                                                $colour ="'btn btn-primary'";
                                             }
                                             else{
                                                $colour ="'btn btn-danger'";   
                                             }               


                                             $startT = date('g:i a', strtotime($row->start_time));
                                             $endT = date('g:i a', strtotime($row->end_time));
                                             $dateST = date('d-M D', strtotime($row->start_time));
                                              echo "<tr><td>".$row2->title."</td><td>".$row->description."</td><td width='14%'>".$startT." To ".$endT."</td><td width='10%'>".$dateST."</td><td>".$row3->name."</td><td>".$row->status."</td><td>".$row->reason."</td><td width='17%'><a class='btn btn-primary' href=".$linkA.">"."Accept"."</a>&nbsp;&nbsp;<a class= 'btn btn-danger' href=".$linkR.">"."Decline"."</a></td></tr>";

                                             //<td><a class= ".$colour." href=".$link.">".$Text."</a></td></tr>";
                                           }
                                          }
                                        } 
                                        else{
                                          $startT = date('g:i a', strtotime($row->start_time));
                                          $endT = date('g:i a', strtotime($row->end_time));
                                          $dateST = date('d M D', strtotime($row->start_time));
                                          echo "<tr><td>Personal Engage</td><td>".$row->description."</td><td width='13%'>".$startT." To ".$endT."</td><td width='10%'>".$dateST."</td><td>Self</td><td></td><td></td><td></td></tr>";
                                        }  
                                    }                 
                                    ?>
                                 </tbody>
                              </table>

                              <table style="font-size: 12px;" class="table table-bordered table-hover table-striped">
                                 <thead >
                                    <tr>
                                       <th border = "0" bgcolor="#D5D5D9">Engages/Classes</th>
                                    
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