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

// foto hasil crop disimpan terlebih dahulu
if (isset($_POST["foto"])) {
  $tempdir = "assets/img/profile/";
  if (!file_exists($tempdir))
    mkdir($tempdir);

  $foto = $_POST["foto"];
  $image_array_1 = explode(";", $foto);
  $image_array_2 = explode(",", $image_array_1[1]);
  $foto = base64_decode($image_array_2[1]);

  $imageName = "foto" . "_" . $npm;
  file_put_contents($tempdir . $imageName, $foto);
}

// update data
if (isset($_POST['btn_update'])) {
  $imageName = "foto" . "_" . $npm;
  $password = $_POST['password'];
  $password1 = $_POST['password1'];
  // cek konfirmasi password
  if ($password !== $password1) {
    $message = "<div class='alert alert-danger' role='alert'>Password tidak sama!</div>";
    if (file_exists("assets/img/profile/" . $imageName))
      unlink("assets/img/profile/" . $imageName); // Hapus file foto sebelumnya yang ada di folder images
  } else {
    if (update_data_mahasiswa($_POST, $imageName) > 0) {
      $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Data berhasil diperbaharui!</div>";
      if ($_SESSION['role'] != '1') {
        header("Location:profil.php?npm=" . $id['npm']);
      } else {
        header('Location:tabel_user.php');
      }
    } else {
      $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Data gagal diperbaharui!</div>";
      unlink("assets/img/profile/" . $imageName); // Hapus file foto sebelumnya yang ada di folder images
      if ($_SESSION['role'] == '1') {
        header("Location:profil.php?npm=" . $id['npm']);
      } else {
        header('Location:tabel_user.php');
      }
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
            <p class="text-white mt-0 mb-5">Ini adalah halaman untuk mengedit data kamu.</p>
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
              <div class="align-items-center">
                <div class="col-8">
                  <h3 class="mb-3">Edit Data</h3>
                </div>
                <?php echo $message; ?>
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="" enctype="multipart/form-data">
                <div class="px-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-npm">NPM</label>
                        <input type="text" id="input-npm" placeholder="Nomor Pokok Mahasiswa" class="form-control" value="<?php echo $data['npm']; ?>" minlength="7" disabled>
                        <!-- penanda npm -->
                        <input type="hidden" id="input-npm" placeholder="Nomor Pokok Mahasiswa" class="form-control" name="npm" value="<?php echo $data['npm']; ?>" minlength="7" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-nama">Nama</label>
                        <input type="text" id="input-nama" placeholder="Nama mahasiswa" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" maxlength="200" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Alamat Email</label>
                        <input type="email" name="email" id="input-email" placeholder="Masukkan alamat email kampus" class="form-control" value="<?php echo $data['email']; ?>" maxlength="200" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-password">Password</label>
                        <input type="password" id="input-password" placeholder="Masukkan password" class="form-control" name="password" maxlength="200" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-password1">Konfirmasi Password</label>
                        <input type="password" id="input-password1" placeholder="Konfirmasi password" class="form-control" name="password1" maxlength="200" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Alamat</label>
                        <textarea rows="4" placeholder="Masukkan alamat" class="form-control" name="alamat" required><?php echo $data['alamat']; ?></textarea>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-kelas">Kelas</label>
                        <select class="form-control" name="kelas" id="input-kelas" required>
                          <?php if ($data['kelas'] == 'A') {
                            echo "<option value='A' selected>A</option>";
                            echo "<option value='B'>B</option>";
                            echo "<option value='C'>C</option>";
                            echo "<option value='D'>D</option>";
                            echo "<option value='E'>E</option>";
                          } elseif ($data['kelas'] == 'B') {
                            echo "<option value='A'>A</option>";
                            echo "<option value='B' selected>B</option>";
                            echo "<option value='C'>C</option>";
                            echo "<option value='D'>D</option>";
                            echo "<option value='E'>E</option>";
                          } elseif ($data['kelas'] == 'C') {
                            echo "<option value='A'>A</option>";
                            echo "<option value='B'>B</option>";
                            echo "<option value='C' selected>C</option>";
                            echo "<option value='D'>D</option>";
                            echo "<option value='E'>E</option>";
                          } elseif ($data['kelas'] == 'D') {
                            echo "<option value='A'>A</option>";
                            echo "<option value='B'>B</option>";
                            echo "<option value='C'>C</option>";
                            echo "<option value='D' selected>D</option>";
                            echo "<option value='E'>E</option>";
                          } else {
                            echo "<option value='A'>A</option>";
                            echo "<option value='B'>B</option>";
                            echo "<option value='C'>C</option>";
                            echo "<option value='D'>D</option>";
                            echo "<option value='E' selected>E</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-jurusan">Jurusan</label>
                        <select class="form-control" name="jurusan" id="input-jurusan" required>
                          <?php if ($data['jurusan'] == 'Teknik Informatika') {
                            echo "<option value='Teknik Informatika' selected>Teknik Informatika</option>";
                            echo "<option value='Teknik Industri'>Teknik Industri</option>";
                            echo "<option value='Teknik Sipil'>Teknik Sipil</option>";
                          } elseif ($data['jurusan'] == 'Teknik Idustri') {
                            echo "<option value='Teknik Informatika'>Teknik Informatika</option>";
                            echo "<option value='Teknik Industri' selected>Teknik Industri</option>";
                            echo "<option value='Teknik Sipil'>Teknik Sipil</option>";
                          } else {
                            echo "<option value='Teknik Informatika'>Teknik Informatika</option>";
                            echo "<option value='Teknik Industri'>Teknik Industri</option>";
                            echo "<option value='Teknik Sipil' selected>Teknik Sipil</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group custom-file">
                        <label class="form-control-label">Pilih foto</label>
                        <input type="file" hidden id="file_foto" name="foto" class="custom-file-input item-img file center-block" accept="image/*">
                        <label class="custom-file-label" for="file_foto">Pilih foto</label>
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
                <!-- <h6 class="heading-small text-muted">Keterangan</h6> -->
                <div class="pl-lg-4 text-right">
                  <button class="btn btn-primary btn_update" type="submit" name="btn_update" id="btn_update">Update Data</button>
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
    $(".gambar").attr("src", "assets/img/profile/<?php echo $data['foto']; ?>");
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
        width: 400,
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
        size: {
          width: 1000,
          height: 1000
        }
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