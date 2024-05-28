<?php require_once 'koneksi.php';
?>
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

    <?php
    include_once("header.php");
    ?>

<?php
// Periksa jika user belum login
session_start();
    // Periksa apakah sesi user telah terinisialisasi dan sesuai
    if (!isset($_SESSION['ulogin'])) {
        // Sesi admin belum ada atau tidak terdefinisi
        echo '<script>alert("Anda harus login terlebih dahulu untuk mengakses halaman ini.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit; // Pastikan untuk menghentikan eksekusi lebih lanjut setelah redirect
    }

if(isset($_GET['id_lap'])) {
    $lapangan_id = $_GET['id_lap'];

    // Lakukan query untuk mendapatkan informasi lapangan berdasarkan id_lap
    $sql_lapangan = "SELECT * FROM lapangan WHERE id_lap = $lapangan_id";
    $hasil_lapangan = mysqli_query($conn, $sql_lapangan);

    // Tampilkan informasi lapangan yang dipilih
    if($row = mysqli_fetch_assoc($hasil_lapangan)) {
    ?>

    <div class="container">
        <h1>Form Pemesanan Lapangan Badminton</h1>
        <form action="proses_pemesanan.php" method="POST">
            <!-- Input nama lapangan (dapat disesuaikan dengan hasil dari query sebelumnya) -->
            <div class="form-group">
                <label for="nama_lapangan">Nama Lapangan:</label>
                <input type="text" id="nama_lapangan" name="nama_lapangan" value="<?= $row['nama_lap'] ?>" readonly>
            </div>
            
            <!-- Input nomor lapangan -->
            <div class="form-group">
                <label for="nomor_lapangan">ID Lapangan:</label>
                <select id="nomor_lapangan" name="nomor_lapangan">
                <option value="<?= $row["id_lap"] ?>"><?= $row["id_lap"] ?></option>
                <!-- Tambahkan opsi lainnya sesuai dengan jumlah lapangan yang tersedia -->
                </select>
            </div>
            
            <!-- Input harga per jam (dalam bentuk input tersembunyi karena sudah diambil dari hasil query sebelumnya) -->
            <div class="form-group">
                <label for="harga_per_jam">Harga Per Jam:</label>
                <input type="number" id="harga_per_jam" name="harga_per_jam" value="<?= $row["harga"] ?>" readonly>
            </div>

            <div class="form-group">
                <label for="metode_pembayaran">Metode Pembayaran:</label>
                <label><input type="radio" name="metode_pembayaran" value="COD" required> COD</label>
            </div>

            <!-- Input tanggal main -->
            <div class="form-group">
                <label for="tanggal_main">Tanggal Main:</label>
                <input type="date" id="tanggal_main" name="tanggal_main" required>
            </div>

            <!-- Input jam main -->
            <div class="form-group">
                <label for="jam_main">Jam Main:</label>
                <input type="time" id="jam_main" name="jam_main" required>
            </div>

            <!-- Input durasi -->
            <div class="form-group">
                <label for="durasi">Durasi (jam):</label>
                <input type="number" id="durasi" name="durasi" min="1" required>
            </div>

            <!-- Input total harga (dihitung berdasarkan harga per jam dan durasi, bisa diisi secara otomatis dengan JavaScript) -->
            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="text" id="total_harga" name="total_harga" readonly>
            </div>

            <!-- Tombol Submit -->
            <div class="form-group">
                <button class="submit" type="submit">Pesan Sekarang</button>
            </div>
        </form>
    </div>
<?php
    } 
}
?>
    <?php
    include_once("footer.php");
    ?>
    <script src="assets/js/script.js"></script>
</body>
</html>

<script>
    // Ambil elemen-elemen yang dibutuhkan
    const hargaPerJamInput = document.getElementById('harga_per_jam');
    const durasiInput = document.getElementById('durasi');
    const totalHargaInput = document.getElementById('total_harga');

    // Event listener untuk perubahan pada input durasi
    durasiInput.addEventListener('input', function() {
        // Ambil harga per jam dan durasi dari input
        const hargaPerJam = parseInt(hargaPerJamInput.value);
        const durasi = parseInt(durasiInput.value);

        // Hitung total harga
        const totalHarga = hargaPerJam * durasi;

        // Tampilkan total harga pada input total_harga
        totalHargaInput.value = isNaN(totalHarga) ? '' : totalHarga;
    });
</script>