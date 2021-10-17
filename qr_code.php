<?php

if(!isset($_GET['name'])){
    die("Something went wrong");
}

$json_details = json_encode($_GET['name']);

$url = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$json_details."&choe=UTF-8";

$qr = file_get_contents($url);
header('Content-Type: image/jpeg');
echo $qr;
exit;

?>