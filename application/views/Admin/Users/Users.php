

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
                        <form onsubmit="return Verify()" action="<?php echo base_url('AddUsers/register')?>" method="post" role="form">
                           <div class="col-lg-6">
                        <form role="form">
                        <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" required>
                        <span class="text-danger"><?php echo form_error("first_name");?></span>
                        </div>                        
                        <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email" required>
                        <span class="text-danger"><?php echo form_error("email");?></span>
                        </div>
                        <div class="form-group">
                        <label>Instructor Id</label>
                        <input class="form-control" type="text" name="id" required>
                        <span class="text-danger"><?php echo form_error("id");?></span>
                        </div>
                        <div class="form-group">
                        <label>Committie Id</label>
                        <input class="form-control" type="text" name="committie_id" required>
                        <span class="text-danger"><?php echo form_error("committie_id");?></span>
                        </div>
                        <div>
                        <button type="submit" name="insert" value="Insert "class="btn btn-primary">Add User</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        </div> 
                        </div>
                        <div class="col-lg-6">
                        <form role="form">
                        <div class="form-group">
                        <label>Designation</label>
                        <input class="form-control" type="text" name="designation" required>
                        <span class="text-danger"><?php echo form_error("designation");?></span>
                        </div>
                        <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="text" name="password" required>
                        <span class="text-danger"><?php echo form_error("password");?></span>
                        </div>
                        <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="text" name="password" required>
                        <span class="text-danger"><?php echo form_error("password");?></span>
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
<script type="text/javascript">
      
function Verify(){
   var abc  = "<?php echo $this->input->post("name"); ?>";

   alert(abc);   
   return false;
}
</script>
