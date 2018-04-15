<!DOCTYPE html>
<html lang="en">
   <head></head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Add Users
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <form action="<?php echo base_url('AddUsers/form_validation')?>" method="post" role="form">
                           <div class="col-lg-6">
                        <form role="form">
                        <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" name="first_name" >
                        <span class="text-danger"><?php echo form_error("first_name");?></span>
                        </div>
                        <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" name="last_name" >
                        <span class="text-danger"><?php echo form_error("last_name");?></span>
                        </div>
                        <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email_name" >
                        </div>
                        <div class="form-group">
                        <label>Instructor Id</label>
                        <input class="form-control" type="text" name="id" >
                        </div>
                        <div class="form-group">
                        <label>Committie Id</label>
                        <input class="form-control" type="text" name="committie_id" >
                        </div>
                        <div>
                        <button type="submit" name="insert" value="Insert "class="btn btn-default">Submit Button</button>
                        <button type="reset" class="btn btn-default">Reset Button</button>
                        </div> 
                        </div>
                        <div class="col-lg-6">
                        <form role="form">
                        <div class="form-group">
                        <label>Designation</label>
                        <input class="form-control" type="text" name="designation">
                        </div>
                        <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="7" ></textarea> 
                        <br>
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