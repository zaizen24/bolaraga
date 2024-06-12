<?php
// proxy_jenis.php

// Atur header untuk mengizinkan CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// URL API Jenis
$url = 'http://localhost:5001/api/Jenis';

// Inisialisasi sesi cURL
$ch = curl_init($url);

// Atur opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi permintaan cURL dan ambil respons
$response = curl_exec($ch);

// Tutup sesi cURL
curl_close($ch);

// Output respons
echo $response;
?>
