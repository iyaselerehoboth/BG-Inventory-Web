<?php


    include("config.php");
    session_start();
    include ('userheader.php');
?>
<section class="content-header">
      <H3 align = "center">Welcome <!--<?php echo $login_session; ?>--> <?php echo $_SESSION['login_user']?></H3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Manage BabbanGona Inventory</a></li>
        <li><a href="welcome.php">Welcome</a></li>
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
    
        <br><br><br>
        <p> Welcome to Babban Gona's foremost Inventory Management web application. The purpose of this web application is to enable the users to be able to monitor and initiate movements of Babban Gona's products between the various warehouses and to Babban Gona's clients and customers.</p>
        <p> This website can be easily navigated from the sidebar, by clicking on the various links for the respective pages.</p>
        <p> For questions and enquiries, please send an email to the admin at <b>admin@babbangona.com<b> <p>
        
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
