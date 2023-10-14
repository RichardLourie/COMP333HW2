<!-- 
  COMP 333: Software Engineering
  Sebastian Zimmeck (szimmeck@wesleyan.edu) 

  PHP sample script for querying a database with SQL. This script can be run 
  from inside the htdocs directory in XAMPP. 
  
  NOTE: The script assumes that there is a database set up (e.g., via phpMyAdmin) 
  named COMP333_SQL_Tutorial with students and student_grades tables per the 
  sql_tutorial.md.
-->

<!DOCTYPE HTML>
<html lang="en">
<head>
  <!-- This is the default encoding type for the HTML Form post submission. 
  Encoding type tells the browser how the form data should be encoded before 
  sending the form data to the server. 
  https://www.logicbig.com/quick-info/http/application_x-www-form-urlencoded.html -->
  <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
  <title>Sample Submission Form</title>
</head>

<body>
  <?php
    // PHP code for retrieving data from the database. If you have multiple files
    // relying on the this server config, you can create a config.php file and
    // import it with `require_once "config.php";` at the beginning of each file 
    // where you need it.
    // Database credentials per below are default for a local server. Assuming 
    // running MySQL server with default setting (user 'root' with no password).
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "COMP333_SQL_Tutorial";

    // Create server connection.
    // The MySQLi Extension (MySQL Improved) is a relational database driver 
    // used in the PHP scripting language to provide an interface with MySQL 
    // databases (https://en.wikipedia.org/wiki/MySQLi).
    // Instances of classes are created using `new`.
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check server connection.
    // -> is used to call a method or access a property instance of a class,
    // in our case the connection $conn we created calls the built in connect_error
    // method available to all connections.
    // Note the difference to =>, which is used for arrow functions, a more 
    // concise syntax for anonymous functions (which we will also see in JavaScript).
    // See https://stackoverflow.com/questions/14037290/what-does-this-mean-in-php-or/14037320.
    if ($conn->connect_error) {
      // Exit with the error message.
      // . is used to concatenate strings.
      die("Connection failed: " . $conn->connect_error);
    }

    // `isset` — Function to determine if a variable is declared and is different than null.
    // Generally, check out the PHP documentation. It is really good and has
    // use examples, e.g., https://www.php.net/manual/en/function.isset.php
    // $_REQUEST is a PHP built-in superglobal variable which is used to collect data 
    // after submitting an HTML form.
    // https://www.w3schools.com/PHP/php_superglobals_request.asp
    // Some predefined variables in PHP are superglobals, which means that 
    // they are always accessible, regardless of scope - and you can access them 
    // from any function, class or file without having to do anything special.
    // https://www.w3schools.com/PHP/php_superglobals.asp
    if(isset($_REQUEST["submit"])){
      // Variables for the output and the web form below.
      $out_value = "";
      $s_id = $_REQUEST['student_id'];
      $s_test = $_REQUEST['test'];

      // The following is the core part of this script where we connect PHP
      // and SQL.
      // Check that the user entered data in the form.
      if(!empty($s_id) && !empty($s_test)){
        // If so, prepare SQL query with the data to query the database.
        $sql_query = "SELECT * FROM student_grades WHERE student_id = ('$s_id') AND test = ('$s_test')";
        // Send the query and obtain the result.
        // mysqli_query performs a query against the database.
        $result = mysqli_query($conn, $sql_query);
        // mysqli_fetch_assoc returns an associative array that corresponds to the 
        // fetched row or NULL if there are no more rows.
        // It does not make much of a difference here, but, e.g., if there are
        // multiple rows returned, you can iterate over those with a loop.
        $row = mysqli_fetch_assoc($result);
        $out_value = "The grade is: " . $row['grade'];
      }
      else {
        $out_value = "No grade available!";
      }
    }

    // Close SQL connection.
    $conn->close();
  ?>

  <!-- 
    HTML code for the form by which the user can query data.
    Note that we are using names (to pass values around in PHP) and not ids
    (which are for CSS styling or JavaScript functionality).
    You can leave the action in the form open 
    (https://stackoverflow.com/questions/1131781/is-it-a-good-practice-to-use-an-empty-url-for-a-html-forms-action-attribute-a)
  -->
  <form method="GET" action="">
  Student ID: <input type="text" name="student_id" placeholder="Enter Student ID" /><br>
  Test: <input type="text" name="test" placeholder="Enter Test" /><br>
  <input type="submit" name="submit" value="Submit"/>
  <!-- 
    Make sure that there is a value available for $out_value.
    If so, print to the screen.
  -->
  <p><?php 
    if(!empty($out_value)){
      echo $out_value;
    }
  ?></p>
  </form>
</body>
</html>