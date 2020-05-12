<?php
include_once "classDatabase.php";
require_once 'classGender.php';
require_once 'classUserModel.php';

class UserView
{
    public static function Login()
    {
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
                                <p>Hello there, Sign in and start managing your greenhouse</p>
                            </div>
                            <div class="login-form-body">
                                <div class="form-gp">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" id="exampleInputEmail1" required>
                                    <i class="ti-email"></i>
                                    <div class="text-danger"></div>
                                </div>
                                <div class="form-gp">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password"  name ="password" id="exampleInputPassword1" required>
                                    <i class="ti-lock"></i>
                                    <div class="text-danger"></div>
                                </div>
                                <div class="row mb-4 rmber-area">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                            <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="submit-btn-area">
                                    <button id="form_submit" type="submit" name="send">Submit <i class="ti-arrow-right"></i></button>
                                </div>
                                <div class="form-footer text-center mt-5">
                                    <p class="text-muted">Dont have an account? <a href="page-register.php">Sign up</a></p>
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
    public static function UpdateMyself($Result)
    {
        $Result2=Gender::ViewDropdown();

        include_once "header.php";
        echo '
        <div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Update your info</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
        <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">First Name<span class="text-danger">*</label>
            <input id="user" type="text" name="firstname"  pattern="[A-Za-z]{3,15}" title="InLettres more than 3 letters, less than 8" class="form-control" value='.$Result->FirstName.' required>
        </div>
        <div class="form-group">
            <label for="pass" class="label" style="font-size:20px;color:black;" >Family Name<span class="text-danger">*</label>
            <input id="user" type="text"  name="familyname"  pattern="[A-Za-z]{3,15}" title="InLettres more than 3 letters, less than 8" class="form-control"  value='.$Result->FamilyName.' required  >
        </div>
        <div class="form-group">
            <label for="example-date-input" class="col-form-label" style="font-size:20px;color:black;">Date of Birth<span class="text-danger">*</label>
            <input class="form-control" type="date" name="dateofbirth" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d)" id="dateofbirth" value='.$Result->DateOfBirth.' required>
        </div>
        <div class="form-group">
            <label for="pass" class="label" style="font-size:20px;color:black;" >Mobile Number<span class="text-danger">*</label>
            <input type="tel" name="MobileNumber" pattern="[0-9]{11}" title="please enter 11 numbers" class="form-control" value=0'.$Result->Mobile.' required>
        </div>
        <div class="form-group">
            <label class="col-form-label" style="font-size:20px;color:black;" >Gender<span class="text-danger">*</label>
            <select class="form-control" name="gender" id="gender"  required>';
                            for($k=0;$k<count($Result2);$k++)
                            {
                                if($Result->Gender == $Result2[$k]->ID){
                                echo '<option  value="'.$Result2[$k]->ID.'" selected>'.$Result2[$k]->Grade.'</option> ';
                                }
                                else{
                                    echo '<option  value="'.$Result2[$k]->ID.'">'.$Result2[$k]->Grade.'</option> ';
                                }
                            } 
            echo "
            </select>
        </div>
        <button type='submit' name='save' class='btn btn-primary btn-flat m-b-30 m-t-30' style='text-align:center; background-color: rgba(45, 65, 21)'>save</button>
        </form>

        </div>
        
        </div>
        </div>";
        include_once "footer.php";
    }
    public static function AddNewUser()
    {
        $Result2=Gender::ViewDropdown();

        include_once "header.php";
        echo '<div class="col-12 mt-5">
        <div class="card">
        <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Add new Admin</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
        <div class="form-group">
        <label for="user" class="label" style="font-size:20px;color:black;">First Name<span class="text-danger">*</label>
            <input id="user" type="text" name="FirstName" pattern="[A-Za-z]{3,15}" title="InLettres more than 3 letters, less than 15" class="form-control" required>
        </div>
        <div class="form-group">
        <label for="user" class="label" style="font-size:20px;color:black;">Family Name<span class="text-danger">*</label>
        <input id="user" type="text" name="FamilyName" pattern="[A-Za-z]{3,15}" title="InLettres more than 3 letters, less than 8" class="form-control" required ><br>
</div>
<div class="form-group">

        <label for="user" class="label" style="font-size:20px;color:black;">Mobile<span class="text-danger">*</label>
        <input id="user" type="tel" name="Mobile" pattern="[0-9]{11}" title="please enter 11 numbers" class="form-control"  required >
</div>
<div class="form-group">

        <label for="user" class="label" style="font-size:20px;color:black;">Email<span class="text-danger">*</label>
        <input id="user" type="email" name="Email" class="form-control"  required ><br>
</div>
<div class="form-group">

        <label for="user" class="label" style="font-size:20px;color:black;">Password<span class="text-danger">*</label>
        <input id="user" type="text" name="Password" class="form-control"   required >
       </div>
       <div class="form-group">

        <label for="user" class="label" style="font-size:20px;color:black;">Gender<span class="text-danger">*</label> 
        <select class="form-control" name="Gender" id="Gender"  required>';
                            for($k=0;$k<count($Result2);$k++)
                            {
                                echo '<option  value="'.$Result2[$k]->ID.'">'.$Result2[$k]->Grade.'</option> ';
                            } 
            echo '
            </select>    

        <div class="form-group">
        <label for="pass" class="label" style="font-size:20px;color:black;">Date of birth <span class="text-danger">*</label>
        <input type="date" name="dateofbirth" id="dateofbirth" class="form-control"   required>
    </div>
    <button type="submit" name="Add" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Add</button>

</form></div>
</div>
</div>';

include_once "footer.php";
    }
    
   public static function Delete()
        {
            $Result2=Users::SelectAll();

            include_once "header.php";
            echo '<div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Delete Admin</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">Email<span class="text-danger">*</label>
            <select class="form-control" name="CurrentOptions2" id="CurrentOptions2"  required>';
                            for($k=0;$k<count($Result2);$k++)
                            {
                                echo '<option  value="'.$Result2[$k]->Email.'">'.$Result2[$k]->Email.'</option> ';
                            } 
            echo '
            </select>   
            </div>
            <button type="submit" id="AddingNewOptionsID"  name="Delete" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Delete</button>
       
        </form>
        </div>
        </div>
        </div>';
include_once "footer.php";
        }
        public static function ViewAllLandowners()
        {
            include_once "header.php";
      $Result=Users::SelectAllLandowners();
      echo '<div class="row">
      <div class="col-12 mt-5">
      <div class="card">
          <div class="card-body">
              <h4 class="header-title">View your land requests & withdraw a request if you want</h4>
              <div class="data-tables">
                  <table id="dataTable" class="text-center">
                      <thead class="bg-light text-capitalize">
                              <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Land ID</th>
                                    <th scope="col">Plant Type</th>

                                </tr>
                            </thead>
                            <tbody>
                            ';
                            if($Result !=NULL)
                            {
                                for($k=0;$k<count($Result);$k++)
                                {
                                echo '
                                <tr>
                                    <th scope="row">'.$Result[$k]->ID.'</th>
                                    <td>'.$Result[$k]->Email.'</td>
                                    <td>'.$Result[$k]->land_ID.'</td>
                                    <td>'.$Result[$k]->planttype.'</td>
                                </tr>';
                                } 
                            }
                            else
                            {
                                echo'<th scope="row">NO DATA TO BE SHOWN</th>';
                                
                            }
                            '  
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div></div>
                </div>
            </div>';
                                     
     
      
include_once "footer.php";
        }
}
?>