<?php

    include("config.php");
    session_start();
    include ('userheader.php');

?>
<!-- THIS SHIPMENT HAS BEEN REMOVED FROM WAYBILL BECAUSE IT HASN'T BEEN IN USE FOR A LONG WHILE -->

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
            <label><H3 align = "center">Vendor Shipment</H3></label>
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
                    Confirm ItemName<input type="text" list="confirmdrop" name = "confirmlist" id="confirmlist" autocomplete="off" placeholder="Confirm Item Name" onchange="validate(); autofill(this.value);" class="box"/>
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
                            $regionsql = mysqli_query($db_con, "SELECT DISTINCT warehousename FROM warehouse_t");
                            while($regionrow = $regionsql->fetch_assoc()){
                                ?>

                                <option value="<?php echo $regionrow['warehousename'];?>"><?php echo $regionrow['warehousename']; ?></option>

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
      </datalist>
    </div>

    <div style="clear: both;"></div>

<p>
    Enter Intended Location <input type="text" list="locationdrop" name="intended_location" id="intended_location" placeholder="Enter Team Member ID" class="box"/> <br>
        <datalist id="locationdrop">
                <?php
                    $regionsql = mysqli_query($db_con, "SELECT * FROM inventory_details");
                        while($regionrow = $regionsql->fetch_assoc()){
                            ?>

                            <option value="<?php echo $regionrow['warehousename'];?>"><?php echo $regionrow['warehousename']; ?></option>
                            <option value="<?php echo $regionrow['customername'];?>"><?php echo $regionrow['customername']; ?></option>

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

                            Select Unit size
                            <select name = "unitlist" id="unitlist" placeholder="Enter Quantity" class="box"/>
                                <option> </option>
                                <option value="Sachets">Sachets</option>
                                <option value="Single Items">Single Items</option>
                                <option value="Packs">Packs</option>
                                <option value="Bags">Bags</option>
                                <option value="Bottles">Bottles</option>
                                <option value="Litres">Litres</option>
                                <option value="Cartons">Cartons</option>
                                <option value="Bales">Bales</option>
                                <option value="Rolls">Rolls</option>
                                <option value="Pieces">Pieces</option>
                            </select>
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

<div style="clear: both;"></div>
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

function stafflength(){
  var id = document.getElementById('destinationlist');

  if(id.value.length != 18){
    document.getElementById('staffid_error').innerHTML = "Error: Staff ID must be 18 characters";
  }else{
    document.getElementById('staffid_error').innerHTML = '';
  }
}
</script>



<?php

    if(isset($_POST['create'])){

        //$mytranstype = mysqli_real_escape_string($db_con, $_POST['transtypelist']);//transaction_type
        $myitemID = mysqli_real_escape_string($db_con, $_POST['itemIDlist']);//product_id
        $myitem = mysqli_real_escape_string($db_con,$_POST['itemlist']); //description
        $myemail = mysqli_real_escape_string($db_con, $_POST['sdemail2']); //emailAddress

        $regionName = mysqli_real_escape_string($db_con,$_POST['regionlist']);
        $regionsql = "SELECT warehouseid FROM warehouse_t WHERE warehousename = '".$regionName."'";
        $regionrun = mysqli_query($db_con, $regionsql);
        while($regionexecute = mysqli_fetch_assoc($regionrun)){
            $myregion = $regionexecute['warehouseid'];
        }


        $myintended_location = mysqli_real_escape_string($db_con, $_POST['intended_location']);//Intended Address
        $mydestination = mysqli_real_escape_string($db_con,$_POST['destinationlist']);//destination
        $myquantity = mysqli_real_escape_string($db_con,$_POST['quantitylist']);//quantity
        $myunit = mysqli_real_escape_string($db_con, $_POST['unitlist']); //unit
        //$mybatchcode = mysqli_real_escape_string($db_con, $_POST['batchCode']); //batch_code
        //$myunitofmeasure = mysqli_real_escape_string($db_con, $_POST['unitofmeasure']); //unit_of_measure
        $mypersonnelName = mysqli_real_escape_string($db_con,$_POST['sdpersonlist']);//personnelName
        $mydate = date("Y-m-d H:i:s");//date
        $mystatus = 'Awaiting Approval';//status

        $last5product_id = substr($myitemID, -5);
        $last10WH_id = substr($mydestination, -10);
        $dateTime = strtotime($mydate);
        $new = floatval(25569 + $dateTime / 86400);
        $waybill_time = round($new, 3);
        echo $waybill_time;
        $mywaybillId = "WT".$last10WH_id."-".$last5product_id."-".$waybill_time;

       if(empty($myitemID) || empty($myitem) || empty($myregion) || empty($myintended_location) || empty($myquantity) || empty($mypersonnelName) || empty($myemail) || empty($mydestination) || empty($myunit)){

        ?>
        <script type="text/javascript">
            window.alert("All Entries must be filled");
        </script>
        <?php

        }else{

        $trans_sql = "INSERT INTO user_waybill (waybill_id, description, product_id, ship_from, destination, delivery_address, intended_location, quantity, unit , batch_code , unit_of_measure ,emailAddress, date, personnelName, status, transaction_type) VALUES ('$mywaybillId','$myitem','$myitemID','$myregion','$mydestination','N/A','$myintended_location','$myquantity','$myunit','N/A','N/A','$myemail','$mydate','$mypersonnelName','$mystatus','Shipment to Vendors')";
        $trans_insert = mysqli_query($db_con, $trans_sql);

        //$to = 'rehoboth.iyasele@babbangona.com';
        $subject = 'BG Inventory Waybill';
        $message = 'A waybill has been created by '.$mypersonnelName;
        $headers = "From: donotreply@babbangona.com\r\n";
        if (mail($myemail, $subject, $message, $headers)) {
            echo "SUCCESS";
        } else {
            echo "ERROR";
        }

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
