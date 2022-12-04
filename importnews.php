<?php 
require 'vendor/autoload.php';
require_once("./DBconn.php");
error_reporting(0);
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$reader->setReadDataOnly(true);
$file_name = $_GET["name"];
$sheet = $_GET["sheet"];
var_dump($file_name);
var_dump($sheet);
$reader->setLoadSheetsOnly([$sheet]);
$spreadsheet = $reader->load("dataset/Data-2022-11-02/".$file_name);
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();
$data = [];
foreach($rows as $item){
    $data[] = [
        "date" => $item[0],
        "media" => $item[1],
        "category_gatra" => $item[2],
        "sub_category" => $item[3],
        "headline" => $item[4]
    ];
}

function formatDate($dateint){
    $split = str_split($dateint);
    $year = $split[0].$split[1].$split[2].$split[3];
    $month = $split[4].$split[5];
    $date = $split[6].$split[7];
    $time = $split[8].$split[9].":".$split[10].$split[11];
    return $year."-".$month."-".$date."-".$time;
}

function insert_news_data($params){
    $conDB = connect_db();
    $stmt = $conDB->prepare("INSERT INTO news (date, media, category_gatra, sub_category, headline) VALUES (?, ?, ?, ?, ?)");
    var_dump(formatDate($params["date"]));
    $stmt->bind_param(
        "sssss", 
        formatDate($params["date"]),
        $params["media"], 
        $params["category_gatra"],
        $params["sub_category"],
        $params["headline"]
    );
    $stmt->execute();
    $result = "New records created successfully";
    $stmt->close();
    $conDB->close();
    return $result;
}
unset($data[0]);
foreach($data as $item){
    insert_news_data($item);
    $message = "Inserted ".$item["headline"];
    ob_start();
    print($message);
    error_log(ob_get_clean(), 4);
}

echo "success insert";
?>