<?php
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai dari form
    $idLapangan = $_POST['idLapangan'];
    $namaLapangan = $_POST['namaLapangan'];
    $jenisLapangan = $_POST['jenisLapangan'];
    $harga = $_POST['harga'];

    // Proses file foto yang diunggah
    $fotoLapangan = $_FILES['fotoLapangan']['name'];
    $fotoLapangan_tmp = $_FILES['fotoLapangan']['tmp_name'];
    $fotoLapangan_path = "../assets/images/lapangan/" . $fotoLapangan; // Ganti "direktori_tujuan/" dengan direktori penyimpanan yang diinginkan
    $fotoLapangan_pathdb = "assets/images/lapangan/" . $fotoLapangan; // Ganti "direktori_tujuan/" dengan direktori penyimpanan yang diinginkan

    // Hapus foto lama jika ada
    $sql_get_foto = "SELECT foto FROM lapangan WHERE id_lap = '$idLapangan'";
    $result_get_foto = mysqli_query($conn, $sql_get_foto);
    $row_get_foto = mysqli_fetch_assoc($result_get_foto);
    $fotoLama = $row_get_foto['foto'];
    if ($fotoLama != "") {
        unlink("../" . $fotoLama); // Ganti "direktori_tujuan/" dengan direktori penyimpanan yang digunakan
    }

    // Pindahkan foto baru ke direktori penyimpanan
    move_uploaded_file($fotoLapangan_tmp, $fotoLapangan_path);

    // Proses update data di database
    $sql = "UPDATE lapangan SET nama_lap = '$namaLapangan', id_jenis = '$jenisLapangan', harga = '$harga', foto = '$fotoLapangan_pathdb' WHERE id_lap = '$idLapangan'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Data lapangan berhasil diperbarui.");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan: " . mysqli_error($conn)");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
    }
} else {
    echo '<script>alert("Metode tidak diizinkan.");</script>';
    echo '<script>window.location.href = "dashboard.php";</script>';
}
?>
