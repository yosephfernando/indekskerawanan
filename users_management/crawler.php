<?php 
    require_once("../DBconn.php");
    error_reporting(E_ALL);
    session_start();
    function check_user_role(){
        if (
            (isset($_SESSION["username"]) && isset($_SESSION["role"]))
            && $_SESSION["role"] == "admin"
        ){
            return true;
        }
        return false;
    }

    if(!check_user_role()){
        header("Location: /login.php");
        die();
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>INDEKS KERAWANAN PEMBERITAAN MEDIA</title>
        <link rel="stylesheet" href="../index.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <?php include_once("../templates/header.php"); ?>
        <div class="container">
            <div class="row">
                <?php include_once("../templates/sidemenu.php"); ?>
                <div style="width:100%">
                    <h1 style="margin-bottom:0px">Crawler Management</h1>
                    <p class="sub-title">History</p>
                </div>
            </div>
        </div>
    </body>
</html>