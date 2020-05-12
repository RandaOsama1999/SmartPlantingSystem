<?php
include_once "classDatabase.php";
class notificationView
{

   public static function addnew()
   {
      $Result=notification::ViewAllDropdownEamil();

        include_once "header.php";
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <body>
        <div class="col-12 mt-5">
        <div class="card">
        <div class="card-body">
        <h2 style="text-align:center; color: rgba(45, 65, 21)">Add new Notification</h2>
        <form class="form-valide" method="post" id="form" name="myForm">
        <div class="form-group">
        <label for="user" class="label" style="font-size:20px;color:black;">landowner Email<span class="text-danger">*</label>
        <select class="form-control" name="landownerEmail" id="landownerEmail" >;
        <option value=4>Choose the Landowner Email</option>; ';
           for($k=0;$k<count($Result);$k++)
           {
               
           echo '<option value="'.$Result[$k]->ID.'">'.$Result[$k]->Email.'</option>';
           } 
           
           echo'</select>
        
        <label for="user" class="label" style="font-size:20px;color:black;">Land Location<span class="text-danger">*</label>
        <select class="form-control" name="landloaction" id="landloaction" >  
        </select>  
      
        <script type="text/javascript">
        $(document).ready(function(){
        $("#landownerEmail").on("change",function(){
        var landowner_ID = $(this).val();
        if(landowner_ID){
            $.ajax({
                type:"POST",
                url:"ajaxprolocation.php",
                data:"owner_id="+landowner_ID,
                success:function(data){
                    $("#landloaction").html(data);
                }
            }); }
        });
        });
        </script>
        </div>
        <div class="form-group">
        <label for="user" class="label" style="font-size:20px;color:black;">Notification Content<span class="text-danger">*</label>
        <input id="user" type="text" name="Content" class="form-control" required>
        </div>
        <button type="submit" id="Add"  name="Add" class="btn btn-primary btn-flat m-b-30 m-t-30" style="text-align:center; background-color: rgba(45, 65, 21)">Send</button>

        </form>
        </div>
        </div>
        </div></body>';
        include_once "footer.php";
   }

   public static function Deleteview()
   { 
      $Result=notification::viewLandLocation();
      include_once "header.php";
      echo '<div class="row">
      <div class="col-12 mt-5">
      <div class="card">
          <div class="card-body">
              <h4 class="header-title">View and Delete your notifications</h4>
              <div class="data-tables">
                  <table id="dataTable" class="text-center">
                      <thead class="bg-light text-capitalize">
                              <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Landowner Email</th>
                                  <th scope="col">Land Location</th>
                                  <th scope="col">Notification Content</th>
                                  <th scope="col">Delete Notification</th>
                              </tr>
                          </thead>
                          <tbody>
                          ';
                          if($Result!=null)
                          {for($k=0;$k<count($Result);$k++)
                          {
                              echo '
                              <tr>
                                  <th scope="row">'.$Result[$k]->ID.'</th>
                                  <td>'.$Result[$k]->Email.'</td>
                                  <td>'.$Result[$k]->location.'</td>
                                  <td>'.$Result[$k]->content.'</td>
                                <td><a href="deletenotifi.php?notificationid='.$Result[$k]->ID.'"><i class="ti-check" id='.$Result[$k]->ID.'></i></a></td>
                              </tr>';
                          }
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