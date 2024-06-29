<?php
include 'db.php';

session_start();

if (!isset($_SESSION['company'])) {
    header('Location: auth.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $sql = "INSERT INTO jobvacancy (name, description, date) VALUES ('$name', '$description', '$date')";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM jobvacancy");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vacancy Page</title>
</head>
<body>
    <h1>Vacancy Page</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Description:</label>
        <textarea name="description" required></textarea>
        <label>Date:</label>
        <input type="date" name="date" required>
        <button type="submit">Upload Vacancy</button>
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['idcode'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['date'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php">Back to Home</a>
</body>
</html>
