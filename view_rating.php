<!-- page to view the rating of a song -->

<?php
// Include the database connection file (dbconnection.php)
session_start();
include 'dbconnection.php';

// Check if the rating ID is provided as a query parameter
if (isset($_GET['id'])) {
    // Retrieve the rating ID from the URL
    $ratingId = $_GET['id'];

    // Construct an SQL query to select the rating
    // avoid sql injection with bind_param
    $query = "SELECT * FROM ratings WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "i", $ratingId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    if ($row) {
        // Rating found, display the rating details
        $username = $row['username'];
        $artist = $row['artist'];
        $song = $row['song'];
        $rating = $row['rating'];

        // display the rating details in HTML here
        echo "<h1 class='page-title'>Rating Details</h1>";
        echo "<p><span class='label'>Username:</span> <span class='username'>" . htmlspecialchars($username) . "</span></p>";
        echo "<p><span class='label'>Artist:</span> <span class='artist'>" . htmlspecialchars($artist) . "</span></p>";
        echo "<p><span class='label'>Song:</span> <span class='song'>" . htmlspecialchars($song) . "</span></p>";
        echo "<p><span class='label'>Rating:</span> <span class='rating'>" . htmlspecialchars($rating) . "</span></p>";
    } else {
        // Rating not found
        echo "Rating not found.";
    }
} else {
    // Rating ID not provided
    echo "Rating ID not provided.";
}

// Close the database connection
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>View Rating</title>
    <div class="user-info">
      <p>You are logged in as user: <span class="username"><?php echo $_SESSION['username'];?></span></p>
      <a href="index.html" class="logout-button">Log Out</a>
    </div>

</head>
<body>
<!-- link back to ratings page -->
    <a href="ratingsPage.php" class="back-link">Back to ratings page</a>
</body>
</html>
