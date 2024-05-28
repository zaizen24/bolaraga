<?php
session_start();
// Pastikan koneksi ke database sudah dilakukan
include_once("koneksi.php"); // Menghubungkan ke database

// Ambil data yang dikirim dari form
$passwordLama = $_POST['passwordLama'];
$passwordBaru = $_POST['passwordBaru'];
$konfirmasiPassword = $_POST['konfirmasiPassword'];

// Ambil username admin dari session atau form (sesuaikan dengan cara login admin)
$usernameAdmin = $_SESSION['alogin'];

// Query untuk mengambil password admin dari database
$sql = "SELECT password FROM admin WHERE username='$usernameAdmin'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $savedPassword = $row['password'];

    // Cocokkan password lama yang dimasukkan admin dengan password di database
    if ($passwordLama === $savedPassword) {
        // Periksa apakah password baru dan konfirmasi password cocok
        if ($passwordBaru === $konfirmasiPassword) {
            // Update password baru ke dalam database
            $updateSql = "UPDATE admin SET password='$passwordBaru' WHERE username='$usernameAdmin'";
            $updateResult = mysqli_query($conn, $updateSql);

            if ($updateResult) {
                echo '<script>alert("Password berhasil diubah.");</script>';
                echo '<script>window.location.href = "ganti_password.php";</script>';
            } else {
                echo '<script>alert("Gagal mengubah password. Silakan coba lagi.");</script>';
                echo '<script>window.location.href = "ganti_password.php";</script>';
            }
        } else {
            echo '<script>alert("Password baru dan konfirmasi password tidak cocok.");</script>';
            echo '<script>window.location.href = "ganti_password.php";</script>';
        }
    } else {
        echo '<script>alert("Password lama yang Anda masukkan tidak cocok.");</script>';
        echo '<script>window.location.href = "ganti_password.php";</script>';
    }
} else {
    echo '<script>alert("Gagal mengambil data admin");</script>';
    echo '<script>window.location.href = "ganti_password.php";</script>';
}

// Tutup koneksi database
mysqli_close($conn);
?>
