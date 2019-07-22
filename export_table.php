<?php

 include("config.php");
 
 if(isset($_POST['exportToExcel'])){
    $output = '';
    $output .= '<table><tr><th>S/NO</th><th>Transaction ID</th><th>Warehouse Out</th><th>Warehouse In</th><th>Item Name</th><th>ItemID</th><th>Amount</th><th>Created By</th><th>Date</th><th>Status</th><th>SD Status</th><th>SD Personnel</th><th>PC Status</th><th>Transaction Type</th><th>Comments</th></tr>';
    $export_query = "SELECT * FROM web_transactions ORDER BY id DESC";
    $export_result = mysqli_query($db_con, $export_query);
    while($fetch = mysqli_fetch_array($export_result)){
        $output .='<tr>
                            <td>'.$fetch['id'].'</td>
                            <td>'.$fetch['transactionID'].'</td>
                            <td>'.$fetch['region'].'</td>
                            <td>'.$fetch['destination'].'</td>
                            <td>'.$fetch['item'].'</td>
                            <td>'.$fetch['itemID'].'</td>
                            <td>'.$fetch['quantity'].' '.$fetch['unit'].'</td>
                            <td>'.$fetch['personnelName'].'</td>
                            <td>'.$fetch['date'].'</td>
                            <td>'.$fetch['status'].'</td>
                            <td>'.$fetch['sdstatus'].'</td>
                            <td>'.$fetch['sdpersonnel'].'</td>
                            <td>'.$fetch['pcstatus'].'</td>
                            <td>'.$fetch['transaction_type'].'</td>
                            <td>'.$fetch['comments'].'</td>
                    </tr>';
    }
    $output .= '</table>';
    header("Content-Type: application/xls");
    header("Content-Disposition:attachment; filename=Inventory Shipments.xls");
    echo $output;

 }

?>