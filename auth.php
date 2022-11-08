<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST["username"];
        $pass = $_POST["password"];
        if($username == "admin" && $pass == "admin123"){
            $_SESSION["username"] = $username;
            if(isset($_SESSION['username'])) {
                header("Location: /index.php");
                exit;
            }
        }else{
            if(!isset($_SESSION['username'])) {
                header("Location: /login.php");
                exit;
            }
        }
    }
?>