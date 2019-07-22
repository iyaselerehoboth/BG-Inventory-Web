<?php

	include("config.php");
    session_start();
    include ('userheader.php');

?>

<section class="content-header">
      <h1>Return Waybill</h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Manage BabbanGona Inventory</a></li>
          <li><a href="view_waybill.php">Return Waybill</a></li>
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



	<?php

	$waybill_id = $_GET['waybill'];
	$details = "SELECT * FROM user_waybill WHERE waybill_id = '".$waybill_id."'";
	$detailsQ = mysqli_query($db_con, $details);

	while($result = mysqli_fetch_assoc($detailsQ)){

		$waybill_id = $result['waybill_id'];
		$description = $result['description'];
		$product_id = $result['product_id'];
		$ship_from = $result['ship_from'];
		$quantity = $result['quantity'];
		$unit = $result['unit'];
		$batch_code = $result['batch_code'];
		$unit_of_measure = $result['unit_of_measure'];
		$emailAddress = $result['emailAddress'];
		$date = date("Y-m-d H:i:s");
		$personnelName = $result['personnelName'];
		$status = 'Reverted';
		$transaction_type = $result['transaction_type'];

	}

	echo "Waybill ID: " .$waybill_id;
	echo "<br>";
	echo "Warehouse Origin: " .$ship_from;
		echo "<br>";
	echo "Total Quantity: " .$quantity;

	?>

<form action = "" method = "post">
<br>
<input type="number" name="revert" placeholder="Enter amount to be returned" min="1" max="<?php echo $quantity ?>" class="box" />
<input type="text" name = "notes" placeholder = "Enter reason for Waybill return" class="box" />
<input type="submit" name="submit" value="Return">

</form>


<?php


	if(isset($_POST['submit'])){

        $myrevert = mysqli_real_escape_string($db_con, $_POST['revert']);//transaction_type
				$mynotes = mysqli_real_escape_string($db_con, $_POST['notes']);//Notes for Returning.
        //$mywarehouse = mysqli_real_escape_string($db_con, $_POST['origin']);//Warehouse to be reverted from.
        $new_waybill_id = $waybill_id."-Revert";

				//Edit - Rehoboth (14-06-19) Kola asked to remove the "warehouse to be reverted from" field because its not needed.
        $finalSql = "INSERT INTO user_waybill (waybill_id, description, product_id, ship_from, destination, quantity, unit , batch_code , unit_of_measure ,emailAddress, date, personnelName, status, notes, transaction_type) VALUES
				('$new_waybill_id','$description','$product_id','REVERT','$ship_from','$myrevert','$unit','$batch_code','$unit_of_measure','$emailAddress','$date','$personnelName','$status','$mynotes','$transaction_type')";
        $finalRun = mysqli_query($db_con, $finalSql);

        if($finalRun){
?>
		<script type="text/javascript">
      window.alert("Waybill <?php echo $waybill_id ?> has been returned");
    </script>

<?php
        }else{
        	die("Error: " .mysqli_error($db_con));
        }


    }

?>

</center>
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
    include 'adminfooter.php';
    ?>
