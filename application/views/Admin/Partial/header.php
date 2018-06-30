<html>
   <head>
      <link href="<?php echo base_url(); ?>application_resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- MetisMenu CSS -->
      <link href="<?php echo base_url(); ?>application_resources/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="<?php echo base_url(); ?>application_resources/dist/css/sb-admin-2.css" rel="stylesheet">
      <!-- Custom Fonts -->
      <link href="<?php echo base_url(); ?>application_resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('Admin/index')?>">Sukkur IBA University</a>
         </div>
         <!-- /.navbar-header -->
         <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
               
               
               <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            
            <!-- /.dropdown -->
            <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
               </a>
               <ul class="dropdown-menu dropdown-alerts">
                  
                  <li class="divider"></li>
                  <li>
                     <a class="text-center" href="#">
                     <strong>See All Alerts</strong>
                     <i class="fa fa-angle-right"></i>
                     </a>
                  </li>
               </ul>
               <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
               </a>
               <ul class="dropdown-menu dropdown-user">
                  <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                  </li>
                  <!--  <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                     </li> -->
                  <li class="divider"></li>
                  <li><a href="<?php echo base_url('Login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                  </li>
               </ul>
               <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
         </ul>
         <!-- /.navbar-top-links -->
         <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
               <ul class="nav" id="side-menu">
                  
                  <li>
                    <!-- <a href="<?php echo base_url('Admin/index')?>"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>-->
                  </li>
                  <li>
                     <a href="<?php echo base_url('AddUsers/index')?>"><i class="fa fa-dashboard fa-fw"></i> Users</a>
                  </li>
                  <li>
                     <a href="<?php echo base_url('AddCommitties/index')?>"><i class="fa fa-table fa-fw"></i> Committies</a>
                  </li>
                  <li>
                     <a href="<?php echo base_url('AddEngages/index')?>"><i class="fa fa-table fa-fw"></i> Add Engages</a>
                  </li>
                  
                  <li>
                     <a href="<?php echo base_url('AdminSettings/index')?>"><i class="fa fa-edit fa-fw"></i> Settings</a>
                  </li>
                  <li>
                     <a href="<?php echo base_url('Login/logout')?>"><i class="fa fa-edit fa-fw"></i> Logout</a>
                  </li>
               </ul>
            </div>
            <!-- /.sidebar-collapse -->
         </div>
         <!-- /.navbar-static-side -->
      </nav>
   </body>
   <html>