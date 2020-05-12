<?php
require_once 'classUserModel.php';
require_once 'classUserView.php';
require_once 'classPlanttype.php';
require_once 'classPlanttypeView.php';
include_once "AlertMessages.php";

class PlantController
{ 
     
    public static function AddNew()
    { 
        PlantView::AddNewPlant();
        if(isset($_POST['Add']))
        {

            $Plant= new Planttype();
            $Plant->plantName=$_POST['Name'];
            $Plant->HourToBeOpened=$_POST['Name2'];
            $Plant->HourToBeClosed=$_POST['Name3'];
            $Plant->Temperature=$_POST['Name1'];
            $Result=Planttype::add($Plant);
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
    public static function Update($landid)
    { 
        $Result=Planttype::getdataTOupdate($landid);
        PlantView::Update($Result);
        if(isset($_POST['Add'])){
            $temp=$_POST['Name1'];
            $houropen=$_POST['Name2'];
            $hourclosed=$_POST['Name3'];
           $Result=Planttype::update($landid,$temp, $houropen, $hourclosed);
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
    public static function Delete()
    { 
        PlantView::Delete();
        if(isset($_POST['Delete']))
        {
            $Plant= new Planttype();
            $Plant->ID=$_POST['CurrentOptions2'];
            $Result=Planttype::Delete($Plant);
        
        if($Result==TRUE)
            {
              AlertMessages::AlertMeassage("success","Sucessfully Deleted");
            }
            else
            {
              AlertMessages::AlertMeassage("danger","Somthing went wrong");
            }
        }
        
    }
    public static function View()
    { 
        PlantView::ViewAllForStatistics();
    }
    
}

 



?>