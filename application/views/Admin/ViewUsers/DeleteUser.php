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


                          $queryCom = $this->db->query("SELECT * FROM committees" );
                          $all_committess = $queryCom->result();
                          $comm_Array = explode(',', $commitee_id);
                          $committees = "";     
                          foreach ($comm_Array as $commArray) {
                            foreach ($all_committess as $comm_name) {
                              if($comm_name->id==$commArray){
                              $committees.=$comm_name->name."<br>";
                              break;  
                              } 
                            }
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
            <form onsubmit="return RemoveMsg();" action="<?php echo base_url('ViewUsers/deleteUser/deleteUser')?>" method="post" role="form">
         </div>
         <table  style="font-size: 12px;" class="table table-striped table-bordered">
         <label><h4>Name: <?php  if(isset($name)){echo $name;} ?></h4></label>
          <thead>
          <tr style="background-color:LightGrey" >
         <th scope="col">INS-ID</th>
         <th scope="col">Designation</th>
         <th scope="col">Email Address</th>
         <th scope="col">Member of Committee(s)</th>
         </tr>  
         </thead>
          <tbody>
            
            <?php

                
                  

                  echo "<tr>";
                  
                      
                  if(isset($id)){echo "<td>".$id."</td>";}else{echo "<td></td>";}
                  if(isset($designation)){echo "<td >".$designation."</td>";}else{echo "<td></td>";}
                  if(isset($email)){echo "<td >".$email."</td>";}else{echo "<td></td>";}
                  if(isset($commitee_id)){echo "<td >".$committees."</td>";}else{echo "<td></td>";}
                  

                  echo "</tr>";

            ?>

         </tbody>
         </table>
         <div>
         <input type="hidden" value=<?php if(isset($id)){ echo "$id"; } ?> name="user_id" />
         
         <h5>Note: You are about to remove the Above User. Confirm?  
          
          <p align="right">
          <input type="submit" class='btn btn-primary' name="insert" value="Yes, Remove " />
          </p>
        </h5>
          </div>

          
            

         </form>




         <!-- /#page-wrapper -->
      </div>
   </body>
</html>


<script type="text/javascript">
function RemoveMsg() {
    
    var r = confirm("Confirm Removal?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
    
}
</script>