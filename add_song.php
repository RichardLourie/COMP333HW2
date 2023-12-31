<!-- php code to add a song when form filled in on add_song_page -->
<?php

session_start();

$db = mysqli_connect("localhost","root","","music_db");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
// Sanitize user input
$username = mysqli_real_escape_string($db, $_SESSION['username']);
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
    echo '<br /><a href="index.html" class="back-link">Go Back</a>';
    exit();
}

// Check if the song by the same artist already exists for the user
$songExistsQuery = "SELECT song FROM ratings WHERE username = ? AND artist = ? AND song = ?";
$songExistsStmt = mysqli_prepare($db, $songExistsQuery);
mysqli_stmt_bind_param($songExistsStmt, "sss", $username, $artist, $song);
mysqli_stmt_execute($songExistsStmt);
mysqli_stmt_store_result($songExistsStmt);
$songCount = mysqli_stmt_num_rows($songExistsStmt);
mysqli_stmt_close($songExistsStmt);

if ($songCount > 0) {
    echo "can't add a duplicate!";
    echo '<br /><a href="ratingsPage.php">Go Back</a>';
    exit();
}

$insertUserQuery = "INSERT INTO ratings (username, artist, song, rating) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($db, $insertUserQuery);

// Bind user inputs to the prepared statement to avoid sql injection
mysqli_stmt_bind_param($stmt, "sssi", $username, $artist, $song, $rating);

if (false === $stmt) {
    die('prepare() failed: ' . htmlspecialchars(mysqli_error($db)));
}

if (mysqli_stmt_execute($stmt)) {
    echo "song add successful!";
    echo '<br /><a href="ratingsPage.php" class="back-link">back to ratings</a>';
} else {
    echo "song add failed";
    echo '<br /><a href="ratingsPage.php" class="back-link">Retry</a>';
}

?>
