<?php
include("config.php");
session_start();
include ('userheader.php');
?>

<style>

</style>
<section class="content-header">
    <h1>Create Movement</h1>       
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="move_asset.php">Move BG Asset</a></li>
    </ol>
</section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">

    <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
            <center>
    <head>
    <title>Create Asset Movement</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <H4 align = "center">Welcome <?php echo $_SESSION['login_user']?></H4>
    </p>

    <div class="createtransactionbox">
    <form action = "" method = "post">
    <center>
    
    <fieldset>

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

    <p>
    Enter ItemID<input type="text" list="productdrop" name = "itemIDlist" id="itemIDlist" autocomplete="off" placeholder="Enter Item ID" class="box"/>
    <datalist id="productdrop">
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

    <!-- <p>
    Enter Item Description<select list="descriptordrop" name = "descriptionlist" id = "descriptionlist" placeholder="Select Item Description" class="box" />
        <datalist id="descriptordrop">
            <option> </option>
            <?php
            $descsql = mysqli_query($db_con, "SELECT * FROM asset_inventory");
            
            ?>
        </datalist>
        </select>
    </p>     -->

    <p>
    Enter Pickup Location<input type="text" list="regiondrop" name = "regionlist" id="regionlist" autocomplete="off" placeholder="Enter location to pick asset up" class="box"/>
    <datalist id="regiondrop">
        <?php
        $regionsql = mysqli_query($db_con, "SELECT * FROM asset_hubt");
        while($regionrow = $regionsql->fetch_assoc()){
        ?>
            <option value="<?php echo $regionrow['hubname']." (".$regionrow['hubid'].")";?>"><?php echo $regionrow['hubname']." (".$regionrow['hubid'].")"; ?></option>
        <?php
        }
        ?>
    </datalist>
    </p>


    <p>
    Enter Delivery Location<input type="text" list="destinationdrop" name = "destinationlist" id="destinationlist" placeholder="Enter location to deliver asset to" class="box"/> <a id="warehouse_error" style="color:red;"></a>
    <datalist id="destinationdrop">
        <?php
        $regionsql = mysqli_query($db_con, "SELECT * FROM asset_hubt");
        while($regionrow = $regionsql->fetch_assoc()){
        ?>
            <option value="<?php echo $regionrow['hubname']." (".$regionrow['hubid'].")";?>"><?php echo $regionrow['hubname']." (".$regionrow['hubid'].")"; ?></option>
        <?php
        }
        ?>
    </datalist>
    </p>

    Enter Unit <input type="number" name="quantitylist" id="quantitylist" placeholder="Enter Item Unit" onchange="validateunit();" class="box"/> <a id="unit_error" style="color:red;"></a> <br>

    Confirm Unit Again <input type="number" name="quantityconfirmlist" id="quantityconfirmlist" placeholder="Enter Item Unit" onchange="validateunit();" class="box"/> <br>

    <p>
    Select Unit size
        <select name = "unitlist" id="unitlist" class="box"/>
            <option> </option>
            <option value="Sachet">Sachet</option>
            <option value="Single Item">Single Item</option>
            <option value="Pack">Pack</option>
            <option value="Bag">Bag</option>
            <option value="Bottle">Bottle</option>
        </select>
    </p>

    Receiver's Name <input type="text" name="sdpersonlist" id="sdpersonlist" list="teamdrop" placeholder="Enter the name of the staff handling this movement" class="box"/> <br>
    <datalist id="teamdrop">
        <?php
        $staffsql = mysqli_query($db_con, "SELECT * FROM bulkbana_apps.es_staff");
        while($staffrow = $staffsql->fetch_assoc()){
        ?>
        <option value="<?php echo $staffrow['staff_name']." (".$staffrow['staff_id'].")"; ?>"><?php echo $staffrow['staff_name']." (".$staffrow['staff_id'].")"; ?></option>
        <?php
        }
        ?>
    </datalist>

    Comments <input type="text" name="commentlist" id="commentlist" placeholder="Enter Comments" class="box"/> <br>

    <input type = "submit" name="create" value = "Create Movement" /><br/>

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


function autofillcustomer(stringClient){

    var customer1 = document.getElementById('customerlist').value;
    var customer2 = document.getElementById('customerconfirmlist').value;


    if(customer1 == customer2){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){

            if(xmlhttp.readyState == 4){
                document.getElementById('clientidlist').value = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "autofillclient.php?client=" +stringClient, true);
        xmlhttp.send();
    }
}

function validateclient(){

    var customer1 = document.getElementById('customerlist');
    var customer2 = document.getElementById('customerconfirmlist');

    if(customer1.value != customer2.value){

        document.getElementById('client_error').innerHTML = "Error: Client Names dont match";

    }else{

        document.getElementById('client_error').innerHTML = "";

    }

}

function validateunit(){

    var unit1 = document.getElementById('quantitylist');
    var unit2 = document.getElementById('quantityconfirmlist');

    if(unit1.value != unit2.value){
        document.getElementById('unit_error').innerHTML = "Error: Units don't match";
    }else{
        document.getElementById('unit_error').innerHTML = "";
    }
}

function validatewarehouse(warehousename){

    var warehousevalue = document.getElementById('destinationlist').value;
    //document.getElementById('warehouse_error').innerHTML = "We have been run";
    if("1" == "1"){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){

            if(xmlhttp.readyState == 4){
                document.getElementById('warehouse_error').innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "warehousevalidate.php?warehouse=" +warehousevalue, true);
        xmlhttp.send();
    }

}

</script>

<?php
if(isset($_POST['create'])){

    //Check if there's internet here before moving on. Or just import swal locally.

    $myitemID = mysqli_real_escape_string($db_con, $_POST['itemIDlist']);
    $myitem = mysqli_real_escape_string($db_con,$_POST['itemlist']);
    $myconfirm = mysqli_real_escape_string($db_con,$_POST['confirmlist']);
    $myregion = mysqli_real_escape_string($db_con,$_POST['regionlist']);
    $mydestination = mysqli_real_escape_string($db_con,$_POST['destinationlist']);
    $myunit = mysqli_real_escape_string($db_con,$_POST['unitlist']);
    $myquantity = mysqli_real_escape_string($db_con,$_POST['quantitylist']);
    $mysdpersonnel = mysqli_real_escape_string($db_con,$_POST['sdpersonlist']);
    $mycomment = mysqli_real_escape_string($db_con,$_POST['commentlist']);
    $mydescription = mysqli_real_escape_string($db_con, $_POST['descriptionlist']);
    $mydate = date("Y-m-d");
    $mystatus = 'pending';
    $mysync = 'no';

    if(empty($_POST['itemIDlist']) || empty($_POST['itemlist']) || empty($_POST['confirmlist']) || 
    empty($_POST['regionlist']) || empty($_POST['destinationlist']) || empty($_POST['unitlist']) || empty($_POST['quantitylist'])){

    ?>
    <script type="text/javascript">
        swal("Error","All inputs must be filled","error");
    </script>
    <?php
    }else if($myitem != $myconfirm){

    ?>
    <script type="text/javascript">
        swal("Error", "Both Item names must be the same", "error");
    </script>

    <?php

    }else{

    $asset_insert = "INSERT INTO asset_transactions(itemid, itemname, location_out, location_in, unit, quantity, procurement_officer, username, status, date, comments) VALUES ('$myitemID','$myitem','$myregion','$mydestination','$myunit','$myquantity','$mysdpersonnel','".$_SESSION['login_user']."','In Progress','$mydate','$mycomment')";

    //$sql_insert = "INSERT INTO web_transactions (transactionID,itemId,item,region,destination,unit,quantity,date,personnelName,status,sdstatus,sdpersonnel,pcstatus,transaction_type,comments,sync) VALUES ('$uniqueID','$myitemID','$myitem','$myregion','$mydestination','$myunit','$myquantity','$mydate','".$_SESSION['login_user']."','$mystatus','pending','$mysdpersonnel','pending','Internal Shipment','$mycomment','$mysync')";

    $result_insert = mysqli_query($db_con,$asset_insert);

    if($result_insert){
    ?>

<script type="text/javascript">
    swal("Yes", "Movement has been initiated", "success");
</script>

<?php
        }
    }
}

include 'adminfooter.php';
?>