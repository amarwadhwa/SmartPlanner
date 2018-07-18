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
         
              <h4>Reserved for Meeting</h4>

         <thead>

         <tr style="background-color:LightGrey" >
         <th scope="col">ID</th>
         <th scope="col">Room ID</th>
         <!--<th scope="col">Room Name</th>-->
         <th scope="col" width="12%">Room Name</th>  
         <th scope="col">Day</th>

         <th scope="col">Start Time</th>
         <th scope="col">End Time</th>
         <th scope="col">Reserved By</th>
         <th scope="col">Description</th>

         </tr>
         </thead>
         <tbody>
           

           


           <?php
           //$query = $this->db->query("SELECT classess.class_name FROM classess INNER JOIN exrta_busy_classes ON classess.class_id=exrta_busy_classes.class_id");

           $query = $this->db->query("SELECT * from exrta_busy_classes INNER JOIN classess ON exrta_busy_classes.class_id=classess.class_id");
                 
           //$row  = $query->result();
          // print_r($row);          
           $count = 0;
           //$query = $this->db->query("SELECT * FROM exrta_busy_classes" );
           foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td width='10%'>".++$count."</td>";
            echo "<td>".$row->class_id."</td>";
            echo "<td>".$row->class_name."</td>";
            echo "<td>"."Remaining"."</td>";
            echo "<td>".$row->start_time."</td>";
            echo "<td>".$row->end_time."</td>";
            echo "<td width='12%'>"."Remaining"."</td>";
            echo "<td>".$row->description."</td>";
            
            echo "</tr>"; 

          }




           ?>
          


         </tbody>
         </table>
         <br><br>
         <table class="table table-bordered" >

              <h4>Reserved for Classes</h4>
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
