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

$query = "SELECT * FROM ratings";
$result = $conn->query($query);

session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Main Page</title>
  </head>
  <body>
    <!-- <div class="container"> -->
    <h1 class="page-title">Welcome to Music DB</h1>

    <div class="user-info">
      <p>You are logged in as user: <span class="username"><?php echo $_SESSION['username'];?></span></p>
      <a href="index.html" class="logout-button">Log Out</a>
    </div>

    <h2 class="ratings-title">Song Ratings</h2>

    <a href="add_song_page.php" class="add-button">Add a New Song Rating</a>
    <!--
    <table class="song-ratings">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Artist</th>
        <th>Song</th>
        <th>Rating</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>1</td>
        <td>JohnDoe</td>
        <td>Artist 1</td>
        <td>Song 1</td>
        <td>4</td>
        <td>
          <a href="view_rating.php?id=1">View</a> |
          <a href="update_rating.php?id=1">Update</a> |
          <a href="delete_rating.php?id=1">Delete</a>
        </td>
      </tr>
    -->

    </table>

    <table border="1">
        <thead>
            <tr>
                <!-- Add your table column names here -->
                <th>Username</th>
                <th>Artist</th>
                <th>Song</th>
                <th>Rating</th>
                <!-- ... and so on for each column -->
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <!-- Adjust these lines according to your table columns -->
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['artist']); ?></td>
                        <td><?php echo htmlspecialchars($row['song']); ?></td>
                        <td><?php echo htmlspecialchars($row['rating']); ?></td>
                        <td><a href="view_rating.php?id=1">View</a></td>
                        <td><a href="update_rating.php?id=1">Update</a></td>
                        <td><a href="delete_rating.php?id=1">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">No records found!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php $conn->close(); ?>
    <!-- </div> -->
  </body>
</html>
