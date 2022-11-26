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

    function get_user_data($username=""){
        $sql = "SELECT * FROM users";
        if($username != ""){
            $sql = "SELECT * FROM users where username = '".$username."'";
        }
        $conDB = connect_db();
        $result = $conDB->query($sql);
        return $result;
    }

    if(!check_user_role()){
        header("Location: /login.php");
        die();
    }

    $data = get_user_data()
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
                    <h1 style="margin-bottom:0px">User Management</h1>
                    <p class="sub-title">All users</p>
                    <a href="/users_management/add.php">
                        <button class="button button-add" style="margin-bottom:10px">+ add new user</button>
                    </a>
                    <table class="data">
                        <tr>
                            <td>No.</td>
                            <td>Nama</td>
                            <td>Username</td>
                            <td>Role</td>
                            <td>Action</td>
                        </tr>
                        <?php 
                            $i = 1;
                            while ($row = $data->fetch_assoc()){ ?>
                            <tr>
                                <td style="width: 10%;"><?= $i ?></td>
                                <td style="width: 30%;"><?= $row["name"] ?></td>
                                <td style="width: 20%;"><?= $row["username"] ?></td>
                                <td style="width: 20%;"><?= $row["role"] ?></td>
                                <td style="width: auto;">
                                    <a href="/users_management/edit.php?id=<?= $row["id_users"] ?>">
                                        <button class="button button-edit">Edit</button>
                                    </a>
                                    <a href="#">
                                        <button class="button button-delete">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php $i++;} ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>