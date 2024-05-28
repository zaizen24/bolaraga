<?php
$host = 'localhost';
$username ='root';
$pass = '';
$db_name = 'sewa_lapangan';

$conn = mysqli_connect($host,$username, $pass, $db_name);

if (! $conn) {
    echo "Failed Connection !";
  }
?>