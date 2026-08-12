<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$sql = "SELECT * FROM notes ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
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

    <p>
        Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
    </p>

    <div style="margin-bottom: 20px;">

        <a href="add_note.php">+ Add New Note</a>

        <a href="logout.php"
           class="logout"
           style="margin-left: 10px;">
           Logout
        </a>

    </div>

    <h3>My Notes</h3>

    <?php if (mysqli_num_rows($result) > 0) { ?>

    <table>

        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Created</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['title']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['subject']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['description']); ?>
            </td>

            <td>
                <?php echo $row['created_at']; ?>
            </td>

            <td class="action-links">

                <a href="edit_note.php?id=<?php echo $row['id']; ?>">
                    Edit
                </a>

                <a href="delete_note.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this note?');">
                    Delete
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

    <?php } else { ?>

        <p>No notes available. Click "Add New Note" to create your first note.</p>

    <?php } ?>

</div>

</body>

</html>