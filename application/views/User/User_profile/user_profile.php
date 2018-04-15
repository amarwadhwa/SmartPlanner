<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">User Profile</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Details
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-6">
                           <form action="<?php echo base_url('User_Profile/changePassword')?>" method="post"role="form">
                              <div class="form-group">
                                 <label>User Name</label>
                                 <input class="form-control" readonly>
                              </div>
                              <div class="form-group">
                                 <label>First Name</label>
                                 <input class="form-control" readonly>
                              </div>
                              <div class="form-group">
                                 <label>Last Name</label>
                                 <input class="form-control" readonly>
                              </div>
                              <div class="form-group">
                                 <label>Email</label>
                                 <input class="form-control" readonly>
                              </div>
                              <br>
                              <label>Change Your Password Click here</label>
                              <button type="submit" name="submit" value="meeting "class="btn btn-primary">Password Change</button>
                           </form>
                        </div>
                        <div class="col-lg-6">
                           <form role="form">
                              <div class="form-group">
                                 <label>Address</label>
                                 <textarea class="form-control" rows="4" readonly></textarea> 
                                 <br>
                           </form>
                           </div>
                        </div>
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