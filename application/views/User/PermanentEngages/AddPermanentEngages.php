
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Add Permamnent Engages</title>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Add Permamnent Engages</h1>
            </div>
            <!-- /.col-lg-12 -->
            
         </div>
         <article>
                                 <div class="demo">
                                    <h3>Time </h3>
                                    <p id="datepairExample">
                                    Start time
                                    <input type="text" class="time start" placeholder="Time" name="start_time"  value="<?php
                                      if(isset($startTime)){echo "$startTime";}

                                       ?>"  required /> to End Time 
                                       <input type="text" class="time end" placeholder="Time"   name="end_date" value="<?php
                                      if(isset($endTime)){echo "$endTime";}

                                       ?>" required />
                                       
                                       <h3>Day</h3>
                                       <label class="radio-inline">
                                          <input type="radio" name="period" value="daily" onclick="hide();">Daily
                                        </label>
                                        or
                                        <label class="radio-inline">
                                          <input type="radio" name="period" value="monsat" onclick="hide();">Monday-Saturday
                                        </label>
                                       or
                                        <label class="radio-inline">
                                          <input type="radio" name="period" onclick="show();">Select Day
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




                                       <script type="text/javascript">
        function show() { document.getElementById('day').style.display = 'block'; }
        function hide() { document.getElementById('day').style.display = 'none'; }
      </script>
      

                                      
                         
                                        </form>
                                        
                                       
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



         </tbody>
         </table>
         </form>



      </div>
   </body>
</html>
