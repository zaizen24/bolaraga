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
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['alogin'])) {
        echo '<script>alert("Anda harus login terlebih dahulu untuk mengakses halaman ini.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit;
    }
    ?>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="page-container">
        <?php include_once("sidebar.php"); ?>

        <div class="main-content">
            <?php include_once("header.php"); ?>

            <div class="main-content-inner">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Data Lapangan</h4>
                                <a href="tambah_lapangan.php" class="btn btn-primary mt-1 mb-3 m-2">Tambah Lapangan</a>
                                <a href="update_lapangan.php" class="btn btn-primary mt-1 mb-3 m-2">Update Lapangan</a>
                                <a href="hapus_lapangan.php" class="btn btn-primary mt-1 mb-3 m-2">Hapus Lapangan</a>
                                <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th>ID Lapangan</th>
                                                <th>Nama Lapangan</th>
                                                <th>Harga / Jam</th>
                                                <th>Jenis Lapangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lapanganData">
                                            <!-- Data akan dimuat di sini oleh JavaScript -->
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lapanganPromise = fetch('proxy/proxy_lapangan.php')
                .then(response => response.json());

            const jenisPromise = fetch('proxy/proxy_jenis.php')
                .then(response => response.json());

            Promise.all([lapanganPromise, jenisPromise])
                .then(([lapanganData, jenisData]) => {
                    const lapanganContainer = document.getElementById('lapanganData');
                    lapanganContainer.innerHTML = '';

                    const jenisMap = jenisData.reduce((map, jenis) => {
                        map[jenis.id_jenis] = jenis.nama_jenis;
                        return map;
                    }, {});

                    lapanganData.forEach(lapangan => {
                        const row = document.createElement('tr');
                        const jenisNama = jenisMap[lapangan.id_jenis] || 'Unknown';

                        row.innerHTML = `
                            <td>${lapangan.id_lap}</td>
                            <td>${lapangan.nama_lap}</td>
                            <td>Rp. ${lapangan.harga}</td>
                            <td>${jenisNama}</td>
                        `;

                        lapanganContainer.appendChild(row);
                    });

                    $('#dataTable').DataTable();
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
</body>

</html>
