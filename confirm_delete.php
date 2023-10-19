<!-- page displayed to confirm that a user wants to delete a song -->
<?php
session_start();

if (!isset($_GET['id'])) {
    die("No ID provided for deletion.");
}
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
</head>
<body>
    <div class="user-info">
        <!-- display current user -->
      <p>You are logged in as user: <span class="username"><?php echo $_SESSION['username'];?></span></p>
      <a href="index.html" class="logout-button">Log Out</a>
    </div>
    <!-- confirm delete or back to ratings page -->
    <h2>Are you sure you want to delete this entry?</h2>
    <a href="delete_rating.php?id=<?php echo $id; ?>" class="back-link">Yes, delete this rating</a>
    <a href="ratingsPage.php" class="back-link">Back to ratings page</a>
</body>
</html>
