<?php
session_start();
if(!$_SESSION["username"]){
    header("Location: /login.php");
    die();
}

$xml=simplexml_load_file("https://news.google.com/rss/search?q=indonesia&hl=id&gl=ID&ceid=ID:id");
$arrayG = json_decode(json_encode((array)$xml), TRUE);
// echo '<pre>' . var_export($arrayG["channel"]["item"], true) . '</pre>';die();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>INDEKS KERAWANAN PEMBERITAAN MEDIA</title>
        <link rel="stylesheet" href="./index.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <?php include_once("./templates/header.php"); ?>
        <div class="container">
            <div class="row">
                <?php include_once("./templates/sidemenu.php"); ?>
                <div style="padding-left: 10px;">
                    <ul class="news">
                        <?php
                            $i = 0;
                            foreach($arrayG["channel"]["item"] as $value):
                                if (++$i == 10) break;
                        ?>
                            <li>
                                <a href="<?= $value["link"]; ?>" style="text-decoration: none">
                                    <div>
                                        <div class="news-source">
                                            <b><?= $value["title"]; ?></b>
                                        </div>
                                        <p><?= $value["description"]; ?></p>
                                        <p class="news-date"><?= $value["pubDate"]; ?></p>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>