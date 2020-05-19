<?php
require_once 'classLandownerModel.php';
require_once 'classLandownerView.php';
include_once "Statistics_Interface.php";
include_once "AlertMessages.php";

class LandownerController implements Statistics{
    public static function SignUp()
    {
        LandownerView::SignUp();
        if(isset($_POST['send'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $date = $_POST['date'];
            $datetime=strtotime($date);
            $Year=date("Y",$datetime);
            $CurrentYear=date("Y");
            $Age=$CurrentYear-$Year;

            if($CurrentYear-$Year>="21")
            {
             
           
              $gender = $_POST['gender'];
              $mobile = $_POST['mobile'];
              $email = $_POST['email'];
              $pass1 = $_POST['pass1'];
              $pass2 = $_POST['pass2'];
             
              if($pass1==$pass2)
              {
              $Result=Landowner::SignUp ($fname,$lname,$date,$gender,$mobile,$email,$pass1);
              if($Result==TRUE)
              {
                AlertMessages::AlertMeassage("success","Sucessfully Added");
              }
              elseif($Result==NULL)
              {
                AlertMessages::AlertMeassage("warning","Already Exists");
              }
              else 
              {
                AlertMessages::AlertMeassage("danger","Somthing went wrong");
              }
               }
              else 
              {
                AlertMessages::AlertMeassage("warning","Passwords are not the same");
              }
            }
            else{
              AlertMessages::AlertMeassage("warning","Check the date, the date you have entered is: $Age");
            }
        }
    }
    public  function viewReport($landid)
    {
        $out=(new Landowner)->viewReport($landid);
        (new LandownerView)->viewReport($out);
    } 
}

?>