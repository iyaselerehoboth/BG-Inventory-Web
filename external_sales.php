<?php

    include("config.php");
    session_start();
    include ('userheader.php');

?>

<style>
    .topnav {
    background-color: #3C8DBC;
    overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
</style>

<section class="content-header">
      
    <h1> <div class="topnav">
  <a href="external_sales.php">External Shipment</a>
  <a href="internal_transaction.php">Internal Shipment</a>
  <a href="convert_transaction_out.php">Conversion OUT</a>
  <a href="convert_transaction_in.php">Conversion IN</a>
</div> </h1>
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="createtransaction.php">Create Transaction</a></li>
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
                
                
            
<H4 align = "center">Welcome <?php echo $_SESSION['login_user']?></H4>
       <!-- <h3>THe session level: <?php echo $_SESSION['sessionlevel']?></h3> -->
            </p>
           
        <div class="createtransactionbox">
        <form action="" method = "post">
            <center>
            <label><H3 align = "center">Transaction Details</H3></label>
            
            
            <fieldset>
                
               <!-- <legend>-->
                
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
                
                    <p>
    Enter WHName<input type="text" list="regiondrop" name = "regionlist" id="regionlist" autocomplete="off" placeholder="Enter Warehouse to move from" class="box"/>
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
    <p>                 
    Enter Client's name <input type="text" list="customerdrop" name="customerlist" id="customerlist" onchange="validateclient();" autocomplete="off" placeholder="Enter BabbanGona's Client Name or Discard" class="box"/><a id="client_error" style="color:red;"></a>
            <datalist id="customerdrop">
                <?php
                    $customersql = mysqli_query($db_con, "SELECT DISTINCT customername FROM customer_t");
                    while($customerrow = $customersql->fetch_assoc()){
                        ?>
                            <option value="<?php echo $customerrow['customername'];?>"><?php echo $customerrow['customername']; ?></option>

                    <?php    
                    }
                
                ?>
                <option value="Discard">Discard</option>
            </datalist>
    </p>

    <p>                 
    Confirm Client's name <input type="text" list="customerconfirmdrop" name="customerconfirmlist" id="customerconfirmlist" autocomplete="off" onchange="validateclient(); autofillcustomer(this.value);" placeholder="Enter BabbanGona's Client Name or Discard" class="box"/>
            <datalist id="customerconfirmdrop">
                <?php
                    $customersql = mysqli_query($db_con, "SELECT DISTINCT customername FROM customer_t");
                    while($customerrow = $customersql->fetch_assoc()){
                        ?>
                            <option value="<?php echo $customerrow['customername'];?>"><?php echo $customerrow['customername']; ?></option>

                    <?php    
                    }
                
                ?>
                <option value="Discard">Discard</option>
            </datalist>
    </p>


    Enter Client ID <input type="text" name="clientidlist" id="clientidlist" placeholder="Enter Client's ID" class="box"/> <br>

    Enter Unit <input type="text" name="quantitylist" id="quantitylist" placeholder="Enter Item Unit" onchange="validateunit();" class="box"/> <a id="unit_error" style="color:red;"></a> <br>
                
    Confirm Unit Again <input type="text" name="quantityconfirmlist" id="quantityconfirmlist" placeholder="Enter Item Unit" onchange="validateunit();" class="box"/> <br>

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

        Enter S&D Phone Number <input type="text" name="sdname1" placeholder="Enter S&D Phone Number (eg. +2348000000000)" class="box"/> <br>

        Confirm S&D Phone Number <input type="text" name="sdname2" placeholder="Confirm S&D Phone Number (eg. +2348000000000)" class="box"/> <br>
        Enter S&D Email<input type="text" name="email1" placeholder="Enter S&D email" class="box"/> <br>
        SD Personnel Name <input type="text" name="sdpersonlist" id="sdpersonlist" placeholder="Enter the Name of the SD Personnel Handling this Transaction" class="box"/> <br>

        Comments <input type="text" name="commentlist" id="commentlist" placeholder="Enter Comments" class="box"/> <br>

        <input type = "submit" name = 'create' value = "Create Shipment" /><br/>

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
           
</script>
             
             
<?php
    
   
    
    if(isset($_POST['create'])){
        
        $itemsql = mysqli_query($db_con, "SELECT * FROM transactions_preloaded ORDER BY RAND() LIMIT 1");
        $itemrow = $itemsql->fetch_assoc();
 
        $uniqueID = $itemrow['transaction_id'];
        //echo "the unique: " .$uniqueID;

        $myemail = mysqli_real_escape_string($db_con, $_POST['email1']);
        $myitemID = mysqli_real_escape_string($db_con, $_POST['itemIDlist']);
        $myitem = mysqli_real_escape_string($db_con,$_POST['itemlist']);
        $myconfirm = mysqli_real_escape_string($db_con,$_POST['confirmlist']);
        $myregion = mysqli_real_escape_string($db_con,$_POST['regionlist']);
        $mydestination = mysqli_real_escape_string($db_con,$_POST['customerlist']);
        $myunit = mysqli_real_escape_string($db_con,$_POST['unitlist']);
        $myquantity = mysqli_real_escape_string($db_con,$_POST['quantitylist']);
        $mysdpersonnel = mysqli_real_escape_string($db_con,$_POST['sdpersonlist']);
        $mycomment = mysqli_real_escape_string($db_con,$_POST['commentlist']);
        $mydate = date("Y-m-d");
        $mystatus = 'pending';
        $mysync = 'no';

        $numbersql = mysqli_query($db_con, "SELECT pc_number FROM warehouse_t WHERE warehousename = '" .$myregion. "'");
        $numberrow = $numbersql->fetch_assoc();

        $lessnumber = $numberrow['pc_number'];
        $pcnumber = "+".$lessnumber;



        
        if(empty($_POST['itemIDlist']) || empty($_POST['email1']) || empty($_POST['itemlist']) || empty($_POST['confirmlist']) || empty($_POST['regionlist']) || empty($_POST['customerlist']) || empty($_POST['unitlist']) || empty($_POST['quantitylist'])){
         
        ?>
           
                 <script type="text/javascript">
               window.alert("Error: All inputs must be filled");
            </script>
        
        <?php
        }else{
        
            if($myitem != $myconfirm){
        ?>
           <script type="text/javascript">
               window.alert("Error: Both Item names must be the same");
        </script>
       
        <?php   
            
        }else{
            
            $sql_insert = "INSERT INTO web_transactions (transactionID,itemId,item,region,destination,unit,quantity,date,personnelName,status,sdstatus,sdpersonnel,pcstatus,transaction_type,comments,sync) VALUES ('$uniqueID','$myitemID','$myitem','$myregion','$mydestination','$myunit','$myquantity','$mydate','".$_SESSION['login_user']."','$mystatus','pending','$mysdpersonnel','pending','External Sales','$mycomment','$mysync')";
        
            
        $result_insert = mysqli_query($db_con,$sql_insert);
        
        if($result_insert){

            echo $myemail;

            $curl = curl_init();
            $number = mysqli_real_escape_string($db_con, $_POST['sdname2']);
            $from = "Inventory";
            $text = "External Shipment,".$uniqueID.",".$myregion.",".$mydestination.",".$myitem.",".$myquantity.",".$myunit;

            $url = "http://ngn.rmlconnect.net:8080/bulksms/bulksms?username=BabbanGona&password=K6kRuXKS&type=5&dlr=0&destination=".urlencode($number)."&source=".urlencode($from)."&message=".urlencode($text)."";

            //$url = "https://www.example.com/file.php?phone=".urlencode($phone)."&message=".urlencode($message)."";
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            //echo $result;

            curl_close($curl);

            
            //Send text to the PC official.
            $pc_curl = curl_init();
            $from = "Inventory";
            $text = "External Shipment,".$uniqueID.",".$myregion.",".$mydestination.",".$myitem.",".$myquantity.",".$myunit;

            $url = "http://ngn.rmlconnect.net:8080/bulksms/bulksms?username=BabbanGona&password=K6kRuXKS&type=5&dlr=0&destination=".urlencode($pcnumber)."&source=".urlencode($from)."&message=".urlencode($text)."";

            //$url = "https://www.example.com/file.php?phone=".urlencode($phone)."&message=".urlencode($message)."";
            curl_setopt($pc_curl, CURLOPT_URL, $url);
            curl_setopt($pc_curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($pc_curl, CURLOPT_RETURNTRANSFER, true);

            //echo $pcnumber;
            $result = curl_exec($pc_curl);

            //echo $result;

            curl_close($pc_curl);       
        
                     
?>

<script type="text/javascript">
      window.alert("Transaction has been created");
</script>
    
<?php
         }
    }
                
  }

  $deletesql = mysqli_query($db_con, "DELETE FROM transactions_preloaded WHERE transaction_id = '" .$uniqueID. "'");


    if(!$deletesql){

        die("Error: " .mysqli_error());
    }else{
        //print "They've been deleted" .$uniqueID;
    }
        
}
         
?>


<?php
    include 'adminfooter.php';
    ?>