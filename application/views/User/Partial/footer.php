<html>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>application_resources/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>application_resources/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>application_resources/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>application_resources/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>application_resources/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>application_resources/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>application_resources/dist/js/sb-admin-2.js"></script>


    <!-- Jquery Token Input -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>application_resources/tokenInput/src/jquery.tokeninput.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("input[type=button]").click(function () {
            alert("Would submit: " + $(this).siblings("input[type=text]").val());
        });
    });
    </script>



    <!--  -->
            <script src="http://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>
            <script src="http://jonthornton.github.io/Datepair.js/dist/jquery.datepair.js"></script>
            
</html>