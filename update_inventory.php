<?php 
include("config.php");
session_start();
include ('adminheader.php');




?>

<section class="content-header">
      <h1>Update Inventory</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage BabbanGona Inventory</a></li>
        <li><a href="update_inventory.php">Update Inventory</a></li>
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
                
                <br>
                <h2>Update Babban Gona Inventory</h2>
                
            </center>


<center>
  <br>
<form action="" method=post>
  
  
  <p>
    Enter Warehouse ID 
     <select name = "warehouseid" id="warehouseid" class="box">
     <?php
       $warehousesql = mysqli_query($db_con, "SELECT DISTINCT warehouseid FROM warehouse_t");
       while($warehouserow = $warehousesql->fetch_assoc()){
        ?>

         <option value="<?php echo $warehouserow['warehouseid']; ?>"><?php echo $warehouserow['warehouseid']; ?></option>

      <?php
      }
    ?>
    </select>
                    

</p>


  
  <p>
     Enter Warehouse Name
     <select name = "warehousename" id="warehousename" class="box">
     <?php
       $warehousesql = mysqli_query($db_con, "SELECT DISTINCT warehousename FROM warehouse_t");
       while($warehouserow = $warehousesql->fetch_assoc()){
        ?>

         <option value="<?php echo $warehouserow['warehousename']; ?>"><?php echo $warehouserow['warehousename']; ?></option>

      <?php
      }
    ?>
    </select>
                    

</p>


  
  <p>
     Enter item available
     <select name = "item" id="item" class="box">
     <?php
       $warehousesql = mysqli_query($db_con, "SELECT DISTINCT itemname FROM item_t");
       while($warehouserow = $warehousesql->fetch_assoc()){
        ?>

         <option value="<?php echo $warehouserow['itemname']; ?>"><?php echo $warehouserow['itemname']; ?></option>

      <?php
      }
    ?>
    </select>
                    

</p>

  Enter Parent Warehouse<input type="text" name="parentwarehouse" placeholder="Enter 'none' if warehouse has no parent" class="box"/> <br>

  Enter amount of available item <input type="text" name="itemamount" placeholder="Enter amount available" class="box"/> <br>

  Enter unit available <input type="text" name="itemunit" placeholder="Enter unit in Bags" class="box"/> <br>

  <input type="submit" name='update' value=" Update Inventory " />

</form>

</center>


<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    
    if(isset($_POST['update'])){

        $mywarehouseid = mysqli_real_escape_string($db_con,$_POST['warehouseid']);
        $mywarehousename = mysqli_real_escape_string($db_con,$_POST['warehousename']);
        $myparentwarehouse = mysqli_real_escape_string($db_con,$_POST['parentwarehouse']);
        $myitem = mysqli_real_escape_string($db_con,$_POST['item']);
        $myitemamount = mysqli_real_escape_string($db_con,$_POST['itemamount']);
        $myitemunit = mysqli_real_escape_string($db_con,$_POST['itemunit']);


        $mysqlquery = "UPDATE inventory_table SET item = '$myitem', warehouse_name = '$mywarehousename', amount_available = '$myitemamount', unit_available = '$myitemunit' WHERE warehouse_id = '$mywarehouseid'";

        $runsql = mysqli_query($db_con, $mysqlquery);

        if(!$runsql){
          
          die ("Error encountered while updating details " .mysqli_error($db_con));

        }else{

         ?>

    <script type="text/javascript">
      window.alert("Inventory update Success !");
    </script>

    <?php
          //echo "<script>window.open('view_inventory.php','_self')</script>";
        
        }

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



  <?php
    include 'adminfooter.php';
    ?>