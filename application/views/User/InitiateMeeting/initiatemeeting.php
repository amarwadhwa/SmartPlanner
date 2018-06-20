
<?php
                    if(isset($_GET["meeting_id"]))
    {                    echo $_GET["meeting_id"];
                         $meeting_id = $_GET["meeting_id"];      
                         $query = $this->db->query("SELECT * FROM meeting_logs WHERE id = '".$meeting_id."'" );
                           if($query->num_rows() >0){                          
                          foreach ($query->result() as $row) {                           
                          $title = $row->title;
                          $description = $row->description;
                          $commArray = explode(',', $row->committee_id);
                          $_SESSION["startTimeStamp"] = $row->start_time;
                          $_SESSION["endTimeStamp"] = $row->end_time;

                          }

         }
    }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <style>
      .ui-autocomplete-loading {
      background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
      }
      </style>
       <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script>
         $( function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#faculty" )
      // don't navigate away from the field on tab when selecting an item
      .on( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "localhost/SmartPlanner/User/getUsers", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 2 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  } );
      </script>
   </head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Initiate Meeting</h1>               
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Please give details
                  </div>
                  <div class="panel-body">
                     <div class="row">
                      <form action="<?php echo base_url('initiateMeeting/initiateMeetingPage2')?>" method="post"role="form">
                            
                        <div class="col-lg-6">
                             <div class="form-group">
                                 <label>Meeting Tittle</label>
                                 <input class="form-control" value="<?php if(isset($title)){ echo $title; }?>" name="title">
                                 <!-- <p class="help-block">Example block-level help text here.</p> -->
                              </div>
                              
                              <div class="form-group">
                                 <label>Committies</label>
                                 <?php 
                                    $count = count($Committies["records"]);
                                    
                                    for($i=0; $i < $count; $i++){
                                 ?>

                                 <div class="checkbox" >
                                    <label>
                                    <input <?php 
                                                if(isset($commArray)){
                                                foreach ($commArray as $comm_Array) {
                                                 if($comm_Array==$Committies["records"][$i]->id ){ echo 'checked="checked"'; 
                                                  break; }
                                                 }}
                                           ?> 

                                     type="checkbox" name="Committee[]" value= <?php echo $Committies["records"][$i]->id ?> />
                                    <?php   echo $Committies["records"][$i]->name ; 
                                    ?>

                                      
        

                                     
                                      

                                            
                                    </label>
                                 </div>






                                 
                                 
                                 <?php
                                    }
                                  ?>   
                              </div>
                              <br>
                              <br>
                              <div class="form-group">
                                 <label>Faculty</label>
                                 <input class="form-control"  name="faculty" >
                              </div>
                              <button type="submit" name="submit" value="meeting"class="btn btn-primary">Next</button>
                                 <button type="reset" class="btn btn-primary">Reset</button>

                            </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label>Meeting Description</label>
                                    <textarea class="form-control" rows="7"  name="description"><?php 
                                    if(isset($description)){ echo $description;}?></textarea> 
                                    <br>
                                 </div>
                                 <br>

                               </div>
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