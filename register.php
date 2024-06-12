<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $nomor = $_POST["nomor"];

    $data = [
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'nomor' => $nomor
    ];

    $url = 'http://localhost:5001/api/User/register'; // Sesuaikan dengan URL API register Anda
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_status == 201) {
        echo "<script>alert('Pendaftaran Berhasil, Silahkan Melakukan Login');</script>";
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        echo "<script>alert('Pendaftaran Gagal: $response');</script>";
    }
} else {
    echo "<script>alert('Invalid Request Method');</script>";
}
?>
