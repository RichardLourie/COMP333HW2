<!-- page to update song rating -->

<?php
// Include the database connection file (dbconnection.php)
include 'dbconnection.php';

session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated data from the form
    $ratingId = $_POST['rating_id'];
    $newArtist = $_POST['artist'];
    $newSong = $_POST['song'];
    $newRating = $_POST['rating'];

    // Construct an SQL query to update the rating
    $updateQuery = "UPDATE ratings SET artist = ?, song = ?, rating = ? WHERE id = ?";

    // Prepare and execute the SQL query
    $stmt = mysqli_prepare($db, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssii", $newArtist, $newSong, $newRating, $ratingId);

    if (mysqli_stmt_execute($stmt)) {
        // Update successful
        echo "Rating updated successfully.";
        echo '<br /><a href="ratingsPage.php" class="back-link">Go back to main page</a>';
    } else {
        // Update failed
        echo "Error updating rating: " . mysqli_error($db);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // If the form is not submitted, retrieve the current rating data
    $ratingId = $_GET['id'];
    $query = "SELECT artist, song, rating FROM ratings WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "i", $ratingId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Close the prepared statement
    mysqli_stmt_close($stmt);
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
    <title>Update Rating</title>
</head>
<body>
    <div class="user-info">
      <p>You are logged in as user: <span class="username"><?php echo $_SESSION['username'];?></span></p>
      <a href="index.html" class="logout-button">Log Out</a>
    </div>
    <!-- form for updating ratings autofilled with previous values -->
    <div id="form-container">
    <h1 class="page-title">Update Rating</h1>
    <form method="post" action="update_rating.php">
        <input type="hidden" name="rating_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
        <div class="form-group">
            <label for="artist">Artist:</label>
            <input type="text" id="artist" name="artist" value="<?php echo htmlspecialchars($row['artist']); ?>" required>
        </div>
        <div class="form-group">
            <label for="song">Song:</label>
            <input type="text" id="song" name="song" value="<?php echo htmlspecialchars($row['song']); ?>" required>
        </div>
        <div class="form-group">
            <label for="rating">Rating (1-5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo htmlspecialchars($row['rating']); ?>" required>
        </div>
        <input type="submit" value="Update">
        <a href="ratingsPage.php" class="back-link">Back to ratings page</a>
    </form>
    </div>
</body>
</html>
