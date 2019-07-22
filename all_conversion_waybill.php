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
      <h1>All ConversionWaybills</h1>
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
                          <div class="col-sm-2"></div>
                          <div class="col-sm-0">
              <center>


<b><center><h5>View Conversion Waybills</h5></center>

<?php
$waybillsql = "SELECT * FROM conversion_waybill GROUP BY waybill_id ORDER BY date DESC";
$waybillexecute = mysqli_query($db_con,$waybillsql);
?>


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
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      
      <?php

        while($waybillrun = mysqli_fetch_array($waybillexecute)){
          if($waybillrun['status'] == "Approved"){
      ?>        
            <tr>
              <td><?php echo $waybillrun['waybill_id']; ?></td>
              <td><?php echo $waybillrun['personnelName']; ?></td>
              <td><?php echo $waybillrun['emailAddress']; ?></td>
              <td><?php echo $waybillrun['status']; ?></td>
              <td><?php echo $waybillrun['date']; ?></td>
              <td><?php echo $waybillrun['transaction_type']; ?></td>
              <td><a href="conversion_waybillpdf.php?waybill=<?php echo $waybillrun['waybill_id']; ?>"onclick = 'return confirm("Are you sure you want to print this waybill ?")'>Print</td>
            </tr>        


      <?php
            }else{
      ?>
          <tr>
              <td><a href="conversion_details.php?waybill=<?php echo $waybillrun['waybill_id']; ?>"><?php echo $waybillrun['waybill_id']; ?></td>
              <td><?php echo $waybillrun['personnelName']; ?></td>
              <td><?php echo $waybillrun['emailAddress']; ?></td>
              <td><?php echo $waybillrun['status']; ?></td>
              <td><?php echo $waybillrun['date']; ?></td>
              <td><?php echo $waybillrun['transaction_type']; ?></td>
              <td><i><small>Approve Waybill to Print</small></i></td>
            </tr>        

      <?php   
                } 
        }
      ?>  
 
    </tbody>
  </table>
</center>








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