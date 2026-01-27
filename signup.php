<?php
require 'db.php';
require 'session.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif (empty($password) || strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
    } else {
        try {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepared statement for SQL injection prevention
            $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email, ':password' => $hashed_password]);

            $message = "User signed up successfully. Redirecting to login...";
            header('refresh: 2; url=login.php');
        } catch (Exception $e) {
            $message = "Something went wrong. Email may already exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <h2>Signup</h2>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Email:</label><br>
        <input type="text" name="email"><br><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <button type="submit">Signup</button>
    </form>
    <br>
    <a href="login.php">Go to Login</a>
</body>
</html>
