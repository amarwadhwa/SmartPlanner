
<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Change Password</h1>
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
                                 <!--
                                 <div class="form-group">
                                 <label >Enter Old Password</label>
                                 <input class="form-control"  id = "Old" required>
                                 </div>
                                 
                                 
                                 
                                 <div class="form-group">
                                 <label>Enter New Password</label>
                                 <input class="form-control" id = "New" required >
                                 </div>

                                 <div class="form-group">
                                 <label>Re-Enter New Password</label>
                                 <input class="form-control" id = "AgainNew" required >
                                 </div>
                                 <button type= "submit" onclick="CallIt()"  class="btn btn-primary" >Click me </button>
                                 -->
                           
                           <form onSubmit="return CallIt(this);" method="post" >
                              <div class="form-group">
                                 <label >Enter Old Password</label>
                                 <input class="form-control"  id = "Old"  required>
                              </div>
                             
                               <div class="form-group">
                                 <label>Enter New Password</label>
                                 <input class="form-control" id = "New" name = "NewOne" required >
                               </div>
                              <div class="form-group">
                                 <label>Re-Enter New Password</label>
                                 <input class="form-control" id = "AgainNew"  name = "NewTwo" required >
                              </div>
                                  
                              <button type="submit"  name="submit" value="meeting "class="btn btn-primary">Submit Button</button>
                              
                           </form> 
                           
                           
                           
                                          



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




function  CallIt(){          
                                                      
           var abc  = "<?php echo $_POST["NewOne"]; ?>"
            window.alert(abc);

               OldpassDatabase = "<?php echo $_SESSION["password"] ?>"; 
               Oldpass = document.getElementById("Old").value;
              
               if (OldpassDatabase==Oldpass) {

                  //Query to the DataBase is remaining                     

               }
               else
                  {
                     window.alert("Incorrect old Password !");
                  }
            
   
  } 
   </script>
