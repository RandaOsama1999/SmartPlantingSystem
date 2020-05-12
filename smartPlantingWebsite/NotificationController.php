<?php
require_once 'classUserModel.php';
require_once 'classUserView.php';
include_once 'classNotificationView.php';
include_once 'classNotificationModel.php';

class NotificationController
{
    public static function AddNew()
    { 
        notificationView::AddNew();
       if(isset($_POST['Add']))
       {
           $notifi=new notification();
           $notifi->landownerID=$_POST["landownerEmail"];
           $notifi->landID=$_POST["landloaction"];
           $notifi->content=$_POST["Content"];
           notification::addnew($notifi);
        }
    }
    public static function Delete()
    {
        notificationView::Deleteview();
    }
    
}

?>