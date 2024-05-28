<?php
include("koneksi.php");
session_start();
if(isset($_SESSION['ulogin']) && isset($_POST['nama_lapangan']) && isset($_POST['nomor_lapangan']) && isset($_POST['tanggal_main']) && isset($_POST['jam_main']) && isset($_POST['durasi']) && isset($_POST['metode_pembayaran'])) {
    $nama_lapangan = $_POST['nama_lapangan'];
    $nomor_lapangan = $_POST['nomor_lapangan'];
    $tanggal_main = $_POST['tanggal_main'];
    $jam_main = $_POST['jam_main'];
    $durasi = $_POST['durasi'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $username = $_SESSION['ulogin']; // Mengambil username dari session

    // Lakukan pengecekan apakah waktu yang dipilih sudah dipesan
    $sql_check_booking = "SELECT * FROM booking WHERE id_lap != $nomor_lapangan AND tanggal_main = '$tanggal_main' AND jam_main = '$jam_main'";
    $result_check_booking = mysqli_query($conn, $sql_check_booking);

    if(mysqli_num_rows($result_check_booking) > 0) {
        // Jika ada booking pada waktu yang sama, beri pesan error atau lakukan tindakan lain
        echo '<script>alert("Maaf, waktu yang Anda pilih sudah dipesan. Silakan pilih waktu lain.");</script>';
        echo '<script>window.location.href = "pemesanan.php";</script>';
        exit;
    } else {
        // Lanjutkan dengan proses pemesanan jika waktu tersedia
        $sql_insert_booking = "INSERT INTO booking (id_lap, nama_lap, tanggal_main, jam_main, durasi, metode_pembayaran, username) VALUES ($nomor_lapangan, '$nama_lapangan', '$tanggal_main', '$jam_main', $durasi, '$metode_pembayaran', '$username')";
        if(mysqli_query($conn, $sql_insert_booking)) {
            // Jika berhasil melakukan pemesanan, tampilkan pesan sukses atau lakukan tindakan lain
            echo '<script>alert("Pemesanan berhasil!");</script>';
            echo '<script>window.location.href = "index.php";</script>';
            exit;
        } else {
            // Jika terjadi kesalahan dalam pemesanan, tampilkan pesan error atau lakukan tindakan lain
            echo '<script>alert("Terjadi kesalahan dalam pemesanan. Silakan coba lagi.");</script>';
            echo '<script>window.location.href = "pemesanan.php";</script>';
            exit;
        }
    }

} else {
    header("Location: index.php");
    exit;
}
?>