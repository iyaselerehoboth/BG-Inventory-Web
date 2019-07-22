<?php

include("config.php");
session_start();
include ('adminheader.php');

$sql = "SELECT * FROM web_transactions ORDER BY id desc";


$viewquery = mysqli_query($db_con, $sql);

if(!$viewquery){
    die('SQL Error: ' .mysqli_error($db_con));
    
    
}

?>

<style>
    
    table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%; 
    border-collapse: collapse; 
    border-spacing: 0; 
}

td, th {  
    border: 1px solid  #45b39d; /* No more visible border */
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
}

th {  
    background: #DFDFDF;  /* Darken header a bit */
    text-align: center;
    font-weight: bold;
}

td {  
    background: #FAFAFA;
    text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
/* Hover cell effect! */
    
    
</style>


?>

<section class="content-header">
      <h1 align="center">View All Shipments</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="admin_view_transaction.php">View All Shipments</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-12">
          
              
              

    <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                        <div class="col-sm-12">

            <center>

            <div  style="overflow-x:auto;">
            <table class = "data-table" BORDER="2"    WIDTH="125%"   CELLPADDING="10" CELLSPACING="30" >
                <caption class="title"><h3>All Web Generated Inventory Shipments</h3></caption>
                
                
                <thead>
                    
                    <tr  ALIGN="CENTER">
                        <th>S/NO</th>
                <th>Transaction ID</th>
                <th>Removal Region</th>
                <th>Destination Region</th>
                <th>Item Name</th>
                <th>Item ID</th>
                <th>Amount</th>
                <th>Created By</th>
                <th>Date</th>
                <th>SD Status</th>
                <th>PC Status</th>
                <th>Transaction Type</th>              
                    </tr>
                
                
                </thead>
                
                <tbody>
                    <?php
                    
                    $no = 1;
                    $total = 0;
                    while($row = mysqli_fetch_array($viewquery)){
                        
                    
                        print '<tr  ALIGN="CENTER">
                                <td>'.$row['id'].'</td>                           
                                <td>'.$row['transactionID'].'</td>
                                <td>'.$row['region'].'</td>
                                <td>'.$row['destination'].'</td>
                                <td>'.$row['item'].'</td>
                                <td>'.$row['itemID'].'</td>
                                <td>'.$row['quantity'].' '.$row['unit'].'</td>
                                <td>'.$row['personnelName'].'</td>
                                <td>'.$row['date'].'</td>
                                <td>'.$row['sdstatus'].'</td>
                                <td>'.$row['pcstatus'].'</td>
                                <td>'.$row['transaction_type'].'</td>
                                <tr>';

                                                       
                        $no++;
                    }
                    $amount = $viewquery->num_rows;
                    
                    ?>            
                </tbody>
                
                <tfoot>
                    <tr ALIGN="CENTER">
                        <th colspan="10">Total Amount of Transactions</th>
                        <th colspan="3"><?=number_format($amount)?></th>
                    
                    </tr>
                
                </tfoot>
        
        
            </table>
        </div>

                


        </div>
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
       