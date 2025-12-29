
<?php 
require 'db.php';
try{

$sql = "SELECT * FROM students";
$stmt = $pdo->query($sql);
$students = $stmt->fetchAll();
}
catch(PDOException $e){
  die("Unableto get student".$e->getMessage());
}


 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Database</title>
</head>
<body>
<h1 style='color: blue;'>Welcome to Student Database</h1>
<table>
  <tr>
    <th>NAME</th>
    <th>EMAIL</th>
    <th>COURSE</th>
  </tr>
  <?php foreach ($students as $student):?>
    <tr>
      <td><?=$student['name']?></td>
      <td><?=$student['email']?></td>
      <td><?=$student['course']?></td>
      <td><a href="Edit.php?id=<?= $student['id'] ?>">Edit</a></td>

      <td>
        |
        <a href="Delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this student?');">
            Delete
        </a>
    </td>

    </tr>
    <?php endforeach ?>
</table>
</body>
</html>