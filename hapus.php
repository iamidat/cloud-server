<?php
session_start();
include 'include/function.php';

// cek sudah login atau belum
if (!isset($_SESSION['user_id'])) {
  header("location: login.php");
}

// cek admin atau bukan
if ($_SESSION['role'] != '1') {
  header("location: index.php");
}

// id login, digunakan juga untuk menampilkan foto pada navbar
$id  = query("SELECT * FROM tbl_mahasiswa WHERE npm='$_SESSION[npm]'")[0];

// hapus data
if (isset($_GET['hapus'])) {
  $npm = $_GET['hapus'];
  $id_npm  = query("SELECT * FROM tbl_mahasiswa WHERE npm='$npm'")[0];
  if ($id_npm != $id) { // jika npm tidak sama dengan yang dihapus
    $status_hapus = hapus($npm);

    // Cek apakah file foto sebelumnya ada di folder images
    if (file_exists("assets/img/profile/" . $id_npm['foto'])) {
      // Jika foto ada
      if ($id_npm['foto'] != "sttgarut.png") {
        unlink("assets/img/profile/" . $id_npm['foto']); // Hapus file foto sebelumnya yang ada di folder images
      }
    }

    if ($status_hapus) {
      $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Data berhasil dihapus</div>";
      header("location: tabel_user.php");
    } else {
      $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Data tidak bisa dihapus</div>";
      header("location: tabel_user.php");
    }
  } else {
    $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Data tidak bisa dihapus</div>";
    header("location: tabel_user.php");
  }
} else {
  $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Data tidak bisa dihapus</div>";
  header("location: tabel_user.php");
}
