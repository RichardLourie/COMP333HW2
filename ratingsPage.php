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

    </table>

    <table border="1" class = "song-ratings">
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
                        <?php if ($row['username'] == $_SESSION['username']):?>
                        <td><a <?php if ($row['username'] == $_SESSION['username']): ?> href="update_rating.php?id=<?php echo htmlspecialchars($row['id']); ?>">Update</a> <?php endif; ?> </td>
                        <td><a href="confirm_delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                        <?php endif; ?> 
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
