<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php
session_start();
require 'include/function.php';

// menampilkan data kelompok 4
$mhs = query("SELECT * FROM tbl_mahasiswa WHERE npm IN (1806043, 1806062, 1806072)");

// id login, digunakan juga untuk menampilkan foto pada navbar
$id  = query("SELECT * FROM tbl_mahasiswa WHERE npm='$_SESSION[npm]'")[0];

// mengecek login
if (!isset($_SESSION['user_id'])) {
  header("location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <?php include 'templates/header.php'; ?>
</head>

<body>
  <!-- Sidenav -->
  <?php include 'templates/sidebar.php'; ?>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include 'templates/navbar.php'; ?>

    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <!-- breadcrumb -->
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav>
            </div>
          </div>
          <!-- End breadcrumb -->
          <!-- Isi Konten -->

          <!-- Dashboard -->
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">Kelompok 4 - Manajemen User (CRUD)</h1>
            <?php if (isset($_SESSION['message'])) : ?>
              <?php echo $_SESSION['message']; ?>
            <?php endif; ?>
            <?php unset($_SESSION['message']); ?>
          </div>

          <!-- Card  -->
          <div class="row">
            <?php foreach ($mhs as $data) : ?>
              <div class="col">
                <div class="container mt-5 d-flex justify-content-center">
                  <div class="card p-3 animate__animated animate__fadeIn">
                    <div class="d-flex align-items-center">
                      <div class="image"> <img src="assets/img/profile/<?= $data['foto']; ?>" width="105" height="105" style="border-radius: 50%;"> </div>
                      <div class="ml-3 w-100">
                        <h3 class="mb-2 mt-0"><?= $data["nama"]; ?></h3>
                        <h5 class="mb-2 mt-0"><?= $data['npm'] ?></h5>
                        <h5>Kelompok 4</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <!-- End Card -->
        </div>
      </div>

      <!-- Footer -->
      <!-- <?php include 'templates/footer.php'; ?> -->

    </div>
  </div>
  <!-- Argon Scripts -->
  <?php include 'templates/js.php'; ?>

</body>

</html>