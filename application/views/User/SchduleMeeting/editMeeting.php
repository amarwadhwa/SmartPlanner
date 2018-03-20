<!DOCTYPE html>
<html lang="en">

<body>

    

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Meeting</h1>
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

                                <div class="col-lg-6">
                                    <form action="<?php echo base_url('schduleMeeting/editConform')?>" method="post"role="form">
                                        <div class="form-group">
                                            <label>Meeting Tittle</label>
                                            <input class="form-control">

                                            <!-- <p class="help-block">Example block-level help text here.</p> -->
                                        </div>
                                        
                                   
                                         <div class="form-group">
                                            <label>Committies</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Senate 
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Departmental
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Senate 
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Departmental
                                                </label>
                                            </div>
                                            <!-- <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Checkbox 3
                                                </label>
                                            </div> -->
                                        </div>
                                        <br>
                                        <br>

                            <div class="form-group">
                                <label>Faculty</label>
                               
                                    <input class="form-control" id="demo-input-facebook-theme" name="blah2" />
                                    
                                    <script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#demo-input-facebook-theme").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                                            theme: "facebook"
                                        });
                                    });
                                    </script>
                                </div>

                                <hr>
                                    

                                        <button type="submit" name="submit" value="meeting "class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>


                               
                          
                            <div class="col-lg-6">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Meeting Description</label>
                                            <textarea class="form-control" rows="7" ></textarea> 
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