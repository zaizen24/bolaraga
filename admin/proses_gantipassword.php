<?php
session_start();
include_once("koneksi.php");

// Ambil data yang dikirim dari form
$passwordLama = $_POST['passwordLama'];
$passwordBaru = $_POST['passwordBaru'];
$konfirmasiPassword = $_POST['konfirmasiPassword'];

// Ambil username admin dari session
$usernameAdmin = $_SESSION['alogin'];

// Data untuk dikirim ke API
$data = [
    'Username' => $usernameAdmin,
    'OldPassword' => $passwordLama,
    'NewPassword' => $passwordBaru,
    'ConfirmNewPassword' => $konfirmasiPassword
];

$ch = curl_init('http://localhost:5001/api/Admin/ChangePassword');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($data))
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($httpCode == 200) {
    echo '<script>alert("Password berhasil diubah.");</script>';
    echo '<script>window.location.href = "ganti_password.php";</script>';
} else {
    $responseMessage = json_decode($response, true)['message'];
    echo '<script>alert("Gagal mengubah password: ' . $responseMessage . '");</script>';
    echo '<script>window.location.href = "ganti_password.php";</script>';
}
?>
