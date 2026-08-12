<?php
session_start();
include "db.php";

$message = "";

if (isset($_POST['register'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {

        $message = "Passwords do not match.";

    } else {

        $check = mysqli_query(
            $conn,
            "SELECT id FROM users WHERE username='$username'"
        );

        if (mysqli_num_rows($check) > 0) {

            $message = "Username already exists.";

        } else {

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $sql = "INSERT INTO users (username, password)
                    VALUES ('$username', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {

                header("Location: login.php");
                exit();

            } else {

                $message = "Registration failed.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Create New Account</h2>

    <?php if ($message != "") { ?>
        <p style="color:red;">
            <?php echo $message; ?>
        </p>
    <?php } ?>

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

        <label>Confirm Password</label>
        <input
            type="password"
            name="confirm_password"
            placeholder="Confirm password"
            required
        >

        <input
            type="submit"
            name="register"
            value="Register"
        >

    </form>

    <p>
        Already have an account?
        <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>