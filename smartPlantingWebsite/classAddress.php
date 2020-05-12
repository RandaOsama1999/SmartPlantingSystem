<?php
include_once "classDatabase.php";
class Address
{
    public  $ID;
    public  $Name;

    public function __construct() {
    }
    public static function ViewDropdown()
    {
        $conn=DB::getInstance();
$mysql=$conn->getConnection();
$conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT * FROM address WHERE Parent_ID=0";
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($DataSet))
		{
            $MyObject= new Address();
            $MyObject->ID=$row["ID"];
            $MyObject->Name=$row["Name"];
			$Result[$i]=$MyObject;
			$i++;
		}
		return $Result;
        //$conn->close();
    }
}
?>