<?php

    include("config.php");
    session_start();
    include ('userheader.php');
 
   
?>

<section class="content-header">
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

	<br><br><br>
	<h5>
    <p> This is the bulk waybill page. Upload csv file to create a waybill with bulk movements</p>

    <p>Click <a href="sample_waybill_download.php">here </a> to download a sample waybill CSV file </p>
	</h5>

	<form enctype="multipart/form-data" method="post" id="uploadForm" action = "">

		<p>
    Select Waybill's Transaction Type
    <select name="transtype" id="transtype" class="box"/>
        <option> </option>
        <option value="Trans-Shipment">Trans-Shipment</option>
        <option value="Sales Shipment">Sales Shipment</option>
        <option value="Shipment to Nestle">Shipment to Nestle</option>
        <option value="Shipment to Customers">Shipment to Customers</option>
        <option value="Shipment to Vendors">Shipment to Vendors</option>
    </select>
    </p> 

	    <input name="csvUpload" id="upload" type="file" accept=".csv" class="box" />
	    <input type="submit" value="Upload" />
	</form>

</center>

<?php

if(isset($_FILES['csvUpload'])) {
	$errors = array();
	$allowed_ext = array('csv');

	$file_name = $_FILES['csvUpload']['name'];
	$end_tmp = explode('.', $file_name);
	$file_ext = strtolower(end($end_tmp));
	$file_size = $_FILES['csvUpload']['size'];
	$file_tmp = $_FILES['csvUpload']['tmp_name'];
	$table = "user_waybill";

	if(in_array($file_ext, $allowed_ext) === false){
		$errors[] = 'This file extension is not valid';
	}

	if($file_size > 10485760){
		$errors[] = 'This file exceeda the limit of 10MB';
	}
	if(empty($errors)){
		$waybillID = rand(354525,4654363);
		$mytranstype = $_POST['transtype'];
		move_uploaded_file($file_tmp, "WaybillUploads/".$file_name);
		$file_dir = "WaybillUploads";
		$file_path = "WaybillUploads/".$file_name;
		$upload = mysqli_query($db_con, '
    	LOAD DATA LOCAL INFILE "'.$file_path.'"
        INTO TABLE user_waybill
        FIELDS TERMINATED by \',\'
        LINES TERMINATED BY \'\n\'
        (description, product_id, ship_from, destination, quantity, unit, batch_code, unit_of_measure, emailAddress, personnelName)
       	SET waybill_id = "'.$waybillID.'", date = NOW(), status = "Awaiting Approval", transaction_type = "'.$mytranstype.'"
 		')or die(mysqli_error($db_con));


		if($upload){
			$dirHandle = opendir($file_dir);
			while($file = readdir($dirHandle)){
				if($file == $file_name){
					unlink($file_dir."/".$file_name);
				}
			}
			closedir($dirHandle);
?>
<!-- Close and re-open php so we can use javascript. -->
			<script type="text/javascript">
               window.alert("File has been successfully uploaded.");
            </script>

<?php
		}
		
	}else{
		print_r($errors);
	}

}

	
?>


      
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
