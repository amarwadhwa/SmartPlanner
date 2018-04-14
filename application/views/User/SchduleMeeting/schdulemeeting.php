<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Schdule Meeting</h1>
            </div>
            <!-- /.col-lg-12 -->
            <form action="<?php echo base_url('schduleMeeting/edit')?>" method="post"role="form">
         </div>
         <table class="table table-bordered">
         <thead>
         <tr>
         <th scope="col">#</th>
         <th scope="col">Meeting Title</th>
         <th scope="col">Comitties</th>
         <th scope="col">Members</th>
         <th scope="col">Date</th>
         <th scope="col">Duration</th>
         <th scope="col">Edit</th>
         </tr>
         </thead>
         <tbody>
         <tr>
         <th scope="row">1</th>
         <td>A</td>
         <td>A</td>
         <td>A</td>
         <td>2-3-2192</td>
         <td>28 min</td>
         <td><button type="submit" class="btn btn-primary">Edit</button></td>
         </tr>
         <tr>
         <th scope="row">2</th>
         <td>Jacob</td>
         <td>A</td>
         <td>A</td>
         <td>Thornton</td>
         <td>@fat</td>
         <td><button type="submit" class="btn btn-primary">Edit</button></td>
         </tr>
         <tr>
         <th scope="row">3</th>
         <td>A</td>
         <td>A</td>
         <td colspan="2">Larry the Bird</td>
         <td>@twitter</td>
         <td><button type="submit" class="btn btn-primary">Edit</button></td>
         </tr>
         </tbody>
         </table>
         </form>
         <!-- /#page-wrapper -->
      </div>
   </body>
</html>