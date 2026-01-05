<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome <?php echo $student_id; ?></h1>

<a href="preference.php">Change Theme</a><br><br>
<a href="logout.php">Logout</a>

</body>
</html>
