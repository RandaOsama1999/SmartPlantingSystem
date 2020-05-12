<?php
require_once 'classLandModel.php';
require_once 'classLandView.php';
require_once 'classLandUpdateRequest.php';
include_once "classDatabase.php";
include_once "Statistics_Interface.php";
include_once "AlertMessages.php";

class LandController implements Statistics{
    public static function AddLandRequest()
    {
        LandView::AddLandRequest();
        if(isset($_POST['send'])){
            $land=new Land();
            $land->landowner_ID=$_SESSION['id'];
            $land->address_ID=$_POST['area'];
            $land->location=$_POST['location'];
            $land->greenhouse_L=$_POST['length'];
            $land->greenhouse_W=$_POST['width'];
            $land->greenhouse_H=$_POST['height'];
            $land->plantType_ID=$_POST['plant'];
            $Result=Land::AddLandRequest($land);
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
        }
    }
    public static function DeleteLandRequest()
    {
        $Result=Land::ShowAllLandRequests();
        LandView::DeleteLandRequest($Result);
    }
    public static function UpdateLandRequest($landid)
    {   
        $Result=Land::getdataTOupdate($landid);
        LandView::UpdateLandRequest($Result);
        if(isset($_POST['send'])){
            $landID=$landid;
            $itemtobeupdated=$_POST['itemtobeupdated'];
            $newitem=$_POST['newitem'];
            $newvalue=$_POST['newvalue'];
            
           
            if($itemtobeupdated=="1")
            {
                $Result=Land::UpdateLandRequest($landID, "City", $newitem);
                
            }
            else if($itemtobeupdated=="6")
            {
                $Result1=Land::UpdateLandRequest($landID, "Plant Type", $newitem);
                
            }
            else{
                $Result2= Land::UpdateLandRequest($landID, $itemtobeupdated, $newvalue);
                   
            }
            $Result4=land::updateRequestTO1($landID);
            if($Result4==TRUE)
                {
                    AlertMessages::AlertMeassage("success","Sucessfully Added");
                }
            else
                {
                    AlertMessages::AlertMeassage("danger","Somthing went wrong");
                }
        }
    }
    public static function ViewAllLands()
    {
        $Result=Land::ShowAllLandRequests2();
        LandView::ViewAllLands($Result);
    }
    public static function AcceptRejectLandRequests()
    {
        $Result=Land::AcceptRejectLandRequests();
        LandView::AcceptRejectLandRequests($Result);
    }
    public static function AcceptRejectCureentLand()
    {
        $Result=Land::AcceptRejectCureentLand();
        LandView::AcceptRejectCureentLand($Result);
    }
    
    public static function viewReport($landid)
    {
        $out=Land::viewReport($landid);
        LandView::viewReport($out);
    }
    public static function AcceptRejectUpdateRequests($landid)
    {
        $Result=LandUpdateRequest::AcceptRejectUpdateRequests($landid);
        //echo($Result[0]->ItemToBeUpdated);
        
       LandView::AcceptRejectUpdateRequests($Result);
    }
}

?>