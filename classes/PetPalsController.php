<?php

// Authors: Matthew Morelli & Dan Do

class PetPalsController {

    private $command;
    private $db;
    private $eventID;

    public function __construct($command, $eventID = NULL) {
        $this->command = $command;
        $this->eventID = $eventID;
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
            case "upcomingloader":
                $this->upcomingLoader();
                break;
            case "addevent":
                $this->addEvent();
                break;
            case "eventpage":
                $this->eventPage($this->eventID);
                break;
            case "userpage":
                $this->userPage();
                break;
            case "addpet":
                $this->addPet();
                break;
            case "editpet":
                $this->editPetInfo();
                break;
            case "deletepet":
                $this->deletePet();
                break;
            case 'exportpets':
                $this->exportPets();
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
                    $_SESSION["logged_in"] = true;
                    $_SESSION["username"] = $username;
                    return;
                }
            }
        }


        include("templates/signup.php");

    }

    // Display the login page (and handle login logic)
    public function login() {
        $error_msg = "N/A";
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
                    $_SESSION["logged_in"] = true;
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

        $petError = false;

        $userID = $this->db->query("select id from user where username = ?;", "s", $user["username"]);
        if ($userID === false) { // If there is an error:
            $load_msg = "Error occurred while loading user.";
        } else if (!empty($userID)) {
            $id = $userID[0]["id"];
            // This loads the pets associated with the current user from the database
            $pets = $this->db->query("select * from pet where user_id = ?;", "i", $id);
            if ($pets === false) {
                $petError = true;
            } else if (empty($pets)) { // If the user has no pets
                $petError = true;
            }
        }

        include("templates/calendar.php");
    }

    // Handle async loading of events in the upcoming sidebar of calendar view.
    public function upcomingLoader() {
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];

        $load_msg = false;
        $eventsJSON = false;
        $eventData = [];

        $userID = $this->db->query("select id from user where username = ?;", "s", $user["username"]);
        if ($userID === false) { // If there is an error:
            $load_msg = "Error occurred while loading events.";
        } else if (!empty($userID)) {
            $id = $userID[0]["id"];
            // This loads the events associated with the current user from the database
            $events = $this->db->query("select * from event where user_id = ? order by dtime asc;", "i", $id);
            if ($events === false) {
                $load_msg = "Error occurred while loading events.";
            } else if (empty($events)) { // If the user has no events:
                $load_msg = "You have not created any events.";
            } else if (!empty($events)) { // If the user does have events:
                $eventsJSON = json_encode($events, JSON_PRETTY_PRINT);
            }
        }

        $eventData['load_msg'] = $load_msg;
        $eventData['events'] = $eventsJSON;

        echo json_encode($eventData);

    }

    // Event page view:
    public function eventPage($eventID = NULL) {
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];
        if ($eventID !== NULL) {
            $id = intval($eventID);
            $event = $this->db->query("select * from event where id = ?;", "i", $id);
            if ($event === false) {
                $load_msg = "Error occurred while loading event.";
            } else if (empty($events)) { // If the user has no events:
                $load_msg = "Error occurred while loading event";
            }
        } else {
            header("Location: ?command=calendar");
            return;
        }

        
        include("templates/event.php");
    }

    // Event creation handler:
    public function addEvent() {
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];
        $userID = $this->db->query("select id from user where username = ?;", "s", $user["username"]);
        if ($userID === false) { // If there is an error:
            $error_msg = "Error occurred while creating event.";
        } else if (!empty($userID)) {
            $id = $userID[0]["id"];
            // Not sure if need to even check for post since html form has required, so they either input or not
            if (isset($_POST["title"])) {
                $insert = $this->db->query("insert into event (user_id, title, assoc_pet, loco, descrip, dtime) values (?, ?, ?, ?, ?, ?);",
                "isssss", $id, $_POST["title"], $_POST["pet"], $_POST["location"], $_POST["desc"], $_POST["when"]);
                if ($insert === false) {
                    $error_msg = "Error creating event.";
                } else {
                    header("Location: ?command=calendar");
                    return;
                }
            }
        }
    }

    public function home() {
        $authenticated = false;
        if (isset($_SESSION["logged_in"])) {
            $user = [
                "username" => $_SESSION["username"],
                "email" => $_SESSION["email"]
            ];
            $authenticated = true;
        } 

        include("templates/home.php");
    }

    public function userPage() {
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];

        $userID = $this->db->query("select id from user where username = ?;", "s", $user["username"]);
        if ($userID === false) { // If there is an error:
            $load_msg = "Error occurred while loading pets.";
        } else if (!empty($userID)) {
            $id = $userID[0]["id"];
            // This loads the pets associated with the current user from the database
            $pets = $this->db->query("select * from pet where user_id = ?;", "i", $id);
            if ($pets === false) {
                $load_msg = "Error occurred while loading pets.";
            } else if (empty($pets)) { // If the user has no pets
                $load_msg = "You have not added any pets to your profile.";
            } else if (!empty($pets)) { // If the user does have pets, load their
                $petsJSON = json_encode($pets, JSON_PRETTY_PRINT);
            }
        }

        include("templates/userPage.php");
    }

    // Adding pet handler:
    private function addPet() {
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];
        $userID = $this->db->query("select id from user where username = ?;", "s", $user["username"]);
        if ($userID === false) { // If there is an error:
            $error_msg = "Error occurred while adding pet.";
        } else if (!empty($userID)) {
            $id = $userID[0]["id"];
            // Not sure if need to even check for post since html form has required, so they either input or not
            if (isset($_POST["name"])) {
                $insert = $this->db->query("insert into pet (user_id, name, animal, breed, allergies, activities, food, bday) values (?, ?, ?, ?, ?, ?, ?, ?);",
                "isssssss", $id, $_POST["name"], $_POST["animal"], $_POST["breed"], $_POST["allergies"], $_POST["activities"], $_POST["food"], $_POST["bday"]);
                if ($insert === false) {
                    $error_msg = "Error adding pet.";
                } else {
                    header("Location: ?command=userpage");
                    return;
                }
            }
        }
    }

    // I think we can combine this and the add function with an if statement that checks if the pet exists in the table?
    // function to edit information of pet
    private function editPetInfo() { 
      $user = [
          "username" => $_SESSION["username"],
          "email" => $_SESSION["email"]
      ];
      $userID = $this->db->query("select id from user where username = ?;", "s", $user["username"]);
      if ($userID === false) { // If there is an error:
          $error_msg = "Error occurred while editing pet info.";
      } else if (!empty($userID)) {
          $id = $userID[0]["id"];
          // Not sure if need to even check for post since html form has required, so they either input or not
          if (isset($_POST["ename"])) {

              $edit = $this->db->query(
                "update pet set name= ?, animal= ?, breed= ?, allergies= ?, activities= ?, food= ?, bday= ? where id = ?;",
                "sssssssi",
                $_POST["ename"] , $_POST["eanimal"], $_POST["ebreed"], $_POST["eallergies"], $_POST["eactivities"], $_POST["efood"], $_POST["ebday"], $_POST["petid"]);

              if ($edit === false) {
                  $error_msg = "Error editing pet info.";
              } else {
                  header("Location: ?command=userpage");
                  return;
              }
          }
      }

    }

    // Function to delete a pet
    private function deletePet() { 
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];

        if (isset($_POST["petid"])) {
            $delete = $this->db->query("DELETE FROM pet WHERE id = ?;", "i", $_POST["petid"]);
            if ($edit === false) {
                $error_msg = "Error deleting pet.";
            } else {
                header("Location: ?command=userpage");
                return;
            }
        }
    }

    // Export pets as .json file handler
    private function exportPets() { // Header code to force .json download from https://stackoverflow.com/a/11545741
        $user = [
            "username" => $_SESSION["username"],
            "email" => $_SESSION["email"]
        ];

        $userID = $this->db->query("select id from user where username = ?;", "s", $user["username"]);
        if ($userID === false) { // If there is an error:
            $load_msg = "Error occurred while loading pets.";
        } else if (!empty($userID)) {
            $id = $userID[0]["id"];
            // This loads the pets associated with the current user from the database
            $pets = $this->db->query("select * from pet where user_id = ?;", "i", $id);
            if ($pets === false) {
                $load_msg = "Error occurred while loading pets.";
            } else if (empty($pets)) { // If the user has no pets
                $load_msg = "You have not added any pets to your profile.";
            } else if (!empty($pets)) { // If the user does have pets, load their
                $petsJSON = json_encode($pets, JSON_PRETTY_PRINT);
            }
        }
        
        header('Content-disposition: attachment; filename=pets.json');
        header('Content-type: application/json');
        echo $petsJSON;
    }

}
