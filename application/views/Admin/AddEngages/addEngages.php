<!DOCTYPE html>
<html lang="en">
   <head></head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Add Engages</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  
                  <div class="panel-body">
                     <div class="row">
                        <form enctype="multipart/form-data" action="upload.php" method="POST">
                        <p>Upload XML file Only</p>
                        <input type="file" name="uploaded_file" ></input><br />
                        <input type="submit" value="Upload"></input>
                     </form>

                     <?PHP
                   if(!empty($_FILES['uploaded_file']))
                  {
                  $path = "SmartPlanner/EngagesByWaseem/";
                  $path = $path . basename( $_FILES['uploaded_file']['name']);
                  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
                   echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
                  " has been uploaded";
                  } else{
                   echo "There was an error uploading the file, please try again!";
                     }
                  }
                  ?>

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
