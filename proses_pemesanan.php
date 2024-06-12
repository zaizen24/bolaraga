<?php
session_start();
if (!isset($_SESSION['ulogin'])) {
    echo '<script>alert("Anda harus login terlebih dahulu untuk mengakses halaman ini.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lapangan = $_POST["nama_lapangan"];
    $nomor_lapangan = $_POST["nomor_lapangan"];
    $harga_per_jam = $_POST["harga_per_jam"];
    $metode_pembayaran = $_POST["metode_pembayaran"];
    $tanggal_main = $_POST["tanggal_main"];
    $jam_main = $_POST["jam_main"];
    $durasi = $_POST["durasi"];
    $total_harga = $_POST["total_harga"];
    $username = $_SESSION['ulogin'];

    // Convert jam_main to a valid TimeSpan format (HH:MM:SS)
    $jam_main = date("H:i:s", strtotime($jam_main));

    $data = [
        'nama_lap' => $nama_lapangan,
        'id_lap' => $nomor_lapangan,
        'harga' => $harga_per_jam,
        'metode_pembayaran' => $metode_pembayaran,
        'tanggal_main' => $tanggal_main,
        'jam_main' => $jam_main,
        'durasi' => $durasi,
        'total_harga' => $total_harga,
        'username' => $username
    ];

    $url = 'http://localhost:5001/api/Booking';
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "<script>console.log('Response: " . addslashes($response) . "');</script>";
    echo "<script>console.log('HTTP Status: " . $http_status . "');</script>";

    if ($http_status == 201 || $http_status == 200) {
        echo "<script>alert('Pemesanan Berhasil');</script>";
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        echo "<script>alert('Pemesanan Gagal: " . addslashes($response) . "');</script>";
    }
} else {
    echo "<script>alert('Invalid Request Method');</script>";
}
?>
