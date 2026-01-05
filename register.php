<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add_student'])) {

    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO students (student_id, full_name, password_hash) VALUES (?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$student_id, $name, $hashedPassword]);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h1>Add Student</h1>

<form method="POST">
    Student Id: <input type="text" name="student_id" required><br>
    Name: <input type="text" name="name" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="add_student">Add Student</button>
</form>

</body>
</html>
