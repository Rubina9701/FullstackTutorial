<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['login'])) {

    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$student_id]);

    $student = $stmt->fetch();

    if ($student && password_verify($password, $student['password_hash'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['student_id'] = $student['student_id'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid Student ID or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h1>Login Student</h1>

<form method="POST">
    Student Id: <input type="text" name="student_id" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="login">Login</button>
</form>

</body>
</html>
