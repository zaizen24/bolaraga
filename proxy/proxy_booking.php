<?php
// proxy_booking.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

session_start();
if (!isset($_SESSION['ulogin'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$username = $_SESSION['ulogin'];
$url = 'http://localhost:5001/api/Booking/username/' . urlencode($username); // Menggunakan endpoint API yang benar

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(['error' => 'Request Error:' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_status == 404) {
    echo json_encode(['error' => 'No bookings found for the user']);
    exit;
}

if ($http_status != 200) {
    echo json_encode(['error' => 'Error fetching bookings']);
    exit;
}

echo $response;
?>
