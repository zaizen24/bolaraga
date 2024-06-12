<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Sport</title>
    <link rel="icon" href="assets/images/logo.png" type="image">
    <link rel="stylesheet" href="assets/css/stylepemesanan.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<?php include_once("header.php"); ?>

<?php
session_start();
if (!isset($_SESSION['ulogin'])) {
    echo '<script>alert("Anda harus login terlebih dahulu untuk mengakses halaman ini.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}

if (isset($_GET['id_lap'])) {
    $lapangan_id = $_GET['id_lap'];
    $apiUrl = "http://localhost:5001/api/Lapangan/$lapangan_id";

    // Inisialisasi cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    // Eksekusi permintaan dan ambil respons
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($httpCode == 200) {
        $row = json_decode($response, true);
?>

<div class="container">
    <h1>Form Pemesanan Lapangan Badminton</h1>
    <form action="proses_pemesanan.php" method="POST">
        <div class="form-group">
            <label for="nama_lapangan">Nama Lapangan:</label>
            <input type="text" id="nama_lapangan" name="nama_lapangan" value="<?= $row['nama_lap'] ?>" readonly>
        </div>
        
        <div class="form-group">
            <label for="nomor_lapangan">ID Lapangan:</label>
            <select id="nomor_lapangan" name="nomor_lapangan">
                <option value="<?= $row["id_lap"] ?>"><?= $row["id_lap"] ?></option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="harga_per_jam">Harga Per Jam:</label>
            <input type="number" id="harga_per_jam" name="harga_per_jam" value="<?= $row["harga"] ?>" readonly>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <label><input type="radio" name="metode_pembayaran" value="COD" required> COD</label>
        </div>

        <div class="form-group">
            <label for="tanggal_main">Tanggal Main:</label>
            <input type="date" id="tanggal_main" name="tanggal_main" required>
        </div>

        <div class="form-group">
            <label for="jam_main">Jam Main:</label>
            <input type="time" id="jam_main" name="jam_main" required>
        </div>

        <div class="form-group">
            <label for="durasi">Durasi (jam):</label>
            <input type="number" id="durasi" name="durasi" min="1" required>
        </div>

        <div class="form-group">
            <label for="total_harga">Total Harga:</label>
            <input type="text" id="total_harga" name="total_harga" readonly>
        </div>

        <div class="form-group">
            <button class="submit" type="submit">Pesan Sekarang</button>
        </div>
    </form>
</div>

<?php
    } else {
        echo "<p>Terjadi kesalahan saat mengambil data lapangan. Silakan coba lagi nanti.</p>";
    }
}
?>

<?php include_once("footer.php"); ?>
<script src="assets/js/script.js"></script>

<script>
    const hargaPerJamInput = document.getElementById('harga_per_jam');
    const durasiInput = document.getElementById('durasi');
    const totalHargaInput = document.getElementById('total_harga');

    durasiInput.addEventListener('input', function() {
        const hargaPerJam = parseInt(hargaPerJamInput.value);
        const durasi = parseInt(durasiInput.value);
        const totalHarga = hargaPerJam * durasi;
        totalHargaInput.value = isNaN(totalHarga) ? '' : totalHarga;
    });
</script>
</body>
</html>
