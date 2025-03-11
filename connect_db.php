<?php
error_reporting(E_ALL);
// Create connection using MySQLi
$con = mysqli_connect('localhost', 'root', '', 'pms');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>