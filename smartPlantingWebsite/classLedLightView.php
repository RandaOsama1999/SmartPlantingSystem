<?php
include_once "classDatabase.php";
include_once "classLedLight.php";
include_once "classPlanttype.php";
include_once "classStage.php";

class LedColorView
{
    public static function AddNewLEDLight()
    {
        include_once "header.php";
         echo '<div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Add new LED Color</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">LED color<span class="text-danger">*</label>
            <input id="user" type="text" name="Name" pattern="[A-Za-z]{3,15}" title="InLettres more than 3 letters, less than 8" class="form-control" required>
            </div>
             <button type="submit" id="AddingNewOptionsID" name="Add" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Add</button>    

    </form>
    </div>
    </div>
    </div>';
    include_once "footer.php";
    }
    public static function plantled()
    {
        $Result=LedColors::ViewLedColorDropdown();
        $Result2=Planttype::ViewDropdown();

        $Result3=Stage::ViewDropdown();
        include_once "header.php";
         echo '<div class="col-12 mt-5">
            <div class="card">
            <div class="card-body">
            <h2 style="text-align:center; color: rgba(45, 65, 21)">Add Plant needed LED Color</h2>
            <form class="form-valide" method="post" id="form" name="myForm">
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">Plant<span class="text-danger">*</label>
            <select class="form-control" name="Plant_ID" id="Plant_ID" >  ';
            for($k=0;$k<count($Result2);$k++)
            {
                echo '<option value="'.$Result2[$k]->ID.'">'.$Result2[$k]->plantName.'</option>';
            }
            echo'</select>
            </div>
            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">LED color<span class="text-danger">*</label>
            <select class="form-control" name="LED_ID" id="LED_ID" >  ';
            for($k=0;$k<count($Result);$k++)
            {
                echo '<option value="'.$Result[$k]->ID.'">'.$Result[$k]->color.'</option>';
            }
            echo'</select>
            </div>

            <div class="form-group">
            <label for="user" class="label" style="font-size:20px;color:black;">Stage<span class="text-danger">*</label>
            <select class="form-control" name="Stage_ID" id="Stage_ID" >  ';
            for($k=0;$k<count($Result3);$k++)
            {
                echo '<option value="'.$Result3[$k]->ID.'">'.$Result3[$k]->Stage.'</option>';
            }
            echo'</select>
            </div>
             <button type="submit" id="AddingNewOptionsID" name="Update" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Add</button>    

    </form>
    </div>
    </div>
    </div>';
    include_once "footer.php";
    }

    public static function Delete()
{
    $Result=LedColors::ViewLedColorDropdown();
    include_once "header.php";
    echo '<div class="col-12 mt-5">
    <div class="card">
    <div class="card-body">
    <h2 style="text-align:center; color: rgba(45,65,21)">Delete LED color</h2>
    <form class="form-valide" method="post" id="form" name="myForm">
        <div class="form-group">
        <label for="user" class="label" style="font-size:20px;color:black;">LED color<span class="text-danger">*</label>
        <select class="form-control" name="CurrentOptions2" id="CurrentOptions2ID" >  ';
        if($Result!=NULL)
        {
            for($k=0;$k<count($Result);$k++)
            {
                echo '<option value="'.$Result[$k]->ID.'">'.$Result[$k]->color.'</option>';
            }
        }
        else {
            echo '<option value="">All LED Lights are deleted</option>';
        }

    echo'</select>
            </div>
            <button type="submit" id="AddingNewOptionsID" name="Delete" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Delete</button>

        </form>
        </div>
        </div>
        </div>';
        include_once "footer.php";
    }
    public static function ViewAll()
    {
        $Result=LedColors::ViewLedColorDropdown();

        include_once "header.php";
        echo '<div class="row">
        <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">View LED Colors</h4>
                <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Color</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            if($Result!=NULL)
                            {
                                for($k=0;$k<count($Result);$k++)
                                {
                                    echo '
                                    <tr>
                                        <th scope="row">'.$Result[$k]->ID.'</th>
                                        <td>'.$Result[$k]->color.'</td>
                                    </tr>';
                                } 
                            }
                            else {
                                echo '
                                <tr>
                                    <th scope="row">NO DATA</th>
                                    <td>NO DATA</td>
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
