<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Add Meeting Room</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Add Room
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <form action="<?php echo base_url('AddRoom/add_room')?>" method="post"role="form">
                           <div class="col-lg-6">
                        <form role="form">
                        <div class="form-group">
                        <label>Room Number</label>
                        <input class="form-control" type="text" placeholder="Ex: Room-102" name="room_name" value="<?php if(isset($formData["room_name"])){ echo $formData["room_name"]; } ?>" required>
                        <?php if(isset($error)) {echo "<h5> <font style='color:red'>". $error . "</font> </h5>";}?>

                        </div>
                        <div class="form-group" >
                        <label>Room Description</label>
                        <textarea class="form-control" rows="7" type="text" name="room_description" value="<?php if(isset($formData["room_description"])){ echo $formData["room_description"]; } ?>" ></textarea> 
                        </div>
                        <div>
                        <button type="submit" name="insert" value="insert"class="btn btn-primary">Add Room</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        </div> 
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