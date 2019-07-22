<?php

    include("config.php");
    session_start();
    include ('userheader.php');
 
    // if(!$_SESSION['login_user']){
    //      header("location: error404.php");
    //      exit();
    // }
    

?>
</h2> </b></p>     
               
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
            <label><H3 align = "center">Transaction Details</H3></label>
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

    <div style="float: right; width: 320px;"> 
    Enter Quantity to Convert <input type="number" name="quantityToConvert" id="quantityToConvert" placeholder="Enter Quantity to Convert" class="box"/> <br>
    </div>         
    <div style="clear: both;"></div> 


    <div style="float: left; width: 320px;">            
    <p>
    Enter Original Unit of Measure <input type="text" name = "originalUnit" id="originalUnit" placeholder="Enter Original Unit of Measure" class="box"/>
    </p> 
    </div>                  

    <div style="float: right; width: 320px;">                              
                    <p>
    Enter Conversion Unit of Measure <input type="text" name = "conversionUnit" id="conversionUnit" placeholder="Enter Conversion Unit of Measure" class="box"/>  
                    </p>  
    </div>
    <div style="clear: both;"></div>

    <div style="float: right; width: 320px;">   
    <p>
    Enter Warehouse Out<input type="text" list="regiondrop" name = "regionlist" id="regionlist" autocomplete="off" placeholder="Enter Warehouse to convert from" class="box"/>
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

        <div style="float: left; width: 320px;"> 
        Enter Purpose for Conversion <input type="text" name="purpose" id="purpose" placeholder="Enter the Purpose for Conversion" class="box"/> <br>
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
</script> 

    
             
<?php
       
    if(isset($_POST['create'])){

        $mytranstype = "Conversion Order";//transaction_type
        $myitemID = mysqli_real_escape_string($db_con, $_POST['itemIDlist']);//product_id
        $myitem = mysqli_real_escape_string($db_con,$_POST['itemlist']); //description
        $myquantityToConvert = mysqli_real_escape_string($db_con, $_POST['quantityToConvert']);//Quantity to Convert
        $myoriginalUnit = mysqli_real_escape_string($db_con, $_POST['originalUnit']);//Original Unit Of Measure
        $myconversionUnit = mysqli_real_escape_string($db_con, $_POST['conversionUnit']);//My Conversion Unit Of Measure
        $mypurpose = mysqli_real_escape_string($db_con, $_POST['purpose']);//Purpose for Conversion
        $myemail = mysqli_real_escape_string($db_con, $_POST['sdemail2']); //emailAddress

        $regionName = mysqli_real_escape_string($db_con,$_POST['regionlist']);
        $regionsql = "SELECT warehouseid FROM warehouse_t WHERE warehousename = '".$regionName."'";
        $regionrun = mysqli_query($db_con, $regionsql);
        while($regionexecute = mysqli_fetch_assoc($regionrun)){
            $myregion = $regionexecute['warehouseid'];
        }
        $mypersonnelName = mysqli_real_escape_string($db_con,$_POST['sdpersonlist']);//personnelName
        $mydate = date("Y-m-d H:i:s");//date
        $mystatus = 'Awaiting Approval';//status

        $last5product_id = substr($myitemID, -5);
        $last10WH_id = substr($myregion, -10);
        $dateTime = strtotime($mydate);
        $new = floatval(25569 + $dateTime / 86400);
        $waybill_time = round($new, 3);
        echo $waybill_time;
        $mywaybillId = "WT".$last10WH_id."-".$last5product_id."-".$waybill_time;
       
       


       $conversion_sql = "INSERT INTO conversion_waybill (waybill_id, product_id, description, quantityToConvert, originalUnitOfMeasure, conversionUnitOfMeasure, destination, purposeForConversion, emailAddress, date, personnelName, status, transaction_type) VALUES ('$mywaybillId','$myitemID','$myitem','$myquantityToConvert','$myoriginalUnit','$myconversionUnit','$myregion','$mypurpose','$myemail','$mydate','$mypersonnelName','Awaiting Approval','$mytranstype')";

       $conversion_execute = mysqli_query($db_con, $conversion_sql);

        ?>


    <script type="text/javascript">
      window.alert("Transaction has been created");
    </script>

    <?php
}
         
?>


<?php
    include 'adminfooter.php';
    ?>