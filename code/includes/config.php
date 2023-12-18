<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=bokhandel;charset=utf8mb4", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// You already have a valid PDO connection in $conn, so there's no need to create another one.
// Use $conn throughout your code where you need a database connection.

if (!isset($_SESSION)) {
    session_start();
}

$user = new USER($conn);
?>
