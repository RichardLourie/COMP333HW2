<!--
  COMP 333: Software Engineering
  Sebastian Zimmeck (szimmeck@wesleyan.edu) 

  PHP sample script for writing user-submitted form data to a csv file on a 
  server.
-->

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
<title>Sample Submission Form</title>
</head>

<body>
<!-- 
  PHP server-side code
 -->
<?php
    // Define two variables and set to empty values.
    // Variables always start with $.
    $name = $nameErr = "";
    // If the user enters a name, post it to the server.
    // $_SERVER["REQUEST_METHOD"] and $_POST are parts of the PHP language.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
          $nameErr = "Name is required";
        } 
        else {
          $name = $_POST["name"];
          // Append the name to a csv file.
          $file = fopen($name . ".csv", "a");
          fwrite($file, $name);
          fclose($file);
        }
    }
?>

<!-- 
  HTML form displayed to the user
  You could also write to a databse (e.g., SQL) if you have set it up 
 -->
<h1>PHP Form Submission Example</h1>
<!-- 
  Upon clicking the submit button, echo will output the user name to the name
  variable. htmlspecialchars converts special characters to HTML entities.
  You can define an action inside a form. Here the action is to run a PHP script.
  PHP_SELF is a variable that refers to the current script being run, i.e., this
  file.
  You can leave the action in the form open 
  (https://stackoverflow.com/questions/1131781/is-it-a-good-practice-to-use-an-empty-url-for-a-html-forms-action-attribute-a)
 -->
<form method="post" action="php_sample_write_csv.php">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
</body>
</html>