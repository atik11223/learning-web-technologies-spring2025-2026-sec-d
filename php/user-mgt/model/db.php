<?php
// Update "your_database_name" to whatever your database is actually called in phpMyAdmin!
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "user_mgt"; 

function getConnection() {
    global $host, $dbuser, $dbpass, $dbname;
    $conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);
    
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>