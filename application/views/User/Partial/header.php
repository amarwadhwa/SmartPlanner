<html>
   <head>
      <link href="<?php echo base_url(); ?>application_resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- MetisMenu CSS -->
      <link href="<?php echo base_url(); ?>application_resources/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="<?php echo base_url(); ?>application_resources/dist/css/sb-admin-2.css" rel="stylesheet">
      <!-- Custom Fonts -->
      <link href="<?php echo base_url(); ?>application_resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Calender -->
      <link href='<?php echo base_url(); ?>application_resources/CalenderFiles/css/fullcalendar.min.css' rel='stylesheet' />
      <link href='<?php echo base_url(); ?>application_resources/CalenderFiles/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
      <style>
         body {
         margin: 0px 0px;
         padding: 0;
         font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
         font-size: 14px;
         }
         #calendar {
         max-width: 900px;
         margin: 0 auto;
         }
         .bs-example{
         margin: 20px;
         }
         @media only screen and (max-width: 800px) {
         /* Force table to not be like tables anymore */
         #no-more-tables table,
         #no-more-tables thead,
         #no-more-tables tbody,
         #no-more-tables th,
         #no-more-tables td,
         #no-more-tables tr {
         display: block;
         }
         /* Hide table headers (but not display: none;, for accessibility) */
         #no-more-tables thead tr {
         position: absolute;
         top: -9999px;
         left: -9999px;
         }
         #no-more-tables tr { border: 1px solid #ccc; }
         #no-more-tables td {
         /* Behave like a "row" */
         border: none;
         border-bottom: 1px solid #eee;
         position: relative;
         padding-left: 50%;
         white-space: normal;
         text-align:left;
         }
         #no-more-tables td:before {
         /* Now like a table header */
         position: absolute;
         /* Top/left values mimic padding */
         top: 6px;
         left: 6px;
         width: 45%;
         padding-right: 10px;
         white-space: nowrap;
         text-align:left;
         font-weight: bold;
         }
         /*
         Label the data
         */
         #no-more-tables td:before { content: attr(data-title); }
         }

         .navbar-default2 {
            background-color:    #011C39;
            border-color: #ffffff;
         }



         .navbar-default {
            
            background-color:   #011C39 ;
            border-color: #ffffff;

         }


         .test {
            color: #ffffff;
            
            
         }
  
        
       
         


      </style>
      <!-- Jquery Token Input -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/tokenInput/styles/token-input.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/tokenInput/styles/token-input-facebook.css" type="text/css" />
      <link href="<?php echo base_url(); ?>application_resources/vendor/morrisjs/morris.css" rel="stylesheet">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Meeting Planner</title>
   </head>
   <body>
      <div id="wrapper">
      <!-- Navigation -->
      <nav   class="navbar navbar-default2 navbar-static-top " role="navigation"  style="margin-bottom: 0" >










         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>


            <a class="navbar-brand test" href="<?php echo base_url('User/index')?>">Smart Meeting Planner</a>
            
         </div>
         <!-- /.navbar-header -->
         <ul class="nav navbar-top-links navbar-right" >

            <!-- /.dropdown -->
            <!-- /.dropdown -->
            <li class="dropdown">
               
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   
               <i class="fa fa-bell fa-fw" style="color: white"></i> <i class="fa fa-caret-down" style="color: white"></i>
               </a>
               <ul class="dropdown-menu dropdown-alerts">
                  <li><a href="<?php echo base_url('My_Meeting')?>"><i class="fa fa-list-ul "></i> My Meetings</a>
                  </li> 

                  <li class="divider"></li>
                  <li>
                     <a class="text-left  fa fa-calendar-check-o" href="<?php echo base_url('Engages')?>">
                     My Engages
                     <i class="fa fa-angle-right"></i>
                     </a>
                  </li>
               </ul>
               <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <i class="fa fa-user fa-fw" style="color: white"></i>
               <i class="fa fa-caret-down" style="color: white"></i>

               </a>


               <ul class="dropdown-menu dropdown-user">
                  <li><a href="<?php echo base_url('User_Profile')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                  </li>
                  
                  <li class="divider"></li>
                  <li><a href="<?php echo base_url('Login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                  </li>
               </ul>
               <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
         </ul>
         <!-- /.navbar-top-links -->
         <div class="navbar-default sidebar " role="navigation" >
            <div class="sidebar-nav navbar-collapse" > 
               <ul class="nav" id="side-menu">
                  
                  <li>
                     <a class="test" href="<?php echo base_url('User/index')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                  </li>
                  <li>
                     <a class="test" href="<?php echo base_url('My_Meeting/index')?>"><i class="fa fa-edit fa-fw"></i> My Meetings</a>
                  </li>
                  
                  <li>
                     <a class="test" href="<?php echo base_url('Engages/index')?>"><i class="fa fa-table fa-fw"></i> My Engages</a>
                  </li>

                  <li>
                     <a class="test"  href="<?php echo base_url('AddPermenentEngagesUser/index')?>"><i class="fa fa-table fa-fw"></i> Add Engage</a>
                  </li>
                  

                  <li>
                     <a class="test" href="<?php echo base_url('InitiateMeeting/index')?>"><i class="fa fa-table fa-fw"></i> Initiate Meeting</a>
                  </li>
                 <!--"<?php //echo base_url('initiateMeeting/index')?>"-->

                  <li>
                     <a class="test" href="<?php echo base_url('SchduleMeeting/index')?>"><i class="fa fa-table fa-fw"></i> Scheduled Meetings</a>
                  </li>
                  <li>
                     <a class="test" href="<?php echo base_url('User_Profile/index')?>"><i class="fa fa-table fa-fw"></i> Profile</a>
                  </li>
                  <li>
                     <a class="test" href="<?php echo base_url('Login/logout')?>"><i class="fa fa-table fa-fw"></i> Logout</a>
                  </li>
               </ul>
            </div>
            <!-- /.sidebar-collapse -->
         </div>
         <!-- /.navbar-static-side -->
      </nav>
   </body>
   <html>