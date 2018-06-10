<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Committies</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Add Committie
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <form action="<?php echo base_url('AddCommitties/register')?>" method="post"role="form">
                           <div class="col-lg-6">
                        <form role="form">
                        <div class="form-group">
                        <label>Committie</label>
                        <input class="form-control" type="text" name="committie">
                        </div>
                        <div class="form-group" >
                        <label>Committie Description</label>
                        <textarea class="form-control" rows="7" type="text" name="committie_description"></textarea> 
                        </div>
                        <div>
                        <button type="submit" name="insert" value="insert"class="btn btn-primary">Add Committee</button>
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