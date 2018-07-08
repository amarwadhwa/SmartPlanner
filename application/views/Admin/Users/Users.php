<?php


                    if(isset($_GET["user_id"]) && isset($_POST["editMode"]))
    {                    $user_id = $_GET["user_id"];      
                         $query = $this->db->query("SELECT * FROM users WHERE id = '".$user_id."'" );
                          if($query->num_rows() >0){                          
                          foreach ($query->result() as $row) {                           
                         
                          
                          $formData["id"] = $row->id;                          
                          $formData["password"] = $row->password;
                          $formData["name"] = $row->name;
                          $formData["designation"] = $row->designation;
                          $commitee_id = $row->commitee_id;
                          $formData["email"] = $row->email;
                          $formData["Committee"] = explode(',', $row->commitee_id);            
                          $edit = "true";
                          $this->load->model('Committee');
                          $Committies = $this->Committee->view_all();   


                          }

         }
    }
?>

<!DOCTYPE html>
<html lang="en">
   <head></head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Add Users
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <form onsubmit="return Verify()" action="" method="post" role="form">
                           <div class="col-lg-6">
                        <form role="form">
                        <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" value="<?php if(isset($formData["name"])){ echo $formData["name"]; } ?>" required>
                        <span class="text-danger"><?php echo form_error("first_name");?></span>
                        </div>                        
                        <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email" value="<?php if(isset($formData["email"])){ echo $formData["email"]; } ?>" required>
                        <span class="text-danger"><?php echo form_error("email");?></span>
                        </div>
                        <div class="form-group">
                        <label>Instructor Id</label>
                        <input class="form-control" type="text" name="id" value="<?php if(isset($formData["id"])){ echo $formData["id"]; } ?>" <?php if(isset($formData["id"])){ echo "readonly"; } ?> required  >
                        <span class="text-danger"><?php echo form_error("id");?></span>
                        <?php if(isset($error)) {echo "<h4> <font style='color:red'>". $error . "</font> </h4>";}?>
                        </div>
                        
                        <input type="hidden" name="edit" value=<?php  if(isset($edit)){echo "editing";}?>        >

                        <div class="form-group">
                        <label>Designation</label>
                        <input class="form-control" type="text" name="designation" value="<?php if(isset($formData["designation"])){ echo $formData["designation"]; } ?>" required>
                        <span class="text-danger"><?php echo form_error("designation");?></span>
                        </div>



                        <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" value="<?php if(isset($formData["password"])){ echo $formData["password"]; } ?>"  required>
                        <span class="text-danger"><?php echo form_error("password");?></span>
                        </div> 
                        <div>
                        
                        <button type="submit" name="insert" value="Insert "class="btn btn-primary"><?php if(isset($edit)){    

                           echo "Update";


                        }
                           else{
                                 echo "Add User";    
                           } 
                        ?></button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        
                        <form role="form">                      
                        <div class="form-group">
                        <label>Add User into the Commitee</label>
                        <div class="col-lg-10">
                        <?php 
                                    $count = count($Committies["records"]);
                                    
                                    for($i=0; $i < $count; $i++){
                        ?>
                        
                       
                        <div class="checkbox" >   
                        

                        <input
                              <?php 
                                                if(isset($formData["Committee"])){
                                                   foreach ($formData["Committee"] as $comm_Array) {
                                                   if($comm_Array==$Committies["records"][$i]->id ){ echo 'checked="checked"'; 
                                                  break; }
                                                 }}
                              ?>



                         type="checkbox" name="Committee[]" value= <?php echo $Committies["records"][$i]->id ?> >
                        <span class="text-danger"><?php echo form_error("Committies");?></span>
                        <?php   echo $Committies["records"][$i]->name; 
                        ?>
                        
                        <br>
                        </div>
                        <?php
                           }
                                  ?>
                         
                                                 
                         <br>
                         <br><br><br>           
                        </div>
                        
                     </div>
                     </form>
                     <!-- /.col-lg-6 (nested) -->
                  </div>
                  <!-- /.col-lg-6 (nested) -->
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
      
function Verify(){
   
   alert(abc);   
   return false;
}
</script>

