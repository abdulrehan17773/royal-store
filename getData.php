<?php

$currentURL = __DIR__;
include_once("$currentURL/core/core.php");


if (isset($_GET['getorder'])) {

    // Retrieve the status parameter from AJAX
    $status = $_GET['status'];

    // Construct your SQL query based on the status
    if ($status == 'all') {
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
    } elseif ($status == 'allcount') {
        $sql = "SELECT * FROM orders ORDER BY created_at";
    } else {
        $sql = "SELECT * FROM orders WHERE `status` = '$status' ORDER BY created_at DESC";
    }
    
    DbConnect('1');
    $result = mysqli_query($db, $sql);
    DbConnect('0');
    // Check if the query was successful
    if ($result) {
        // Fetch data and send it back to the client as JSON
        $myArray = array();
        while ($row = mysqli_fetch_array($result)) { 
        $myArray[] = $row;
}
        echo json_encode($myArray);
    } else {
        // Handle query error
        echo json_encode(['error' => 'Query error']);
    }
}