<?php
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

$db->query(""); //Add SQL code here!