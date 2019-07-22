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
    /* border: 1px solid  #45b39d; /* No more visible border */
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

tr {  
    white-space: pre;
    /*background: #FAFAFA;*/
    font-weight: normal;
    text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #8CB57; }

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
          <li><a href="view_delivery_invoice.php">View Delivery Invoices</a></li>
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


<b><center><h4>View All Delivery Invoices</h4></center>

<div style="overflow-x:auto;">
<center>
<table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Product ID</th>
        <th>Customer Name</th>
        <th>Customer ID</th>
        <th>Delivered Amount</th>
        <th>Corresponding Waybill</th>
        <th>Team Member ID</th>
        <th>Date Delivered</th>
        <th>Print Delivery Invoice</th>
      </tr>
    </thead>

<?php
$waybillsql = "SELECT * FROM delivery_invoice ORDER BY id DESC";
$waybillexecute = mysqli_query($db_con,$waybillsql);
while($waybillrun = mysqli_fetch_assoc($waybillexecute)){
?>

    <tbody>
          <tr>
              <td><?php echo $waybillrun['id']; ?></td>
              <td><?php echo $waybillrun['product_name']; ?></td>
              <td><?php echo $waybillrun['product_id']; ?></td>
              <td><?php echo $waybillrun['customer_name']; ?></td>
              <td><?php echo $waybillrun['customer_id']; ?></td>
              <td><?php echo $waybillrun['delivered_amount']; ?></td>
              <td><?php echo $waybillrun['waybill_id']; ?></td>
              <td><?php echo $waybillrun['team_member_id']; ?></td>
              <td><?php echo $waybillrun['date_delivered']; ?></td>
              <td><a href="invoice_delivery_pdf.php?id=<?php echo $waybillrun['id']; ?>"onclick = 'return confirm("Are you sure you want to print this Delivery Invoice ?")'>Print</td>

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