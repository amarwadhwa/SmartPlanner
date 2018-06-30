<?php
                    if(isset($_GET["engage_id"]))
    {                    
                         $engage_id = $_GET["engage_id"];      
                         $query = $this->db->query("SELECT * FROM permanent_engages WHERE id = '".$engage_id."'" );
                           if($query->num_rows() >0){                          
                          foreach ($query->result() as $row) {

                          $startTimePerm = date("g:ia",strtotime($row->start_time));
                          $endTimeperm = date("g:ia",strtotime($row->end_time));
                          $descriptionPerm = $row->description;
                          $day = $row->day;
                          //$_SESSION["startTimeStamp"] = $row->start_time;
                          //$_SESSION["endTimeStamp"] = $row->end_time;
                          $editCheck = true;
                          }

         }
    }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
      .ui-autocomplete-loading {
      background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
      }
    </style>

    </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Add Engages</h1>               
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-20">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Please give details
                  </div>
                  <div class="panel-body">
                     <div class="row">

                        <div class="col-lg-10">
                             <div class="form-group">
                                <h4>
                                 <label class="radio-inline">
                                  <input checked type="radio" name="period" value="permEngage" onclick="permEngage();"><b>Permanent Engage</b>
                                  </label>
                                  
                                  <label class="radio-inline">
                                  <input type="radio" name="period" value="tempEngage" onclick="tempEngage();"><b>Temporary Engage</b>
                                  </label>
                                  </h4>
                            </div>
                      

                      <form action="<?php echo base_url('AddPermenentEngagesUser/index')?>" method="post" role="form">

                            
                            <div>
                              <div class="demo"  id="permanentEng" style="display: block;"  >
                                    <div class="form-group">
                                      
                                    
                                    <p id="datepairExample"><br>
                                      <label>Time</label> <br>
                                    From
                                    <input type="text" class="time start" placeholder="Time" name="start_timePerm"  value="<?php
                                      if(isset($startTimePerm)){echo "$startTimePerm";}

                                       ?>"  required /> to  
                                       <input type="text" class="time end" placeholder="Time"   name="end_timePerm" value="<?php
                                      if(isset($endTimeperm)){echo "$endTimeperm";}

                                       ?>" required />

                                        </div>
                                        </p>
                                       <div class="form-group">
                                        <br><label>Description</label> 
                                        <input required class="form-control" value="<?php if(isset($descriptionPerm)){ 
                                          echo "$descriptionPerm"; }?>" 
                                        name="descriptionPerm"/>
                                 <!-- <p class="help-block">Example block-level help text here.</p> -->
                                        </div>

                                        <br>
                                        
                                       <label>Day</label><br>

                                       <label  class="radio-inline">
                                          <input required type="radio" name="day" value="daily"  onclick="hide();">Daily
                                        </label>
                                        
                                        <label class="radio-inline">
                                          <input type="radio" name="day" value="mon-sat" onclick="hide();">Monday-Saturday
                                        </label>
                                       
                                        <label class="radio-inline">
                                          <input type="radio" name="day" <?php if(isset($editCheck)){ echo "checked" ; } ?> 
                                          value="selectDay" onclick="show();">Select Day
                                        </label>
                                      
                                        <br>

                                        
                                        <div class="form-group" id="day" style="display: none;">
                                          <h3>Select Day </h3>
                                            <select name="particularDay"  class="form-control" required >
                                              <option <?php if(isset($day) && $day =="Monday") echo "selected"; ?> value="Monday">Monday</option>
                                              <option <?php if(isset($day) && $day =="Tuesday") echo "selected"; ?> value="Tuesday">Tuesday</option>
                                              <option <?php if(isset($day) && $day =="Wednesday") echo "selected"; ?> value="Wednesday">Wednesday</option>
                                              <option <?php if(isset($day) && $day =="Thursday") echo "selected"; ?> value="Thursday">Thursday</option>
                                              <option <?php if(isset($day) && $day =="Friday") echo "selected"; ?> value="Friday">Friday</option>
                                              <option <?php if(isset($day) && $day =="Saturday") echo "selected"; ?> value="Saturday">Saturday</option>
                                              <option <?php if(isset($day) && $day =="Sunday") echo "selected"; ?> value="Sunday">Sunday</option>        
                                            </select>
                                          </div>

                              <br>
                              <br>
                                <input type="hidden" value="<?php if(isset($editCheck)){ echo "edited"; } ?>" name="editCheck" />
                                <input type="hidden" value="<?php if(isset($engage_id)){ echo "$engage_id"; } ?>" name="Engage_Id"/>
                                   <input type="submit" name="addPermEng" value="Add Permanent Engage" class="btn btn-primary"/>
                                  <button type="reset" class="btn btn-primary">Reset Page</button>       

                                </div>
                                  


                                  
                                  

                            </div>
                          </div>
                              

                                </form>
                              </div>
                              <div>
                           <form action="<?php echo base_url('AddPermenentEngagesUser/index')?>" method="post" role="form">

                                <div class="demo"  id="TempEng" style="display: none;" >
                                    <div class="form-group">
                                      
                                    
                                    <p id="datepairExample"><br>
                                      <label>Date and Time</label> <br>
                                      <input type="text" class="date start" placeholder="Date"  name="start_dateTemp" autocomplete="off" value="<?php
                                      if(isset($startDateTemp)){echo "$startDateTemp";}

                                       ?>" required />
                                    From
                                    <input type="text" class="time start" placeholder="Time" name="start_timeTemp"  value="<?php
                                      if(isset($startTimeTemp)){echo "$startTime";}

                                       ?>"  required /> to  
                                       <input type="text" class="time end" placeholder="Time"   name="end_timeTemp" value="<?php
                                      if(isset($endTimeTemp)){echo "$endTime";}

                                       ?>" required />

                                    </div>
                                    </p>
                                       <div class="form-group">
                                        <br><label>Description</label> 
                                        <input required class="form-control" value="<?php if(isset($descriptionTemp)){ echo "$descriptionTemp"; }?>" name="descriptionTemp">
                                 <!-- <p class="help-block">Example block-level help text here.</p> -->
                                        </div>

                                        <br>
                                       <input type="submit" name="addTempEng" value="Add Temporary Engage" class="btn btn-primary"/>
                                <button type="reset" class="btn btn-primary">Reset Page</button>


                                </div>
                                </form>
                                
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

<script type="text/javascript" src="datepair.js"></script>
<script type="text/javascript" src="jquery.datepair.js"></script>
                                 <script type="text/javascript">
                                    $('#datepairExample .time').timepicker({
                                        
                                        'minTime': '8:00am',
                                        'maxTime': '7:59am',
                                        'timeFormat': 'g:ia',                                        
                                        'scrollDefault': 'now'

                                    });


                                    
                                    $('#datepairExample .date').datepicker({
                                        'format': 'm/d/yyyy',
                                        'autoclose': true
                                        //'todayBtn': true
                                    });
                                    
                                    $('#datepairExample').datepair();

        function show() { document.getElementById('day').style.display = 'block'; }
        function hide() { document.getElementById('day').style.display = 'none'; }
        function permEngage() { 
          document.getElementById('TempEng').style.display = 'none';
          document.getElementById('permanentEng').style.display = 'block';
         }
        function tempEngage() { 
          document.getElementById('permanentEng').style.display = 'none';
          document.getElementById('TempEng').style.display = 'block'; 
        }

      </script>
      