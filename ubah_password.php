<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>
    <link rel="icon" href="assets/images/logo.png" type="image">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <?php
    include_once("header.php"); 
    ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6" style="margin:150px;">
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0">Ubah Password</h4>
        </div>
        <div class="card-body">
          <form action="proses_ubahpassword.php" method="POST">
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
<?php
    include_once("footer.php"); 
    ?>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
