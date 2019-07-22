<?php

    include("config.php");
    session_start();
    include ('userheader.php');

?>

<style>
    table{
        font-weight: normal;
        color: #333;
        font-family: Helvetica, Arial, sans-serif;
        width: 800px; 
        border-collapse: collapse; 
        border-spacing: 0; 
        }
    td, th {  
        border: 1px solid  #45b39d; /* No more visible border */
        height: 30px; 
        transition: all 0.3s;  /* Simple transition for hover effect */
        }

    thead {  
            background: #DFDFDF;  /* Darken header a bit */
            text-align: center;
            font-weight: bold;
        }

    tbody {  
            background: #FAFAFA;
            text-align: center;
            font-weight: lighter;
        }
    
    
</style>

 <section class="content-header">
      <h1>Cancel Transaction</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage BabbanGona Inventory</a></li>
        <li><a href="cancel_transaction.php">Cancel Transactions</a></li>
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
              
                              
<center>
<form action="" method=post>       
<br>Enter Transaction ID<input type="text" name="transidlist" autocomplete="off" placeholder="Enter ID of Transaction to be Cancelled" class="box"/> <br>
                
<input type = "submit" name = "search" value = "Search ID" />
                
</form>
    
</center>
                
<?php
                
error_reporting(E_ERROR);
                
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['search'])){

        $transid = mysqli_real_escape_string($db_con,$_POST['transidlist']);
        $transsql = "SELECT transactionID, itemID, region, destination, unit, quantity, transaction_type FROM web_transactions WHERE transactionID = '$transid'";
        $transexecute = mysqli_query($db_con,$transsql);
        if(!$transexecute){
        ?>
    
        <br><br>
        <p>Error: No such transaction is actively existing</p>

        <?php                
        }
        
        while($row = mysqli_fetch_array($transexecute)){
?>
        <br><br>
        <table class="cancel_table">
            <thead>
                <tr>
                    <th> TransactionID </th>
                    <th> Item ID </th>
                    <th> Region </th>
                    <th> Destination </th>
                    <th> Unit </th>
                    <th> Quantity</th>
                    <th> Transaction Type </th>
                    <th> Cancel Transaction </th>
                </tr>
            </thead> 
            
            <tbody>
                <tr>
                    <td><?php echo $row['transactionID']; ?></td>
                    <td><?php echo $row['itemID']; ?></td>
                    <td><?php echo $row['region']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['unit']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['transaction_type']; ?></td>
                    <td><a href="cancel.php?cancel=<?php echo $row['transactionID']; ?>" onclick ='return confirm("Are you sure you want to cancel this transaction ?")'>cancel</a></td>
                </tr>
            </tbody>
        </table>
 
<?php                                              
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
        
        
        <div class="footer">
            
<?php
    include 'adminfooter.php';
    ?>