<?php
    include "config.php";

    $dates = date("Y-m-d");
    $file = "Asset Movements Export "; //File name.
    $filename = $file.$dates.".xls";
    
    $query = mysqli_query($db_con, "SELECT * FROM asset_transactions ORDER BY id DESC");
    
    if(!$query){
        die("Error: " .mysqli_error($db_con));
    }

    while($records = mysqli_fetch_assoc($query)){
        $result[] = $records;
    }
        
    //header info for browser
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    $heading = false;
    
    if(!empty($result))
        foreach($result as $row){
            if(!$heading){
                //display field/column names as first row.
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }

            echo implode("\t", array_values($row)) . "\n";
        }
        exit;

?>


