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

$message = '';

// id login, digunakan juga untuk menampilkan foto pada navbar
$id  = query("SELECT * FROM tbl_mahasiswa WHERE npm='$_SESSION[npm]'")[0];

// cek sudah login atau belum
if (!isset($_SESSION['user_id'])) {
  header("location: login.php");
}

// cek admin atau bukan
if ($_SESSION['role'] != '1') {
  header("location: index.php");
}

// foto hasil crop disimpan terlebih dahulu
if (isset($_POST["foto"])) {
  $tempdir = "assets/img/profile/";
  if (!file_exists($tempdir))
    mkdir($tempdir);

  $foto = $_POST["foto"];
  $image_array_1 = explode(";", $foto);
  $image_array_2 = explode(",", $image_array_1[1]);
  $foto = base64_decode($image_array_2[1]);

  $imageName = "foto" . "_";
  file_put_contents($tempdir . $imageName, $foto);
}

// tambah data
if (isset($_POST['tambah_data'])) {
  // cek apakah ada npm yang sama atau tidak
  $imageName = "foto" . "_";
  $npm = mysqli_real_escape_string($conn, $_POST['npm']);
  $check_npm = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa WHERE npm = '$npm'");
  $numrows_npm = mysqli_num_rows($check_npm);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $check_email = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa WHERE email = '$email'");
  $numrows_email = mysqli_num_rows($check_email);
  if ($numrows_npm > 0) {
    $message = "<div class='alert alert-danger' role='alert'>NPM sudah dipakai!</div>";
  } elseif ($numrows_email > 0) {
    $message = "<div class='alert alert-danger' role='alert'>Email sudah dipakai!</div>";
  } else {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah_data_mahasiswa($_POST, $imageName) > 0) {
      $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Data berhasil disimpan</div>";
      header('Location:tabel_user.php');
    } else {
      $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Ada kesalahan dalam menyimpan data</div>";
      if (file_exists("assets/img/profile/" . $imageName))
        unlink("assets/img/profile/" . $imageName); // Hapus file foto sebelumnya yang ada di folder images
      header('Location:tabel_user.php');
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
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg col-md-10">
            <h1 class="display-2 text-white">Halo <?php echo $_SESSION['username']; ?></h1>
            <p class="text-white mt-0 mb-5">Ini adalah halaman menambah data mahasiswa.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--9">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-3">Tambah Data</h3>
                </div>
              </div>
              <?php echo $message; ?>
            </div>
            <div class="card-body">
              <form method="post" action="" enctype="multipart/form-data">
                <div class="px-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-npm">NPM</label>
                        <input type="text" id="input-npm" placeholder="Nomor Pokok Mahasiswa" class="form-control" name="npm" minlength="7" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-role">Pilih Status User</label>
                        <select class="form-control" name="role" id="input-role" required>
                          <option selected>Pilih Role</option>
                          <option value="1">Admin</option>
                          <option value="2">User</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-nama">Nama</label>
                        <input type="text" id="input-nama" placeholder="Nama mahasiswa" class="form-control" name="nama" maxlength="200" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Alamat Email</label>
                        <input type="email" name="email" id="input-email" placeholder="Masukkan alamat email kampus" class="form-control" maxlength="200" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Alamat</label>
                        <textarea rows="4" placeholder="Masukkan alamat" class="form-control" name="alamat" required></textarea>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-kelas">Kelas</label>
                        <select class="form-control" name="kelas" id="input-kelas" required>
                          <option selected>Pilih kelas</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                          <option value="E">E</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-jurusan">Jurusan</label>
                        <select class="form-control" name="jurusan" id="input-jurusan" required>
                          <option selected>Pilih jurusan</option>
                          <option value="Teknik Informatika">Teknik Informatika</option>
                          <option value="Teknik Industri">Teknik Industri</option>
                          <option value="Teknik Sipil">Teknik Sipil</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group custom-file">
                        <label class="form-control-label">Pilih foto</label>
                        <input type="file" hidden id="input-foto" name="foto" class="custom-file-input item-img file center-block" accept="image/*">
                        <label class="custom-file-label" for="input-foto">Pilih foto</label>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form group">
                        <img src="" height="200" class="gambar my-3 rounded-circle mx-auto d-block" id="item-img-output">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal crop -->
                <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Crop</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <div id="upload-demo" class="center-block"></div>
                      </div>
                      <div class="modal-footer text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted">Keterangan</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <p class="small text-muted mb-4">Password akan diisi otomatis, yaitu "<b>sttgarut</b>"</p>
                  </div>
                </div>
                <div class="pl-lg-4 text-right">
                  <button class="btn btn-primary" type="submit" name="tambah_data" id="tambah_data">Tambah Data</button>
                  <button class="btn btn-danger" type="reset">Reset</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Footer -->
      <?php include 'templates/footer.php'; ?>

    </div>
  </div>
  <!-- Argon Scripts -->
  <?php include 'templates/js.php'; ?>
  <script>
    // Start upload preview image
    $(".gambar").attr("src", "assets/img/profile/sttgarut.png");
    var $uploadCrop,
      tempFilename,
      rawImg,
      imageId;

    function readFile(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.upload-demo').addClass('ready');
          $('#cropImagePop').modal('show');
          rawImg = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      } else {
        swal("Sorry - you're browser doesn't support the FileReader API");
      }
    }

    $uploadCrop = $('#upload-demo').croppie({
      enableExif: true,
      viewport: {
        width: 200,
        height: 200,
        type: 'square'
      },
      boundary: {
        width: 300,
        height: 300
      }
    });

    $('#cropImagePop').on('shown.bs.modal', function() {
      // alert('Shown pop');
      $uploadCrop.croppie('bind', {
        url: rawImg
      }).then(function() {
        console.log('jQuery bind complete');
      });
    });

    $('.item-img').on('change', function() {
      imageId = $(this).data('id');
      tempFilename = $(this).val();
      $('#cancelCropBtn').data('id', imageId);
      readFile(this);
    });

    $('#cropImageBtn').click(function(event) {
      $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response) {
        $.ajax({
          url: "",
          type: "POST",
          data: {
            "foto": response
          },
          success: function(data) {
            $('#cropImagePop').modal('hide');
            $('#item-img-output').attr('src', response);
          }
        });
      })
    });
    // End upload preview image
  </script>

</body>

</html>