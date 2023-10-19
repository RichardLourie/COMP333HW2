<!-- page to verify a user after entering login details -->
<?php
session_start();

include 'dbconnection.php';
$userid = $_POST['userid'];
$password = $_POST['password'];

// Use a prepared statement to fetch the user's hashed password.
$getUserQuery = "SELECT password FROM users WHERE username = ?";
$stmt = mysqli_prepare($db, $getUserQuery);
mysqli_stmt_bind_param($stmt, "s", $userid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

if ($num > 0) {
    // User with the entered username exists, now verify the password.
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['password'];

    if (password_verify($password, $hashedPassword)) {
        // Passwords match, so it's a successful login.
        $_SESSION['username'] = $userid;
        header("Location: ratingsPage.php");  // Redirect to ratingsPage.php
        exit;  // It's a good practice to call exit after a header redirection.
    } else {
        // Passwords do not match.
        echo "Wrong User id or password";
        echo '<br /><a href="index.html" class="back-link">Retry</a>';
    }
} else {
    // No user with the entered username found.
    echo "User does not exist";
    echo '<br /><a href="index.html" class="back-link">Retry</a>';
}
?>


<!-- old login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($password) < 10) {
      $loginError = "Password must be at least 10 characters long.";
  } else {
      // Replace the following lines with database query code to retrieve the user's data.
      // Verify the password using password_verify.
      $pdo = new PDO('mysql:host=localhost;dbname=music_db', 'username', 'password');
      $stmt = $pdo->prepare("SELECT username, password FROM users WHERE username = ?");
      $stmt->execute([$username]);
      $user = $stmt->fetch();

      if ($user && password_verify($password, $user['password'])) {
          // Start a session and store the username for authentication.
          session_start();
          $_SESSION['user'] = $username;
          header('Location: ratingsPage.html'); // Redirect to the main page after successful login.
      } else {
          $loginError = "Invalid username or password. Please try again.";
      }
  }
} -->
