<?php

//  DATABASE CREDENTIALS
$servername = "localhost";
$username = "id6549663_root";
$password = "abc123";
$dbname = "id6549663_nodemcu";

// SETTING CONNECTION WITH DATABASE
global $dbc;
$conn = new mysqli($servername, $username, $password, $dbname);

// CHECK CONNECTION
if ($conn->connect_error) {
    echo $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    header("Refresh: $sec; url=$page");
    die("Connection failed: " . $conn->connect_error);    
}
nl2br("\n");

//  INITIALISING SESSION
session_start();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
