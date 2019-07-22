<?php
  /*include("config.php");*/
  //session_start();
  if(!$_SESSION['login_user']){
    header("location: error404.php");
    exit();
  }
?>

<li class="treeview">
  <a href="#">
    <i class="fa fa-tags"></i> <span> Manage Inventory</span> <i class="fa fa-angle-left pull-right"></i>
  </a>
<ul class="treeview-menu">
  <li><a href="view_transaction.php"><i class="fa fa-circle-o"></i> View All Shipments</a></li>

  <?php
  $passedlevel = $_SESSION['sessionlevel'];
  if($passedlevel == 3 || $passedlevel == 0){
  ?>

  <li><a href="create_transaction.php"><i class="fa fa-circle-o"></i> Create Shipment</a></li>
  <li><a href="cancel_transaction.php"><i class="fa fa-circle-o"></i> Cancel Shipment</a></li>
  <li><a href="view_invoice.php"><i class="fa fa-circle-o"></i> View All Invoices</a></li>

  <?php
  }
  ?>
  </li>
</ul>
</li>

<?php
  $passedlevel = $_SESSION['sessionlevel'];
  if($passedlevel == 3 || $passedlevel == 0){
?>
      <li class="treeview">
      <a href="#">
        <i class="fa fa-shopping-cart"></i> <span> Manage Delivery Invoices</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="invoice_delivery.php"><i class="fa fa-circle-o"></i> Generate Delivery Invoices</a></li>
        <li><a href="view_delivery_invoice.php"><i class="fa fa-circle-o"></i> View Delivery Invoices</a></li>
      </ul>
    </li>

<?php
  }
?>


<?php
  $passedlevel = $_SESSION['sessionlevel'];
  if($passedlevel == 1 || $passedlevel == 3 || $passedlevel == 0){
?>
<li class="treeview">
  <a href="#">
    <i class="fa fa-truck"></i> <span> Manage Waybills</span> <i class="fa fa-angle-left pull-right"></i>
  </a>
<ul class="treeview-menu">
      <li><a href="waybill_choose.php"><i class="fa fa-circle-o"></i> Create Waybill</a></li>
      <!-- <li><a href="upload_waybill.php"><i class="fa fa-circle-o"></i> Upload Waybill</a></li> -->
      <li><a href="approved_waybill.php"><i class="fa fa-circle-o"></i> View Approved Waybills</a></li>
      <li><a href="all_waybill.php"><i class="fa fa-circle-o"></i> View All Waybills</a></li>
</ul>
</li>

<li class="treeview">
<a href="#">
  <i class="fa fa-exchange"></i> <span> Manage Conversions</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
  <li><a href="create_conversion.php"><i class="fa fa-circle-o"></i> Create Conversion Waybill</a></li>
  <li><a href="all_conversion_waybill.php"><i class="fa fa-circle-o"></i> View Conversion Waybills</a></li>
</ul>
</li>
<?php
  }
?>

<?php
  $passedlevel = $_SESSION['sessionlevel'];
  if($passedlevel == 2 || $passedlevel == 0){
?>
<li class="treeview">
  <a href="#">
    <i class="fa fa-book"></i> <span> Manage Assets </span> <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
  <li><a href="move_asset.php"><i class="fa fa-circle-o"></i> Create Asset Movement</a></li>
  <li><a href="view_asset_location.php"><i class="fa fa-circle-o"></i> View Asset Movements</a></li>
  <li><a href="#"><i class="fa fa-circle-o"></i> View Asset Location</a></li>
  </ul>
</li>
<?php
  }
?>

<li><a href="logout.php"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>


<!-- </ul> -->
</section>
<!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
