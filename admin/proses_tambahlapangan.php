<?php
session_start();
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaLapangan = $_POST["namaLapangan"];
    $jenisLapangan = $_POST["jenisLapangan"];
    $harga = $_POST["harga"];
    $fotoLapangan = $_FILES["fotoLapangan"]["name"];
    $targetFolder = "../assets/images/lapangan/";

    // Memindahkan file yang diunggah ke direktori yang ditentukan
    if (move_uploaded_file($_FILES["fotoLapangan"]["tmp_name"], $targetFolder . $fotoLapangan)) {
        // Menggunakan $targetFolder dan $fotoLapangan untuk menyimpan jalur lengkap file
        $fotoPath = "assets/images/lapangan/" . $fotoLapangan;

        // Data yang akan dikirim ke API
        $data = [
            'nama_lap' => $namaLapangan,
            'harga' => $harga,
            'foto' => $fotoPath,
            'id_jenis' => $jenisLapangan
        ];

        // URL endpoint API
        $url = 'http://localhost:5001/api/Lapangan';

        // Inisiasi cURL
        $ch = curl_init($url);

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Eksekusi cURL dan dapatkan respons
        $response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Cek status respons dan tampilkan pesan sesuai
        if ($http_status == 201) {
            echo '<script>alert("Data lapangan berhasil ditambahkan.");</script>';
            echo '<script>window.location.href = "dashboard.php";</script>';
        } else {
            echo '<script>alert("Gagal menambahkan data lapangan.");</script>';
            echo '<script>window.location.href = "dashboard.php";</script>';
        }
    } else {
        echo '<script>alert("Gagal mengunggah file.");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
    }
}
