<?php
// Initialize variables
$name = $email = "";
$errors = [];
$success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect form data safely
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    // ---------------- VALIDATION ----------------

    // Name validation
    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    // Email validation
    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    // Password validation
    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Password must be at least 6 characters";
    }

    // Confirm password
    if ($password !== $confirmPassword) {
        $errors["confirm_password"] = "Passwords do not match";
    }

    // ---------------- PROCESS DATA ----------------
    if (empty($errors)) {

        $file = "users.json";

        // Check file existence
        if (!file_exists($file)) {
            $errors["file"] = "User storage file not found";
        } else {

            // Read JSON file
            $jsonData = file_get_contents($file);
            $users = json_decode($jsonData, true);

            if ($users === null) {
                $errors["file"] = "Error reading user data";
            } else {

                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Create user array
                $newUser = [
                    "name" => $name,
                    "email" => $email,
                    "password" => $hashedPassword
                ];

                // Add user
                $users[] = $newUser;

                // Save back to JSON
                if (file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT))) {
                    $success = "Registration successful!";
                    $name = $email = "";
                } else {
                    $errors["file"] = "Failed to write data";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial; }
        .error { color: red; font-size: 14px; }
        .success { color: green; font-size: 16px; }
        form { width: 300px; }
        input { width: 100%; margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>User Registration</h2>

<?php if ($success): ?>
    <div class="success"><?= $success ?></div>
<?php endif; ?>

<form method="post">

    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
    <div class="error"><?= $errors["name"] ?? "" ?></div>

    <label>Email</label>
    <input type="text" name="email" value="<?= htmlspecialchars($email) ?>">
    <div class="error"><?= $errors["email"] ?? "" ?></div>

    <label>Password</label>
    <input type="password" name="password">
    <div class="error"><?= $errors["password"] ?? "" ?></div>

    <label>Confirm Password</label>
    <input type="password" name="confirm_password">
    <div class="error"><?= $errors["confirm_password"] ?? "" ?></div>

    <button type="submit">Register</button>

    <div class="error"><?= $errors["file"] ?? "" ?></div>

</form>

</body>
</html>

