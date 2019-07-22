<?php
    include("config.php");
    session_start();
    include ('userheader.php');


$sql = "SELECT * FROM web_transactions";
$viewquery = mysqli_query($db_con, $sql);
$amount = $viewquery->num_rows;


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
    color: white;
    background: #377EAA;  /* Darken header a bit */
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
 
.search{
    position: relative;
}   

.search input[type="text"]{
    width: 220px;
}

.search input[type="button"]{
    width: 75px;
    height: 25px;
    text-align: left;
    background-image: url("magnifying-lens.png");
    background-position: right top;
    background-repeat: no-repeat;
    background-size: contain; 
}



    
</style>



<section class="content-header">
      <h1 align="center">View All Transactions</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="view_transaction.php">View All Transactions</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-14">
          
              
              

    <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                        <div class="col-sm-12">
                      
    <H4 align = "center">Welcome <?php echo $_SESSION['login_user']?></H4>
    <H5>Total Amount of Transactions: <?php echo $amount ?></H5>

<!-- <form action="es_search_user.php" method="post" align="right">Type Staff Name Here <input  type = "text" width= "48" name = "staff_name" /><input  type = "submit" name = "search"  value="SEARCH"/></form> -->

<div class="search">
<form action="filter_search.php" method="post">
<input type="text" name="searchtext" placeholder="Search Shipments Table......     "/>
<input type="submit" name="search" value="Search"  />
</form>
</div>

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
                    while($run = mysqli_fetch_array($viewquery)){

                        if(($run['sdstatus'] == 'Delivered') &&($run['pcstatus'] == 'Authorized')){
                            $trans = $run['transactionID'];
                            
                        $updatesql = "UPDATE web_transactions SET status = 'Completed' WHERE transactionID = '$trans'";
                        
                            $update = mysqli_query($db_con, $updatesql);
                        }

                    }


                    //This is the pagination function.
                    /*if(isset($_GET['pageno'])){
                        $pageno = $_GET['pageno'];
                    }else{
                        $pageno = 1;
                    }
                    $no_of_records_per_page = 25;
                    $offset = ($pageno-1) * $no_of_records_per_page;

                    $total_pages_sql = "SELECT COUNT(transactionID) FROM web_transactions ORDER BY id desc";
                    $result = mysqli_query($db_con,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);*/
                    
                    //Pagination SQL Query.
                    //$runagain =  "SELECT * FROM web_transactions ORDER BY id desc LIMIT $offset, $no_of_records_per_page";

                    $runagain = "SELECT * FROM web_transactions ORDER BY id desc LIMIT 20";
                    $runquery = mysqli_query($db_con, $runagain);
                    while ($result = mysqli_fetch_array($runquery)){
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
                            <td style = "white-space: pre;" >'.$result['comments'].'</td>
                    </tr>';
                    }  
                    
                
           ?>
        </tbody>

        
    </center>

</table>
</div>

<!-- This is the bottom links for the pagination. -->
<!-- <center>
<ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
</center> -->


<br><br>
<center>
<div class="export">
<form action="export_table.php" method="post">
<input type="submit" name="exportToExcel" value="Export Complete Table"  />
</form>
</div>
</center>



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