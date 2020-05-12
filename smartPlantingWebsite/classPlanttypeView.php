<?php
include_once "classDatabase.php";
class PlantView
{
        
        public static function AddNewPlant()
        {
            include_once "header.php";
            echo '<div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Add new Plant</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">Plant Type<span class="text-danger">*</label>
            <input id="user" type="text" name="Name" pattern="[A-Za-z]{3,15}" title="InLettres more than 3 letters, less than 8" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">Hours to be opened<span class="text-danger">*</label>
            <input class="form-control" type="text" name="Name2" placeholder="00:00:00" pattern="([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" title="Enter the time in time format *23:59:59*" id="example-time-input" required>
            </div>
            <div>
            <label for="user" class="label" style="font-size:20px;color:black;">Hours to be closed<span class="text-danger">*</label>
            <input class="form-control" type="text" name="Name3" placeholder="00:00:00"  pattern="([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" title="Enter the time in this format *23:59:59*" id="example-time-input" required>

            </div>
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">The suitable temperature<span class="text-danger">*</label>
            <input id="user" type="text" name="Name1" pattern="[0-9]{2}" title="Make sure to enter the temperature between 10-99 degree c" class="form-control" required>
            </div>
            <button type="submit" id="AddingNewOptionsID"  name="Add" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Add</button>
       
        </form>
        </div>
        </div>
        </div>';
        include_once "footer.php";
        }
        public static function Update($Result)
        {
            include_once "header.php";
            echo '<div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Add new Plant</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">Hours to be opened<span class="text-danger">*</label>
            <input class="form-control" type="text" name="Name2" value='.$Result->HourToBeOpened.' id="example-time-input" required>
            </div>
            <div>
            <label for="user" class="label" style="font-size:20px;color:black;">Hours to be closed<span class="text-danger">*</label>
            <input class="form-control" type="text" name="Name3" value='.$Result->HourToBeClosed.' id="example-time-input" required>
            </div>
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">The suitable temperature<span class="text-danger">*</label>
            <input id="user" type="text" name="Name1" class="form-control" value='.$Result->Temperature.' required>
            </div>
            <button type="submit" id="AddingNewOptionsID"  name="Add" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Add</button>
       
        </form>
        </div>
        </div>
        </div>';
        include_once "footer.php";
        }
        
        public static function Delete()
        {
            $Result=Planttype::ViewDropdown();
            include_once "header.php";
            echo '<div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
            <h2 style="text-align:center; color: rgba(45, 65, 21)">Delete Plant</h2>
            <form class="form-valide" method="post" id="form" name="myForm">
                <div class="form-group">
                <label for="user" class="label" style="font-size:20px;color:black;">Plant Type<span class="text-danger">*</label>
                <select class="form-control" name="CurrentOptions2" id="CurrentOptions2ID" >  ';
           for($k=0;$k<count($Result);$k++)
           {
               
           echo '<option value="'.$Result[$k]->ID.'">'.$Result[$k]->plantName.'</option>';
           }  
           echo'</select> 
                 </div>
                <button type="submit" id="AddingNewOptionsID"  name="Delete" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Delete</button>
        
            </form>
            </div>
            </div>
            </div>';
include_once "footer.php";
        }
        public static function ViewAll()
        {
            $Result=Planttype::ViewDropdown();

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
                                    <th scope="col">Plant Type</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            for($k=0;$k<count($Result);$k++)
                            {
                                echo '
                                <tr>
                                    <th scope="row">'.$Result[$k]->ID.'</th>
                                    <td>'.$Result[$k]->plantName.'</td>
                                </tr>';
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
        public static function ViewAllForStatistics()
        {
            $Result=Planttype::SelectAll();

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
                                    <th scope="col">Plant Type</th>
                                    <th scope="col">Temperature</th>
                                    <th scope="col">Hour LED to be opened</th>
                                    <th scope="col">Hour LED to be closed</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">View Statistics</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            for($k=0;$k<count($Result);$k++)
                            {
                                echo '
                                <tr>
                                    <th scope="row">'.$Result[$k]->ID.'</th>
                                    <td>'.$Result[$k]->plantName.'</td>
                                    <td>'.$Result[$k]->Temperature.'</td>
                                    <td>'.$Result[$k]->HourToBeOpened.'</td>
                                    <td>'.$Result[$k]->HourToBeClosed.'</td>
                                    <td><a href="UpdatePlanttype.php?plantid='.$Result[$k]->ID.'"><i class="ti-save" id='.$Result[$k]->ID.'></i></a></td>
                                    <td><a href="ViewStatisticsByAdmin.php?landid='.$Result[$k]->ID.'"><i class="ti-stats-up" id='.$Result[$k]->ID.'></i></a></td>
                                </tr>';
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
}
?>