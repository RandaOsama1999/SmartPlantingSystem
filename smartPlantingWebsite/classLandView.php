<?php
include_once "classDatabase.php";
include_once "classAddress.php";
include_once "classPlanttype.php";
include_once "Statistics_Interface.php";

class LandView implements Statistics
{
    public static function AddLandRequest()
    {
        $Result2=Address::ViewDropdown();
        $Result3=Planttype::ViewDropdown();

        include_once "header.php";
        echo '<!DOCTYPE html>
        <html lang="en">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <body>
        <div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Add the greenhouse details</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
        <div class="form-group">
            <label class="col-form-label" style="font-size:20px;color:black;" >City<span class="text-danger">*</label>
            <select class="form-control" name="city" id="city"  required>;
            <option value=4>Choose the greenhouse city</option>';
                for($k=0;$k<count($Result2);$k++)
                {
                    echo '<option  value="'.$Result2[$k]->ID.'">'.$Result2[$k]->Name.'</option> ';
                } 
            echo '
            </select>
            <label for="pass" class="label" style="font-size:20px;color:black;" >Area<span class="text-danger">*</label>
                        <select class="form-control" name="area" id="area" required>

        </select>
        <script type="text/javascript">
        $(document).ready(function(){
        $("#city").on("change",function(){
        var cityID = $(this).val();
        if(cityID){
            $.ajax({
                type:"POST",
                url:"ajaxpro.php",
                data:"city_id="+cityID,
                success:function(html){
                    $("#area").html(html);
                }
            }); }
        });
        });
        </script>
        </div>
        <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">Location in details<span class="text-danger">*</label>
            <input id="user" type="text" name="location" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase letter For example: 7st Citystars nasr city" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="col-form-label" style="font-size:20px;color:black;" >Plant Type<span class="text-danger">*</label>
            <select class="form-control" name="plant" id="plant"  required>';
                            for($k=0;$k<count($Result3);$k++)
                            {
                                echo '<option  value="'.$Result3[$k]->ID.'">'.$Result3[$k]->plantName.'</option> ';
                            } 
            echo '
            </select>
        </div>
        <h5 style="color: black">Greenhouse dimensions</h5>
        <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="length">Length</label>
            <input type="number" class="form-control" name="length" id="length" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="width">Width</label>
            <input type="number" class="form-control" name="width" id="width" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="height">Height</label>
            <input type="number" class="form-control" name="height" id="height" required>
        </div>
    </div>
        <button type="submit" name="send" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">send</button>
        </form>

        </div>
        </div>
        </div></body>';
        include_once "footer.php";
    }
    public static function DeleteLandRequest($Result)
    {
        include_once "header.php";

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
                                    <th scope="col">Location</th>
                                    <th scope="col">Greenhouse dimensions</th>
                                    <th scope="col">Plant Type</th>
                                    <th scope="col">Withdraw</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            if($Result!=NULL)
                            {for($k=0;$k<count($Result);$k++)
                            {
                                echo '
                                <tr>
                                    <th scope="row">'.$Result[$k]->ID.'</th>
                                    <td>'.$Result[$k]->location.',  '.$Result[$k]->area.', '.$Result[$k]->city.'</td>
                                    <td>'.$Result[$k]->greenhouse_L.' x '.$Result[$k]->greenhouse_W.' x '.$Result[$k]->greenhouse_H.'</td>
                                    <td>'.$Result[$k]->planttype.'</td>
                                    <td><a href="delete.php?landid='.$Result[$k]->ID.'"><i class="ti-trash" id='.$Result[$k]->ID.'></i></a></td>
                                </tr>';
                            } }
                            else {
                                echo '
                                <tr>
                                    <th scope="row">NO DATA</th></tr>';
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
    public static function ViewAllLands($Result)
    {
        include_once "header.php";

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
                                    <th scope="col">Location</th>
                                    <th scope="col">Greenhouse dimensions</th>
                                    <th scope="col">Plant Type</th>
                                    <th scope="col">View Land Statistics</th>
                                    <th scope="col">Update Request</th>
                                    <th scope="col">Delete Request</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            if( $Result!=NULL)
                           { 
                                for($k=0;$k<count($Result);$k++)
                                {
                                    echo '
                                    <tr>
                                        <th scope="row">'.$Result[$k]->ID.'</th>
                                        <td>'.$Result[$k]->location.',  '.$Result[$k]->area.', '.$Result[$k]->city.'</td>
                                        <td>'.$Result[$k]->greenhouse_L.' x '.$Result[$k]->greenhouse_W.' x '.$Result[$k]->greenhouse_H.'</td>
                                        <td>'.$Result[$k]->planttype.'</td>
                                        <td><a href="ViewOwnLandStatistics.php?landid='.$Result[$k]->ID.'"><i class="ti-stats-up" id='.$Result[$k]->ID.'></i></a></td>
                                        <td><a href="updatelandrequest.php?landid='.$Result[$k]->ID.'"><i class="ti-save" id='.$Result[$k]->ID.'></i></a></td>
                                        <td><a href="delete2.php?landid='.$Result[$k]->ID.'"><i class="ti-trash" id='.$Result[$k]->ID.'></i></a></td>
                                    </tr>';
                                } 
                            }
                            else
                            {
                               echo'<td>NO DATA</td>';

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
    public static function UpdateLandRequest($Result)
    {
        $Result2=Address::ViewDropdown();
        $Result3=Planttype::ViewDropdown();

        include_once "header.php";
        echo '<!DOCTYPE html>
        <html lang="en">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <body>
        <div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Add the greenhouse details</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
        <div class="form-group">
        <fieldset disabled>
            <label class="col-form-label" style="font-size:20px;color:black;" >Land ID<span class="text-danger">*</label>
            <input id="user" type="text" name="firstname" class="form-control" value='.$Result->ID.' required>
            </fieldset>
            </div>
        <div class="form-group">
            <label for="pass" class="label" style="font-size:20px;color:black;" >Item to be Updated<span class="text-danger">*</label>
                        <select class="form-control" name="itemtobeupdated" id="itemtobeupdated" required>
                        <option  value="0">Item to be Updated</option> 
                        <option  value="1">Area</option> 
                        
                        <option  value="6">PlantType</option> 
        </select>
        </div>

        <div class="form-group">
        <label for="pass" class="label" style="font-size:20px;color:black;" >choose New Value of the selected item <span class="text-danger">*</label>
                    <select class="form-control" name="newitem" id="newitem" required >
                    
    </select>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
    $("#itemtobeupdated").on("change",function(){
    var cityID = $(this).val();
    
    if(cityID>0){
        $.ajax({
            type:"POST",
            url:"ajaxpro2.php",
            data:"city_id="+cityID,
            success:function(html){
                $("#newitem").html(html);
            }
        }); }
    });
    });
    </script>
        
        <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">New Value for location/Length/Width/Heigth<span class="text-danger">*</label>
            <input id="user" type="text" name="newvalue" id ="newvalue" class="form-control" required >
        
        </div>
        <button type="submit" name="send" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">send</button>
      
        </form>

        <script >
        function validateForm(){
            var z =document.getElementById("newvalue").value;
            alert(z);
            if(!/^[0-9]+$/.test(z)){
              alert("Please only enter numeric characters only for your Age! (Allowed input:0-9)")
            }
            </script>
          
        </div>
        </div>
        </div></body>';
        include_once "footer.php";
    }
    public static function AcceptRejectLandRequests($Result)
    {
        include_once "header.php";

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
                                    <th scope="col">Location</th>
                                    <th scope="col">Greenhouse dimensions</th>
                                    <th scope="col">Plant Type</th>
                                    <th scope="col">Accept</th>
                                    <th scope="col">Reject</th>

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
                                        <td>'.$Result[$k]->location.',  '.$Result[$k]->area.', '.$Result[$k]->city.'</td>
                                        <td>'.$Result[$k]->greenhouse_L.' x '.$Result[$k]->greenhouse_W.' x '.$Result[$k]->greenhouse_H.'</td>
                                        <td>'.$Result[$k]->planttype.'</td>
                                        <td><a href="acceptnewrequest.php?landid='.$Result[$k]->ID.'"><i class="ti-check" id='.$Result[$k]->ID.'></i></a></td>
                                        <td><a href="rejectnewrequest.php?landid='.$Result[$k]->ID.'"><i class="ti-close" id='.$Result[$k]->ID.'></i></a></td>
                                    </tr>';
                                } 
                            }
                            else
                            {
                                echo '<td>NO DATA</td>';
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
    public static function AcceptRejectCureentLand($Result)
    {
        include_once "header.php";

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
                                    <th scope="col">Location</th>
                                    <th scope="col">Greenhouse dimensions</th>
                                    <th scope="col">Plant Type</th>
                                    <th scope="col">View Update request</th>
                                    <th scope="col">Accept Delete Request</th>
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
                                        <td>'.$Result[$k]->location.',  '.$Result[$k]->area.', '.$Result[$k]->city.'</td>
                                        <td>'.$Result[$k]->greenhouse_L.' x '.$Result[$k]->greenhouse_W.' x '.$Result[$k]->greenhouse_H.'</td>
                                        <td>'.$Result[$k]->planttype.'</td>
                                        <td><a href="viewupdaterequests.php?landid='.$Result[$k]->ID.'"><i class="ti-layers-alt" id='.$Result[$k]->ID.'></i></a></td>
                                        <td><a href="acceptdeleterequest.php?landid='.$Result[$k]->ID.'"><i class="ti-check" id='.$Result[$k]->ID.'></i></a></td>
                                    </tr>';
                                } 
                            }
                            else
                            {
                               echo'<td>NO DATA</td>';
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
    public static function AcceptRejectUpdateRequests($Result)
    {
        include_once "header.php";

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
                                    <th scope="col">ItemToBeUpdated</th>
                                    <th scope="col">NewValue </th>
                                    
                                    <th scope="col">Accept</th>
                                    <th scope="col">Reject</th>

                                    <th scope="col"></th>
                                     
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            if($Result !=NULL)
                            {
                                    for($k=0;$k<count($Result);$k++)
                                {
                                    //$_SESSION["landid"] = $Result[$k]->ID;
                                    echo '
                                    <tr>
                                        <th scope="row">'.$Result[$k]->Land_ID.'</th>
                                        
                                        <td>'.$Result[$k]->ItemToBeUpdated.'</td>
                                        <td>'.$Result[$k]->NewValue.'</td>
                                        
                                        <td><a href="accept_Update_request.php?landid='.$Result[$k]->Land_ID.'&item='.$Result[$k]->ItemToBeUpdated.
                                        '&ID='.$Result[$k]->Land_ID.
                                        '&new='.$Result[$k]->NewValue.'&rowid='.$Result[$k]->ID.
                                        ' "><i class="ti-check" id='.$Result[$k]->Land_ID.'></i></a></td>
                                    
                                        <td><a href="reject_Update_request.php?landid='.$Result[$k]->Land_ID.'&RowID='.$Result[$k]->ID.
                                        '"><i class="ti-close" id='.$Result[$k]->Land_ID.'></i></a></td>
                                        <td></td>
                                        </tr>';
                                } 
                            }
                            else
                            {
                                echo '
                                
                                    <th scope="row">NO DATA</th>';
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
    



        //////////////////
        public static  function viewReport($Result)
        {
            include_once "header.php";
            $percentage=0;
             $ctr=0;
             $ctrFinal=$ctr+7;
             $dataPoints= array( 
                array("y" => 0,"label" => " " )
            );
            $Weeks= array( 
                "Week1","Week2","Week3","Week4","Week5","Week6","Week7","Week8","Week9","Week10","Week11","Week12","Week13","Week14"
                ,"Week15","Week16","Week17","Week18","Week19","Week20" );
                 
                
//Kam week let they are 2 weeks
//3yza 25od awel 7 in each land 
  $size=$Result[0]->arrsize;
                //echo($size);
                $size=$size/7;
for($k=0;$k<$size;$k++)
{
            for($i=0;$i<count($Result);$i++)//Awel land
            {
                    for($j=$ctr;$j<$ctrFinal;$j++)
                    {
                        
                       
                        $percentage+=($Result[$i]->percentage[$j]);
                    }
            }
            array_push($dataPoints,array("y" =>$percentage/(7*count($Result)),"label" => $Weeks[$k]));
            $ctr=$ctrFinal;
            $ctrFinal=$ctr+7;
            $percentage=0;
 }
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>

window.onload = function() {
    CanvasJS.addColorSet("greenShades",
                [//colorSet Array

                "#0B6623",
                "#90EE90",
                "#3CB371",
                "#2E8B57",
                "#4F7942"
                ]);
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
    colorSet: "greenShades",
	title:{
		text: <?php echo json_encode("Plant through weeks"); ?>

	},
	axisY: {
		title: "Percentage",
		
		 
	},
	data: [{
		type: "bar",
		 
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints); ?>
	}]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="margin-bottom: 50px;margin-left:100px;height: 330px; width: 70%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>   

       <?php
    include_once "footer.php";
        }
}
?>