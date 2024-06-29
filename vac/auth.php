<?php
include 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $idcode = $_POST['idcode'];
    
    $result = $conn->query("SELECT * FROM company WHERE name='$name' AND idcode=$idcode");
    
    if ($result->num_rows > 0) {
        $_SESSION['company'] = $name;
        header('Location: vacancy.php');
        exit();
    } else {
        echo "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Authorization Page</title>
</head>
<body>
    <h1>Authorization Page</h1>
    <form method="POST">
        <label>Company Name:</label>
        <input type="text" name="name" required>
        <label>Company ID Code:</label>
        <input type="text" name="idcode" required>
        <button type="submit">Login</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
