<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h2 class="page-header">Busy Rooms</h2>
            </div>
            <!-- /.col-lg-12 -->
            <form action="" method="post" role="form">
         </div>

          <input type="hidden" name="editMode" value="on">

         <table class="table table-bordered" >
            
         <thead>
         <tr style="background-color:LightGrey" >
         <th scope="col">ID</th>
         <th scope="col">Room ID</th>
         <!--<th scope="col">Room Name</th>-->
         <th scope="col">Day</th> 
         <th scope="col">Start Time</th>
         <th scope="col">End Time</th>
         <th scope="col">Added By</th>

         </tr>
         </thead>
         <tbody>
           


           <?php
           $count = 0;
           $query = $this->db->query("SELECT * FROM busy_classes" );
           foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td width='10%'>".++$count."</td>";
            echo "<td>".$row->class_id."</td>";
            echo "<td>".$row->day."</td>";
            echo "<td>".$row->start_time."</td>";
            echo "<td>".$row->end_time."</td>";
            echo "<td>".$row->added_by."</td>";
            
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
