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
include 'include/function.php';

// menampilkan data mahasiswa
$data = query("SELECT * FROM tbl_mahasiswa, tbl_login, tbl_user WHERE tbl_mahasiswa.email=tbl_login.username AND tbl_login.id_role=tbl_user.id_role");

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
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Data Mahasiswa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Mahasiswa</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="form_add.php" class="btn btn-neutral nav-link" style="display: inline-block!important;">
                <i class="ni ni-fat-add"></i>
                <span class="nav-link-text">Tambah</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-3">Data Mahasiswa</h3>
              <?php if (isset($_SESSION['message'])) : ?>
                <?php echo $_SESSION['message']; ?>
              <?php endif; ?>
              <?php unset($_SESSION['message']); ?>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush table-hover data">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col" class="sort" data-sort="nama">Nama</th>
                    <th scope="col" class="sort" data-sort="npm">NPM</th>
                    <th scope="col" class="sort" data-sort="role">Role</th>
                    <!-- <th scope="col">Foto</th> -->
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php
                  $i = 1;
                  foreach ($data as $row) { ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td>
                        <div class="media align-items-center">
                          <a href="profil.php?npm=<?= $row['npm']; ?>" class="avatar rounded-circle mr-3">
                            <img alt="foto" src="assets/img/profile/<?= $row['foto'] ?>">
                          </a>
                          <div class="media-body">
                            <a href="profil.php?npm=<?= $row['npm']; ?>" class="text-default">
                              <span class="name mb-0 text-sm font-weight-bold"><?= $row['nama']; ?></span>
                            </a>
                          </div>
                        </div>
                      </td>
                      <td><?= $row['npm']; ?></td>
                      <td>
                        <?php
                        if ($row['id_role'] == '1') { ?>
                          <span class="badge badge-dot mr-4">
                            <i class="bg-primary"></i>
                            <span class="status"><?= $row['role']; ?></span>
                          </span>
                        <?php } else { ?>
                          <span class="badge badge-dot mr-4">
                            <i class="bg-success"></i>
                            <span class="status"><?= $row['role']; ?></span>
                          </span>
                        <?php }
                        ?>
                      </td>
                      <td>
                        <a href="form_edit.php?npm=<?= $row['npm']; ?>" class="btn btn-primary" role="button" aria-pressed="true">
                          <i class="fas fa-pen"></i>
                          <span class="nav-link-text">Edit</span>
                        </a>
                        <a data-toggle="modal" data-target="#HapusModal-<?php echo $i; ?>" class="btn btn-danger" role="button" aria-pressed="true">
                          <i class="fas fa-times text-white"></i>
                          <span class="nav-link-text text-white">Hapus</span>
                        </a>
                      </td>
                    </tr>

                    <!-- Modal  -->
                    <div class="modal fade" id="HapusModal-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapus" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="HapusModalLongTitle">Hapus data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data ini?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a class="btn btn-danger" href="hapus.php?hapus=<?= $row['npm']; ?> ">Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php $i++;
                  } ?>
                </tbody>
              </table>
            </div>

            <!-- Card footer -->
            <div class=" card-footer py-4">
              <nav aria-label="...">
              </nav>
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
  <script type="text/javascript">
    $(document).ready(function() {
      $('.data').DataTable({
        "language": {
          "url": "assets/dataTables/Indonesian.json",
          "sEmptyTables": "Tidads"
        }
      });
    });
  </script>
  <!-- script alert 3 detik -->
  <!-- <script>
    setTimeout(function() {
      let alert = document.querySelector(".alert");
      alert.remove();
    }, 3000);
  </script> -->

</body>

</html>