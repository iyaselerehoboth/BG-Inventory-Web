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
    background: #bab8b8;  /* Darken header a bit */
    text-align: center;
    font-weight: bold;
}

td {  
    white-space: pre;
    background: #FAFAFA;
    text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #bab8b8; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr:hover td{ background: #666; color: #FFF; }  
/* Hover cell effect! */
 
button {
    background-position: left top;
    background-repeat: no-repeat;
    background-size: 50px 50px;
    width: 50px;
    height: 50px;
    background-image: url("back.png");
    /*text-decoration: none;
    color: initial;*/
}

button img{
  position: relative;
}

</style>


<?php
    $itemname = ($_POST['searchtext']);

    if(empty($itemname)){
      echo("Please type a word and search again");
      exit();
      
    }

    $filterSQL = "SELECT * FROM web_transactions WHERE (transactionID LIKE '%$itemname%') OR (region LIKE '%$itemname%') OR (destination LIKE '%$itemname%') OR (item LIKE '%$itemname%') OR (date LIKE '%$itemname%') OR (sdpersonnel LIKE '%$itemname%') OR (transaction_type LIKE '%$itemname%') ORDER BY id DESC";

    $filterResult = mysqli_query($db_con, $filterSQL);
?>

<section class="content-header">
      <H3 align = "center">Search Results</H3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Search Results</a></li>
        <li><a href="filter_search.php">Welcome</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-12">



<a href="view_transaction.php">Go back to Shipments.</a>
<!-- <button onclick= "window.location.href='view_transaction.php'"> </button><br> -->
<div  style="overflow-x:auto;">
<table class="transaction_table" id="transaction_table">
  <center><!--<h5>Babban Gona Transactions</h5>-->
        <thead>
            <tr align = "center">
                <th>S/NO</th>
                <th>Transaction ID</th>
                <th>Removal Region</th>
                <th>Destination Region</th>
                <th>Item Name</th>
                <th>Item ID</th>
                <th>Amount</th>
                <th>Created By</th>
                <th>Date</th>
                <th>Status</th>
                <th>SD Status</th>
                <th>SD Personnel</th>
                <th>PC Status</th>
                <th>Transaction Type</th>
                <th>Comments</th>
            </tr>
        </thead>

        <tbody>

            
           <?php
                    while ($result = mysqli_fetch_array($filterResult)){
                       print'<tr align = "center">
                            <td>'.$result['id'].'</td>
                            <td>'.$result['transactionID'].'</td>
                            <td>'.$result['region'].'</td>
                            <td>'.$result['destination'].'</td>
                            <td>'.$result['item'].'</td>
                            <td>'.$result['itemID'].'</td>
                            <td>'.$result['quantity'].' '.$result['unit'].'</td>
                            <td>'.$result['personnelName'].'</td>
                            <td>'.$result['date'].'</td>
                            <td>'.$result['status'].'</td>
                            <td>'.$result['sdstatus'].'</td>
                            <td>'.$result['sdpersonnel'].'</td>
                            <td>'.$result['pcstatus'].'</td>
                            <td>'.$result['transaction_type'].'</td>
                            <td>'.$result['comments'].'</td>
                    </tr>';
                    }  
                    
                
           ?>
        </tbody>

        
    </center>

</table>
</div>


          
              
              

    <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">




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
