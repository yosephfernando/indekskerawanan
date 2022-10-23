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
        ));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

    $get_data = callAPI('GET', 'https://newsapi.org/v2/everything?q=politik%20indonesia&sortBy=date&apiKey=c4827bfd4a7044a9867995cdd6c51fef', false);
    $response = json_decode($get_data, true);
    var_dump($response)
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
        <div class="row header">
            <h3>INDEKS KERAWANAN PEMBERITAAN MEDIA</h3>
            <div style="font-size: x-large;display: flex;align-items: center;color:#fff;margin-right: 5px;">
                <img style="width: 50px;margin-right:5px" src="./id.png" />
                <i class="fa-solid fa-circle-user"></i>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div style="padding-right: 10px;width: 20%">
                    <ul class="naviagation">
                        <li class="active"><i class="fa-solid fa-house"></i> Home</li>
                        <li><i class="fa-solid fa-gauge-high"></i> Dashboard</li>
                        <li><i class="fa-regular fa-clock"></i> Timeline</li>
                        <li><i class="fa-solid fa-gauge-high"></i> IKPM - Gatra</li>
                        <li><i class="fa-solid fa-gauge-high"></i> IKPM - Provinsi</li>
                        <li><i class="fa-solid fa-gauge-high"></i> IKPM - Media</li>
                        <li><i class="fa-solid fa-heart"></i> Sentiment</li>
                        <li><i class="fa-solid fa-map-location-dot"></i> Maps</li>
                        <li><i class="fa-solid fa-fire"></i> Top Issues</li>
                        <li><i class="fa-solid fa-star"></i> Trending Issue</li>
                        <li><i class="fa-solid fa-chart-column"></i> Report</li>
                    </ul>
                </div>
                <div>
                    <iframe width="700" height="1099" src="https://datastudio.google.com/embed/reporting/743386ec-5c63-4bac-8bb9-7ecbc92aa8b8/page/fQq5C" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div style="padding-left: 10px;">
                    <ul class="news">
                        <?php foreach($data as $item): ?>
                            <li>
                                <div>
                                    <img src="<?= $item["urlToImage"]; ?>" />
                                </div>
                                <div>
                                    <div class="news-source">
                                        <b><?= $item["source"]["name"]; ?></b>
                                        <p>4 jam lalu</p>
                                    </div>
                                    <p><?= $item["description"]; ?></p>
                                    <p class="news-date"><?= $item["publishedAt"]; ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>