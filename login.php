<!DOCTYPE HTML>
<html>
    <head>
        <title>LOGIN</title>
        <link rel="stylesheet" href="./index.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body style="background-color: #2e2c2c">
        <div class="container">
            <div class="row" style="justify-content: center;height: 100vh;align-items: center;flex-direction: column">
                <h2>INDEKS KERAWANAN <br />PEMBERITAAN MEDIA</h2>
                <form method="POST" action="/auth.php" class="form-login">
                    <div class="form-group">
                        <label>Username :</label>
                        <input type="text" name="username" class="form-text" />
                    </div>
                    <div class="form-group">
                        <label>Password :</label>
                        <input type="password" name="password" class="form-text"/>
                    </div>
                    <div style="text-align:center">
                        <input class="button-red" type="submit" value="Sign in"/>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>