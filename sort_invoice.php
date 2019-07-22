<?php
    include("config.php");
    session_start();
    include ('userheader.php');
    $waybill_id = $_GET['waybill'];
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
<label><H3 align = "center">Invoice Details</H3></label>
<br>         
<fieldset>

    <p>
    Select Invoice Type
    <select name="transtype" id="transtype" class="box"/>
        <option> </option>
        <option value="Bike Invoice">Bike Invoice</option>
        <option value="Tricycle Invoice">Tricycle Invoice</option>
        <option value="Nestle Invoice">Nestle Invoice</option>
        <option value="Other Invoice">Other Invoice</option>
        <option value="Customer Invoice">Customer Invoice</option>
    </select>
    </p> 

    <input type="submit" name="submit" value="Submit" />

<?php
    if(isset($_POST['submit'])){
        $mytranstype = mysqli_real_escape_string($db_con, $_POST['transtype']);//transaction_type
        //Check Transaction Types and Modify Database Entry.
        switch ($mytranstype) {

            case 'Bike Invoice':

                    ?>

                    <script type="text/javascript">location.href = "invoice_bike.php?waybill=<?php echo $waybill_id; ?>";</script>

                    <?php

                break;



            case 'Tricycle Invoice':   

                    ?>

                    <script type="text/javascript">location.href = "invoice_tricycle.php?waybill=<?php echo $waybill_id; ?>";</script>

                    <?php

                break;



            case 'Nestle Invoice':

                    ?>

                    <script type="text/javascript">location.href = "invoice_nestle.php?waybill=<?php echo $waybill_id; ?>";</script>

                    <?php

                break;



            case 'Other Invoice':

                    ?>

                    <script type="text/javascript">location.href = "invoice_other.php?waybill=<?php echo $waybill_id; ?>";</script>

                    <?php

                break;





            case 'Customer Invoice':

                    ?>

                    <script type="text/javascript">location.href = "invoice_customer.php?waybill=<?php echo $waybill_id; ?>";</script>

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