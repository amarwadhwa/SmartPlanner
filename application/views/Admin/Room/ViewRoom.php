<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h2 class="page-header">Available Rooms</h2>
            </div>
            <!-- /.col-lg-12 -->
            <form onsubmit="return RemoveMsg();" action="" method="post" role="form">
         </div>

          <input type="hidden" name="editMode" value="on">

         <table style="font-size: 12px;"  class="table table-bordered" >
            
         <thead>
         <tr style="background-color:LightGrey" >
         <th scope="col">ID</th>
         <th scope="col">Room ID </th>
         <th scope="col">Room Name</th>
         <th scope="col">Remove</th>                 
         </tr>
         </thead>
         <tbody>
           


           <?php
           $count = 0;
           $query = $this->db->query("SELECT * FROM classess " );
           foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td width='10%'>".++$count."</td>";
            echo "<td>".$row->class_id."</td>";
            echo "<td>".$row->class_name."</td>";
            
            echo "<td width='10%'><button  type='submit' formaction=/Rooms/delete?room_id=$row->class_name name = 'submit' value = $row->id class='btn btn-primary'>Remove</button></td>";
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

