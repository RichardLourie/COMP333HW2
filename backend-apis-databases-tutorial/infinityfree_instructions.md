# SQL Database Creation and Deployment

A setup guide for COMP 333 Software Engineering.
Created by Sebastian Zimmeck (<szimmeck@wesleyan.edu>).

## 0. InfinityFree Account Sign-up

We will be using InfinityFree as our production environment (prod). Please
sign up for a free account on <https://www.infinityfree.net/>.

## 1. Create a New Hosting Account

Create a new account by following the instructions of the setup wizard.
You can select any subdomain and domain that you like.

![Picture1](images/Picture1.png)

## 2. Create a New Database

Click on "Control Panel." On the opening site click on "MySQLDatabases."
Create a new database and take note of its name and credentials. We do not need
it here for our initial setup, but you will need a database later for the
homework.

## 3. Start phpMyAdmin

Check that phpMyAdmin is working. Here you would set up your database and tables.

![Picture4a](images/Picture4a.png)

![Picture4b](images/Picture4b.png)

Here is an example query to create a database table that you can run under
phpMyAdmin -> SQL. We will not further use it. It is just an example to test
that the setup is working.

```sql
CREATE TABLE `yourdbname`.`users` ( `id` INT(16) NOT NULL AUTO_INCREMENT ,
                                    `username` VARCHAR(32) NOT NULL ,
                                    `password` VARCHAR(255) NOT NULL ,
                                    PRIMARY KEY (`id`),
                                    UNIQUE (`username`))
                                    ENGINE = MyISAM;
```

`NOT NULL` means that each column (i.e. `id`, `username`, and `password`)
cannot contain empty values. In other words, when people input data into your
app, they must enter something for both the username and password fields in
order for the data to be properly inputted into the database. The code of your
app should enforce these constraints on the frontend.

## 5. Deploy a Minimal Working Example in Prod

Click on "File Manager" on the site that you previously opened.

![Picture5](images/Picture5.png)

On the file manager site, navigate to the htdocs folder and upload
the php_sample_write_csv.php file there.

Test your app by navigating in your browser to
<yourdomain.com/php_sample_write_csv.php/>.
