<?php

	   include("config.php");
     session_start();
     include ('adminheader.php');

?>

  
<section class="content-header">
      <h1 align="center">FILTER INVENTORY</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage BabbanGona Inventory</a></li>
        <li><a href="inventory_byitem.php">Filter Inventory By Warehouse</a></li>
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



<form action="" method=post>
<br>
<center>Enter Warehouse to get total amount available<br>
<!-- <input type="text" name="warehousesearch" placeholder="Enter Warehouse name" class="box"/> <br> -->
<br>
<p>
     
     <select name = "warehouselist" id="warehouselist" class="box">
      <option>Please Select a Warehouse</option>
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

<input type = "submit" name = "search" value = "Search" />

<br><br><br>
</center>

</form>


<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['search'])){

        $warehousesearch = mysqli_real_escape_string($db_con,$_POST['warehouselist']);
        $searchsql = "SELECT warehouse_name,SUM(amount_available) FROM inventory_table WHERE warehouse_name = '$warehousesearch'";
        $runsearch = mysqli_query($db_con, $searchsql);
        if(!$runsearch){
            echo "No success in query";
        }

        $searchrow = $runsearch->fetch_assoc();
        echo "Total amount of Items available in " .$searchrow['warehouse_name']. " is :" .$searchrow['SUM(amount_available)'];
        

        $sqlfetch_warehouse = "SELECT * FROM inventory_table WHERE warehouse_name = '$warehousesearch'";
        $run_fetch = mysqli_query($db_con, $sqlfetch_warehouse);
        if(!$run_fetch){
          die("Error " .mysqli_error());
        }

        while($row = mysqli_fetch_array($run_fetch)){
        
            print("<br>");
            print "Amount of " .$row['item']. " available in " .$row['warehouse_name']. " is: " .($row['amount_available'])." ".($row['unit_available']); 
    }
  }
}
?>




<!-- SUM(amount_available) -->
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