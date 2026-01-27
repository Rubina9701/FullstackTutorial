<?php
require 'db.php';
require 'session.php';

$user_email = '';
$logged_in = false;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Prepared statement
    $sql = "SELECT email FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch();
    if ($user) {
        $user_email = htmlspecialchars($user['email']);
        $logged_in = true;
    }
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to my site</h1>
    <?php if ($logged_in): ?>
        <p>Logged In User: <?php echo $user_email; ?></p>
        <a href="?logout=true">
            <button>Logout</button>
        </a>
    <?php else: ?>
        <a href="login.php">
            <button>Login</button>
        </a>
    <?php endif; ?>
</body>
</html>
