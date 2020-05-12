<?php
require_once 'classUserModel.php';
require_once 'classUserView.php';
require_once 'classLedLight.php';
require_once 'classLedLightView.php';
require_once 'AlertMessages.php';
class LedColorController
{
    public static function viewLedColors()
    {
        LedColorView::ViewAll();
    }
    public static function creatnewled()
    {
        LedColorView::AddNewLEDLight();
        if(isset($_POST['Add']))
        {
          $obj = new LedColors();
          $obj->color=$_POST['Name'];
          $Result=LedColors::create($obj);
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
    public static function deleteLEDLight()
  {
    LedColorView::Delete();
       if(isset($_POST['Delete']))
       {
           $obj = new LedColors();
           $obj->ID=$_POST['CurrentOptions2'];
          $Result= LedColors::delete($obj);
          if($Result==NULL)
          {
            AlertMessages::AlertMeassage("success","Sucessfully Deleted");
          }
          elseif($Result==FALSE)
           {
            AlertMessages::AlertMeassage("danger","Somthing went wrong");
          }
          //  echo '<script type="text/javascript">';
          //   echo 'window.location.href="DeleteLEDLight.php";';
          //   echo '</script>';
       }
  }
  public static function plantled()
  {
    LedColorView::plantled();
       if(isset($_POST['Update']))
       {
           $Stage_ID=$_POST['Stage_ID'];
           $LED_ID=$_POST['LED_ID'];
           $Plant_ID=$_POST['Plant_ID'];
           $Result=LedColors::plantled($Stage_ID,$LED_ID,$Plant_ID);
           if($Result==TRUE)
           {
            AlertMessages::AlertMeassage("success","Sucessfully Added");
           }
           elseif ($Result==NULL)
            {
              AlertMessages::AlertMeassage("warning","Already Exists");
            }
           else
          {
            AlertMessages::AlertMeassage("danger","Somthing went wrong");
          }
            
         
          //  echo '<script type="text/javascript">';
          //   echo 'window.location.href="AddPlantLEDLight.php";';
          //   echo '</script>';
       }
  }
  public static function viewplantled()
  {
    LedColorView::plantled();
       if(isset($_POST['Update']))
       {
           $Stage_ID=$_POST['Stage_ID'];
           $LED_ID=$_POST['LED_ID'];
           $Plant_ID=$_POST['Plant_ID'];
           LedColors::plantled($Stage_ID,$LED_ID,$Plant_ID);
           echo '<script type="text/javascript">';
            echo 'window.location.href="AddPlantLEDLight.php";';
            echo '</script>';
       }
  }
}