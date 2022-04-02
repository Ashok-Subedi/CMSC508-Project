<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "cmsc508.com"; // localhost means "itself" because the MySQL servers runs on the same server than the Apache webserver.
$username = "pradhanr";
$password = "V00942207";
$database = "project_pradhanr";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connection Sucessful!! ";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
