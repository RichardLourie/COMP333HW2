<?php

$db = mysqli_connect("localhost","root","","music_db");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
// Sanitize user input
$username = mysqli_real_escape_string($db, $_POST['username']);
$artist = mysqli_real_escape_string($db, $_POST['artist']);
$song = mysqli_real_escape_string($db, $_POST['song']);
$rating = (int) $_POST['rating']; 

// Check if the username exists in the users table
$userExistsQuery = "SELECT username FROM users WHERE username = ?";
$userExistsStmt = mysqli_prepare($db, $userExistsQuery);
mysqli_stmt_bind_param($userExistsStmt, "s", $username);
mysqli_stmt_execute($userExistsStmt);
mysqli_stmt_store_result($userExistsStmt);
$rowCount = mysqli_stmt_num_rows($userExistsStmt);
mysqli_stmt_close($userExistsStmt);

if ($rowCount == 0) {
    echo "Username does not exist in users table!";
    echo '<br /><a href="index.html">Go Back</a>';
    exit();
}

$insertUserQuery = "INSERT INTO ratings (username, artist, song, rating) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($db, $insertUserQuery);

// Bind user inputs to the prepared statement
mysqli_stmt_bind_param($stmt, "sssi", $username, $artist, $song, $rating);

if (false === $stmt) {
    die('prepare() failed: ' . htmlspecialchars(mysqli_error($db)));
}

if (mysqli_stmt_execute($stmt)) {
    echo "song add successful!";
    echo '<br /><a href="ratingsPage.php">Login</a>';
} else {
    echo "song add failed";
    echo '<br /><a href="ratingsPage.php">Retry</a>';
}

?>