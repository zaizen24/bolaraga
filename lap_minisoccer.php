<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolaraga</title>
    <link rel="icon" href="assets/images/logo.png" type="image">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <?php include_once("header.php"); ?>

    <div class="titlesewa">
        <h1>Sewa Lapangan Mini Soccer</h1>
    </div>
    
    <div id="lapanganContainer"></div>

    <?php include_once("footer.php"); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('proxy/proxy_lapangan.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data);  // Log the data to verify it
                    const container = document.getElementById('lapanganContainer');
                    
                    data.forEach(lapangan => {
                        // Filter only lapangan with id_jenis 1 (badminton)
                        if (lapangan.id_jenis === 3) {
                            const lapanganElement = document.createElement('div');
                            lapanganElement.className = 'container-lap';  // Match the class name with your PHP code

                            lapanganElement.innerHTML = `
                                <div class="foto">
                                    <img src="${lapangan.foto}" alt="${lapangan.nama_lap}">
                                </div>
                                <div class="content">
                                    <div class="nama-lap">
                                        <h3>${lapangan.nama_lap}</h3>
                                    </div>
                                    <div class="harga-lap">
                                        <h3>Rp. ${lapangan.harga}</h3>
                                    </div>
                                </div>
                                <div class="btnpesan">
                                    <a href="pemesanan.php?id_lap=${lapangan.id_lap}">Pesan</a>
                                </div>
                            `;

                            container.appendChild(lapanganElement);
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
</body>
</html>
