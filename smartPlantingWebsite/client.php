<?php
include_once 'classNotification.php';
include_once 'acceptnewrequest.php';
include_once 'rejectnewrequest.php';
include_once "classDatabase.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//session_start();

 
class Subject implements \SplSubject
{
     
    public $state;

     
    private $observers;
    
    public function __construct()
    {
        $this->observers = new \SplObjectStorage;
    }
 
    public function attach(\SplObserver $observer) 
    {
        echo "Subject: Attached an observer.\n";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
        echo "Subject: Detached an observer.\n";
    }
    public function notify() 
    {
        echo "Subject: Notifying observers...\n";
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
    public function someBusinessLogic()
    {
        $this->notify();
    }
}
class ConcreteObserverA implements \SplObserver
{
    private $status;
 
    public function __construct($status) {
        $this->status = $status;
    }
    public function update(\SplSubject $subject)
    {
        $obj=new Notification();//Sending to Admin
        $obj->UserType_ID='1';
        
        $msg1=' The Request has been'." ".$this->status." ". 'for the land with ID: '   ." ".$_GET['landid'];
        
        $obj->Notification=$msg1;
        $obj->User_ID=$_SESSION['id'];
        
        Notification::sendmail($obj);
    }
}

class ConcreteObserverB implements \SplObserver
{
    private $status;
 
    public function __construct($status) {
        $this->status = $status;
    }
    public function update(\SplSubject $subject) 
    { 
        $obj=new Notification();//Sending to Landowner
        $obj->UserType_ID='2';
        $msg1=' The Admin has'." ".$this->status." ".'the request of your land with ID: ' ." ".$_GET['landid'];
        $obj->Notification=$msg1;
        $land=$_GET['landid'];
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM land WHERE ID=".$land."";
        $result = mysqli_query($mysql,$sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {         
                $user=$row['landowner_ID'];
            }
        } 
        $obj->User_ID=$user;

        Notification::sendmail($obj);
    }
}
$page = basename($_SERVER['PHP_SELF']);
if($page==="acceptnewrequest.php"){
    $subject = new Subject();
        
    $o1 = new ConcreteObserverA("accepted");
    $subject->attach($o1);
        
    $o2 = new ConcreteObserverB("accepted");
    $subject->attach($o2);
        
    $subject->someBusinessLogic();
    header('location: ViewAllLandsRequests.php');
}
else{
    $subject = new Subject();
    
    $o1 = new ConcreteObserverA("rejected");
    $subject->attach($o1);
        
    $o2 = new ConcreteObserverB("rejected");
    $subject->attach($o2);
        
    $subject->someBusinessLogic();
    header('location: ViewAllLandsRequests.php');
}


 
 
?>