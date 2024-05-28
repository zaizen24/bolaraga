<?php require_once 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Sport</title>
    <link rel="icon" href="assets/images/logo.png" type="image">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <?php
    include_once("header.php");
    ?>
    <div class="titlesewa">
        <h1>Sewa Lapangan Futsal</h1>
    </div>
    <?php
    $sql = 'SELECT * FROM lapangan where id_jenis = "2"';
    $hasil = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($hasil)) {
    ?>
        <div class="container-lap">
            <div class="foto">
                <img src="<?= $row["foto"] ?>" alt="">
            </div>
            <div class="nama-lap">
                <h3><?= $row["nama_lap"] ?></h3>
            </div>
            <div class="harga-lap">
                <h3><?= "Rp. " . $row["harga"] ?></h3>
            </div>
            <div class="btnpesan">
                <a href="pemesanan.php?id_lap=<?= $row['id_lap'] ?>">Pesan</a>
            </div>
        </div>
    <?php
    }
    include_once("footer.php");
    ?>
    <script src="assets/js/script.js"></script>
</body>
</html>