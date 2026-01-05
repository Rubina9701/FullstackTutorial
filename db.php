<?php 
<<<<<<< HEAD

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'herald_db';

try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    $pdo = new PDO(
        "mysql:host=$server;dbname=$database;charset=utf8mb4",
        $username,
        $password,
        $options
    );

    echo "<h3 style='color:green;'>Welcome to Student Database!</h3>";

} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}

?>
=======
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
>>>>>>> c8e75afd6b764ed2443984fc5859b396ce290e53
