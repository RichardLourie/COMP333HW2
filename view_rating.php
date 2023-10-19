<?php
// Include the database connection file (dbconnection.php)
include 'dbconnection.php';

// Check if the rating ID is provided as a query parameter
if (isset($_GET['id'])) {
    // Retrieve the rating ID from the URL
    $ratingId = $_GET['id'];

    // Construct an SQL query to select the rating
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

        // You can display the rating details in HTML here
        echo "<h1>Rating Details</h1>";
        echo "<p>Username: " . htmlspecialchars($username) . "</p>";
        echo "<p>Artist: " . htmlspecialchars($artist) . "</p>";
        echo "<p>Song: " . htmlspecialchars($song) . "</p>";
        echo "<p>Rating: " . htmlspecialchars($rating) . "</p>";
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
</head>
<body>
    <a href="ratingsPage.php">Back to ratings page</a>
</body>
</html>
