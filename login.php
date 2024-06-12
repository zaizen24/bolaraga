<?php
session_start();

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // Data untuk dikirim ke API
    $data = [
        'Username' => $username,
        'Password' => $password
    ];

    // URL API
    $apiUrl = 'http://localhost:5001/api/User/login';

    // Inisialisasi cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Eksekusi permintaan dan ambil respons
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    // // Log data untuk debugging
    // file_put_contents('debug.log', "Request: " . json_encode($data) . "\nResponse: " . $response . "\nHTTP Code: " . $httpCode . "\nCurl Error: " . $curlError . "\n", FILE_APPEND);

    // Proses respons
    if ($httpCode == 200) {
        $user = json_decode($response, true);
        $_SESSION['ulogin'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Username atau Password Salah!');</script>";
        echo '<script>window.location.href = "index.php";</script>';
    }
}

if (isset($_POST['logout'])) {
    // Hapus semua session
    session_unset();
    // Hapus session data dari server
    session_destroy();
    // Redirect ke halaman lain atau ke halaman yang sama
    header("Location: index.php"); // Ganti index.php dengan halaman yang diinginkan setelah logout
    exit();
}
?>
