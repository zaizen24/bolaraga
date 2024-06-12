<?php
// proxy.php

// Atur header untuk mengizinkan CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Teruskan permintaan ke API sebenarnya
$url = 'http://localhost:5001/api/Lapangan';
$response = file_get_contents($url);

// Output respons
echo $response;
?>
