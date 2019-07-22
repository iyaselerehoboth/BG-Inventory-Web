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
  <a href="external_sales.php">External Sales</a>
  <a href="internal_transaction.php">Internal Transaction</a>
  <a href="discard_transaction.php">Discard Product</a>
  <a href="convert_transaction_out.php">Conversion OUT</a>
  <a href="convert_transaction_in.php">Conversion IN</a>
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
  
                
                
                
<H4 align = "center">Welcome <?php echo $_SESSION['login_user']?></H4>
       <!-- <h3>THe session level: <?php echo $_SESSION['sessionlevel']?></h3> -->
            </p>
           
        <div class="createtransactionbox">
        <form action = "" method = "post">
            <center>
            <label><H3 align = "center">Transaction Details</H3></label>
            
            
            <fieldset>
                
               <!-- <legend>-->
                    
                    <p>
                        
        Enter Product ID<input type="text" list="productdrop" name = "itemIDlist" id="itemIDlist" autocomplete="off" placeholder="Enter Product ID" class="box"/>
                        <datalist id=productdrop>
                            <option>Please Select the Product ID</option>
                            <?php
                            $itemsql = mysqli_query($db_con, "SELECT DISTINCT itemid FROM item_t");
                            while($itemrow = $itemsql->fetch_assoc()){
                            ?>

                                <option value="<?php echo $itemrow['itemid'];?>"><?php echo $itemrow['itemid'];?></option>
                                

                        <?php                            
                            }
                        ?>
                        
                    </datalist>
                    </p>
                
                    <p>
                    Enter Product<input type="text" list="itemdrop" name = "itemlist" id="itemlist" autocomplete="off" placeholder="Enter Product Name" class="box"/>
                        <datalist id="itemdrop">
                            <?php
                            $itemnamesql = mysqli_query($db_con, "SELECT DISTINCT itemname FROM item_t");
                            while($itemnamerow = $itemnamesql->fetch_assoc()){
                            ?>

                                <option value="<?php echo $itemnamerow['itemname'];?>"><?php echo $itemnamerow['itemname']; ?></option>
                                
                            <?php
                        }
                            ?>
                        </datalist>
                       
                    
                    </p>
                
                    
                   <p>
    Select Region to get item<input type="text" list="regiondrop" name = "regionlist" autocomplete="off" id="regionlist" placeholder="Enter Region to get item" class="box"/>
                        <datalist id="regiondrop">    
                          <?php
                            $regionsql = mysqli_query($db_con, "SELECT DISTINCT warehousename FROM warehouse_t");
                            while($regionrow = $regionsql->fetch_assoc()){
                                ?>

                                <option value="<?php echo $regionrow['warehousename'];?>"><?php echo $regionrow['warehousename']; ?></option>
                                
                            <?php
                            }
                            ?>  
                        </datalist>
                        
                </p>      
                                                  
                <br>Enter Amount To Discard <input type="text" name="quantitylist" autocomplete="off" placeholder="Enter Amount of Product To Discard" class="box"/> <br>
                
                <p>
                        
                        Select Unit
                        <select name = "unitlist" id="unitlist" class="box"/>
                            <option>Please Select the Unit</option>
                            <option value="KG">KG</option>
                            <option value="Bags">Bags</option>
                            <option value="MT">Metric Ton</option>
                        </select>
                     </p> 
                
                </fieldset>
                <br>
        <input type = "submit" name = 'create' value = "Create Transaction" /><br/>

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
    
    $uniqueID = "BG_".time();
    
    if(isset($_POST['create'])){
        
        
        $myitemID = mysqli_real_escape_string($db_con, $_POST['itemIDlist']);
        $myitem = mysqli_real_escape_string($db_con,$_POST['itemlist']);
        $myregion = mysqli_real_escape_string($db_con,$_POST['regionlist']);
        $mydestination =/* mysqli_real_escape_string($db_con,$_POST['customerlist'])*/ 'none';
        $myunit = mysqli_real_escape_string($db_con,$_POST['unitlist']);
        $myquantity = mysqli_real_escape_string($db_con,$_POST['quantitylist']);
        $mydate = date("Y-m-d");
        $mystatus = 'pending';
        $mysync = 'no';

        /*print $myitemID;
        
        print $myitem;*/
       
        
         $sql_insert = "INSERT INTO web_transactions (transactionID,itemId,item,region,destination,unit,quantity,date,personnelName,status,transaction_type,sync) VALUES ('$uniqueID','$myitemID','$myitem','$myregion','$mydestination','$myunit','$myquantity','$mydate','".$_SESSION['login_user']."','$mystatus','Discard Product','$mysync')";
        
            
        $result_insert = mysqli_query($db_con,$sql_insert);
        
             ?>        
?>

<script type="text/javascript">
      window.alert("Transaction has been created");
</script>
    
<?php
        
    }
?>
            
            
<?php
    include 'adminfooter.php';
    ?>