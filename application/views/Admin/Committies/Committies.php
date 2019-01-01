<!DOCTYPE html>
<html lang="en">
   <head>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Committee</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Add Committee
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <form action="<?php echo base_url('AddCommitties/register')?>" method="post"role="form">
                        <div class="col-lg-6">
                        <form role="form">
                           <div class="form-group">
                           <label>Committee Name</label>
                           <input class="form-control" type="text" name="committie">
                           </div>
                           <div class="form-group" >
                           <label>Committee Description</label>
                           <textarea class="form-control" rows="7" type="text" name="committie_description"></textarea> 
                           </div>
                           <div>   
                           <button type="submit" name="insert" value="insert"class="btn btn-primary">Add Committee</button>
                           <button type="reset" class="btn btn-primary">Reset</button>
                           </div> 
                        
                        </div>
                        

                      <div class="col-lg-6">
                        <label>Add Members into the Committee</label>
                           <div class="panel panel-default">
                           <div class="panel-body">
                               <input class="form-control" type="text"  name="search" autocomplete="off">  
                              <div id="" style="overflow-y:scroll; overflow-x:visible; height:150px;">
                                                                      


                                                                  <div class="checkbox">
                                                                   <ul >
                                                                     <li><input type="checkbox" name="extraUsers[]" value="id">Karan</label>             <br>
                                                            <li><input type="checkbox" value="id">Amar</li><br>
                                                            <li><input type="checkbox" value="">Usama Usmani</li><br>
                                                            <li><input type="checkbox" value="id">Amar</li><br>
                                                            <li><input type="checkbox" value="">Usama Usmani</li><br><li><input type="checkbox" value="id">Amar</li><br>
                                                            <li><input type="checkbox" value="">Usama Usmani</li><br><li><input type="checkbox" value="id">Amar</li><br>
                                                            <li><input type="checkbox" value="">Usama Usmani</li><br><li><input type="checkbox" value="id">Amar</li><br>
                                                            <li><input type="checkbox" value="">Usama Usmani</li><br><li><input type="checkbox" value="id">Amar</li><br>
                                                            <li><input type="checkbox" value="">Usama Usmani</li><br>
                                                            <label><input type="checkbox" value="">Dr. Qamar Uddin Khand</label><br>
                                                            <label><input type="checkbox" value="">Amar</label><br>
                                                            <label><input type="checkbox" value="">Usama Usmani</label><br>
                                                            <li><input type="checkbox" value="">Amar</li><br>
                                                            <label><input type="checkbox" value="">Usama Usmani</label>
                                                                   </ul>        
                                                                  </div>




<input id="txt" type="text" />
<br />
<ul id="lst">
    <li><a href="#">JM Aroma</a></li>
    <li><a href="#">Red Square Bonanza</a></li>
    <li><a href="#">Skylabs Special</a></li>
    <li><a href="#">Society Someplace</a></li>
    <li><a href="#">Anywhere</a></li>
    <li><a href="#">Everywhere</a></li>
    <li><a href="#">Nowhere</a></li>
    <li><a href="#">Somewhere</a></li>
</ul>



                                                                     


                                 

                              </div>  
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
<script src="jquery.js" type="text/javascript"></script>
<script>

   $("document").ready(function () {
    $("[name=search]").on("keyup", function (input) {
        $("input[type=checkbox]").each(function (checkbox) {
        var regex = new RegExp($.trim($(input).val()), "gi");
        if($(checkbox).html().match(regex) !== null) {
            $(checkbox).hide();
        }
        else {
            $(checkbox).show();
        }
        });
    });
});

$("#txt").on("keyup", function() {
    var srchTerm = $(this).val(), 
        $rows = $("#lst").children("li");
    if (srchTerm.length > 0) {
        $rows.stop().hide();
        $("#lst").find("li:contains('" + srchTerm + "')").stop().show();
    } else {
        $rows.stop().show();
    }   
});


    //script from jsFiddle (only the plugin part at the top).
</script>


</html>