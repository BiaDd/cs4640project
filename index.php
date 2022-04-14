<?php
/* Sources used:
    1. https://stackoverflow.com/questions/26148701/file-get-contents-ssl-operation-failed-with-code-1-failed-to-enable-crypto
    2. https://cs4640.cs.virginia.edu/homework/homework4.html
    3. https://cs4640.cs.virginia.edu/lectures/examples/trivia-cookies.html
    4. https://php.net
    5. https://www.kodingmadesimple.com/2015/01/convert-mysql-to-json-using-php.html (for SQL query to JSON conversion)
*/

// Production URLs:
// CS Server: https://cs4640.cs.virginia.edu/mjm7ngb/cs4640project

// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

// This array contains all of the commands that require authentication.
// All new commands that require authentication should be added here.
$authRequired = array("userpage", "addpet", "editpet", "deletepet", "exportpets", "logout", "calendar");

session_start();

// Parse the query string for command
$command = "home";
if (isset($_GET["command"]))
    $command = $_GET["command"];

// If the user tries to use a command that is in $authRequired, but "logged_in" has not
// been set in the session variables, then they are redirected to login page.

if (!isset($_SESSION["logged_in"]) && in_array($command, $authRequired)) {
    // they need to see the login
    $command = "login";
}


// Instantiate the controller and run
$wordGame = new PetPalsController($command);
$wordGame->run();