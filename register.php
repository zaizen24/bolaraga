<?php
require("koneksi.php");
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$nomor = $_POST["nomor"];

$sql = "INSERT INTO users (username, password, email, nomor)
        VALUES ('$username', '$password', '$email', '$nomor')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Pendaftaran Berhasil, Silahkan Melakukan Login');</script>";
    echo '<script>window.location.href = "index.php";</script>';
    exit();
} else {
    echo"Pendaftaran Gagal : ". mysqli_error($conn);
}