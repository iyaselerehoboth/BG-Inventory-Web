<?php 
include("config.php");
session_start();
include ('adminheader.php');




?>

<section class="content-header">
      <h1>Add New Users</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage BabbanGona Inventory</a></li>
        <li><a href="add_newUsers.php">Add New Users</a></li>
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
                
                <br>
                <h2>Create New Users</h2>
                
            </center>
            
            <center>
                <form action="" method="post">
                    
                                        
                    Enter new Username   <input type="text" name="username" placeholder="Enter username" class="box"/> <br>
                    Enter User's Email <input type="text" name="email" placeholder="Enter user's email address" class="box"/> <br>
                    Enter new password  <input type="password" name="password" placeholder="Enter password" class="box"/> <br>
                    Enter password again <input type="password" name="passwordagain" placeholder="Enter password again" class="box" /><br>
                    Enter user's level   <input type="number" name="level" placeholder="Enter user's level between 1-3" min="1" max="3" class="box" /><br>
                    
                    <input type="submit" name='create' value=" Create  User " />
                                        
                </form>
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
  
<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    
    if(isset($_POST['create'])){
        
            
    $mynewusername = mysqli_real_escape_string($db_con,$_POST['username']);
    $mynewemail = mysqli_real_escape_string($db_con, $_POST['email']);
    $mynewpassword = mysqli_real_escape_string($db_con,$_POST['password']);
    $mynewpasswordagain = mysqli_real_escape_string($db_con,$_POST['passwordagain']);
    $mynewlevel = mysqli_real_escape_string($db_con, $_POST['level']);
    $mynewdate = date("Y-m-d");
    /*$newhashed_password = sha1($mynewpassword);
    print $newhashed_password;*/
    
        
    if($mynewpasswordagain == $mynewpassword){
        
        $sqlinsert = "INSERT INTO hq_login_table (email, name, password, level ,date) VALUES ('$mynewemail', '$mynewusername',PASSWORD('$mynewpassword'),'$mynewlevel','$mynewdate')";
    
        $result = mysqli_query($db_con,$sqlinsert);
        
        if(!$result){
            die('ERROR: ' .mysqli_error($db_con));
        }
    ?>

    <script type="text/javascript">
      window.alert("User has been added");
    </script>

    <?php
        
    }else{

      ?>


    <script type="text/javascript">

      window.alert("Passwords do not match");

    </script>

    
    <?php
    }
    
}

}





?>
<?php
    include 'adminfooter.php';
    ?>
