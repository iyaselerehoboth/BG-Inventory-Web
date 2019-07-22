<?php

    include("config.php");
    session_start();
    include ('userheader.php');

?>

<style>

table {
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%;
    border: none;
    float: center;
    /*border-collapse: collapse; */
    border-spacing: 3px;

}

td, th {
    /*border: 1px solid  #45b39d; /* No more visible border */
    height: 30px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    padding: 2px;
}

th {
    color: white;
    background: #377EAA;  /* Darken header a bit */
    text-align: center;
    font-weight: bold;
}

td {
    white-space: pre;
    background: #FAFAFA;
    font-weight: normal;
    text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */
tr:nth-child(even) td { background: #bab8b8; }

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */
tr:nth-child(odd) td { background: #FEFEFE; }

tr:hover td{ background: #666; color: #FFF; }
/* Hover cell effect! */


</style>


<section class="content-header">
      <h1>All Waybills</h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Manage BabbanGona Inventory</a></li>
          <li><a href="view_waybill.php">Create Transaction</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="row">
          <div class="col-sm-12">



      <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                          <div class="col-sm-0"></div>
                          <div class="col-sm-15">


   <center>
<b><center><h5>View All Waybills</h5></center>

<?php
$waybill_id = $_GET['waybill'];
$waybillDetailSql = "SELECT * FROM conversion_waybill WHERE waybill_id = '".$waybill_id."'";
$waybillDetailExecute = mysqli_query($db_con,$waybillDetailSql);


?>

<br>

<div  style="overflow-x:auto;">
<table>
    <thead>
      <tr>
        <th>S/NO</th>
        <th>Waybill ID</th>
        <th>Product ID</th>
        <th>Description</th>
        <th>Quantity to Convert</th>
        <th>Original Unit Of Measure</th>
        <th>Conversion Unit of Measure</th>
        <th>Destination</th>
        <th>Purpose For Conversion</th>
        <th>Email Address</th>
        <th>Date Created</th>
        <th>SD Personnel</th>
        <th>Waybill Status</th>
        <th>Transaction Type</th>
      </tr>
    </thead>

    <tbody>

      <?php

        while($waybillDetailRun = mysqli_fetch_array($waybillDetailExecute)){
      ?>
          <tr>
              <td><?php echo $waybillDetailRun['id']; ?></td>
              <td><?php echo $waybillDetailRun['waybill_id']; ?></td>
              <td><?php echo $waybillDetailRun['product_id']; ?></td>
              <td><?php echo $waybillDetailRun['description']; ?></td>
              <td><?php echo $waybillDetailRun['quantityToConvert']; ?></td>
              <td><?php echo $waybillDetailRun['originalUnitOfMeasure']; ?></td>
              <td><?php echo $waybillDetailRun['conversionUnitOfMeasure']; ?></td>
              <td><?php echo $waybillDetailRun['destination']; ?></td>
              <td><?php echo $waybillDetailRun['purposeForConversion']; ?></td>
              <td><?php echo $waybillDetailRun['emailAddress']; ?></td>
              <td><?php echo $waybillDetailRun['date']; ?></td>
              <td><?php echo $waybillDetailRun['personnelName']; ?></td>
              <td><?php echo $waybillDetailRun['status']; ?></td>
              <td><?php echo $waybillDetailRun['transaction_type']; ?></td>
            </tr>

<?php
$itemName = $waybillDetailRun['description'];
$itemID = $waybillDetailRun['product_id'];
?>


      <?php
        }
      ?>

    </tbody>
  </table>
</div>



</b>
<?php
if($_SESSION['sessionlevel'] == 3){

?>

<br><br><br>
<form action="" method="post">
<div style="float: left; width: 520px;">
<input type="submit" name="approve" value="Approve Waybill" onclick="itemQR(); waybillQR();"  />
</div>

<div style="float: right; width: 520px;">
<input type="submit" name="decline" value="Decline Waybill" />
</div>
<div style="clear: both;"></div>
</form>

<?php

  }

?>

</center>

<script>

  function waybillQR(){
        var val = "<?php echo $waybill_id ?>";
        if("1" == "1"){

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){

                if(xmlhttp.readyState == 4){
                    //document.getElementById('warehouse_error').innerHTML = xmlhttp.responseText;
                }
            }

          xmlhttp.open("GET", "qr_code.php?qrwaybill_id=" +val, true);
          xmlhttp.send();
          alert("Hello world!");

        }
     }


  function itemQR(){

        var itemName = "<?php echo $itemName ?>";
        var itemID = "<?php echo $itemID ?>";

        if("1" == "1"){

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){

                if(xmlhttp.readyState == 4){
                    //document.getElementById('warehouse_error').innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "item_qr_code.php?itemName=" +itemName+"&itemID=" +itemID, true);
            xmlhttp.send();
            alert("Hello Again!");
        }
    }

</script>



<?php

  if(isset($_POST['approve'])){

      $approveWaybillSql = "UPDATE conversion_waybill SET status = 'Approved' WHERE waybill_id = '".$waybill_id."'";
      $approveWaybillRun = mysqli_query($db_con, $approveWaybillSql);
      if($approveWaybillRun){

    }else{
      die("Error: ".mysqli_error($db_con));
    }

}

?>




</div>
                        <div class="col-sm-0"></div>
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
