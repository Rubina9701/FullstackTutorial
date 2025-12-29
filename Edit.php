<?php
include "db.php";

$id = $_GET["id"];

// Fetch student
$sql = "SELECT * FROM students WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([":id" => $id]);
$student = $stmt->fetch();

if(isset($_POST["update"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $course = $_POST["course"];

    $update = "UPDATE students SET name=:name, email=:email, course=:course WHERE id=:id";
    $stmt = $conn->prepare($update);
    $stmt->execute([
        ":name" => $name,
        ":email" => $email,
        ":course" => $course,
        ":id" => $id
    ]);

    echo "Student Updated Successfully!";
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<form method="post">
    Name: <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br><br>
    Course: <input type="text" name="course" value="<?php echo $student['course']; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>