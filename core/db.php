<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "awan_web";

// Create connection
$db = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($db->connect_error) {
    header('location:error_500');
    die("Connection failed: " . $db->connect_error);
}

// SQL statements to create tables
$db->close();

function DbConnect($action)
{
    // Globe variable to store the connection
    global $servername;
    global $dbusername;
    global $dbpassword;
    global $dbname;
    global $db;



    // Perform the requested action
    if ($action === "1") {
        // Open connection
        $db = new mysqli($servername, $dbusername, $dbpassword, $dbname);
        // Check the connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // echo "Connection opened successfully<br>";
    } elseif ($action === "0") {
        // Close connection
        if (isset($db) && $db instanceof mysqli) {
            $db->close();
            // echo "Connection closed successfully<br>";
        } else {
            // echo "No open connection to close<br>";
        }
    } else {
        // echo "Invalid action. Use '1' to open connection or '0' to close connection.<br>";
    }
}