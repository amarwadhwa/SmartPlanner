
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
                      <form action="<?php echo base_url('AddPermenentEngagesUser/index')?>" method="post" role="form">

                            
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
                            
                            <div>
                              <div class="demo"  id="permanentEng" style="display: block;"  >
                                    <div class="form-group">
                                      
                                    
                                    <p id="datepairExample"><br>
                                      <label>Time</label> <br>
                                    From
                                    <input type="text" class="time start" placeholder="Time" name="start_time"  value="<?php
                                      if(isset($startTime)){echo "$startTime";}

                                       ?>"  required /> to  
                                       <input type="text" class="time end" placeholder="Time"   name="end_date" value="<?php
                                      if(isset($endTime)){echo "$endTime";}

                                       ?>" required />

                                        </div>
                                        </p>
                                       <div class="form-group">
                                        <br><label>Description</label> 
                                        <input required class="form-control" value="<?php if(isset($title)){ echo $title; }?>" name="title"/>
                                 <!-- <p class="help-block">Example block-level help text here.</p> -->
                                        </div>

                                        <br>
                                        
                                       <label>Day</label><br>

                                       <label  class="radio-inline">
                                          <input required type="radio" name="day" value="daily"  onclick="hide();">Daily
                                        </label>
                                        
                                        <label class="radio-inline">
                                          <input type="radio" name="day" value="monsat" onclick="hide();">Monday-Saturday
                                        </label>
                                       
                                        <label class="radio-inline">
                                          <input type="radio" name="day" value="selday" onclick="show();">Select Day
                                        </label>
                                      
                                        <br>

                                        
                                        <div class="form-group" id="day" style="display: none;">
                                          <h3>Select Day </h3>
                                            <select class="form-control" >
                                              <option>Monday</option>
                                              <option>Tuesday</option>
                                              <option>Wednesday</option>
                                              <option>Thursday</option>
                                              <option>Friday</option>
                                              <option>Saturday</option>
                                              <option>Sunday</option>        
                                            </select>
                                          </div>

                                </div>
                                <div class="demo"  id="TempEng" style="display: none;" >
                                    <div class="form-group">
                                      
                                    
                                    <p id="datepairExample"><br>
                                      <label>Date and Time</label> <br>
                                      <input type="text" class="date start" placeholder="Date"  name="start_date" autocomplete="off" value="<?php
                                      if(isset($startDate)){echo "$startDate";}

                                       ?>" required />
                                    From
                                    <input type="text" class="time start" placeholder="Time" name="start_time"  value="<?php
                                      if(isset($startTime)){echo "$startTime";}

                                       ?>"  required /> to  
                                       <input type="text" class="time end" placeholder="Time"   name="end_date" value="<?php
                                      if(isset($endTime)){echo "$endTime";}

                                       ?>" required />

                                    </div>
                                    </p>
                                       <div class="form-group">
                                        <br><label>Description</label> 
                                        <input class="form-control" value="<?php if(isset($title)){ echo $title; }?>" name="title">
                                 <!-- <p class="help-block">Example block-level help text here.</p> -->
                                        </div>

                                        <br>
                                       

                                </div>              

                              <br>
                              <br>
                                  
                                  <input type="submit" name="submit" value="Add Engage" class="btn btn-primary"/>
                                  <button type="reset" class="btn btn-primary">Reset Page</button>

                            </div>
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
      