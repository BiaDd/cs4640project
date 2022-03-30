<?php
class PetPalsController {

    private $command;
    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
    }

    public function run() {
        switch($this->command) {
            case "signup":
                $this->signup();
                break;
            case "home":
                $this->home();
                break;
            case "calendar":
                $this->calendar();
                break;
            case "userpage":
                $this->userPage();
                break;
            case "addPet":
                $this->addPet();
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
        if (isset($_SESSION["email"])) { // If already logged into session
            header("Location: ?command=home");
            return;

        } else if (isset($_POST["email"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && isset($_POST["username"])
        && !empty($_POST["password"]) && isset($_POST["password"]) && !empty($_POST["password_check"]) && isset($_POST["password_check"])) { /// If all fields filled
            $username = strtolower($_POST["username"]); // Makes all alphabetical characters in username lowercase.
            $checkemail = $this->db->query("select * from user where email = ?;", "s", $_POST["email"]);
            $checkusername = $this->db->query("select * from user where username = ?;", "s", $username);
            if ($checkemail === false) {
                $error_msg = "Error occurred while registering.";
            } else if ($_POST["password"] !== $_POST["password_check"]) {
                $error_msg = "Passwords do not match.";
            } else if (!empty($checkusername)) {
                $error_msg = "That username is taken.";
            } else if (!empty($checkemail)) {
                $error_msg = "A user with that email address already exists.";
            } else {
                $insert = $this->db->query("insert into user (username, email, password) values (?, ?, ?);",
                "sss", $username, $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));

                if ($insert === false) {
                    $error_msg = "Error registering user.";
                } else {
                    header("Location: ?command=home");
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["logged_in"] = TRUE;
                    $_SESSION["username"] = $username;
                    return;
                }
            }
        }


        include("templates/signup.php");

    }

    // Display the login page (and handle login logic)
    public function login() {
        if (isset($_SESSION["email"])) { // If already logged into session
            header("Location: ?command=home");
            return;
        } else if (!empty($_POST["username"]) && isset($_POST["username"]) && !empty($_POST["password"]) && isset($_POST["password"])) { /// validate the email coming in

            $username = strtolower($_POST["username"]);
            $data = $this->db->query("select * from user where username = ?;", "s", $username);
            if ($data === false) { // If there is an error:
                $error_msg = "Error occurred while logging in.";
            } else if (!empty($data)) { // If there is no error:
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    header("Location: ?command=userpage");
                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["username"] = $data[0]["username"];
                    $_SESSION["logged_in"] = TRUE;
                    return;
                } else {
                    $error_msg = "Incorrect password.";
                }
            } else {
                $error_msg = "Username or password is incorrect. Have you registered?";
            }
        }

        include "templates/login.php";
    }



    // Display the calendar template
    public function calendar() {
        // set user information for the page from the session
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];


        include("templates/calendar.php");
    }

    public function home() {
      /*
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];
        */

        include("templates/home.php");
    }

    public function userPage() {
      $user = [
          "username" => $_SESSION["username"],
          "email" => $_SESSION["email"]
      ];

      include("templates/userPage.php");
    }

    private function addPet() {
      $user = [
          "username" => $_SESSION["username"],
          "email" => $_SESSION["email"]
      ];
      $username = $this->db->query("select * from user where username = ?;", "s", $user["username"]);
      $id =  $this->db->query("select id from user where username = ?;", "s", $username);

      // Not sure if need to even check for post since html form has required, so they either input or not
      if (isset($_POST["name"])) {
          $insert = $this->db->query("insert into pet_table (user_id, name, type, breed, age) values (?, ?, ?, ?, ?);",
          "sssss", $id, $_POST["name"], $_POST["type"], $_POST["breed"], $_POST["age"]);
          header("Location: ?command=userpage"); // why does this redirect to homepage?
      }
      
    }
}
