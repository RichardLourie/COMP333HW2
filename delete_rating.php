<?php
$host = 'localhost';
$db   = 'music_db';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// cancel if no ID provided through URL
if (!isset($_GET['id'])) {
    die("No ID provided for deletion.");
}
$id = $_GET['id'];

// prepared sql statement to avoid injection
$query = "DELETE FROM ratings WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ratingsPage.php"); // Redirect back to the main page.
exit();
?>
