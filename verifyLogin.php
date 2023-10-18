<?php

include 'dbconnection.php';
$userid = $_POST['userid'];
$password = $_POST['password'];
// Use placeholders ? for username and password values for the time being.
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
// Construct a prepared statement.
$stmt = mysqli_prepare($db, $sql);
// Bind the values for username and password that the user entered to the
// statement AS STRINGS (that is what "ss" means). In other words, the
// user input is strictly interpreted by the server as data and not as
// porgram code part of the SQL statement.
mysqli_stmt_bind_param($stmt, "ss", $userid, $password);
// Run the prepared statement.
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

if ($num > 0) {
  echo "Login Success";
  echo '<br /><a href="ratingsPage.html">proceed</a>';
} else {
  echo "Wrong User id or password";
  echo '<br /><a href="index.html">retry</a>';
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