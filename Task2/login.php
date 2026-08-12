<?php
session_start();
include "db.php";

$message = "";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];

            header("Location: dashboard.php");
            exit();

        } else {

            $message = "Invalid username or password.";

        }

    } else {

        $message = "Invalid username or password.";

    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Student Notes Management System</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h2>Student Notes Management System</h2>

    <h3>Login</h3>

    <?php
    if ($message != "") {
        echo "<p style='color:red;'>$message</p>";
    }
    ?>

    <form method="POST">

        <label>Username</label>

        <input
            type="text"
            name="username"
            placeholder="Enter username"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            placeholder="Enter password"
            required
        >

        <input
            type="submit"
            name="login"
            value="Login"
        >

    </form>

    <p>
        Don't have an account?
        <a href="register.php">Create New Account</a>
    </p>

</div>

</body>

</html>