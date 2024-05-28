<?php
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idLapangan'])) {
    $idLapangan = $_POST['idLapangan'];

    // Dapatkan path foto dari database sebelum menghapus data
    $sql_select_foto = "SELECT foto FROM lapangan WHERE id_lap = ?";
    $stmt_select_foto = $conn->prepare($sql_select_foto);
    $stmt_select_foto->bind_param("i", $idLapangan);
    $stmt_select_foto->execute();
    $stmt_select_foto->store_result();

    if ($stmt_select_foto->num_rows > 0) {
        $stmt_select_foto->bind_result($fotoPath);
        $stmt_select_foto->fetch();

        $fixfotoPath = "../" . $fotoPath;
        // Hapus foto dari folder
        if (unlink($fixfotoPath)) {
            // Hapus data lapangan dari database
            $sql_delete_lapangan = "DELETE FROM lapangan WHERE id_lap = ?";
            $stmt_delete_lapangan = $conn->prepare($sql_delete_lapangan);
            $stmt_delete_lapangan->bind_param("i", $idLapangan);
            $stmt_delete_lapangan->execute();

            if ($stmt_delete_lapangan->affected_rows > 0) {
                // Jika berhasil dihapus, arahkan kembali ke halaman terkait
                echo '<script>alert("Berhasil menghapus data lapangan.");</script>';
                echo '<script>window.location.href = "dashboard.php";</script>';
            } else {
                // Jika gagal hapus, tampilkan pesan kesalahan
                echo '<script>alert("Gagal menghapus data lapangan.");</script>';
                echo '<script>window.location.href = "dashboard.php";</script>';
            }
            $stmt_delete_lapangan->close();
        } else {
            echo "Gagal menghapus foto.";
        }
    } else {
        echo "Data lapangan tidak ditemukan.";
    }

    $stmt_select_foto->close();
} else {
    echo "Permintaan tidak valid.";
}
?>
