<?php
/*
This file will be the script that sets up the database.
When testing, be sure to add print statements so that if there are no errors,
you can see that something is happening.
*/


// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

/* This comes from a Config.php file that is ignored by git.
Format:
class Config {
    public static $db = [
        "host" => "",
        "user" => "",
        "pass" => "",
        "database" => ""
    ]
}

*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli(Config::$db["host"], Config::$db["user"],
                Config::$db["pass"], Config::$db["database"]);

// Need to add tables to database:

/*
$sql = "CREATE TABLE user (
id INT NOT NULL AUTO_INCREMENT,
username VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
PRIMARY KEY (id)
)";
*/

/*
$sql = "CREATE TABLE pet (
    id INT NOT NULL AUTO_INCREMENT,
    user_id int not null,
    name VARCHAR(255) NOT NULL,
    animal VARCHAR(255) NOT NULL,
    breed VARCHAR(255) NOT NULL,
    allergies VARCHAR(255) NOT NULL,
    activities VARCHAR(255) NOT NULL,
    food VARCHAR(255) NOT NULL,
    bday date NOT NULL,
    PRIMARY KEY (id)
)";
*/


if ($db->query($sql) === TRUE) {
  echo "Table pet created successfully";
} else {
  echo "Error creating table: " . $db->error;
}

$db->close();
