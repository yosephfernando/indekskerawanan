<?php 
    require_once("../../DBconn.php");
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

    function get_media(){
        $sql = "SELECT * FROM media ORDER BY tanggal DESC";
        $conDB = connect_db();
        $result = $conDB->query($sql);
        return $result;
    }

    if(!check_user_role()){
        header("Location: /login.php");
        die();
    }

    if(!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }

    $data = get_media();
    $number_of_result = mysqli_num_rows($data);
    $results_per_page = 10;
    $page_first_result = ($page-1)*$results_per_page;
    //determine the total number of pages available  
    $number_of_page = ceil($number_of_result/$results_per_page);
    $query = "SELECT * FROM media ORDER BY tanggal DESC LIMIT ".$page_first_result.','.$results_per_page;
    $result = mysqli_query(connect_db(), $query);
    //  //display the retrieved result on the webpage  
    // while($row = mysqli_fetch_array($result)) {
    //     echo $row['id'].''.$row['alphabet'].'</br>';
    // }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>INDEKS KERAWANAN PEMBERITAAN MEDIA</title>
        <link rel="stylesheet" href="../../index.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <?php include_once("../../templates/header.php"); ?>
        <div class="container">
            <div class="row">
                <?php include_once("../../templates/sidemenu.php"); ?>
                <div style="width:100%">
                    <h1 style="margin-bottom:0px">Dataset Management</h1>
                    <p class="sub-title">ANALISA SENTIMEN MEDIA</p>
                    <p class="sub-title" style="color: red"><?= (isset($_GET["message"]) ? $_GET["message"]:"") ?><p>
                    <form action="sentiment_media.php">
						Tanggal Proses : <input type="date" value="<?php echo date("Y-m-d"); ?>" name="tanggal">
						<input type="submit">
					</form>
                    <table class="data" style="margin-top: 10px">
                        <tr>
                            <td>No.</td>
                            <td>Media</td>
                            <td>Kerawanan</td>
                            <td>Tanggal</td>
                        </tr>
                        <?php 
                            $i = 1;
                            while($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td style="width: 10%;"><?= ($page - 1) * 10 + $i; ?></td>
                                <td style="width: 30%;"><?= $row["media"] ?></td>
                                <td style="width: 20%;"><?= $row["kerawanan"] ?></td>
                                <td style="width: 20%;"><?= $row["tanggal"] ?></td>
                            </tr>
                        <?php $i++;} ?>
                    </table>
                    <div class="pagination">
                        <a href="#">&laquo;</a>
                        <?php 
                            for($page = 1;$page<=$number_of_page;$page++){
                                echo'<a class="'.(isset($_GET["page"]) && $page == $_GET["page"] ? 'active':'').'" href="/users_management/dataset?page='.$page.'">'.$page.'</a>';
                            }
                        ?>
                        <a href="#">&raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>