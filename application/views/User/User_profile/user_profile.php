<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">User Profile</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Details
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-6">
                           <form action="<?php echo base_url('User_Profile/changePassword')?>" method="post" role="form">
                              <div class="form-group">
                                 <label>User Name</label>
                                 <input class="form-control" name="Uname" id="Uname" required>
                              </div>
                              <div class="form-group">
                                    <label>Email</label>
                                 <input class="form-control" name="email" id="email" required >
                                
                                 </div>
                              <div class="form-group">
                                 <label>Designation</label>
                                 <input class="form-control" name="designation" id="designation" required >
                                 
                              
                              </div>
                              <br>
                              <button type="submit" formaction="<?php echo base_url('User_Profile/updateProfile')?>" name="submit2" value="updateProfile" class="btn btn-primary">Update profile</button> 
                           <button type="submit" name="submit" value="meeting "class="btn btn-primary">Change Password</button>

                           </form>
                              



                        </div>
                        <div class="col-lg-6">
                           <form role="form">
                              <div class="form-group">
                                 <label>You are member Of the following Committees</label>
                                 <textarea class="form-control" rows="4" id= "comm" readonly></textarea> 
                                 <br>
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


   
   
   <script type="text/javascript">

            var UserName = "<?php 



             $query = $this->db->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
             foreach($query->result() as $name){
              echo  $name->name;

             }
      ?>"; 
            document.getElementById("Uname").value = UserName;

            var Email = "<?php 
                              foreach($query->result() as $email){
                              echo  $email->email;
             }//echo $_SESSION["gmail"]; ?>"; 
            document.getElementById("email").value = Email;

            
            var designation = "<?php 
                                foreach($query->result() as $designation){
                              echo  $designation->designation;
             }//echo $_SESSION["designation"]; ?>"; 
            document.getElementById("designation").value = designation;

            var comm = "<?php 
                                 $CommString =  $_SESSION["commitee_id"];    
                                 $commetties = "";
                                 if(strlen($CommString)>1){
                                    $CommArray = explode(",",$CommString);
                                    
                                        
                                    $N =  count($CommArray);     
                                    for($i=0; $i < $N; $i++)
                                    {
                                       $query = $this->db->query("SELECT name FROM committees WHERE id = ".$CommArray[$i]."");
                                       if($query->num_rows() >0){
                                          foreach ($query->result() as $row) {
                                             $commetties .=  $row->name . " , " ;
                                          }
                                       }
                                    }


                                    $commetties = substr($commetties, 0,-2);
                                    echo $commetties;
                                 } 
                                 else{
                                    if(strlen($CommString)>0){

                                       $query = $this->db->query("SELECT name FROM committees WHERE id = ".$CommString."");
                                       if($query->num_rows() >0){
                                                 foreach ($query->result() as $row) {
                                                       $commetties = $row->name;
            
                                                 }
                                       }                                                                  
                                       
                                          echo $commetties;
                                       }

                                    else {
                                          echo "None";
                                    }

                                    
                              }    
                              ?>"
            document.getElementById("comm").value = comm;

</script>




            