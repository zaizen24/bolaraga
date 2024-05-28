<?php
session_start();

include_once("koneksi.php"); // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang diinputkan pengguna
    $passwordLama = $_POST['passwordLama'];
    $passwordBaru = $_POST['passwordBaru'];
    $konfirmasiPassword = $_POST['konfirmasiPassword'];

    // Ambil username pengguna dari session
    $username = $_SESSION['ulogin'];

    // Query untuk mengambil password yang ada di database
    $sql = "SELECT password FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $savedPassword = $row['password'];

        // Cocokkan password lama yang dimasukkan pengguna dengan password di database
        if ($passwordLama === $savedPassword) {
            // Periksa apakah password baru dan konfirmasi password cocok
            if ($passwordBaru === $konfirmasiPassword) {
                // Update password baru ke dalam database
                $updateSql = "UPDATE users SET password='$passwordBaru' WHERE username='$username'";
                $updateResult = mysqli_query($conn, $updateSql);

                if ($updateResult) {
                    echo '<script>alert("Password berhasil diubah.");</script>';
                    echo '<script>window.location.href = "ubah_password.php";</script>';
                } else {
                    echo '<script>alert("Gagal mengubah password. Silakan coba lagi.");</script>';
                    echo '<script>window.location.href = "ubah_password.php";</script>';
                }
            } else {
                echo '<script>alert("Password baru dan konfirmasi password tidak cocok.");</script>';
                echo '<script>window.location.href = "ubah_password.php";</script>';
            }
        } else {
            echo '<script>alert("Password lama yang Anda masukkan tidak cocok.");</script>';
            echo '<script>window.location.href = "ubah_password.php";</script>';
        }
    } else {
        echo '<script>alert("Gagal mengambil data pengguna");</script>';
        echo '<script>window.location.href = "ubah_password.php";</script>';
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>
