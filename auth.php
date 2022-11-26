<?php
    session_start();
    require_once("./DBconn.php");

    function check_user($params){
        $sql = "SELECT username, role, name, password FROM users WHERE username=?";
        $conDB = connect_db();
        $stmt = $conDB->prepare($sql);
        $stmt->bind_param("s", $params["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc() ?? false;

        if($user){
            if(auth_user($user["password"], $params["password"])){
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];
                return true;
            }
        }

        $stmt->close();
        $conDB->close();

        return $user;
    }

    function auth_user($pass_from_db, $pass_from_login){
        $result = password_verify($pass_from_login, $pass_from_db);
        return $result;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(check_user($_REQUEST)){
            if(isset($_SESSION['username'])) {
                header("Location: /index.php");
                exit;
            }
        }else{
            header("Location: /login.php");
            exit;
        }
    }
?>