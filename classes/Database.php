<?php

// The code in this file was adapted from the Day 17 lecture.

class Database {
    private $mysqli;

    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->mysqli = new mysqli(Config::$db["host"], Config::$db["user"],
                                   Config::$db["pass"], Config::$db["database"]);
    }

    /*
    * This function allows for shorthand of interacting with the database. 
    */
    public function query($query, $bparam=null, ...$params) {
        $stmt = $this->mysqli->prepare($query);

        if ($bparam != null) {
            $stmt->bind_param($bparam, ...$params);
        }
        if (!$stmt->execute()) {
            return false;
        }
        if (($result = $stmt->get_result()) !== false) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } 

        return true;
    }
}