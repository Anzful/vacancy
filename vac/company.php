<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $sql = "INSERT INTO company (name, date) VALUES ('$name', '$date')";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $idcode = $_POST['idcode'];
        $sql = "DELETE FROM company WHERE idcode=$idcode";
        $conn->query($sql);
    } elseif (isset($_POST['update'])) {
        $idcode = $_POST['idcode'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $sql = "UPDATE company SET name='$name', date='$date' WHERE idcode=$idcode";
        $conn->query($sql);
    }
}

$result = $conn->query("SELECT * FROM company");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Page</title>
</head>
<body>
    <h1>Company Page</h1>
    <form method="POST">
        <input type="hidden" name="idcode">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Date:</label>
        <input type="date" name="date" required>
        <button type="submit" name="add">Add Company</button>
        <button type="submit" name="update">Update Company</button>
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['idcode'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['date'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="idcode" value="<?= $row['idcode'] ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php">Back to Home</a>
</body>
</html>
