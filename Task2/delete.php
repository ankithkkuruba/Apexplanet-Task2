<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id=$id";

if(mysqli_query($conn, $sql)){
    header("Location: index.php");
    exit();
}else{
    echo "Error: " . mysqli_error($conn);
}
?>