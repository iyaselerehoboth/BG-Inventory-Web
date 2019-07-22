<?php include 'adminheader.php';?>
<section class="content-header">
      <h1>Add Category</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage Category</a></li>
        <li><a href="#">Add Category</a></li>
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
							<form action="" method="post" name="frm">
								<input type="text" name="name" class="form-control" placeholder="Category Name" required="required" /><br>
								<select name="status" class="form-control">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
								<br>
								<!-- /.box-header -->
								<div class="box-body">
								  <div class="form-group">
										<textarea class="form-control" name="description" placeholder="Category Description" style="height: 100px" required="required">
										</textarea>
								  </div>
								</div>
								<!-- /.box-body -->
            					<input type="submit" name="submit" id="button" class="btn bg-primary" value="Submit" /><br><br>
							</form>
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
  
		
		<?php include('adminfooter.php');
?>
