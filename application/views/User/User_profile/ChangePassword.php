<?php
if (isset($_POST['submit']) && $_POST['submit'] == "set") {
$oldPass = $_SESSION["password"];
$userOldPass = $_POST["oldPass"];
$newPass = $_POST["newOne"];

if ($oldPass == $userOldPass) {
   $_POST['submit'] = "Not Set" ;
   unset($_POST['submit']);   
      $data = array('password' => "$newPass");      
         $this->db->set($data); 
         $this->db->where("id",$userId); 
         $this->db->update("users", $data);
        $_SESSION["passwordChange"] = "set";
         redirect("Login");


}
else {
   $_POST['submit'] = "Not Set" ;
   unset($_POST['submit']); 
   $error = false;
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
                           <form onSubmit="return validatePassword(this);"  method="post" >
                              <?php if (isset($error)) {
                                echo '<font color="RED"> <h5>Invalid Old Password</h5></font>';
                                 unset($error);                                                                
                              } ?>
                              <div class="form-group">
                                 <label >Enter Old Password</label>
                                 <input class="form-control" name="oldPass"  type="password" required>
                              </div>
                             
                               <div class="form-group">
                                 <label>Enter New Password</label>
                                 <input class="form-control" id = "password" name = "newOne"  type="password" required >
                               </div>
                              <div class="form-group">
                                 <label>Re-Enter New Password</label>
                                 <input class="form-control" id = "confirm_password" name = "NewTwo" type="password" required >
                              </div>
                                  
                              <button type="submit"  name="submit" value = "set" class="btn btn-primary">Submit Button</button>
                              
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

  var password = document.getElementById("password"),confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
   window.alert("Password does not Matched");   
    
    return false;
  } else {
   
    
    return true;
  }
}

</script>

