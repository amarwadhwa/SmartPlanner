<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h2 class="page-header">Members</h2>
            </div>
            <!-- /.col-lg-12 -->
            <form action="<?php echo base_url('schduleMeeting/edit')?>" method="post" role="form">
         </div>

          <input type="hidden" name="editMode" value="on">

         <table style="font-size: 12px;" class="table table-striped table-bordered">
            
         <thead>
         <tr style="background-color:LightGrey" >
         <th scope="col">ID</th>
         <th scope="col">INS-ID </th>
         <th scope="col">Name</th>
         <th scope="col">Designation</th>
         <th scope="col">Email Address</th>
         <th scope="col">Member of Committee(s)</th>
         <th scope="col">Update/Remove</th>                   
         </tr>
         </thead>
         <tbody>
           
           <?php
           $count = 0;
           $queryCom = $this->db->query("SELECT * FROM committees" );
           $all_committess = $queryCom->result();

           $query = $this->db->query("SELECT * FROM users " );
           foreach ($query->result() as $row) {
                $comm_Array = explode(',', $row->commitee_id);
                $committees = "";     
                foreach ($comm_Array as $commArray) {
                    foreach ($all_committess as $comm_name) {
                      if($comm_name->id==$commArray){
                          $committees.=$comm_name->name."<br>";
                          break;  
                      }
                    }
                }


            echo "<tr>";
            echo "<td>".++$count."</td>";
            echo "<td>".$row->id."</td>";
            echo "<td>".$row->name."</td>";
            echo "<td>".$row->designation."</td>";
            echo "<td>".$row->email."</td>";
            echo "<td>".$committees."</td>";

            if($row->id=="admin"){
              echo "<td><button type='submit' formaction=/AddUsers/?user_id=$row->id name = 'submit' value = $row->id class='btn btn-primary'>Edit</button>&nbsp&nbsp<button  type='submit' formaction=/ViewUsers/deleteUser?user_id=$row->id name = 'submit' value = $row->id class='btn btn-primary' disabled>Remove</button></td>";
  
            }
            else{
              echo "<td><button type='submit' formaction=/AddUsers/?user_id=$row->id name = 'submit' value = $row->id class='btn btn-primary'>Edit</button>&nbsp&nbsp<button  type='submit' formaction=/ViewUsers/deleteUser?user_id=$row->id name = 'submit' value = $row->id class='btn btn-primary'>Remove</button></td>";

            }

            

            echo "</tr>"; 

          }

           ?>
          


         </tbody>
         </table>
         </form>
         <!-- /#page-wrapper -->
      </div>
   </body>
</html>
