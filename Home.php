<?php

    include("config.php");
    session_start();
    include ('userheader.php');

?>

<style>
    .topnav {
    background-color: #3C8DBC;
    overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
</style>
<section class="content-header">
      
    <h1> <div class="topnav">
  <a href="external_sales.php">External Shipment</a>
  <!-- <a href="internal_transaction.php">Internal Shipment</a>
  <a href="convert_transaction_out.php">Conversion OUT</a>
  <a href="convert_transaction_in.php">Conversion IN</a> -->
</div> </h1>
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="createtransaction.php">Create Transaction</a></li>
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
                
        <br><br>
     <h2> <b><p> Welcome to the waybill page</h2> </b></p>         
                
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