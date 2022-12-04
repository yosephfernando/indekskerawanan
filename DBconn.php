<?php
    function connect_db(){
        $mysqli = new mysqli("34.28.119.212","root","iykratest","ikpm", "3306");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        return $mysqli;
    }