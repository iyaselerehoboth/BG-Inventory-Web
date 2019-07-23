
<?php
    include("config.php");
    session_start();
    include ('userheader.php');
    $sql_fetch_users = "SELECT id,name,password,level FROM hq_login_table";
    $result = mysqli_query($db_con,$sql_fetch_users);
    if(!$result){
    die('SQL Error: ' .mysqli_error($db_con));

    }
?>
    <section class="content-header">
      <h1>View all Users</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage BabbanGona Inventory</a></li>
        <li><a href="view_allUsers.php">View all Users</a></li>
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
    
    <table class="users_table" BORDER="2"    WIDTH="100%"   CELLPADDING="4" CELLSPACING="10" >
        <center><h3>Babban Gona Inventory Web-application users</h3>
        <thead>
        <tr ALIGN="CENTER">
            <th> ID </th>
            <th> Name </th>
            <th> Level </th>
            <th> Delete User </th>
        </tr>
        </thead>
        <tbody>
            <?php
            
                while($row = mysqli_fetch_array($result)){
                
                    print'<tr ALIGN="CENTER">
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['level'].'</td>
                    <td><a href="delete.php?del='.$row['name'].'" onclick=\'return confirm("Are you sure you want to delete this User ?")\'><i class = "fa fa-trash"></i></a></td>
                    </tr>';
                }
                $amount = $result->num_rows;
            ?>
            
           
        </tbody>
         <tfoot>
                    <tr align="CENTER">
                        <th colspan="3">Total Amount of Users</th>
                        <th><?=number_format($amount)?></th>
                    
                    </tr>
                
        </tfoot>
        </center>
    </table>
                            
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
