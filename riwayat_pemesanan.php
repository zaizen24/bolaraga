<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Sport</title>
    <link rel="icon" href="assets/images/logo.png" type="image">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <?php 
    include_once("header.php");
    ?>
    <?php
session_start();
// Pastikan user sudah login sebelum menampilkan riwayat pemesanan
if(isset($_SESSION['ulogin'])) {
    $username = $_SESSION['ulogin'];

    // Lakukan koneksi ke database dan query untuk mendapatkan riwayat pemesanan
    // ...

    // Contoh kueri SQL untuk mendapatkan riwayat pemesanan berdasarkan username
    $sql = "SELECT * FROM booking WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Tampilkan data pemesanan dalam tabel
    echo '
    <div class="container">
        <div class="row">
            <div class="col text-center pt-5 ">
                <table class="table table-bordered w-80 mx-auto mt-5">
                    <thead>
                        <tr>
                            <th scope="col">ID Booking</th>
                            <th scope="col">Nama Lapangan</th>
                            <th scope="col">Tanggal Main</th>
                            <th scope="col">Jam Main</th>
                            <th scope="col">Durasi</th>
                            <th scope="col">Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>';

    // Lakukan iterasi untuk setiap baris hasil dari kueri
    while($row = mysqli_fetch_assoc($result)) {
        echo '
                        <tr>
                            <th scope="row">' . $row['id_booking'] . '</th>
                            <td>' . $row['nama_lap'] . '</td>
                            <td>' . $row['tanggal_main'] . '</td>
                            <td>' . $row['jam_main'] . '</td>
                            <td>' . $row['durasi'] . '</td>
                            <td>' . $row['metode_pembayaran'] . '</td>
                        </tr>';
    }

    echo '
                    </tbody>
                </table>
            </div>
        </div>
    </div>';
} else {
    // Jika user belum login, tambahkan pesan atau lakukan redirect ke halaman login
    header("Location: login.php");
    exit;
}
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>