<?php
    function connect_db(){
        $mysqli = new mysqli("us-cdbr-east-06.cleardb.net","bc9152c7f0e9e1","f0b09be8","heroku_7b51eb645d01297", "3306");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        return $mysqli;
    }