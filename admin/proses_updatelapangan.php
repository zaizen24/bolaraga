<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLapangan = $_POST['idLapangan'];
    $namaLapangan = $_POST['namaLapangan'];
    $jenisLapangan = $_POST['jenisLapangan'];
    $harga = $_POST['harga'];

    // Proses file foto yang diunggah
    $fotoLapangan = $_FILES['fotoLapangan']['name'];
    $fotoLapangan_tmp = $_FILES['fotoLapangan']['tmp_name'];
    $fotoLapangan_path = "../assets/images/lapangan/" . $fotoLapangan;
    $fotoLapangan_pathdb = "assets/images/lapangan/" . $fotoLapangan;

    move_uploaded_file($fotoLapangan_tmp, $fotoLapangan_path);

    $lapanganData = [
        "id_lap" => $idLapangan,
        "nama_lap" => $namaLapangan,
        "id_jenis" => $jenisLapangan,
        "harga" => $harga,
        "foto" => $fotoLapangan_pathdb
    ];

    $jsonLapanganData = json_encode($lapanganData);

    $ch = curl_init('http://localhost:5001/api/Lapangan');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonLapanganData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonLapanganData))
    );

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch); // Tambahan untuk menangkap kesalahan curl
    curl_close($ch);

    // Menampilkan respon dan kode status untuk debugging
    if ($httpCode == 200 || $httpCode == 201 || $httpCode == 204) {
        echo "Data lapangan berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui data lapangan. Kode HTTP: $httpCode. Respon: $response. Curl Error: $curlError";
    }
}
?>
