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

         <table class="table table-bordered" >
            
         <thead>
         <tr style="background-color:LightGrey" >
         <th scope="col">ID</th>
         <th scope="col">CMS ID </th>
         <th scope="col">Name</th>
         <th scope="col">Designation</th>
         <th scope="col">Member of following Committees </th>
         <th scope="col">Update/Delete</th>                   
         </tr>
         </thead>
         <tbody>
           
           <?php
           $count = 0;
           $query = $this->db->query("SELECT * FROM users " );
           foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td>".++$count."</td>";
            echo "<td>".$row->id."</td>";
            echo "<td>".$row->name."</td>";
            echo "<td>".$row->designation."</td>";
            echo "<td>".$row->commitee_id."</td>";
            
            echo "<td><button type='submit' formaction=/SmartPlanner/AddUsers/?user_id=$row->id name = 'submit' value = $row->id class='btn btn-primary'>Edit</button>&nbsp&nbsp<button type='submit' formaction=/SmartPlanner/AddUsers/cancel?engage_id=$row->id name = 'submit' value = $row->id class='btn btn-primary'>Delete</button></td>";
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
