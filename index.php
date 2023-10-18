<?php
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
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Welcome to Music DB</title>
  </head>
  <body>
    <div class="container">
      <div class="login-box">
        <h1>Welcome to Music DB!</h1>
        <h2>Login</h2>
        <p>Please fill in your credentials to login</p>

        <form action="index.php" method="post">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required />
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />
          </div>

          <input type="submit" value="Login" />
        </form>

        <?php
            if (isset($loginError)) {
                echo '<p class="error-message">' . $loginError . '</p>';
            }
            ?>

        <p>Don't have an account? <a href="signup.html">Sign up now</a></p>
      </div>
    </div>
  </body>
</html>
