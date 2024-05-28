<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Space Sport Admin</title>
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
            <div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Semua Transaksi</h4>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>ID Booking</th>
                                    <th>Nama Lapangan</th>
                                    <th>Tanggal Main</th>
                                    <th>Jam Main</th>
                                    <th>Durasi</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once("koneksi.php");
                                // Lakukan koneksi ke database

                                // Lakukan query untuk mengambil data dari tabel booking
                                $sql = "SELECT * FROM booking";
                                $result = mysqli_query($conn, $sql);

                                // Tampilkan data dalam tabel HTML
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                        <tr>
                                            <td>" . $row['id_booking'] . "</td>
                                            <td>" . $row['nama_lap'] . "</td>
                                            <td>" . $row['tanggal_main'] . "</td>
                                            <td>" . $row['jam_main'] . "</td>
                                            <td>" . $row['durasi'] . "</td>
                                            <td>" . $row['metode_pembayaran'] . "</td>
                                            <td>" . $row['username'] . "</td>
                                        </tr>
                                    ";
                                }

                                // Tutup koneksi database
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

        </div>
        <!-- main content area end -->
    </div>
    <!-- page container area end -->

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
</body>

</html>