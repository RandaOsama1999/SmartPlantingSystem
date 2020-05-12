<?php
include_once "classDatabase.php";
include_once "classLink.php";
include_once "classNotification.php";
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                <a href="updatemyself.php"><img src="images/7.png"  alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <?php
                            
                                $Resultheader=Link::headerPerm();
                                $LEDarrayFriendly=array();
                                $LEDarrayPhysical=array();
                                $TimerarrayFriendly=array();
                                $TimerarrayPhysical=array();
                                $LandRequestarrayFriendly=array();
                                $LandRequestPhysical=array();
                                $LandarrayFriendly=array();
                                $LandPhysical=array();
                                $PlantarrayFriendly=array();
                                $PlantPhysical=array();
                                $AdminarrayFriendly=array();
                                $AdminPhysical=array();
                                $LandownerarrayFriendly=array();
                                $LandownerPhysical=array();
                                //$NotificationContentarrayFriendly=array();
                                //$NotificationContentPhysical=array();
                                $SensorarrayFriendly=array();
                                $SensorPhysical=array();
                                

                                for ($i=0;$i<count($Resultheader);$i++)
                                {
                                    /*if(strpos($Resultheader[$i]->FriendlyAddress, "LED") !== false){
                                        array_push($LEDarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                        array_push($LEDarrayPhysical,$Resultheader[$i]->PhysicalAddress);
                                    }*/
                                    if(strpos($Resultheader[$i]->FriendlyAddress, "Timer") !== false){
                                        array_push($TimerarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                        array_push($TimerarrayPhysical,$Resultheader[$i]->PhysicalAddress);
                                    }
                                    if(strpos($Resultheader[$i]->FriendlyAddress, "Land") !== false){
                                        if(strpos($Resultheader[$i]->FriendlyAddress, "Land Request") !== false){
                                            array_push($LandRequestarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                            array_push($LandRequestPhysical,$Resultheader[$i]->PhysicalAddress);
                                        }
                                        else if(strpos($Resultheader[$i]->FriendlyAddress, "Landowner") !== false){
                                            array_push($LandownerarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                            array_push($LandownerPhysical,$Resultheader[$i]->PhysicalAddress);
                                        }
                                        else{
                                            array_push($LandarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                            array_push($LandPhysical,$Resultheader[$i]->PhysicalAddress);
                                        }
                                    }
                                    if(strpos($Resultheader[$i]->FriendlyAddress, "LED") !== false){
                                        if(strpos($Resultheader[$i]->FriendlyAddress, "Plant") == false){
                                            array_push($LEDarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                            array_push($LEDarrayPhysical,$Resultheader[$i]->PhysicalAddress);
                                        }
                                    }
                                    if(strpos($Resultheader[$i]->FriendlyAddress, "Plant") !== false){
                                        array_push($PlantarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                        array_push($PlantPhysical,$Resultheader[$i]->PhysicalAddress);
                                    }
                                    if(strpos($Resultheader[$i]->FriendlyAddress, "Admin") !== false){
                                        array_push($AdminarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                        array_push($AdminPhysical,$Resultheader[$i]->PhysicalAddress);
                                    }
                                   /* if(strpos($Resultheader[$i]->FriendlyAddress, "Content") !== false){
                                        array_push($NotificationContentarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                        array_push($NotificationContentPhysical,$Resultheader[$i]->PhysicalAddress);
                                    }*/
                                    if(strpos($Resultheader[$i]->FriendlyAddress, "sensor") !== false){
                                        array_push($SensorarrayFriendly,$Resultheader[$i]->FriendlyAddress);
                                        array_push($SensorPhysical,$Resultheader[$i]->PhysicalAddress);
                                    }
                                    
                                }
                                if(!empty($LEDarrayFriendly)){
                                    echo '<li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>LED</span></a>
                                    <ul class="collapse">';
                                    for ($i = 0; $i < count($LEDarrayFriendly); $i++) {
                                        echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$LEDarrayPhysical[$i].'>'.$LEDarrayFriendly[$i].' </a></li>';                                    
                                    }
                                    echo '</ul></li>';
                                }
                                if(!empty($TimerarrayFriendly)){
                                    echo '<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Timer</span></a>
                                <ul class="collapse">';
                                for ($i = 0; $i < count($TimerarrayFriendly); $i++) {
                                    echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$TimerarrayPhysical[$i].'>'.$TimerarrayFriendly[$i].' </a></li>';                                    
                                }
                                echo '</ul></li>';
                                }
                                if(!empty($LandRequestarrayFriendly)){
                                    echo '<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Land Requests</span></a>
                                <ul class="collapse">';
                                for ($i = 0; $i < count($LandRequestarrayFriendly); $i++) {
                                    echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$LandRequestPhysical[$i].'>'.$LandRequestarrayFriendly[$i].' </a></li>';                                    
                                }
                                echo '</ul></li>';
                                }
                                if(!empty($LandarrayFriendly)){
                                    echo '<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>My Lands</span></a>
                                <ul class="collapse">';
                                for ($i = 0; $i < count($LandarrayFriendly); $i++) {
                                    echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$LandPhysical[$i].'>'.$LandarrayFriendly[$i].' </a></li>';                                    
                                }
                                echo '</ul></li>';
                                }
                                if(!empty($PlantarrayFriendly)){
                                    echo '<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Plants</span></a>
                                <ul class="collapse">';
                                for ($i = 0; $i < count($PlantarrayFriendly); $i++) {
                                    echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$PlantPhysical[$i].'>'.$PlantarrayFriendly[$i].' </a></li>';                                    
                                }
                                echo '</ul></li>';
                                }
                                if(!empty($AdminarrayFriendly)){
                                    echo '<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Admins</span></a>
                                <ul class="collapse">';
                                for ($i = 0; $i < count($AdminarrayFriendly); $i++) {
                                    echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$AdminPhysical[$i].'>'.$AdminarrayFriendly[$i].' </a></li>';                                    
                                }
                                echo '</ul></li>';
                                }
                                if(!empty($LandownerarrayFriendly)){
                                    echo '<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Landowners</span></a>
                                <ul class="collapse">';
                                for ($i = 0; $i < count($LandownerarrayFriendly); $i++) {
                                    echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$LandownerPhysical[$i].'>'.$LandownerarrayFriendly[$i].' </a></li>';                                    
                                }
                                echo '</ul></li>';
                                }
                                
                                /*if(!empty($NotificationContentarrayFriendly)){
                                    echo '<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Notification Content</span></a>
                                <ul class="collapse">';
                                for ($i = 0; $i < count($NotificationContentarrayFriendly); $i++) {
                                    echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$NotificationContentPhysical[$i].'>'.$NotificationContentarrayFriendly[$i].' </a></li>';                                    
                                }
                                echo '</ul></li>';
                                }*/
                                if(!empty($SensorarrayFriendly)){
                                    echo '<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Sensors</span></a>
                                <ul class="collapse">';
                                for ($i = 0; $i < count($SensorarrayFriendly); $i++) {
                                    echo '<li><a style="font-size:120%; aria-expanded="true" text-align:center" href='.$SensorPhysical[$i].'>'.$SensorarrayFriendly[$i].' </a></li>';                                    
                                }
                                echo '</ul></li>';
                                }
                                

                                
                            ?>
                    
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                    <span><?php echo Notification::countnotifications(); ?></span>
                                </i>
                                <div class="dropdown-menu bell-notify-box notify-box">
                                    <span class="notify-title">You have <?php echo Notification::countnotifications(); ?> notifications</span>
                                    <div class="nofity-list">
                                        <?php  
                                            $Resultnotifications=Notification::viewnotifications();
                                            if(!empty($Resultnotifications)){
                                                for ($j=0;$j<count($Resultnotifications);$j++){
                                                    echo '<a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                                    <div class="notify-text">
                                                        <p>'.$Resultnotifications[$j]->content.' in land of ID = '.$Resultnotifications[$j]->land_ID.', which is located in '.$Resultnotifications[$j]->location.'</p>
                                                        <span>'.$Resultnotifications[$j]->DateTime.'</span>
                                                    </div>
                                                    </a>';
                                                }
                                            }
                                            else{
                                                echo '<p> No notifictions</p>';
                                            }
                                        ?>
                                        
                                
                                    </div>
                                </div>
                            </li>
                            <li>
                                    <img class="avatar user-thumb" src="images/avatar.jpg" alt="avatar" data-toggle="dropdown">
                                    <div class="dropdown-menu">
                                    <form  method="get" >
                                        <a class="dropdown-item" href="#">Messages</a>
                                        <a class="dropdown-item" href="#">Settings</a>
                                        <a class="dropdown-item"><button style="background-color: white; color: black; border: none; text-align: center; text-decoration: none;
                                        display: inline-block; cursor: pointer;" name="Logout"> Logout</button></a>
                                    </form>
                                    </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <div class="main-content-inner">