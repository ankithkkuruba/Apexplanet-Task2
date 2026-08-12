<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $sql = "DELETE FROM notes WHERE id=$id";

    mysqli_query($conn, $sql);
}

header("Location: dashboard.php");
exit();
?>