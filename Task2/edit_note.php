<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM notes WHERE id=$id");

if (mysqli_num_rows($result) != 1) {
    header("Location: dashboard.php");
    exit();
}

$note = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['update_note'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "UPDATE notes
            SET title='$title',
                subject='$subject',
                description='$description'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {

        header("Location: dashboard.php");
        exit();

    } else {

        $message = "Failed to update note: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Note</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Edit Note</h2>

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
            value="<?php echo htmlspecialchars($note['title']); ?>"
            required
        >

        <label>Subject</label>

        <input
            type="text"
            name="subject"
            value="<?php echo htmlspecialchars($note['subject']); ?>"
            required
        >

        <label>Description</label>

        <textarea
            name="description"
            rows="8"
            required
        ><?php echo htmlspecialchars($note['description']); ?></textarea>

        <input
            type="submit"
            name="update_note"
            value="Update Note"
        >

    </form>

    <p>
        <a href="dashboard.php">← Back to Dashboard</a>
    </p>

</div>

</body>

</html>