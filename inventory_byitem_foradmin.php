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
        <li><a href="inventory_byitem_foradmin.php">Filter Inventory By Item</a></li>
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

<center>Enter Product to get total amount available<br>
<input type="text" name="productsearch" placeholder="Enter item name" class="box"/> <br>
<input type = "submit" name = "search" value = "Search" />
</center>

</form>

<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['search'])){

        $itemsearch = mysqli_real_escape_string($db_con,$_POST['productsearch']);
        $searchsql = "SELECT item,SUM(amount_available) FROM inventory_table WHERE item = '$itemsearch'";
        $runsearch = mysqli_query($db_con, $searchsql);
        if(!$runsearch){
            echo "No success in query";
        }
        

        $searchrow = $runsearch->fetch_assoc();
        echo "Total amount of " .$searchrow['item']. " available in all BabbanGona warehouses: " .$searchrow['SUM(amount_available)']. ".";
        

        $sqlfetch_warehouse = "SELECT item,amount_available,warehouse_name,unit_available FROM inventory_table WHERE item = '$itemsearch'";
        $run_fetch = mysqli_query($db_con, $sqlfetch_warehouse);

        
        while($row = mysqli_fetch_array($run_fetch)){
        
            print("<br>");
            print "Amount of " .$row['item']. " available in " .$row['warehouse_name']. " is: " .($row['amount_available'])." ".($row['unit_available']);                

/*            $searchbywarehouse = "SELECT SUM(amount_available) FROM inventory_table WHERE warehousename = '" $row['warehouse_name'] "'";
            if(!$searchbywarehouse){
                die("Sql Error :" .mysqli_error());
            }
            $warehouserow = $searchbywarehouse->fetch_assoc();
            echo "Amount of " .$itemsearch. "available in " .$warehouserow['warehousename']. " is: " .$searchrow['SUM(amount_available)'];*/
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