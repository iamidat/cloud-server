<?php
session_start();

include "include/koneksi.php";

$message = '';

// Cek Cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // Ambil username berdasarkan ID
  $result = mysqli_query($conn, "SELECT username FROM tbl_login WHERE user_id = $id");
  $row = mysqli_fetch_assoc($result);

  // Cek cookie dan username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

// Jika sesi login ada maka pindah ke halaman index.php
if (!empty($_SESSION['login'])) {
  header("location: index.php");
}

// Mengecek user yang login sesuai dengan username dan password di database
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $result = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa, tbl_login WHERE tbl_mahasiswa.email=tbl_login.username and email = '$username' and password = '$password'");
  $row = mysqli_fetch_array($result);
  $check = mysqli_num_rows($result);


  if ($check > 0) {
    $_SESSION['login'] = ($row['username']);
    $_SESSION['user_id'] = ($row['user_id']);
    $_SESSION['username'] = ($row['nama']);
    $_SESSION['npm'] = ($row['npm']);
    $_SESSION['role'] = ($row['id_role']);
    
    if (isset($_POST['remember'])) {
      setcookie('id', $row['user_id'], time() + 3600);
      setcookie('key', hash('sha256', $row['username']), time() + 3600);
    }

    header("location: index.php");
  } else {
    $message = "<div class='alert alert-danger' role='alert'>Username atau Password Salah!</div>";
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <?php include 'templates/header.php'; ?>
</head>

<body class="bg-default">

  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="assets/img/logo/logo-vertical-dark-background.png">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="index.php">
                <img src="assets/img/logo/logo-vertical-light-background.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <span class="nav-link-inner--text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link">
              <span class="nav-link-inner--text">Login</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- Main content -->
  <div class="main-content">

    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-6">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-4">
              <img src="assets/img/logo/logo-only-dark-background.svg" alt="" width="100px" draggable="false">
              <br>
              <br>
              <h1 class="text-white">Selamat Datang!</h1>
              <p class="text-lead text-white">Cloud Server B merupakan aplikasi penyimpanan data secara online yang dikembangkan mahasiswa teknik informatika B 2018</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- End Header -->

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Silahkan login menggunakan email <br> Sekolah Tinggi Teknologi Garut</small>
              </div>
              <form role="form" method="post">
                <p class="text-danger"><?php echo $message; ?></p>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="username">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted" name="remember">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4" name="login">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <!-- <div class="row mt-3">
            <div class="col-6">
              <a href="#" class="text-light"><small>Forgot password?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="#" class="text-light"><small>Create new account</small></a>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2021 <a href="index.php" class="font-weight-bold ml-1" target="_blank">Teknik Informatika B</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="index.php" class="nav-link" target="_blank">Cloud Server B</a>
            </li>
            <li class="nav-item">
              <a href="about.php" class="nav-link" target="_blank">About Us</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Argon Scripts -->
  <?php include 'templates/js.php'; ?>
</body>

</html>