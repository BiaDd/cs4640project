<?php
class PetPalsController {

    private $command;

    public function __construct($command) {
        $this->command = $command;
    }

    public function run() {
        switch($this->command) {
            case "home":
                $this->home();
                break;
            case "signup":
                $this->signup();
                break;
            case "calendar":
                $this->calendar();
                break;
            case "logout":
                $this->destroySession();
            case "login":
            default:
                $this->login();
                break;
        }
    }

    // Clear and destroy the session
    private function destroySession() {
        session_unset();
        session_destroy();
    }
    
    public function signup() {
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];

        include("templates/signup.php");
    }

    // Display the login page (and handle login logic)
    public function login() {
        if (isset($_SESSION["email"])) { // If already logged into session
            header("Location: ?command=home");
            return;
        } else if (isset($_POST["email"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && isset($_POST["email"])) { /// validate the email coming in
            header("Location: ?command=home");
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["logged_in"] = TRUE;
            $_SESSION["username"] = $_POST["username"];
            return;
        }

        include "templates/login.php";
    }

    

    // Display the word game template (and handle word game logic)
    public function calendar() {
        // set user information for the page from the session
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];
        

        include("templates/calendar.php");
    }

    public function home() {
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];

        include("templates/home.php");
    }
}