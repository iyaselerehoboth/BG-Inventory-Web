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



<b><center><h5>View All Waybills</h5></center></b>

<a href="all_waybill.php">Go back to All Waybills..</a>
</br>

<?php
 $itemname = ($_POST['searchtext']);

    if(empty($itemname)){
      echo("Please type a word and search again");
      exit();

    }

    $filterSQL = "SELECT * FROM user_waybill WHERE (waybill_id LIKE '%$itemname%') OR (ship_from LIKE '%$itemname%') OR (destination LIKE '%$itemname%') OR (description LIKE '%$itemname%') OR (date LIKE '%$itemname%') OR (personnelName LIKE '%$itemname%') OR (transaction_type LIKE '%$itemname%') ORDER BY id DESC";

    $filterResult = mysqli_query($db_con, $filterSQL);
if(!$filterResult){
  die("Error: " .mysqli_error($db_con));
}

?>

<br>

<div  style="overflow-x:auto;">
<table>
    <thead>
      <tr>
        <th>S/NO</th>
        <th>Waybill ID</th>
        <th>Description</th>
        <th>Product ID</th>
        <th>Ship From</th>
        <th>Destination</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Batch Code</th>
        <th>Unit of Measure</th>
        <th>Intended Location</th>
        <th>SD Personnel</th>
        <th>Email Address</th>
        <th>Waybill Status</th>
        <th>Date Created</th>
        <th>Transaction Type</th>
      </tr>
    </thead>

    <tbody>

      <?php

        while($waybillDetailRun = mysqli_fetch_array($filterResult)){
      ?>
          <tr>
              <td><?php echo $waybillDetailRun['id']; ?></td>
              <td><?php echo $waybillDetailRun['waybill_id']; ?></td>
              <td><?php echo $waybillDetailRun['description']; ?></td>
              <td><?php echo $waybillDetailRun['product_id']; ?></td>
              <td><?php echo $waybillDetailRun['ship_from']; ?></td>
              <td><?php echo $waybillDetailRun['destination']; ?></td>
              <td><?php echo $waybillDetailRun['quantity']; ?></td>
              <td><?php echo $waybillDetailRun['unit']; ?></td>
              <td><?php echo $waybillDetailRun['batch_code']; ?></td>
              <td><?php echo $waybillDetailRun['unit_of_measure']; ?></td>
              <td><?php echo $waybillDetailRun['intended_location']; ?></td>
              <td><?php echo $waybillDetailRun['personnelName']; ?></td>
              <td><?php echo $waybillDetailRun['emailAddress']; ?></td>
              <td><?php echo $waybillDetailRun['status']; ?></td>
              <td><?php echo $waybillDetailRun['date']; ?></td>
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

</center>


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
