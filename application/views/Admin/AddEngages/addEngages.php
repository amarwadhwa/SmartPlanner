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
                     <h3>Upload XML File</h3>
                     <br>

                      <?php echo $error;?>

                     <?php echo form_open_multipart('AddEngages/uploadxml');?>

                     <input type="file" name="userfile" size="20" />
                     <br>
                     <input type="submit" value="upload" />

                     </form>
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
