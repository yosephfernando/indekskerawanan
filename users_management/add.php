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

    function insert_user_data($params){
        $conDB = connect_db();
        $pass_hash = password_hash($params["password"], PASSWORD_BCRYPT);
        $stmt = $conDB->prepare("INSERT INTO users (name, username, role, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss", 
            $params["name"],
            $params["username"], 
            $params["role"], 
            $pass_hash
        );
        $stmt->execute();
        $result = "New records created successfully";
        $stmt->close();
        $conDB->close();
        return $result;
    }

    if(!check_user_role()){
        header("Location: /login.php");
        die();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $params = $_REQUEST;
        insert_user_data($params);
        header("Location: /users_management");
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
                    <h1 style="margin-bottom:0px">User Management</h1>
                    <p class="sub-title">Add new user</p>
                    <form method="post" action="/users_management/add.php" class="form-login" style="background-color: #2e2c2c;padding: 10px">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-text" />
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-text" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-text" />
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-text" name="role">
                                <option value="">-- pilih role --</option>
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