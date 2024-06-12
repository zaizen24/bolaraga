<?php
include("login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="#"><img src="assets/images/logo.png" alt="space-sport" width="60px" height="60px"/></a>
            <a href="#">Bolaraga</a>
        </div>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li class="dropdown">
            <a href="#">Sewa Lapangan &#9662;</a>
            <ul class="dropdown-content">
                <li><a href="lap_badminton.php">Lap. Badminton</a></li>
                <li><a href="lap_futsal.php">Lap. Futsal</a></li>
                <li><a href="lap_minisoccer.php">Lap. Mini Soccer</a></li>
            </ul>
            <li>
                <a href="#" onclick="scrollContact()">Kontak</a>
            </li>
            <li>
                <a href="#" onclick="scrollTestimoni()">Testimoni</a>
            </li>
            <li>
                <a href="#">FAQ</a>
            </li>
        </ul>
            <div class="main">
            <?php   if(empty($_SESSION['ulogin']))
			{	
			?>
            <div class="login"><a href="" onclick="showPopup('loginPopup')">Masuk</a></div>
            <div class="register"><a href="" onclick="showPopup('registerPopup')">Daftar</a></div>
            <div class="icon"><i class="ph ph-list"></i></div>
            
            <?php }
            else{
                ?>
                <!-- Tampilan jika sudah login -->
                <div>
                    Selamat Datang, <?php echo $_SESSION['ulogin']; ?>
                    <form method="post" action="">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ubah_password.php">Ganti Password</a></li>
                        <li><a class="dropdown-item" href="riwayat_pemesanan.php">Riwayat Pemesanan</a></li>
                        <li><a class="dropdown-item" href="#"><button type="submit" name="logout">Logout</button></a></li>
                    </ul>
                    </div>
                    </form>
                </div>
            <?php } ?>

            <div class="popup-logres" id="loginPopup">
                <div class="popup-content">
                    <span class="close-btn" onclick="hidePopup('loginPopup')">&times;</span>
                    <h2>Masuk</h2>
                    <a href=""><h6>Belum punya akun? Daftar</h6></a>
                    <form action="login.php" id="loginForm" method="POST">
                        <div class="form-group">
                            <input type="text" id="username" name="username" placeholder="Enter your username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <button name="login" type="submit">Log In</button>
                    </form>
                </div>
            </div>


        <div class="popup-logres" id="registerPopup">
        <div class="popup-content">
            <span class="close-btn" onclick="hidePopup('registerPopup')">&times;</span>
            <h2>Daftar</h2>
            <a href=""><h6>Sudah punya akun? Login</h6></a>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <input type="text" id="nomor" name="nomor" placeholder="Enter your phone number" required>
                </div>
                <button name="register" type="submit">Register</button>
            </form>
        </div>
    </div>

    </nav>
    <script src="assets/js/scroll.js"></script>
</body>
</html>