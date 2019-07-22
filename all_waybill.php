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
                          <div class="col-sm-0">


<b><center><h4>View All Waybills</h4></center></b>

<div class="search">
<form action="waybill_search_details.php" method="post">
<input type="text" name="searchtext" placeholder="Search Waybill Table............     "/>
<input type="submit" name="search" value="Search"  />
</form>
</div>

<?php
$waybillsql = "SELECT DISTINCT waybill_id, personnelName, emailAddress, status, date, transaction_type FROM user_waybill GROUP BY waybill_id ORDER BY id DESC";
$waybillexecute = mysqli_query($db_con,$waybillsql);
?>

<div style="overflow-x:auto;">
<center>
<table>
    <thead>
      <tr>
        <th>Waybill ID</th>
        <th>SD Personnel</th>
        <th>Email Address</th>
        <th>Waybill Status</th>
        <th>Date Created</th>
        <th>Transaction Type</th>
      </tr>
    </thead>

    <tbody>
      
      <?php
         //The Pagination function begins here.
      if(isset($_GET['pageno'])){
        $pageno = $_GET['pageno'];
      }else{
        $pageno = 1;
      }
      $no_of_records_per_page = 15;
      $offset = ($pageno-1) * $no_of_records_per_page;

      $total_waybill = "SELECT COUNT(waybill_id) FROM user_waybill ORDER BY id DESC";
      $total_result = mysqli_query($db_con, $total_waybill);
      $total_rows = mysqli_fetch_array($total_result)[0];
      $total_pages = ceil($total_rows / $no_of_records_per_page);

        $paginantionSQL = "SELECT * FROM user_waybill GROUP BY waybill_id ORDER BY id desc LIMIT $offset, $no_of_records_per_page";
        $paginationExecute = mysqli_query($db_con, $paginantionSQL);


        while($waybillrun = mysqli_fetch_array($paginationExecute)){
      ?>
          <tr>
              <td><a href="waybill_details.php?waybill=<?php echo $waybillrun['waybill_id']; ?>"><?php echo $waybillrun['waybill_id']; ?></td>
              <td><?php echo $waybillrun['personnelName']; ?></td>
              <td><?php echo $waybillrun['emailAddress']; ?></td>
              <td><?php echo $waybillrun['status']; ?></td>
              <td><?php echo $waybillrun['date']; ?></td>
              <td><?php echo $waybillrun['transaction_type']; ?></td>
            </tr>        

      <?php    
        }
      ?>  
 
    </tbody>
  </table>
</center>
</div>
</b>

<center>
  <ul class="pagination">
     <li><a href="?pageno=1">First Page</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Previous Page</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next Page</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last Page</a></li> 
  </ul>
</center>

</div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <center>
        <div class="container">
        <form action="download.php" method="post" class="mb-5">
            <input type="submit" class="btn btn-warning text-white" name="user_download" value="Download Waybill Table">
        </form>
      </div>
    </center>
            
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