<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE students
            SET name='$name',
                email='$email',
                course='$course'
            WHERE id=$id";

    if(mysqli_query($conn, $sql)){
        header("Location: index.php");
        exit();
    }else{
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Edit Student</h2>

<form method="POST">

    <label>Name</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

    <label>Course</label><br>
    <input type="text" name="course" value="<?php echo $row['course']; ?>" required><br><br>

    <input type="submit" name="update" value="Update Student">

</form>

<br>

<a href="index.php">Back to Home</a>

</body>
</html>