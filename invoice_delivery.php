<?php
include("config.php");
session_start();
include ('userheader.php');
//$waybill_id = $_GET['waybill'];


?>


 <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">

    <form action = "" method = "post">
    <center>

    <br>
    <div style="float: left; width: 300px;">
     Enter Customer Name:
    <input type="text" name="customerName" list="customerdrop" id="customerName" placeholder="Enter Customer Name" onchange="autofillcustomer(this.value);" class="box">
    <datalist id="customerdrop">
        <?php
            $customersql = mysqli_query($db_con, "SELECT DISTINCT customername FROM customer_t");
            while($customerrow = $customersql->fetch_assoc()){
        ?>
            <option value="<?php echo $customerrow['customername'];?>"><?php echo $customerrow['customername']; ?></option>

        <?php    
            }
                
        ?>
   
    </datalist>
    <br>
	</div>

    <div style="float: right; width: 300px;">
    Enter Customer ID:
    <input type="text" name="customerID" id="customerID" placeholder="Enter Customer ID" class="box">
    <br>
	</div>
	
	<div style="clear: both;"></div>

    <div style="float: right; width: 300px;"> 
    Enter Product Name <input type="text" list="itemdrop" name="product" id="product" placeholder= "Enter Product Name" onchange="autofill(this.value);" class="box"/> <br>
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
    </div>                    

    <div style="float: left; width: 300px;">            
    Enter Product ID <input type="text" list="productdrop" name="product_id" id="product_id" placeholder="Enter Product ID" class="box"/> <br>
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
    </div>


    <div style="clear: both;"></div>

    <div style="float: right; width: 300px;"> 
    Enter Amount Delivered. <input type="text" name="amountDelivered" id="amountDelivered" placeholder= "Enter Amount Delivered" class="box"/> <br>
    </div>                    

    <div style="float: left; width: 300px;">            
    Enter Corresponding Waybill <input type="text" name="waybill_id" id="waybill_id" placeholder=" Enter Corresponding Waybill ID" class="box"/> <br>
    </div>

    <div style="clear: both;"></div>

    <div style="float: right; width: 300px;"> 
    Enter Team Member's ID <input type="text" name="member_id" id="member_id" placeholder= "Enter Team Member's ID" class="box"/> <br>
    </div>                    

    <div style="float: left; width: 300px;">            
    Select Date Delivered. <input type="date" name="delivery_date" id="delivery_date" placeholder="Select Date Delivered" class="box"/> <br>
    </div>


    <input type="submit" name="generate" value="Generate Delivery Invoice"  onclick="itemQR(); customerQR();" /><br>

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


<script>

 function autofill(stringName){
        
 var confirmname = document.getElementById('product').value;
 //var itemname = document.getElementById('itemlist').value;

 if(1 == 1){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
    
    if(xmlhttp.readyState == 4){
        
        document.getElementById('product_id').value = xmlhttp.responseText;
            }
        }
        
        xmlhttp.open("GET", "autofill.php?value=" +stringName, true);
        xmlhttp.send();
    }
 }


function autofillcustomer(stringClient){

    //var customer1 = document.getElementById('customerlist').value;
    //var customer2 = document.getElementById('customerconfirmlist').value;


    if(1 == 1){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){

            if(xmlhttp.readyState == 4){
                document.getElementById('customerID').value = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "autofillclient.php?client=" +stringClient, true);
        xmlhttp.send();
    }
} 

</script> 


<?php

	if(isset($_POST['generate'])){

		
		$mycustomername = mysqli_real_escape_string($db_con, $_POST['customerName']);
        $mycustomerid = mysqli_real_escape_string($db_con, $_POST['customerID']);
        $myproduct = mysqli_real_escape_string($db_con, $_POST['product']);
        $myproductid = mysqli_real_escape_string($db_con, $_POST['product_id']);
        $mydate = mysqli_real_escape_string($db_con, $_POST['delivery_date']);
        $myamountdelivered = mysqli_real_escape_string($db_con, $_POST['amountDelivered']);
        $mywaybill = mysqli_real_escape_string($db_con, $_POST['waybill_id']);
        $myteamMember = mysqli_real_escape_string($db_con, $_POST['member_id']);
        $myNowdate = date("Y-m-d");




		if(empty($myproduct) || empty($mycustomerid) || empty($mycustomername) || empty($myproductid)  || empty($mywaybill) || empty($mydate)|| empty($myteamMember)|| empty($myamountdelivered) ){
			?>
			<script type="text/javascript">
               window.alert("Error: All inputs must be filled");
            </script>
			<?php
		}else{

			$invoiceSQL = "INSERT INTO delivery_invoice (product_name, product_id, customer_name, customer_id, delivered_amount, waybill_id, team_member_id, date_delivered, date) VALUES ('$myproduct', '$myproductid', '$mycustomername', '$mycustomerid', '$myamountdelivered', '$mywaybill', '$myteamMember', '$mydate', '$myNowdate')";

			$invoice_insert = mysqli_query($db_con, $invoiceSQL);

			if(!$invoice_insert){
				echo ("Error: ".mysqli_error($db_con));
                ?>
            <script type="text/javascript">
               window.alert("Error in creating invoice");
            </script>
            <?php
			}else if($invoice_insert){
				?>
			<script type="text/javascript">
               window.alert("Delivery Invoice has been created");
            </script>
            <?php
			}


		}




	}
?>
<script>
    
function itemQR(){  

        var itemName = document.getElementById('product').value;
        var itemID = document.getElementById('product_id').value;

        if("1" == "1"){

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){

                if(xmlhttp.readyState == 4){
                    //document.getElementById('warehouse_error').innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "combined_product_qr_code.php?itemName=" +itemName+"&itemID=" +itemID, true);
            xmlhttp.send();
            //alert("Hello Again!");
        }
}

function customerQR(){
        var customerName = document.getElementById('customerName').value;
        var customerID = document.getElementById('customerID').value;
        
        if("1" == "1"){

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){

                if(xmlhttp.readyState == 4){
                    //document.getElementById('warehouse_error').innerHTML = xmlhttp.responseText;
                }
            }

          xmlhttp.open("GET", "combined_customer_qr_code.php?customerName=" +customerName+"&customerID=" +customerID, true);
          xmlhttp.send();
          //alert("Hello world!");

        }
}    



</script>


<?php

    include 'adminfooter.php';
?>            