<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$message = "";

if (isset($_POST['add_note'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO notes (title, subject, description)
            VALUES ('$title', '$subject', '$description')";

    if (mysqli_query($conn, $sql)) {

        header("Location: dashboard.php");
        exit();

    } else {

        $message = "Failed to add note: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Note</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Add New Note</h2>

    <?php if ($message != "") { ?>
        <p style="color:red;">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php } ?>

    <form method="POST">

        <label>Title</label>

        <input
            type="text"
            name="title"
            placeholder="Enter note title"
            required
        >

        <label>Subject</label>

        <input
            type="text"
            name="subject"
            placeholder="Enter subject"
            required
        >

        <label>Description</label>

        <textarea
            name="description"
            rows="8"
            placeholder="Write your note here..."
            required
        ></textarea>

        <input
            type="submit"
            name="add_note"
            value="Save Note"
        >

    </form>

    <p>
        <a href="dashboard.php">← Back to Dashboard</a>
    </p>

</div>

</body>

</html>