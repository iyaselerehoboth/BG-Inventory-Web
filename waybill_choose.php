<?php

    include("config.php");
    session_start();
    include ('userheader.php');

?>


    <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
            <center>

       <!-- <h3>THe session level: <?php echo $_SESSION['sessionlevel']?></h3> -->
            </p>



<div class="createtransactionbox">
<form action = "" method = "post">
<center>
<label><H3 align = "center">Transaction Details</H3></label>
<br>
<fieldset>

    <p>
    Select Waybill Transaction Type
    <select name="transtype" id="transtype" class="box"/>
        <option> </option>
        <option value="Trans-Shipment">Trans-Shipment</option>
        <option value="Sales Shipment">Sales Shipment</option>
        <option value="Shipment to Nestle">Shipment to Nestle</option>
        <option value="Shipment to Customers">Shipment to Customers</option>
        <!-- Removed the Shipment to Vendors because its no longer or was never really used. -->
    </select>
    </p>


    <input type="submit" name="submit" value="Submit" />


<?php

    if(isset($_POST['submit'])){

        $mytranstype = mysqli_real_escape_string($db_con, $_POST['transtype']);//transaction_type

        //Check Transaction Types and Modify Database Entry.
        switch ($mytranstype) {
            case 'Trans-Shipment':
                    ?>
                    <script type="text/javascript">location.href = 'trans_shipment.php';</script>
                    <?php
                break;

            case 'Sales Shipment':
                    ?>
                    <script type="text/javascript">location.href = 'sales_shipment.php';</script>
                    <?php
                break;

            case 'Shipment to Customers':
                    ?>
                    <script type="text/javascript">location.href = 'customer_shipment.php';</script>
                    <?php
                break;

            case 'Shipment to Vendors':
                    ?>
                    <script type="text/javascript">location.href = 'vendor_shipment.php';</script>
                    <?php
                break;


            case 'Shipment to Nestle':
                    ?>
                    <script type="text/javascript">location.href = 'nestle_shipment.php';</script>
                    <?php
                break;


            default:
                # code...
                break;
            }

    }

?>


            </fieldset>

           </center>
        </form>
    </div>



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
