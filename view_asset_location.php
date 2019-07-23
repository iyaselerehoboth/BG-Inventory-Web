<?php
include("config.php");
session_start();
include('userheader.php');
?>
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto+Slab:300);
    table {
        color: #333;
        font-family: Roboto, Slab;
        width: 100%;
        border: none;
        table-layout: auto;
        /* border-style: solid;
    border-spacing: 3px; */
    }
    td,
    th {
        border: 1px solid #45b39d;
        /* No more visible border */
        height: auto;
        transition: all 0.3s;
        /* Simple transition for hover effect */
        padding: 5px;
    }
    th {
        color: white;
        background: #377EAA;
        /* Darken header a bit */
        text-align: center;
        font-weight: bold;
    }
    td {
        white-space: pre;
        background: #FAFAFA;
        font-weight: normal;
        text-align: center;
    }
    /* Cells in even rows (2,4,6...) are one color */
    tr:nth-child(even) td {
        background: #bab8b8;
    }
    /* Cells in odd rows (1,3,5...) are another (excludes header cells)  */
    tr:nth-child(odd) td {
        background: #FEFEFE;
    }
    tr:hover td {
        background: #666;
        color: #FFF;
    }
    /* Hover cell effect! */
    .btn {
        background-color: DodgerBlue;
        border: none;
        color: white;
        padding: 12px 30px;
        cursor: pointer;
        font-size: 14px;
    }
    /* Darker background on mouse-over */
    .btn:hover {
        background-color: RoyalBlue;
    }
</style>

<section class="content-header">
    <h1>All Asset Movements</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="move_asset.php">Move BG Asset</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="col-sm-0"></div>
                    <div class="col-sm-0">
                        <center>
                            <!-- Table goes here -->
                            <?php
                            $query = "SELECT * FROM asset_transactions ORDER BY date DESC";
                            $exec = mysqli_query($db_con, $query);
                            ?>
                            <div style="overflow-x:auto; overflow-y:auto">
                                <center>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Out</th>
                                                <th>In</th>
                                                <th>Qty</th>
                                                <th>Receiver</th>
                                                <th>Created By</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($result = mysqli_fetch_array($exec)) {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $result['itemname'] ?></td>
                                                    <td><?php echo $result['location_out'] ?></td>
                                                    <td><?php echo $result['location_in'] ?></td>
                                                    <td><?php echo $result['quantity'] ?></td>
                                                    <td><?php echo $result['procurement_officer'] ?></td>
                                                    <td><?php echo $result['username'] ?></td>
                                                    <td><?php echo $result['date'] ?></td>
                                                </tr>
                                            </tbody>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </center>
                            </div>
                        <center>
                            <br>
                            <div class="download-container">
                              
                                    <a href="export_to_excel.php"><button type="submit" class="btn" name="exportAssetT"><i class="fa fa-download"></i> Download Asset Movements</button></a>
                              
                            </div>`
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

    <div class="footer">
        <?php
        include('adminfooter.php');
        ?>