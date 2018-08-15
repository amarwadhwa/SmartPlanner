


<!DOCTYPE html>
<html lang="en">
   <head>

<script type='text/javascript' src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type='text/javascript' src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  
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

         <table style="font-size: 12px;" class="table table-bordered" >
         
              <h4>Reserved for Meeting</h4>

         <thead>

         <tr style="background-color:LightGrey" >
         <th scope="col">ID</th>
         
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

           $t=time()+(60*60*3);
           $currentTime =  date("Y-m-d H:i:s",$t); 
           
           $query = $this->db->query("SELECT * from exrta_busy_classes INNER JOIN classess ON exrta_busy_classes.class_id=classess.class_id  WHERE exrta_busy_classes.end_time > '".$currentTime."'");
                 
          //$query = $this->db->query("SELECT * from exrta_busy_classes WHERE end_time >'".$currentTime."'");
            

           //$row  = $query->result();
          // print_r($row);          
           $count = 0;
           //$query = $this->db->query("SELECT * FROM exrta_busy_classes" );
           foreach ($query->result() as $row) {
            $start_time = date(' g:ia M-d-Y', strtotime($row->start_time));
            $end_time = date('g:ia M-d-Y', strtotime($row->end_time));
            $day = date('l', strtotime($row->start_time));

            echo "<tr>";
            echo "<td width='10%'>".++$count."</td>";
            echo "<td>".$row->class_name."</td>";
            echo "<td>".$day."</td>";
            echo "<td>".$start_time."</td>";
            echo "<td>".$end_time."</td>";
            echo "<td width='12%'>".$row->reserved_by."</td>";
            echo "<td>".$row->description."</td>";
            
            echo "</tr>"; 

          }




           ?>
          


         </tbody>
         </table>
         <br><br>
         <table id="example" style="font-size: 12px;" class="table table-striped table-bordered" >

              <h4>Reserved for Classes</h4>
         <thead>
         <tr style="background-color:LightGrey" >
         <th scope="col">ID</th>
         <th scope="col">Room Name</th>
         <th scope="col">Day</th> 
         <th scope="col">Start Time</th>
         <th scope="col">End Time</th>
         <th scope="col">Added By</th>
         <th scope="col">Instructor Name</th>
         </tr>
         </thead>
         <tbody>
           


           <?php
           $count = 0;

           $query = $this->db->query("SELECT * from busy_classes INNER JOIN classess ON busy_classes.class_id=classess.class_id
            INNER JOIN users ON busy_classes.description=users.id");
           foreach ($query->result() as $row) {
            $start_time = date('g:i a ', strtotime($row->start_time));
            $end_time = date('g:i a ', strtotime($row->end_time));

            echo "<tr>";
            echo "<td width='10%'>".++$count."</td>";
            echo "<td>".$row->class_name."</td>";
            echo "<td>".$row->day."</td>";
            echo "<td>".$start_time."</td>";
            echo "<td>".$end_time."</td>";
            echo "<td>".$row->added_by."</td>";
            echo "<td>".$row->name."</td>";
            
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
<script>

$(document).ready(function() {
    $('#example').DataTable();
} );

</script>