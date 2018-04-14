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
                           <form action="<?php echo base_url('initiateMeeting/initiateMeetingPage2')?>" method="post"role="form">
                              <div class="form-group">
                                 <label>Meeting Tittle</label>
                                 <input class="form-control" name="title">
                                 <!-- <p class="help-block">Example block-level help text here.</p> -->
                              </div>
                              
                              <div class="form-group">
                                 <label>Committies</label>
                                 <?php 
                                    $count = count($Committies["records"]);
                                    
                                    for($i=0; $i < $count; $i++){
                                 ?>
                                 
                                 <div class="checkbox" >
                                    <label>
                                    <input type="checkbox" name="Committee[]" value= <?php echo $Committies["records"][$i]->id ?> />  
                                    <?php   echo $Committies["records"][$i]->name ; 
                                    ?>
                                    </label>
                                 </div>
                                 <?php
                                    }
                                  ?>   
                              </div>
                              <br>
                              <br>
                              <div class="form-group">
                                 <label>Faculty</label>
                                 <input class="form-control" id="demo-input-facebook-theme" name="Faculty" >
                                 <script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#demo-input-facebook-theme").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                                            theme: "facebook"
                                        });
                                    });
                                 </script>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label>Meeting Description</label>
                                    <textarea class="form-control" rows="7"  name="description" ></textarea> 
                                    <br>
                                 </div>
                                 <br>
                                 <button type="submit" name="submit" value="meeting"class="btn btn-default">Submit Button</button>
                                 <button type="reset" class="btn btn-default">Reset Button</button>
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