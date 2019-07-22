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
            <label><H3 align = "center">Transaction Details</H3></label>
<br>         
<fieldset>
                
    <p>
    Select Transaction Type
    <select name = "transtypelist" id="transtypelist" placeholder="Select Transaction Type" class="box"/>
        <option> </option>
        <option value="Trans-Shipment">Trans-Shipment</option>
        <option value="Sales Shipment">Sales Shipment</option>
        <option value="Shipment to Customers">Shipment to Customers</option>
        <option value="Shipment to Vendors">Shipment to Vendors</option>
    </select>
    </p> 
                
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

        <div style="float: right; width: 320px;"> 
        Enter Batch Code <input type="text" name="batchCode" id="batchCode" placeholder="Enter Transaction Batch Code" class="box"/> <br>
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
                    <p>
    Enter Destination:<input type="text" list="destinationdrop" name = "destinationlist" id="destinationlist" autocomplete="off" placeholder="Enter Warehouse to move from" class="box"/>
                        <datalist id="destinationdrop">    
                          <?php
                            $destinationsql = mysqli_query($db_con, "SELECT DISTINCT warehousename FROM warehouse_t");
                            while($destinationrow = $destinationsql->fetch_assoc()){
                                ?>

                                <option value="<?php echo $destinationrow['warehousename'];?>"><?php echo $destinationrow['warehousename']; ?></option>
                                
                            <?php
                            }
                            ?>  
                        </datalist>
                        
                    </p>  
    </div>
    <div style="clear: both;"></div>


        <div style="float: left; width: 320px;">            
        Enter Quantity <input type="text" name="quantitylist" id="quantitylist" placeholder="Enter Quantity" class="box"/> <br>
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

<div style="float: right; width: 320px;"> 
       Enter Unit of Measure <input type="text" name="unitofmeasure" id="unitofmeasure" placeholder="Enter the Unit of Measure" class="box"/> <br>
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


    
             
<?php
       
    if(isset($_POST['create'])){

        $mywaybillId = rand(354525,4654363); //waybill_id
        $mytranstype = mysqli_real_escape_string($db_con, $_POST['transtypelist']);//transaction_type
        $myitemID = mysqli_real_escape_string($db_con, $_POST['itemIDlist']);//product_id
        $myitem = mysqli_real_escape_string($db_con,$_POST['itemlist']); //description
        $myemail = mysqli_real_escape_string($db_con, $_POST['sdemail2']); //emailAddress
        $myregion = mysqli_real_escape_string($db_con,$_POST['regionlist']);//ship_from
        $mydestination = mysqli_real_escape_string($db_con,$_POST['destinationlist']);//destination
        $myquantity = mysqli_real_escape_string($db_con,$_POST['quantitylist']);//quantity
        $myunit = mysqli_real_escape_string($db_con, $_POST['unitlist']); //unit
        $mybatchcode = mysqli_real_escape_string($db_con, $_POST['batchCode']); //batch_code
        $myunitofmeasure = mysqli_real_escape_string($db_con, $_POST['unitofmeasure']); //unit_of_measure
        $mypersonnelName = mysqli_real_escape_string($db_con,$_POST['sdpersonlist']);//personnelName
        $mydate = date("Y-m-d");//date
        $mystatus = 'Awaiting Approval';//status
       

        //Check Transaction Types and Modify Database Entry.
        switch ($mytranstype) {
            case 'Trans-Shipment':
                $trans_sql = "INSERT INTO user_waybill (waybill_id, description, product_id, ship_from, destination, quantity, unit , batch_code , unit_of_measure ,emailAddress, date, personnelName, status, transaction_type) VALUES ('$mywaybillId','$myitem','$myitemID','$myregion','$mydestination','$myquantity','$myunit','$mybatchcode','$myunitofmeasure','$myemail','$mydate','$mypersonnelName','$mystatus','$mytranstype')";
                $trans_insert = mysqli_query($db_con, $trans_sql);
                break;

            case 'Sales Shipment':   
                $trans_sql = "INSERT INTO user_waybill (waybill_id, description, product_id, ship_from, destination, quantity, unit , batch_code , unit_of_measure ,emailAddress, date, personnelName, status, transaction_type) VALUES ('$mywaybillId','$myitem','$myitemID','$myregion','$mydestination','$myquantity','$myunit','$mybatchcode','$myunitofmeasure','$myemail','$mydate','$mypersonnelName','$mystatus','$mytranstype')";
                $trans_insert = mysqli_query($db_con, $trans_sql);
                break;

            case 'Shipment to Customers':
                $trans_sql = "INSERT INTO user_waybill (waybill_id, description, product_id, ship_from, destination, quantity, unit , batch_code , unit_of_measure ,emailAddress, date, personnelName, status, transaction_type) VALUES ('$mywaybillId','$myitem','$myitemID','$myregion','$mydestination','$myquantity','$myunit','$mybatchcode','$myunitofmeasure','$myemail','$mydate','$mypersonnelName','$mystatus','$mytranstype')";
                $trans_insert = mysqli_query($db_con, $trans_sql);
                break;

            case 'Shipment to Vendors':
                $trans_sql = "INSERT INTO user_waybill (waybill_id, description, product_id, ship_from, destination, quantity, unit , batch_code , unit_of_measure ,emailAddress, date, personnelName, status, transaction_type) VALUES ('$mywaybillId','$myitem','$myitemID','$myregion','$mydestination','$myquantity','$myunit','$mybatchcode','$myunitofmeasure','$myemail','$mydate','$mypersonnelName','$mystatus','$mytranstype')";
                $trans_insert = mysqli_query($db_con, $trans_sql);
                break;
            default:
                # code...
                break;
        }



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