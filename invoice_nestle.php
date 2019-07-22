<?php
include("config.php");
session_start();
include ('userheader.php');
$waybill_id = $_GET['waybill'];


?>


 <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">

    <form action = "" method = "post">
    <center>

    <div style="float: left; width: 300px;">    
    <p>
        Select Customer Name
        <select list="customerdrop" name="customerlist" id="customerlist" class="box"/>
            <datalist id="customerdrop">
                <option value=" "> </option>
            <?php
                $itemnamesql = mysqli_query($db_con, "SELECT DISTINCT customername FROM customer_t ORDER BY customername ASC");
                while($itemnamerow = $itemnamesql->fetch_assoc()){
            ?>
                
                <option value="<?php echo $itemnamerow['customername'];?>"><?php echo $itemnamerow['customername']; ?></option>
                                
            <?php
            }
            ?>
            </datalist>
    </p>    
    <div style="clear: both;"></div>

    <br>
    <div style="float: left; width: 300px;">
     Enter Nestle Material Number:
    <input type="text" name="materialNumber" id="materialNumber" placeholder="Enter Nestle Material Number" class="box"></textarea>
    <br>
	</div>

    <div style="float: right; width: 300px;">
    Enter Product:
    <input type="text" name="product" id="product" placeholder="Enter Product" class="box"></textarea>
    <br>
	</div>
	
	<div style="clear: both;"></div>

    <div style="float: right; width: 300px;"> 
    Enter Quantity Delivered (in Kg) <input type="text" name="qtydelivered" id="qtydelivered" placeholder= "Enter Quantity Delivered" class="box"/> <br>
    </div>                    

    <div style="float: left; width: 300px;">            
    Enter Price PER KG <input type="text" name="priceperkg" id="priceperkg" placeholder="Enter Price PER KG" class="box"/> <br>
    </div>


    <div style="clear: both;"></div>

    <div style="float: right; width: 300px;"> 
    Enter Purchase Order <input type="text" name="purchaseOrder" id="purchaseOrder" placeholder= "Enter purchase order" class="box"/> <br>
    </div>                    

    <div style="float: left; width: 300px;">            
    Enter Purchase Order Date <input type="date" name="purchaseOrderDate" id="purchaseOrderDate" placeholder="Enter Purchase Order Date" class="box"/> <br>
    </div>

    <div style="clear: both;"></div>
    
    <div style="float: right; width: 300px;"> 
    Enter Invoice Date <input type="date" name="invoiceDate" id="invoiceDate" placeholder= "Enter Invoice Date" class="box"/> <br>
    </div>                    

    <div style="float: left; width: 300px;">            
    Enter Number of days <input type="text" name="noOfDays" id="noOfDays" placeholder="Enter Number of Days Before payment" class="box"/> <br>
    </div>

    <div style="clear: both;"></div>

    Any Comments <input type="text" name="comments" id="comments" placeholder="Enter Any Comments" class="box" /> <br>


    <input type="submit" name="generate" value="Generate Invoice" /><br>

    </center>
	</form>

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

	if(isset($_POST['generate'])){

		$itemsql = mysqli_query($db_con, "SELECT * FROM user_waybill WHERE waybill_id = '".$waybill_id."'");
        $itemrow = $itemsql->fetch_assoc();

        $mycustomerName = mysqli_real_escape_string($db_con, $_POST['customerlist']);
        $mydate = date("Y-m-d");
        $customerSQL = "SELECT customerid FROM customer_t WHERE customername = '".$mycustomerName."'";
        $customerRUN = mysqli_query($db_con, $customerSQL);
        $customerFETCH = $customerRUN->fetch_assoc();
        $customerEXEC = $customerFETCH['customerid'];
        $customerlast4 = substr($customerEXEC, -4);

        $dateTime = strtotime($mydate);
        $new = floatval(25569 + $dateTime / 86400);
        $mynewdatetime = round($new, 3);

        $myinvoice_id = "IN-".$customerlast4."-".$mynewdatetime;
        $mybatch_code = $itemrow['batch_code'];
        $waybillID = $itemrow['waybill_id'];
        $description = $itemrow['description'];
        $productID = $itemrow['product_id'];
        echo $waybillID;
		$myproduct = mysqli_real_escape_string($db_con, $_POST['product']);
		$mymaterialNumber = mysqli_real_escape_string($db_con, $_POST['materialNumber']);
		$Qtydelivered = mysqli_real_escape_string($db_con, $_POST['qtydelivered']);
		$priceperKG = mysqli_real_escape_string($db_con, $_POST['priceperkg']);
		$mypurchaseOrder = mysqli_real_escape_string($db_con, $_POST['purchaseOrder']);
		$mypurchaseOrderDate = mysqli_real_escape_string($db_con, $_POST['purchaseOrderDate']);
		$myAmount = ($Qtydelivered * $priceperKG);
        $myInvoiceDate = mysqli_real_escape_string($db_con, $_POST['invoiceDate']);
        $mynoOfDays = mysqli_real_escape_string($db_con, $_POST['noOfDays']);
        $myComments = mysqli_real_escape_string($db_con, $_POST['comments']);
        $myCreatedBy = $_SESSION['login_user'];


		if(empty($myproduct) || empty($mymaterialNumber) || empty($Qtydelivered) || empty($priceperKG) || empty($waybillID)){
			?>
			<script type="text/javascript">
               window.alert("Error: All inputs must be filled");
            </script>
			<?php
		}else{

			$invoiceSQL = "REPLACE INTO user_invoice (id, customer_name, to_details, for_details, productID, description, waybillNo, QtyDelivered, pricePerItem, Amount, memberRequesting, engineNo, chassisNo, invoiceNo, date, deductions, deductions_type, other_deductions, number_of_days, invoice_date, createdBy, comments, batchCode, purchaseOrderDate, purchaseOrder, engineModel, factoryNumber, productType, manufactureDate, color, invoiceType) VALUES (NULL, '$mycustomerName', 'Nestle', '$myproduct', '$productID', '$description', '$waybillID', '$Qtydelivered', '$priceperKG', '$myAmount', 'N/A', 'N/A', 'N/A', '$myinvoice_id', '$mydate', 'N/A', 'N/A', 'N/A', '$mynoOfDays', '$myInvoiceDate', '$myCreatedBy', '$myComments', '$mybatch_code', '$mypurchaseOrderDate', '$mypurchaseOrder', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Nestle Invoice')";
			$invoice_insert = mysqli_query($db_con, $invoiceSQL);

			if(!$invoice_insert){
				echo ("Error: ".mysqli_error($db_con));
			}else if($invoice_insert){
				?>
			<script type="text/javascript">
               window.alert("Invoice has been created");
            </script>
            <?php
			}


		}




	}




    include 'adminfooter.php';
?>            