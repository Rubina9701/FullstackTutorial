<?php 
$server = "localhost";
$database = "school_db";
$username = "root";
$password = "";

try {
    $conn = new PDO(
        "mysql:host=$server;dbname=$database;charset=utf8",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Unable to connect to database: " . $e->getMessage());
}
?>
