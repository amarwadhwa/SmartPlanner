<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
    display: block; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #00aff0;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #00aff0;
    color: white;
}
</style>
</head>
<body>

<!-- Trigger/Open The Modal -->

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->

<div class="modal-content">
    <form id="role-form" action="<?php echo base_url('schduleMeeting/setStatus/'.$rowId.'/Rejected');?> method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h2>Sukkur IBA University</h2>
        </div>
        <div class="modal-body">

            <h3>Please Specify the Reason</h3>
            <div class="form-group col-md-12">
                
                
                 <br> 
                 <!--<input type="text" placeholder="Not Specified"  name="reason">-->

                 <textarea rows="4" style="width: 100%;" placeholder="Not Specified"  name="reason"></textarea>

            </div>
        

            <div class="clearfix">
                <div class="row">
                <div class="form-group col-md-12">
                 
                 <button type="submit"
                formaction="http://sibasmartplanner.com/schduleMeeting/setStatus/<?php echo $rowId;?>/Rejected/" 
                class="btn btn-primary" style="float: left" >Submit</button>       
                
                </div>

        </div> 

            </div>
        
            
        </div>


        <div class="modal-footer">

           <h4>sibasmartplanner.com</h4>
            

        </div>
    </form>
</div>
</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
    document.getElementById('myModal').style.display = "none";
     //window.location = "http://sibasmartplanner.com/User/index";
     history.back() 

}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
       history.back();

    }
}
</script>

</body>
</html>
