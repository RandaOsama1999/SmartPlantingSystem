<?php
include_once "classDatabase.php";
require_once 'classGender.php';
include_once "Statistics_Interface.php";

class LandownerView implements Statistics
{
    public static function SignUp()
    {
        $Result=Gender::ViewDropdown();
        echo '<!doctype html>
        <html class="no-js" lang="en">
        
        <head>
            <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <title>Login - srtdash</title>
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
            <!-- login area start -->
            <div class="login-area">
                <div class="container">
                    <div class="login-box ptb--100">
                    <form method="post">
                        <div class="login-form-head" style="background-color: green;">
                        <img src="images/7.png"  alt="logo" height="160" width="160">
                                <p>Sign up</p>
                            </div>
                            <div class="login-form-body">
                            <div class="form-gp">
                            <label for="exampleInputName1">First Name</label>
                            <input type="text" name="fname" pattern="[A-Za-z]{3,15}" title="InLettres more than 3 letters, less than 15" id="exampleInputName1" required>
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                            <label for="exampleInputName2">Last Name</label>
                            <input type="text" name="lname" pattern="[A-Za-z]{3,15}" title="InLettres more than 3 letters, less than 15" id="exampleInputName2" required>
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                            <input type="date" name="date" id="dob" required>
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                            <select name="gender" id="gender"  required>';
                            for($k=0;$k<count($Result);$k++)
                            {
                                echo '<option  value="'.$Result[$k]->ID.'">'.$Result[$k]->Grade.'</option> ';
                            } 
                            echo '
                            </select>
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                            <label for="mob">Mobile number</label>
                            <input type="text" name="mobile" required  pattern="[0-9]{11}" title="Please enter 11 numbers only" id="mob" required>
                            <i class="ti-mobile"></i>
                            <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" pattern="/^[a-zA-Z0-9.!#$%&"*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" required  id="exampleInputEmail1">
                                <i class="ti-email"></i>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="pass1" id="exampleInputPassword1" required>
                                <i class="ti-lock"></i>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-gp">
                                <label for="exampleInputPassword2">Confirm Password</label>
                                <input type="password" name="pass2" id="exampleInputPassword2" required>
                                <i class="ti-lock"></i>
                                <div class="text-danger"></div>
                            </div>
                                <div class="submit-btn-area">
                                    <button id="form_submit" type="submit" name="send">Submit <i class="ti-arrow-right"></i></button>
                                </div>
                                <div class="form-footer text-center mt-5">
                                    <p class="text-muted">Already have an account? <a href="page-login.php">Sign in</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- login area end -->
        
            <!-- jquery latest version -->
            <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
            <!-- bootstrap 4 js -->
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/owl.carousel.min.js"></script>
            <script src="assets/js/metisMenu.min.js"></script>
            <script src="assets/js/jquery.slimscroll.min.js"></script>
            <script src="assets/js/jquery.slicknav.min.js"></script>
            
            <!-- others plugins -->
            <script src="assets/js/plugins.js"></script>
            <script src="assets/js/scripts.js"></script>
        </body>
        
        </html>';
    }
    public static function viewReport($Result)
        {
            include_once "header.php";
            $percentage=0;
             $ctr=0;
             $ctrFinal=$ctr+7;
             $dataPoints= array( 
                array("y" => 0,"label" => " " )
            );
            $Weeks= array( 
                "Week1","Week2","Week3","Week4","Week5","Week6","Week7","Week8","Week9","Week10","Week11","Week12","Week13","Week14"
                ,"Week15","Week16","Week17","Week18","Week19","Week20" );
            for($i=0;$i<count($Result);$i++)
            {
                $size=$Result[$i]->arrsize;
                $size=$size/7;//kam week

               for($k=0;$k<$size;$k++)
                {
                   
                    for($j=$ctr;$j<$ctrFinal;$j++)
                    {
                        $percentage+=($Result[$i]->percentage[$j]);
                      
                        

                    }
                    
                     $ctr=$ctrFinal;
                    $ctrFinal=$ctr+7;
                    array_push($dataPoints,array("y" =>$percentage/7,"label" => $Weeks[$k]));
                    $percentage=0;
                }
                
               
            }

            
           
            //array_push($dataPoints,array("y" =>100,"label" => "Week2" ))
           // echo(($percentage/7)); 
            //$percentage=round(($percentage/7),1);

 
/*$dataPoints = array( 
	array("y" => $percentage,"label" => "Week1" ),
	array("y" => 12,"label" => "Week2" ),
	array("y" => 28,"label" => "Week3" ),
	array("y" => 18,"label" => "Week4" ),
	array("y" => 41,"label" => "Week5" )
);*/
?>
<!DOCTYPE HTML>
<html>
<head>
<script>

window.onload = function() {
    CanvasJS.addColorSet("greenShades",
                [//colorSet Array

                "#0B6623",
                "#90EE90",
                "#3CB371",
                "#2E8B57",
                "#4F7942"
                ]);
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
    colorSet: "greenShades",
	title:{
		text: <?php echo json_encode("Land through weeks"); ?>

	},
	axisY: {
		title: "Percentage",
		
		 
	},
	data: [{
		type: "bar",
		 
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints); ?>
	}]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="margin-bottom: 50px;margin-left:100px;height: 330px; width: 70%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>   

       <?php
    include_once "footer.php";
        }

}
?>