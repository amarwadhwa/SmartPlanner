<?php


                    if(isset($_GET["user_id"]))
    {                    $user_id = $_GET["user_id"];      
                         $query = $this->db->query("SELECT * FROM users WHERE id = '".$user_id."'" );
                          if($query->num_rows() >0){                          
                          foreach ($query->result() as $row) {                           
                         
                          
                          $id = $row->id;                          
                          $name = $row->name;
                          $designation = $row->designation;
                          $commitee_id = $row->commitee_id;
                          $email = $row->email;     
                        
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
               <h2 class="page-header">Please Confirm </h2>
            </div>
            <!-- /.col-lg-12 -->
            <form onsubmit="return RemoveMsg(this)" action="<?php echo base_url('ViewUsers/deleteUser/deleteUser')?>" method="post" role="form">
         </div>
         <table class="table table-bordered" >
         <label><h3>Name: <?php  if(isset($name)){echo $name;} ?></h3></label>
          <thead>
          <tr style="background-color:LightGrey" >
         <th scope="col">ID</th>
         <th scope="col">Designation</th>
         <th scope="col">Committee id</th>
         <th scope="col">Email</th>
         </tr>  
         </thead>
          <tbody>
            
            <?php

                
                  

                  echo "<tr>";
                  
                      
                  if(isset($id)){echo "<td>".$id."</td>";}
                  if(isset($designation)){echo "<td >".$designation."</td>";}
                  if(isset($commitee_id)){echo "<td >".$commitee_id."</td>";}
                  if(isset($email)){echo "<td >".$email."</td>";}

                  echo "</tr>";

            ?>

         </tbody>
         </table>
         <div>
         <input type="hidden" value=<?php if(isset($id)){ echo "$id"; } ?> name="user_id" />
         
         <h5>Note: You are about to remove the Above User. Confirm?  
          
          <p align="right">
          <input type="submit"  class='btn btn-secondary' name="insert" value="Yes, Remove " />
          </p>
        </h5>
          </div>

          
            

         </form>




         <!-- /#page-wrapper -->
      </div>
   </body>
</html>


<script type="text/javascript">
function RemoveMsg(){
  
  window.alert("User Removed Successfully");
  return true;   

  

}
</script>