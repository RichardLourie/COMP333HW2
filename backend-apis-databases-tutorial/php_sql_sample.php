<!-- 
  COMP 333: Software Engineering
  Sebastian Zimmeck (szimmeck@wesleyan.edu) 

  PHP sample script for connecting to a database with SQL. This script can be run 
  from inside the htdocs directory in XAMPP. Based on and modified from
  https://www.w3schools.com/php/php_mysql_connect.asp
-->

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>First PHP and SQL Example</title>
    </head>

    <body>
        <p>This is our first PHP and SQL example of a dynamically served 
            web page!</p>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";

            // Create connection
            // The MySQLi extension was introduced with PHP version 5.0.0 and 
            // the MySQL Native Driver was included in PHP version 5.3.0. i 
            // stands for improved in MySQLi and provides various functions to 
            // access the MySQL database and to manipulate the data records 
            // inside the MySQL database. You would require to call the MySQLi 
            // functions in the same way you call any other PHP function.
            // https://www.tutorialspoint.com/mysqli/index.htm
            $conn = new mysqli($servername, $username, $password);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully";
            // If the connection to the database is successful, you could now 
            // query your database using MySQL, e.g., with
            // $sql_query = "SELECT * FROM student_table WHERE student_id = *;
            // (assuming you have previously set up a student table with 
            // the student_id attribute))
        ?>
    </body>
</html>