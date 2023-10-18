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
  echo '<br /><a href="main.php">proceed</a>';
} else {
  echo "Wrong User id or password";
  echo '<br /><a href="index.html">retry</a>';
}
?>
