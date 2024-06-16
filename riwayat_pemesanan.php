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
    <?php include_once("header.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col text-center pt-5">
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
                    <tbody id="bookingData">
                        <!-- Data akan dimuat di sini oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('proxy/proxy_booking.php')
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    const bookingData = document.getElementById('bookingData');
                    bookingData.innerHTML = '';

                    data.forEach(booking => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <th scope="row">${booking.id_booking}</th>
                            <td>${booking.nama_lap}</td>
                            <td>${booking.tanggal_main}</td>
                            <td>${booking.jam_main}</td>
                            <td>${booking.durasi}</td>
                            <td>${booking.metode_pembayaran}</td>
                        `;
                        bookingData.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
</body>
</html>
