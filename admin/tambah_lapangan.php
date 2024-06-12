<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bolaraga Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/logo.png" type="image">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <style>
        /* Custom CSS untuk form */
        .custom-file-input:lang(en)~.custom-file-label::after {
            content: "Browse";
        }

        .custom-file-label {
            overflow: hidden;
        }

    </style>
</head>

<body>
    <?php
    session_start();
    // Periksa apakah sesi admin telah terinisialisasi dan sesuai
    if (!isset($_SESSION['alogin'])) {
        // Sesi admin belum ada atau tidak terdefinisi
        echo '<script>alert("Anda harus login terlebih dahulu untuk mengakses halaman ini.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit; // Pastikan untuk menghentikan eksekusi lebih lanjut setelah redirect
    }
    ?>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
		<?php
		include_once("sidebar.php");
		?>
        <!-- main content area start -->
        <div class="main-content">
            <?php
			    include_once("header.php");
			?>
            <?php
                include_once("koneksi.php");
            ?>

            <div class="container mt-4">
                <h2>Tambah Lapangan</h2>
                <form action="proses_tambahlapangan.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group mt-3">
                        <label for="namaLapangan">Nama Lapangan</label>
                        <input type="text" class="form-control" id="namaLapangan" name="namaLapangan" placeholder="Masukkan Nama Lapangan" required>
                    </div>
                    <div class="form-group">
                        <label for="jenisLapangan">Jenis Lapangan</label>
                        <select class="form-control p-2"  id="jenisLapangan" name="jenisLapangan" required>
                            <!-- Pilihan dari database jenis lapangan -->
                            <?php
                            // Koneksi ke database
                            include_once('koneksi.php');

                            // Query untuk mengambil jenis lapangan dari tabel
                            $query = "SELECT * FROM jenis";

                            // Eksekusi query
                            $result = mysqli_query($conn, $query);

                            // Loop untuk menampilkan pilihan dari database
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['id_jenis'] . '">' . $row['nama_jenis'] . '</option>';
                            }

                            // Tutup koneksi database
                            mysqli_close($conn);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="fotoLapangan">Foto Lapangan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoLapangan" name="fotoLapangan" required onchange="updateFileName()">
                            <label class="custom-file-label" for="fotoLapangan" id="fileNameLabel">Pilih file</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Lapangan</button>
                </form>
            </div>

        </div>
        <!-- main content area end -->
    </div>
    <!-- page container area end -->
    <script>
    function updateFileName() {
        const fileName = document.getElementById('fotoLapangan').files[0].name;
        document.getElementById('fileNameLabel').innerText = fileName;
    }
    </script>
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

    
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
