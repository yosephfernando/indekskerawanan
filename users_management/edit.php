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

    function update_user_data($params){
        $conDB = connect_db();

        $pass_hash = password_hash($params["password"], PASSWORD_BCRYPT);
        
        if($params["password"] != ""){
            $stmt = $conDB->prepare("UPDATE users SET name=?,  username=?, role=?, password=? WHERE id_users=?");
            $stmt->bind_param(
                "ssssi", 
                $params["name"], 
                $params["username"], 
                $params["role"], 
                $pass_hash,
                $params["id_users"]
            );
        }else{
            $stmt = $conDB->prepare("UPDATE users SET name=?, username=?, role=? WHERE id_users=?");
            $stmt->bind_param(
                "sssi", 
                $params["name"], 
                $params["username"], 
                $params["role"],
                $params["id_users"]
            );
        }

        
        $stmt->execute();
        $result = "Update records successfully";
        $stmt->close();
        $conDB->close();
        return $result;
    }

    function get_user_data($id){
        $conDB = connect_db();
        $stmt = $conDB->prepare("SELECT * FROM users WHERE id_users=?");
        $stmt->bind_param(
            "i",
            $id
        );
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc() ?? false;
        $stmt->close();
        $conDB->close();

        return $user;
    }

    if(!check_user_role()){
        header("Location: /login.php");
        die();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $params = $_REQUEST;
        update_user_data($params);
        header("Location: /users_management");
        die();
    }

    $user_data = get_user_data($_GET["id"])
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
                    <p class="sub-title">Update user</p>
                    <form method="post" action="/users_management/edit.php" class="form-login" style="background-color: #2e2c2c;padding: 10px">
                        <input type="hidden" name="id_users" class="form-text" value="<?= $user_data["id_users"] ?>" />
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-text" value="<?= $user_data["name"] ?>" />
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-text" value="<?= $user_data["username"] ?>" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-text" />
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-text" name="role">
                                <?php if($user_data["role"] == "admin"){ ?>
                                    <option value="admin" selected>Admin</option>
                                <?php }else{ ?>
                                    <option value="user" selected>User</option>
                                <?php } ?>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button class="button button-add" style="width:100px">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>