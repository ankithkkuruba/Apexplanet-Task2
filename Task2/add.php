<?php
include 'db.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students(name, email, course)
            VALUES('$name', '$email', '$course')";

    if(mysqli_query($conn, $sql)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add Student</h2>

<form method="POST">

    <label>Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Course</label><br>
    <input type="text" name="course" required><br><br>

    <input type="submit" name="submit" value="Add Student">

</form>

<br>

<a href="index.php">Back to Home</a>

</body>
</html>