<?php

     include "config.php";


    // if(isset($_POST['user_download'])) {

        $waybillsql_query = "SELECT * FROM user_waybill";
        $waybillsql_result = mysqli_query($db_con, $waybillsql_query);

        $output ='';

        $output .= '<table><tr><th>S/NO</th>
        <th>Waybill Number</th>
        <th>Product Description</th>
        <th>Product ID</th>
        <th>Ship From</th>
        <th>Destination</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Batch Code</th>
        <th>Unit Of Measure</th>
        <th>Intended Location</th>
        <th>Email Address</th>
        <th>Date</th>
        <th>Personnel Name</th>
        <th>Waybill Status</th>
        <th>Hub</th>
        <th>Notes</th>
        <th>Transaction Type</th></tr>';


        while($fetch = mysqli_fetch_array($waybillsql_result)){
                    $output .='<tr>
                            <td>'.$fetch['id'].'</td>
                            <td>'.$fetch['waybill_id'].'</td>
                            <td>'.$fetch['description'].'</td>
                            <td>'.$fetch['product_id'].'</td>
                            <td>'.$fetch['ship_from'].'</td>
                            <td>'.$fetch['destination'].'</td>
                            <td>'.$fetch['quantity'].'</td>
                            <td>'.$fetch['unit'].'</td>
                            <td>'.$fetch['batch_code'].'</td>
                            <td>'.$fetch['unit_of_measure'].'</td>
                            <td>'.$fetch['intended_location'].'</td>
                            <td>'.$fetch['emailAddress'].'</td>
                            <td>'.$fetch['date'].'</td>
                            <td>'.$fetch['personnelName'].'</td>
                            <td>'.$fetch['status'].'</td>
                            <td>'.$fetch['hub'].'</td>
                            <td>'.$fetch['notes'].'</td>
                            <td>'.$fetch['transaction_type'].'</td>
                    </tr>';
        }
        $output .= '</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=Waybill Export.xls");
        echo $output;
    // }



?>
