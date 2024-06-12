<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passwordLama = $_POST['passwordLama'];
    $passwordBaru = $_POST['passwordBaru'];
    $konfirmasiPassword = $_POST['konfirmasiPassword'];

    $username = $_SESSION['ulogin'];

    // Log untuk memastikan username dan data yang dikirim ke API
    error_log("Username: " . $username);
    error_log("Data: " . json_encode($data));

    $data = [
        'Username' => $username,
        'OldPassword' => $passwordLama,
        'NewPassword' => $passwordBaru,
        'ConfirmPassword' => $konfirmasiPassword
    ];

    $url = 'http://localhost:5001/api/User/change-password';
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    error_log("Response: " . $response);
    error_log("HTTP Status: " . $http_status);

    echo "<script>console.log('Response: " . addslashes($response) . "');</script>";
    echo "<script>console.log('HTTP Status: " . $http_status . "');</script>";

    if ($http_status == 204) {
        echo '<script>alert("Password berhasil diubah.");</script>';
        echo '<script>window.location.href = "ubah_password.php";</script>';
    } elseif ($http_status == 400) {
        echo '<script>alert("Password baru dan konfirmasi password tidak cocok atau password lama salah.");</script>';
        echo '<script>window.location.href = "ubah_password.php";</script>';
    } elseif ($http_status == 404) {
        echo '<script>alert("User tidak ditemukan.");</script>';
        echo '<script>window.location.href = "ubah_password.php";</script>';
    } else {
        echo '<script>alert("Gagal mengubah password. Silakan coba lagi.");</script>';
        echo '<script>window.location.href = "ubah_password.php";</script>';
    }
}
?>
