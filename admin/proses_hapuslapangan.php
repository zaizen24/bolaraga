<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idLapangan'])) {
    $idLapangan = $_POST['idLapangan'];

    // Dapatkan path foto dari database sebelum menghapus data melalui API
    include_once("koneksi.php");
    $sql_select_foto = "SELECT foto FROM lapangan WHERE id_lap = ?";
    $stmt_select_foto = $conn->prepare($sql_select_foto);
    $stmt_select_foto->bind_param("i", $idLapangan);
    $stmt_select_foto->execute();
    $stmt_select_foto->store_result();

    if ($stmt_select_foto->num_rows > 0) {
        $stmt_select_foto->bind_result($fotoPath);
        $stmt_select_foto->fetch();
        $stmt_select_foto->close();

        // Kirim permintaan DELETE ke API
        $ch = curl_init('http://localhost:5001/api/Lapangan/' . $idLapangan);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($httpCode == 204) {
            // Hapus foto dari folder jika API berhasil menghapus data lapangan
            $fixfotoPath = "../" . $fotoPath;
            if (file_exists($fixfotoPath) && unlink($fixfotoPath)) {
                echo '<script>alert("Berhasil menghapus data lapangan dan fotonya.");</script>';
            } else {
                echo '<script>alert("Berhasil menghapus data lapangan, tetapi gagal menghapus foto.");</script>';
            }
            echo '<script>window.location.href = "dashboard.php";</script>';
        } else {
            echo "Gagal menghapus data lapangan. Kode HTTP: $httpCode. Respon: $response. Curl Error: $curlError";
        }
    } else {
        echo "Data lapangan tidak ditemukan.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
