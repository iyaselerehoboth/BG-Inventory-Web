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
          <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
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
              <center>

<b><center><h4>View All Waybills</h4></center>
<?php

$waybillsql = "SELECT * FROM user_invoice ORDER BY date DESC";
$waybillexecute = mysqli_query($db_con,$waybillsql);
?>
<div style="overflow-x:auto;">
<center>
<table>
    <thead>
      <tr>
        <th>Invoice ID</th>
        <th>To</th>
        <th>For</th>
        <th>Waybill Number</th>
        <th>Amount</th>
        <th>Date Created</th>
        <th>Invoice Type</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
      <?php


        while($waybillrun = mysqli_fetch_array($waybillexecute)){
          switch ($waybillrun['invoiceType']) {
            case 'Bike Invoice':
              $url = "invoice_bike_pdf.php";
              break;
            case 'Tricycle Invoice':
              $url = "invoice_tricycle_pdf.php";
              break;
            case 'Nestle Invoice':
              $url = "invoice_nestle_pdf.php";
              break;
              
            case 'Other Invoice':
              $url = "invoice_other_pdf.php";
              break;
            
            case 'Customer Invoice':
              $url = "invoice_customer_pdf.php";
              break;      
            
            default:
              $url = "";
              //echo "Invalid Invoice type";
              break;
          }
      ?>
          <tr>
              <td><?php echo $waybillrun['invoiceNo']; ?></td>
              <td><?php echo $waybillrun['to_details']; ?></td>
              <td><?php echo $waybillrun['for_details']; ?></td>
              <td><?php echo $waybillrun['waybillNo']; ?></td>
              <td><?php echo $waybillrun['Amount']; ?></td>
              <td><?php echo $waybillrun['date']; ?></td>
              <td><?php echo $waybillrun['invoiceType']; ?></td>
              <td><a href="<?php echo $url ?>?waybill=<?php echo $waybillrun['waybillNo']; ?>"onclick = 'return confirm("Are you sure you want to print this Invoice ?")'>Print</td>
            </tr>        
      <?php    
        }
      ?>  
 
    </tbody>
  </table>
</center>
</div>




</div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
            </div>
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