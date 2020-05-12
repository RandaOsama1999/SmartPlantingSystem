<?php
include_once "classDatabase.php";
class SensorView
{

   public static function addnew()
   {
       include_once "header.php";
       echo '<div class="col-12 mt-5">
       <div class="card">
       <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Add new Sensor</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
        <div class="form-group">
        <label for="user" class="label" style="font-size:20px;color:black;">Sensor Name<span class="text-danger">*</label>
        <input id="user" type="text" name="Name"  pattern="[a-zA-Z0-9]{2,15}" title="In Lettres or Numbers more than 2 letters, less than 15" class="form-control" required>
        </div>
        <button type="submit" id="AddingNewOptionsID"  name="Add" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Add</button>
        
        </form>
        </div>
        </div>
        </div>';
       include_once "footer.php";
   }
   public static function Deleteview()
   {
        $Result=sensor::viewsensors();
        include_once "header.php";
        echo '<div class="row">
        <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">View and Delete Sensors</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Delete Sensor Type</th>
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
                                        <td>'.$Result[$k]->Type.'</td>
                                    <td><a href="deletesensors.php?sensorid='.$Result[$k]->ID.'"><i class="ti-trash" id='.$Result[$k]->ID.'></i></a></td>
                                    </tr>';
                                
                                }
                        }
                        else
                        { 
                           echo'<th scope="row">NO DATA</th>';

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
