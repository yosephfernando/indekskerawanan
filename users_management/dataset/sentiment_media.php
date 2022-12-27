<?php
require_once("../../DBconn.php");
error_reporting(E_ALL);

// /* Connect to a MySQL database using driver invocation */
// $dsn = 'mysql:dbname=ikpm;host=34.29.41.58;port=3307';
// $user = 'root';
// $password = 'iykratest';
$var_date = $_GET['tanggal'];
// try {
//     $dbh = new PDO($dsn, $user, $password);
// } catch (PDOException $e) {
//     echo 'Connection failed: ' . $e->getMessage();
// }

$sql = "SELECT content FROM `news` WHERE `date`LIKE '$var_date%'";
$conDB = connect_db();
$result = $conDB->query($sql);

// $sth = $dbh->prepare("SELECT content FROM `news` WHERE `date`LIKE '$var_date%'");
// $sth->execute();


$file = fopen("./kompas.csv", "w");

while ($row = $result->fetch_assoc()){
    fputcsv($file, $row);
}
// foreach ($sth as $line) {
//     fputcsv($file, $line);
// }
fclose($file);


$command = escapeshellcmd('python sentiment.py');
$output = shell_exec($command);
echo $output;

$file = new SplFileObject('rawan.txt');
$line = $file->fgets();

try{
    $stmt = $conDB->prepare("INSERT INTO `media` ( `media`, `kerawanan`,`tanggal`) VALUES (?,?,?)");
    $media = '01b-kompas';
    $lineFLoat = floatval($line);
    $stmt->bind_param(
        "sds", 
        $media,
        $lineFLoat, 
        $var_date
    );
    $stmt->execute();
    header("Location: /users_management/dataset/");
}catch(Exception $e){
    header("Location: /users_management/dataset?message=".$e->getMessage()."/");
}


// $sth = $dbh->prepare('INSERT INTO `media` ( `media`, `kerawanan`,`tanggal`) VALUES (?,?,?)');
// $sth->bindValue(1, '01b-kompas');
// $sth->bindValue(2, (float)$line, PDO::PARAM_STR);
// $sth->bindValue(3, $var_date);
// $sth->execute();

//header("refresh:5;url=index.php");
//echo "<script>alert('Data Sudah Tersimpan ke Database.');window.location='index.php';</script>";
