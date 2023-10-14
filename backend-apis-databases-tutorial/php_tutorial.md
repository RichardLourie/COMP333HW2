# PHP Tutorial

An introduction to PHP based on <https://www.learn-php.org/> for COMP 333:
Software Engineering.
Check out the [official PHP documentation](https://www.php.net/manual/en/langref.php)
as well. It is really good and has lots of examples.
Created by Sebastian Zimmeck (<szimmeck@wesleyan.edu>)

## 1. Hello World

Save the following code in an index.php file and put it on a server
(in the htdocs directory).
Use the built-in `echo` language construct to print.

```php
    <?php $user = "Patti Smith"; ?>
    <html>
        <head></head>
        <body>
            Hello <?php echo $user; ?>
        </body>
    </html>
```

## 2. Variables

PHP is dynamically typed and does not require explicit type declarations. You
can define a PHP variable using the $ sign at the start of your variable name.
Use the `gettype` function to get the type of a variable. You can also use
common HTML syntax, e.g., to insert a break. Concatenate strings using the `.`
notation.

```php
<html>
<head></head>
<body>
<?php
    echo gettype($x = 1);
    echo "<br>";
    echo gettype($y = "a string");
    echo "<br>";
    echo gettype($z = True);
    echo "<br>";
    echo "Pat " . "Metheney";
?>
</body>
</html>
```

You can perform operations with variables (also note the comment style; it
differs from html).

```php
<html>
<head></head>
<body>
<?php
    $x = 1;
    $y = 2;
    $sum = $x + $y;
    echo $sum;       // Prints out 3.
?>
</body>
</html>
```

## 3. Loops and Conditionals

`For` loops are useful it we want to iterate over an array and refer to a member
of the array using a changing index. For example, let's say we have a list of
odd numbers. To print them out, we need to refer to each individually. The code
we write in the `for`loop can use the index`i`, which changes in every iteration
of the `for` loop.

```php
<html>
<head></head>
<body>
<?php
$odd_numbers = [1,3,5,7,9];
for ($i = 0; $i < count($odd_numbers); $i=$i+1) {
    $odd_number = $odd_numbers[$i];
    echo $odd_number . "\n";
}
?>
</body>
</html>
```

Here is an example of a `while` loop that is executed a total of eight times
until the condition is reached.

```php
<html>
<head></head>
<body>
<?php
$counter = 0;

while ($counter < 10) {
    $counter += 1;
    if ($counter > 8) {
        echo "counter is larger than 8, stopping the loop.";
        break;
    }
    echo "Executing - counter is $counter.<br>";
}
?>
</body>
</html>
```

## 4. Functions

There are two types of functions --- library functions and user functions.
Library functions, such as `array_push`, are part of PHP and can be
used by anyone. However, you may also write your own functions and use them across
your code.

A function receives a list of arguments separated by commas. Every argument only
exists in the context of the function, meaning that they become variables inside
the function block, but are not defined outside of that function block.

```php
<html>
<head></head>
<body>
<?php
// Define a function called `sum` that will
// receive a list of numbers as an argument.
function sum($numbers) {
    // Initialize the variable we will return.
    $sum = 0;

    // Sum up the numbers.
    // Using a foreach loop.
    // Store the current value in the array as $number.
    foreach ($numbers as $number) {
        $sum += $number;
    }

    // Return the sum to the user.
    return $sum;
}

// Call the sum function.
echo sum([1,2,3,4,5,6,7,8,9,10]);
?>
</body>
</html>
```

## 5. Setting a Session Using `session_start()` and the PHPSESSID Cookie

`session_start()` creates a session (or resumes the current one) based on a
session identifier passed via a GET or POST request, or passed via a cookie.
You can use it to keep track of whether people are logged in.

`$_SESSION` is a superglobal variable built into PHP that can contain session
variables available to the current script over all its files.

Try it out by pasting the following code and wrapping it around php tags, `<?php`
and `?>`.

```php
// page_1.php

// Will set a session cookie with the name PHPSESSID.
session_start();

echo 'Welcome to page #1<br />';

// session_id() is a built-in function used to get or set the session id for the
// current session (https://www.php.net/manual/en/function.session-id.php).
echo('PHPSESSID: ' . session_id());

// Set session variables.
// The "loggedin" session variable is used here to keep track if a user
// is logged in.
$_SESSION['animal']   = 'cat';
$_SESSION["loggedin"] = true;

// Call page 2
if($_SESSION["loggedin"]){
    echo '<br /><a href="page_2.php">page 2</a>';
}
```

![Picture6](images/Picture6.png)

```php
// page2.php

// session_start() is called here to continue session.
session_start();
echo 'Welcome to page #2<br />';

// Session variables and PHPSESSID cookie are still set.
echo "Current animal: " . $_SESSION['animal'] . '<br />';   // cat
echo "Current logged-in state " . $_SESSION["loggedin"] . '<br />'; // 1
echo('PHPSESSID: ' . session_id());

// Unset all session variables and destroy session.
$_SESSION = array();
session_destroy();

// Variables and PHPSESSID cookie are no longer set.
// The PHPSESSID cookie may still be in the browser cache,
// but it is no longer valid.
echo "<br />Current animal: " . $_SESSION['animal'];   // not set
echo "<br />Current logged-in state: " . $_SESSION["loggedin"]; // not set
echo('<br />PHPSESSID: ' . session_id()); // not set

// Return to page 1
echo '<br /><a href="page_1.php">page 1</a>';
// Additional remark:
// The built-in isset function can be used to determine if a variable is declared
// and is different than NULL. It can be used in connection with a conditional.
// If it is true, send the user wherever they should be when they are logged in,
// e.g., via `header("location: index.php")` if they should be redirected to
// index.php.
?>
```

## 6. Preventing SQL Injections Using Parameterized Queries (aka Prepared Statements)

The following is based on and modified from [How to prevent SQL Injection in PHP?](https://www.geeksforgeeks.org/how-to-prevent-sql-injection-in-php/).

A SQL injection is a code injection technique, in which malicious SQL statements
are inserted into an entry field for execution, for example, to dump the database
contents to the attacker or gain access to an account without password.

In a SQL injection attack the attacker uses characters to convert the SQL query
into a new SQL query that discloses information that should not be disclosed.

Here is the setup:

### Step 1: Create a Database (e.g., in XAMPP)

```sql
CREATE DATABASE unsecuredb;
```

### Step 2: Populate the Database

```sql
CREATE TABLE users(
    id int(10) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    password VARCHAR(255)
);
```

```sql
INSERT INTO users VALUES(1, 'Billy', '1234');
INSERT INTO users VALUES(2, 'comp333', 'aGoodPass53@woRD');
```

### Step 3: Create a PHP Script --- dbconnection.php --- as Login Page

Wrap the code below around `<?php` and `?>` tags.

```php
$db = mysqli_connect("localhost","root","","unsecuredb");

if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: "
  . mysqli_connect_error();
}
```

### Step 4: Create an HTML Input Form --- form.html

```html
<!DOCTYPE html>
<html>
  <head>
    <title>GFG SQL Injection Article</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>

  <body>
    <div id="form">
      <h1>LOGIN FOR SQL INJECTION</h1>
      <form name="form" action="verifyLogin.php" method="POST">
        <p>
          <label> USER NAME: </label>
          <input type="text" id="user" name="userid" />
        </p>

        <p>
          <label> PASSWORD: </label>
          <input type="text" id="pass" name="password" />
        </p>

        <p>
          <input type="submit" id="button" value="Login" />
        </p>
      </form>
    </div>
  </body>
</html>
```

### Step 5: Create a verifyLogin.php

Wrap the code below around `<?php` and `?>` tags.

```php
include 'dbconnection.php';
$userid = $_POST['userid'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE username = '$userid' AND password = '$password'";
$result = mysqli_query($db, $sql) or die(mysqli_error($db));
$num = mysqli_fetch_array($result);

if($num > 0) {
 echo "Login Success";
}
else {
 echo "Wrong User id or password";
}
```

### Step 6: The Attack

Enter the username `comp333` into the form field (maybe you saw someone typing it)
and the characters below in the password field.

```sql
' or 'a'='a
```

What happens?

**Explanation**:

If you replace `$password` in

`'$password'`

with the string

`' or 'a'='a`

you get (assuming the single quotes remain in place, just the variable is replaced)

`'' or 'a'='a'`,

i.e., an empty string, and the string comparison `'a'='a'`, which is always true.

### Step 7: Using a Parameterized Query to Prevent SQL Injections

Use the following version of the verifyLogin.php instead.

Wrap the code below around `<?php` and `?>` tags.

```php
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
} else {
  echo "Wrong User id or password";
}
```

Enter

```sql
' or 'a'='a
```

What happens?

## 7. Storing Passwords Securely and Privately

Passwords should be stored securely and privately. As the
[OWASP Password Storage Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Password_Storage_Cheat_Sheet.html)
describes, it is essential to store passwords in a way that prevents them from
being obtained by an attacker even if the application or database is compromised.
The majority of modern languages and frameworks provide built-in functionality
to help store passwords safely.

Password hashing and salting is critical. Both are built into PHP's
`password_hash`.

After an attacker has acquired stored password hashes, they are always able to
brute force hashes offline. However, as a defender, it is possible to slow down
offline attacks by selecting hash algorithms that are as resource intensive
as possible.

A salt is a unique, randomly generated string that is added to each password as
part of the hashing process. As the salt is unique for every user, an attacker
has to crack hashes one at a time using the respective salt rather than
calculating a hash once and comparing it against every stored hash.

With the following you can hash a password:

```php
password_hash($password, PASSWORD_DEFAULT);
```

`PASSWORD_DEFAULT` means to use the bcrypt hashing algorithm; `$password` is the
password the user entered.

With the following you can verify whether a user-entered password matches a
stored hashed (and salted) password. If there is a match, you can log in the user.

```php
password_verify($password, $hashed_password)
```

## 8. Iterating over and Printing a Table

You can use
[mysqli_fetch_array](https://www.php.net/manual/en/mysqli-result.fetch-array.php)
to iterate over the rows of a table and print (some of) them.
