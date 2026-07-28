<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Student Management System</h2>

<a href="add.php">+ Add Student</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Action</th>
    </tr>

    <?php
$sl = 1;
while($row = mysqli_fetch_assoc($result)) {
?>

    <tr>
        <td><?php echo $sl++; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['course']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>"
            onclick="return confirm('Are you sure you want to delete this student?');">
            Delete
</a>
        </td>
    </tr>

    <?php } ?>
    <div class="container">

    <!-- Your existing page content -->

</div>  

</table>

</body>
</html>