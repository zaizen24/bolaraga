<?php
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
        // Insert data ke dalam tabel lapangan dengan menyimpan jalur file
        $sql = "INSERT INTO lapangan (nama_lap, harga, foto, id_jenis) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $namaLapangan, $harga, $fotoPath, $jenisLapangan); // Menggunakan $fotoPath
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo '<script>alert("Data lapangan berhasil ditambahkan.");</script>';
            echo '<script>window.location.href = "dashboard.php";</script>';
        } else {
            echo '<script>alert("Gagal menambahkan data lapangan.");</script>';
            echo '<script>window.location.href = "dashboard.php";</script>';
        }
        $stmt->close();
    } else {
        echo '<script>alert("Gagal mengunggah file.");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
    }
}

