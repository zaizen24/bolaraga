<?php
include("koneksi.php");
session_start();

if(isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Pastikan password yang dimasukkan sesuai dengan yang tersimpan di database
        if($password === $row['password']) { // Verifikasi tanpa hash, gunakan dengan hati-hati
            $_SESSION['ulogin'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Username atau Password Salah!');</script>";
            echo '<script>window.location.href = "index.php";</script>';
        }
    } else {
        echo "<script>alert('Username atau Password Salah!');</script>";
        echo '<script>window.location.href = "index.php";</script>';

    }
}

if(isset($_POST['logout'])) {
    // Hapus semua session
    session_unset();
    // Hapus session data dari server
    session_destroy();
    // Redirect ke halaman lain atau ke halaman yang sama
    header("Location: index.php"); // Ganti index.php dengan halaman yang diinginkan setelah logout
    exit();
}
?>
