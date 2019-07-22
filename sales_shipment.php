<?php

    include("config.php");
    session_start();
    include ('userheader.php');

?>


    <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
            <center>

       <!-- <h3>THe session level: <?php echo $_SESSION['sessionlevel']?></h3> -->
            </p>



        <div class="createtransactionbox">
        <form action = "" method = "post">
            <center>
            <label><H3 align = "center">Sales Shipment</H3></label>
<br>
<fieldset>
    <div style="float: left; width: 320px;">
        <p>
        Enter ItemName<input type="text" list="itemdrop" name = "itemlist" id="itemlist" autocomplete="off" placeholder="Enter Item Name" onchange="validate();" class="box"/><a id="item_error" style="color:red;"></a>
                        <datalist id="itemdrop">
                            <?php
                            $itemnamesql = mysqli_query($db_con, "SELECT DISTINCT itemname FROM item_t");
                            while($itemnamerow = $itemnamesql->fetch_assoc()){
                            ?>

                                <option value="<?php echo $itemnamerow['itemname'];?>"><?php echo $itemnamerow['itemname']; ?></option>

                            <?php
                        }
                            ?>
        </datalist>

                    <!-- onchange="validate(); autofill(this.value); -->
                    <!-- Put them all like that and check if they are the same before running autofill -->
                    </p>
                </div>

    <div style="float: right; width: 320px;">
        <p>
        Confirm ItemName<input type="text" list="confirmdrop" name = "confirmlist" id="confirmlist" autocomplete="off" placeholder="Confirm Item Name" onchange="validate(); autofill(this.value); autounitfill(this.value);" class="box"/>
                        <datalist id="confirmdrop">
                            <?php
                            $itemnamesql = mysqli_query($db_con, "SELECT DISTINCT itemname FROM item_t");
                            while($itemnamerow = $itemnamesql->fetch_assoc()){
                            ?>

                                <option value="<?php echo $itemnamerow['itemname'];?>"><?php echo $itemnamerow['itemname']; ?></option>

                            <?php
                        }
                            ?>
                        </datalist>
        </p>
    </div>
                    <div style="clear: both;"></div>

         <div style="float: left; width: 320px;">
                    <p>
        Enter ItemID<input type="text" list="productdrop" name = "itemIDlist" id="itemIDlist" autocomplete="off" placeholder="Enter Item ID" class="box"/>
                        <datalist id=productdrop>
                            <option>Please Select the Product ID</option>
                            <?php
                            $itemsql = mysqli_query($db_con, "SELECT DISTINCT itemid FROM item_t");
                            while($itemrow = $itemsql->fetch_assoc()){
                            ?>

                                <option value="<?php echo $itemrow['itemid'];?>"><?php echo $itemrow['itemid'];?></option>


                        <?php
                            }
                        ?>

                    </datalist>
                    </p>
        </div>
    <div style="clear: both;"></div>

    <div style="float: left; width: 320px;">
                    <p>
    Enter Ship From:<input type="text" list="regiondrop" name = "regionlist" id="regionlist" autocomplete="off" placeholder="Enter Warehouse to move from" class="box"/>
                        <datalist id="regiondrop">
                          <?php
                            $regionsql = mysqli_query($db_con, "SELECT * FROM warehouse_t");
                            while($regionrow = $regionsql->fetch_assoc()){
                                ?>

                                <option value="<?php echo $regionrow['warehousename']."_".$regionrow['warehouseid'];?>"><?php echo $regionrow['warehousename']."_".$regionrow['warehouseid']; ?></option>

                            <?php
                            }
                            ?>
                        </datalist>

                    </p>
    </div>

    <div style="float: right; width: 320px;">
      Enter Team Member ID:<input type="text" name="destinationlist" id="destinationlist" list="teamdrop" placeholder="Enter Team Member ID" class="box"/><br>
      <datalist id="teamdrop">
        <?php
        $staffsql = mysqli_query($db_con, "SELECT * FROM bulkbana_apps.es_staff");
        while($staffrow = $staffsql->fetch_assoc()){
        ?>
            <option value="<?php echo $staffrow['staff_name']."_".$staffrow['staff_id']; ?>"><?php echo $staffrow['staff_name']."_".$staffrow['staff_id']; ?></option>
        <?php
        }
        ?>
    </div>

<div style="clear: both;"></div>

<p>
  Enter Intended Location <input type="text" list="locationdrop" name="intended_location" id="intended_location" placeholder="Select Intended Location" class="box"/> <br>
  <datalist id="locationdrop">
  <?php
  //Display the lmd details.
  $lmdsql = mysqli_query($db_con, "SELECT * FROM lmd_t");
    while($lmdrow = $lmdsql->fetch_assoc()){
  ?>
    <option value="<?php echo $lmdrow['lmdname']."_".$lmdrow['lmdid'];?>"><?php echo $lmdrow['lmdname']."_".$lmdrow['lmdid']; ?></option>
  <?php
  }
  ?>
  </datalist>
</p>

<div style="float: left; width: 320px;">
    Enter Quantity <input type="number" min="0" step="1" name="quantitylist" id="quantitylist" placeholder="Enter Quantity" class="box"/> <br>
</div>

<div style="float: right; width: 320px;">
  <p>
    Unit size <input type="text" name = "unitlist" id="unitlist" placeholder="Unit Size" class="box"/> <br>
  </p>
</div>


<div style="clear: both;"></div>

<div style="float: left; width: 320px;">
  Enter S&D Email Address <input type="text" name="sdemail1" id="sdemail1" placeholder="Enter S&D's Email Address" class="box"/> <br>
</div>

<div style="float: right; width: 320px;">
  Confirm S&D Email <input type="text" name="sdemail2" id="sdemail2" placeholder="Confirm S&D's Email Addresss " class="box"/> <br>
</div>

<div style="clear: both;"></div>

<div style="float: left; width: 320px;">
  SD Personnel Name <input type="text" name="sdpersonlist" id="sdpersonlist" placeholder="Enter the Name of the SD Personnel Handling this Transaction" class="box"/> <br>
</div>

<div style="float: right; width: 320px;">
  <p>
  Select the Hub for this Transaction
  <select name = "hublist" id="hublist" list="hubdrop" class="box"/>
    <option> </option>
    <?php
    //Display Hubs from the database.
    $hubsql = mysqli_query($db_con, "SELECT * FROM hub_t");
    while($hubrow = $hubsql->fetch_assoc()){
    ?>
        <option value="<?php echo $hubrow['hubname']; ?>"><?php echo $hubrow['hubname']; ?></option>
    <?php
    }
    ?>
  </select>
  </p>
</div>

<div style="clear: both;"></div>

Notes: <input type="text" maxlength="50" name="notes" id="notes" placeholder="Enter any Transaction Note." class="box" /><br>

<input type = "submit" name = 'create' value = "Create Waybill" /><br/>


</fieldset>

</center>
</form>
</div>



</div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
            </div>
        </div>

                <!-- /.post -->
                </div>
                <!-- /.post -->

              </div>

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<div class="footer">

<script>

 function autofill(stringName){

 var confirmname = document.getElementById('confirmlist').value;
 var itemname = document.getElementById('itemlist').value;

 if(confirmname == itemname){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){

    if(xmlhttp.readyState == 4){

        document.getElementById('itemIDlist').value = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "autofill.php?value=" +stringName, true);
        xmlhttp.send();
    }
 }

function validate(){

    var item = document.getElementById('itemlist');
    var confirm = document.getElementById('confirmlist');

    if(item.value != confirm.value){

        document.getElementById('item_error').innerHTML = "Error: Item Names dont match";
        //document.getElementById('confirm_error').innerHTML = "Error: Item Names dont match";
    }else{
        document.getElementById('item_error').innerHTML = "";
        }
}

function autounitfill(stringName){
  var confirmname = document.getElementById('confirmlist').value;
  var itemname = document.getElementById('itemlist').value;

  if(confirmname == itemname){
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function(){
     if(xmlhttp.readyState == 4){
         document.getElementById('unitlist').value = xmlhttp.responseText;
             }
         }
         xmlhttp.open("GET", "unitfill.php?value=" +stringName, true);
         xmlhttp.send();
     }
}
</script>



<?php

    if(isset($_POST['create'])){

        $myitemID = mysqli_real_escape_string($db_con, $_POST['itemIDlist']);//product_id
        $myitem = mysqli_real_escape_string($db_con,$_POST['itemlist']); //description
        $myemail = mysqli_real_escape_string($db_con, $_POST['sdemail2']); //emailAddress
        $regionName = mysqli_real_escape_string($db_con,$_POST['regionlist']);
        $myintended_location = mysqli_real_escape_string($db_con, $_POST['intended_location']);//Intended Address
        $mydestination = mysqli_real_escape_string($db_con,$_POST['destinationlist']);//destination
        $myquantity = mysqli_real_escape_string($db_con,$_POST['quantitylist']);//quantity
        $myunit = mysqli_real_escape_string($db_con, $_POST['unitlist']); //unit
        $mypersonnelName = mysqli_real_escape_string($db_con,$_POST['sdpersonlist']);//personnelName
        $myhub = mysqli_real_escape_string($db_con, $_POST['hublist']); //Hub
        $mynotes = mysqli_real_escape_string($db_con, $_POST['notes']); //Notes
        $mydate = date("Y-m-d H:i:s");//date
        $mystatus = 'Awaiting Approval';//status

        $last5product_id = substr($myitemID, -5);
        $last10WH_id = substr($mydestination, -10);
        $dateTime = strtotime($mydate);
        $new = floatval(25569 + $dateTime / 86400);
        $waybill_time = round($new, 3);
        $mywaybillId = "WT".$last10WH_id."-".$last5product_id."-".$waybill_time;


        if(empty($myitemID) || empty($myitem) || empty($regionName) || empty($myhub) || empty($myintended_location) || empty($myquantity) || empty($mypersonnelName) || empty($mydestination) || empty($myemail) || empty($myunit)){

        ?>
        <script type="text/javascript">
            window.alert("All Entries must be filled");
        </script>
        <?php

        }else{

          //First Process, Check whether the 'Ship from' exists in the database.
          $myregion = explode("_", $regionName);
          $q1 = "SELECT warehouseid FROM warehouse_t WHERE warehouseid = '".$myregion[1]."'";
          $regioncheck = mysqli_query($db_con, $q1);
          if(mysqli_num_rows($regioncheck) < 1){
            //Not found in warehouse database.
            //Use JS to display prompt then exit script.
            ?>
            <script type="text/javascript">
                alert("Ship from location not found in database. Kindly enter a valid location.");
            </script>
            <?php
            exit();
          }

          //Second Process Check the intended location.
          $myintended = explode("_", $myintended_location);
          $intendedQ2 = "SELECT lmdid FROM lmd_t WHERE lmdid = '".$myintended[1]."'";
          $intendedcheck2 = mysqli_query($db_con, $intendedQ2);
          if(mysqli_num_rows($intendedcheck2) < 1){
            //Not found in lmdt, now lets alert and terminate script...
              ?>
              <script type="text/javascript">
                  alert("Intended location not found in database. Kindly enter a valid location.");
              </script>
              <?php
              exit();
            }

            //Another process, check whether the staff id is in the database.
            $mystaff = explode("_", $mydestination);
            $staffQ = "SELECT * FROM bulkbana_apps.es_staff WHERE staff_id= '".$mystaff[1]."'";
            $staffcheck = mysqli_query($db_con, $staffQ);
            if(mysqli_num_rows($staffcheck) < 1){
              ?>
              <script type="text/javascript">
                  alert("Staff ID not found in database. Kindly enter a valid ID");
              </script>
              <?php
              exit();
            }

          $trans_sql = "INSERT INTO user_waybill (waybill_id, description, product_id, ship_from, destination, delivery_address, intended_location, quantity, unit, batch_code, unit_of_measure, emailAddress, date, personnelName, status, hub, notes, transaction_type) VALUES
          ('$mywaybillId','$myitem','$myitemID','$myregion[1]','$mystaff[1]','N/A','$myintended[1]','$myquantity','$myunit','N/A','N/A','$myemail','$mydate','$mypersonnelName','$mystatus', '$myhub', '$mynotes', 'Sales Shipment')";
          $trans_insert = mysqli_query($db_con, $trans_sql);

        ?>

        <script type="text/javascript">
          window.alert("Transaction has been created");
        </script>

        <?php

       }
}

?>


<?php
    include 'adminfooter.php';
    ?>
