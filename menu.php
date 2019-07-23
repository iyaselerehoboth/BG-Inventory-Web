      <?php
      if ($_SESSION['login_user'] != "admin") {
        header("location: error404.php");
        exit();
      }
      ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> Manage Inventory</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="add_newUsers.php"><i class="fa fa-circle-o"></i> Add New Users</a></li>
			<li><a href="view_allUsers.php"><i class="fa fa-circle-o"></i> View All Users</a></li> -->
          <li><a href="admin_view_transaction.php"><i class="fa fa-circle-0"></i> View all Shipments</a></li>
          <li><a href="admin_view_inventory.php"><i class="fa fa-circle-0"></i>View Inventory</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> Manage Users</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="add_newUsers.php"><i class="fa fa-circle-o"></i> Add New Users</a></li>
          <li><a href="view_allUsers.php"><i class="fa fa-circle-o"></i> View All Users</a></li>

        </ul>
      </li>

      <li><a href="logout.php"><i class="fa fa-book"></i> <span>Logout</span></a></li>
      <li><a href="index.php"><i class="fa fa-book"></i> <span>Return to Website</span></a></li>

      </ul>
      </section>
      <!-- /.sidebar -->
      </aside>
      <!-- =============================================== -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">