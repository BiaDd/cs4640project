<?php
/* Sources used:
    1. https://stackoverflow.com/questions/26148701/file-get-contents-ssl-operation-failed-with-code-1-failed-to-enable-crypto
    2. https://cs4640.cs.virginia.edu/homework/homework4.html
    3. https://cs4640.cs.virginia.edu/lectures/examples/trivia-cookies.html
    4. https://php.net
*/

// Production URL: https://cs4640.cs.virginia.edu/mjm7ngb/hw4

// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

session_start();

// Parse the query string for command
$command = "login";
if (isset($_GET["command"]))
    $command = $_GET["command"];

// If the user's email is not set in the cookies, then it's not
// a valid session (they didn't get here from the login page),
// so we should send them over to log in first before doing
// anything else!
if (!isset($_SESSION["logged_in"]) && $command !== "signup") {
    // they need to see the login
    $command = "login";
}

// Instantiate the controller and run
$wordGame = new PetPalsController($command);
$wordGame->run();