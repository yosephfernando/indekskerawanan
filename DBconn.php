<?php
    function connect_db(){
        $mysqli = new mysqli("localhost","root","IKPMsql123!","ikpm", "3306");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        return $mysqli;
    }