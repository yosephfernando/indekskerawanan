<?php
    function connect_db(){
        $mysqli = new mysqli("host","user","pass","db", "port");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        return $mysqli;
    }