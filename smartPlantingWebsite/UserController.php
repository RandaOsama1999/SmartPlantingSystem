<?php
require_once 'classUserModel.php';
require_once 'classUserView.php';
include_once "AlertMessages.php";

class UserController{
    public static function Login()
    {
        UserView::Login();
        if(isset($_POST['send'])){
            $email = $_POST['email'];
            $pass = $_POST['password'];
            Users::Login ($email,$pass);
        }
    }
    public static function UpdateMyself($iD)
    {
        $Result=Users::getdataTOupdate($iD);
        UserView::UpdateMyself($Result);
        if(isset($_POST['save'])){
            $obj = new Users();
            $obj->ID=$iD;
            $obj->FirstName=$_POST['firstname'];
            $obj->FamilyName=$_POST['familyname'];
            $obj->DateOfBirth=$_POST['dateofbirth'];
            $obj->Mobile=$_POST['MobileNumber'];
            $obj->Gender=$_POST['gender'];
            $Result=Users::update($obj);
            if($Result==TRUE)
            {
                AlertMessages::AlertMeassage("success","Sucessfully Updated");
            }
            else
            {
                AlertMessages::AlertMeassage("danger","Somthing went wrong");
            }
        }
    }
    public static function AddNew()
    { 
        UserView::AddNewUser();
        if(isset($_POST['Add']))
        {
            $Users= new Users();
            $Users->FirstName=$_POST['FirstName'];
            $Users->FamilyName=$_POST['FamilyName'];
            $Users->DateOfBirth=$_POST['dateofbirth'];
            $Users->Mobile=$_POST['Mobile'];
            $Users->Gender=$_POST['Gender'];
            $Users->Email=$_POST['Email'];
            $Users->Password=$_POST['Password'];
           // $Users->usertype_ID=$_POST['Password'];

            $Result=Users::add($Users);
            if($Result==TRUE)
            {
                AlertMessages::AlertMeassage("success","Sucessfully Added");
            }
            else
            {
                AlertMessages::AlertMeassage("danger","Somthing went wrong");
            }
        }
        
    }
    public static function Delete()
    { 
        
        UserView::Delete();
        if(isset($_POST['Delete']))
        {
            
            $Users= new Users();
         
            $Users->Email=$_POST['CurrentOptions2'];
            
            $Result=Users::Delete($Users);
            if($Result==TRUE)
            {
                AlertMessages::AlertMeassage("success","Sucessfully Deleted");
            }
            else{
                AlertMessages::AlertMeassage("danger","Somthing went wrong");
            }
            
        }
        
    }
    public static function View()
    { 
         
        UserView::ViewAllLandowners();
         
        
    }
}

?>