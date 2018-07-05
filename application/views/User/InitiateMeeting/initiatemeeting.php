
<?php
                    if(isset($_GET["meeting_id"]))
    {                    echo $_GET["meeting_id"];
                         $meeting_id = $_GET["meeting_id"];      
                         $query = $this->db->query("SELECT * FROM meeting_logs WHERE id = '".$meeting_id."'" );
                           if($query->num_rows() >0){                          
                          foreach ($query->result() as $row) {                           
                          $title = $row->title;
                          $description = $row->description;
                          $commArray = explode(',', $row->committee_id);
                          $_SESSION["startTimeStamp"] = $row->start_time;
                          $_SESSION["endTimeStamp"] = $row->end_time;
                          $editCheck = true;
                          }

         }
    }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      
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
                      <form action="<?php echo base_url('initiateMeeting/initiateMeetingPage2')?>" method="post"role="form">
                            
                        <div class="col-lg-6">
                             <div class="form-group">
                                 <label>Meeting Tittle</label>
                                 <input class="form-control" value="<?php if(isset($title)){ echo $title; }?>" name="title" required>
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
                                    <input  <?php 
                                                if(isset($commArray)){
                                                foreach ($commArray as $comm_Array) {
                                                 if($comm_Array==$Committies["records"][$i]->id ){ echo 'checked="checked"'; 
                                                  break; }
                                                 }}
                                           ?> 

                                     type="radio" name="Committee[]" value= <?php echo $Committies["records"][$i]->id ?> />
                                    <?php   echo $Committies["records"][$i]->name ; 
                                    ?>

                                      
        

                                     
                                      

                                            
                                    </label>
                                 </div>






                                 
                                 
                                 <?php
                                    }
                                  ?>   
                              </div>
                              <!--<br>-->
                              <!--<br>-->
                              <!--<div class="form-group">
                                 <label>Faculty</label>
                                 <input class="form-control"  name="faculty">
                              </div>-->
                              <button type="submit" name="submit" value="meeting"class="btn btn-primary">Next</button>
                                 <button type="reset" class="btn btn-primary">Reset</button>

                            </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label>Meeting Description</label>
                                    <textarea class="form-control" rows="7"  name="description" required><?php 
                                    if(isset($description)){ echo $description;}?></textarea> 
                                    <br>
                                 </div>
                                 <br>
                               </div>
                                <input type="hidden" value="<?php if(isset($editCheck)){ echo "submit"; } ?>" name="editCheck" />

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