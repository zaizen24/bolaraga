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
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6" style="margin:50px;">
                            <div class="card">
                                <div class="card-header">
                                <h4 class="mb-0">Ubah Password</h4>
                            </div>
                            <div class="card-body">
                            <form action="proses_gantipassword.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="passwordLama">Password Lama</label>
                                    <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Masukkan password lama" required>
                                </div>
                                <div class="form-group  mb-3">
                                    <label for="passwordBaru">Password Baru</label>
                                    <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" placeholder="Masukkan password baru" required>
                                </div>
                                <div class="form-group  mb-3">
                                    <label for="konfirmasiPassword">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="konfirmasiPassword" name="konfirmasiPassword" placeholder="Konfirmasi password baru" required>
                                    <div id="passwordWarning" style="color: red; display: none; margin-top:10px;">Konfirmasi password tidak sesuai dengan password baru.</div>
                                </div>
                                <button type="submit" class="btn btn-primary  mb-3">Ubah Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- page container area end -->

<script>
document.getElementById("passwordBaru").addEventListener("input", function() {
    validatePassword();
});

document.getElementById("konfirmasiPassword").addEventListener("input", function() {
    validatePassword();
});

function validatePassword() {
    var passwordBaru = document.getElementById("passwordBaru").value;
    var konfirmasiPassword = document.getElementById("konfirmasiPassword").value;
    var passwordWarning = document.getElementById("passwordWarning");

    if (passwordBaru !== konfirmasiPassword) {
        passwordWarning.style.display = "block";
    } else {
        passwordWarning.style.display = "none";
    }
}
</script>
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