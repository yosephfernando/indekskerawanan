<?php
    function callAPI($method, $url, $data){
        $curl = curl_init();
        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'Content-Type: application/json',
           'User-Agent: '.$_SERVER['HTTP_USER_AGENT']
        ));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    $get_data = callAPI('GET', 'https://newsapi.org/v2/everything?q=politik%20indonesia&sortBy=date&apiKey=c4827bfd4a7044a9867995cdd6c51fef', false);
    $response = json_decode($get_data, true);
    $data = $response['articles'];
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
                <div>
                    <iframe width="900" height="1099" src="https://datastudio.google.com/embed/reporting/3c7af7d0-ad70-4892-bef4-8b50c60ad48c/page/fQq5C" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <!-- <div style="padding-left: 10px;">
                    <ul class="news">
                        <?php
                            $i = 0;
                            foreach($data as $item):
                                if (++$i == 10) break;
                        ?>
                            <li>
                                <div>
                                    <img src="<?= $item["urlToImage"]; ?>" />
                                </div>
                                <div>
                                    <div class="news-source">
                                        <b><?= $item["source"]["name"]; ?></b>
                                        <p><?= time_elapsed_string($item["publishedAt"]); ?></p>
                                    </div>
                                    <p><?= $item["description"]; ?></p>
                                    <p class="news-date"><?= date("F jS, Y", strtotime($item["publishedAt"])); ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div> -->
            </div>
        </div>
    </body>
</html>