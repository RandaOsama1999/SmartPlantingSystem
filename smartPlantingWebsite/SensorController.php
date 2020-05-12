<?php
require_once 'classUserModel.php';
require_once 'classUserView.php';
include_once 'classSensorView.php';
include_once 'classSensorModel.php';
include_once 'AlertMessages.php';

class SensorController
{
    public static function AddNew()
    { 
        SensorView::AddNew();
        if(isset($_POST['Add']))
        {
            $data=new sensor();
            $data->Type=$_POST['Name'];
            $Result= sensor::addnew($data);
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
       
    }
    public static function Delete()
    {
        SensorView::Deleteview();
       
    }
    // public static function deleting($sensorID)
    // {
    //     SensorView::Deleteview();
       
        
    // }
    
}

?>