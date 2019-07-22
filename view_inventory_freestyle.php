<?php

	include("config.php");
    session_start();
    include ('userheader.php');


    $sqlfetch_inventory = "SELECT * FROM inventory_table";
    $run_fetch = mysqli_query($db_con, $sqlfetch_inventory);

    if(!$run_fetch){
    	die('SQL Error: ' .mysqli_error($db_con));

    }

?>

<style>
    
    table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 700px; 
    border-collapse: collapse; 
    border-spacing: 0; 
}

td, th {  
    border: 1px solid  #45b39d; /* No more visible border */
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
}

th {  
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
}

td {  
    background: #FAFAFA;
    text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
/* Hover cell effect! */
    
    
</style>



<section class="content-header">
      <h1 align="center">VIEW INVENTORY</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage BabbanGona Inventory</a></li>
        <li><a href="view_inventory.php">View Inventory</a></li>
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


<br>
<table id="inventory_table" class="inventory_table">
    <center><h5>Babban Gona Inventory</h5>
		
		<thead>
        <tr>
            <th> ID </th>
            <th> Warehouse ID </th>
            <th> Warehouse Name </th>
            <th> Parent Warehouse </th>
            <th> Item Available </th>
            <th> Amount Available</th>
            <th> Unit </th>
        </tr>
        </thead>


        <tbody>
        	
        	<?php

        		while($row = mysqli_fetch_array($run_fetch)){

        			print'<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['warehouse_id'].'</td>
                    <td>'.$row['warehouse_name'].'</td>
                    <td>'.$row['parent_warehouse'].'</td>
                    <td>'.$row['item'].'</td>
                    <td>'.$row['amount_available'].'</td>
                    <td>'.$row['unit_available'].'
                    </tr>';
        		}


        	?>


        </tbody>

      


</center>
</table>


<script>
function exportToExcel(inventory_table){
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6' style='height: 100%; text-align: center; width: 100%'>";
    var textRange; var j=0;
    tab = document.getElementById(inventory_table); // id of table

    for(j = 0 ; j < tab.rows.length ; j++)
    {

        tab_text=tab_text;

        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text= tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); //remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer

    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write( 'sep=,\r\n' + tab_text);
        txtArea1.document.close();
        txtArea1.focus();
        sa=txtArea1.document.execCommand("SaveAs",true,"sudhir123.txt");
    }

    else {
       sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
    }
    
    return (sa);
}
</script>


<br><br>
<center>
<input type="button" value="Export to Excel Sheet" onclick="exportToExcel('inventory_table')" />
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

    include 'adminfooter.php';

?>