<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_kelas_b";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
  echo "Koneksi Database Gagal" . mysqli_connect_error();
}
