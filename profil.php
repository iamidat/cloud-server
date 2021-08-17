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

// id login, digunakan juga untuk menampilkan foto pada navbar
$id  = query("SELECT * FROM tbl_mahasiswa WHERE npm='$_SESSION[npm]'")[0];


// mengecek login
if (!isset($_SESSION['user_id'])) {
  header("location: login.php");
}

// mendapatkan npm untuk menampilkan data
if (isset($_GET['npm'])) {
  $npm = $_GET['npm'];
  if ($_SESSION['role'] != '1') {
    if ($npm != $_SESSION['npm']) { // cek apakah npm yang diperoleh link merupakan npm dari session
      header('Location: index.php');
    } else {
      $data = query("SELECT * FROM tbl_mahasiswa WHERE npm = $npm")[0];
    }
  } else {
    $data = query("SELECT * FROM tbl_mahasiswa WHERE npm = $npm")[0];
    $cek = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa WHERE npm = '$npm'");
    // apakah npm yang diakses ada?
    $cek_npm = mysqli_num_rows($cek);
    if ($cek_npm <= 0) {
      $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>User tidak ditemukan!</div>";
      header('Location: tabel_user.php');
    }
  }
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
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(assets/img/theme/profile-cover.jpeg); background-size: cover; background-position: center;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg col-md-10">
            <h1 class="display-2 text-white">Halo <?php echo $_SESSION['username']; ?></h1>
            <?php
            if ($_SESSION['role'] == '1') { ?>
              <p class="text-white mt-0 mb-5">Ini adalah halaman profil, kamu bisa melihat profil <b><?= $data['nama']; ?></b> disini.</p>
            <?php } else { ?>
              <p class="text-white mt-0 mb-5">Ini adalah halaman profil, kamu bisa melihat profil kamu disini.</p>
            <?php }
            ?>
            <a href="form_edit.php?npm=<?= $data['npm']; ?> " class="btn btn-neutral mb-5">Edit profil</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--9">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="assets/img/theme/pattern.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="assets/img/profile/<?= $data['foto'] ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <!-- <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div> -->
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                    <!-- <div>
                      <span class="heading">22</span>
                      <span class="description">Friends</span>
                    </div> -->
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Folder</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">File</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                  <?php echo $data['nama']; ?><span class="font-weight-light"></span>
                </h5>
                <div class="h5 font-weight-300">
                  <?= $data['npm'] ?>
                  <br>
                  <i class="ni ni-email-83 pt-2 mr-2"></i><?= $data['email'] ?>
                </div>
                <div class="h5 mt-4">
                  Sekolah Tinggi Teknologi Garut
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-3">Data</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
              <?php if (isset($_SESSION['message'])) : ?>
                <?php echo $_SESSION['message']; ?>
              <?php endif; ?>
              <?php unset($_SESSION['message']); ?>
            </div>
            <div class="card-body">
              <form method="post" action="" enctype="multipart/form-data">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-npm">NPM</label>
                        <input type="number" id="input-npm" placeholder="Nomor Pokok Mahasiswa" class="form-control-plaintext" min="0" name="npm" value="<?php echo $data['npm']; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-nama">Nama</label>
                        <input type="text" id="input-nama" placeholder="Nama mahasiswa" class="form-control-plaintext" name="nama" value="<?php echo $data['nama']; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Alamat Email</label>
                        <input type="email" name="email" id="input-email" placeholder="Masukkan alamat email kampus" class="form-control-plaintext" value="<?php echo $data['email']; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Alamat</label>
                        <textarea placeholder="Masukkan alamat" class="form-control-plaintext" name="alamat" readonly><?php echo $data['alamat']; ?></textarea>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-kelas">Kelas</label>
                        <input type="kelas" name="kelas" id="input-kelas" placeholder="Masukkan kelas" class="form-control-plaintext" value="<?php echo $data['kelas']; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-jurusan">Jurusan</label>
                        <input type="jurusan" name="jurusan" id="input-jurusan" placeholder="Masukkan jurusan" class="form-control-plaintext" value="<?php echo $data['jurusan']; ?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <hr class="my-4" />
                 Description
                <h6 class="heading-small text-muted">Keterangan</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <p class="small text-muted mb-4">Password akan diisi otomatis, yaitu "<b>sttgarut</b>"</p>
                  </div>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <?php include 'templates/footer.php'; ?>

    </div>
  </div>
  <!-- Argon Scripts -->
  <?php include 'templates/js.php'; ?>

</body>

</html>