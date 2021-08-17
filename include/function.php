<?php

include 'koneksi.php';

function query($query)
{
  global $conn;

  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function hapus($npm)
{
  global $conn;

  mysqli_query($conn, "DELETE tbl_mahasiswa, tbl_login FROM tbl_mahasiswa JOIN tbl_login ON tbl_mahasiswa.email=tbl_login.username AND npm='$npm'");
  return mysqli_affected_rows($conn);
}

function tambah_data_mahasiswa($data, $gambar)
{
  global $conn;

  $npm = $_POST['npm'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $kelas = $_POST['kelas'];
  $jurusan = $_POST['jurusan'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  $id_npm  = query("SELECT * FROM tbl_mahasiswa WHERE npm='$npm'")[0];

  // Cek apakah user ingin menambah fotonya atau tidak
  // Jika tidak ada foto
  if (empty($foto)) {
    // beri nama default
    $foto = "sttgarut.png";

    // masukkan data
    $query_data_mahasiswa = "INSERT INTO tbl_mahasiswa (npm, nama, alamat, kelas, jurusan, email, foto) VALUES ('$npm', '$nama', '$alamat', '$kelas', '$jurusan', '$email', '$foto')";
    $query_data_login = "INSERT INTO tbl_login (username, password, id_role) VALUES ('$email', md5('sttgarut'), '$role')";
    mysqli_query($conn, $query_data_mahasiswa);
    mysqli_query($conn, $query_data_login);
    return mysqli_affected_rows($conn);
  } else { //jika ada foto
    // Cek apakah file foto sebelumnya ada di folder images
    if (file_exists("assets/img/profile/" . $id_npm['foto'])) {
      // Jika foto ada
      if ($id_npm['foto'] != "sttgarut.png") {
        unlink("assets/img/profile/" . $id_npm['foto']); // Hapus file foto sebelumnya yang ada di folder images
      }
    }

    // ganti nama
    $extension = end(explode(".", $foto));
    $tempdir = "assets/img/profile/";
    $namaBaru = "foto" . "_" . $npm . "." . $extension;
    rename($tempdir . $gambar, $tempdir . $namaBaru);

    // masukkan data
    $query_data_mahasiswa = "INSERT INTO tbl_mahasiswa (npm, nama, alamat, kelas, jurusan, email, foto) VALUES ('$npm', '$nama', '$alamat', '$kelas', '$jurusan', '$email', '$namaBaru')";
    $query_data_login = "INSERT INTO tbl_login (username, password, id_role) VALUES ('$email', md5('sttgarut'), '$role')";
    mysqli_query($conn, $query_data_mahasiswa);
    mysqli_query($conn, $query_data_login);
    return mysqli_affected_rows($conn);
  }
}


function update_data_mahasiswa($data, $gambar)
{
  global $conn;

  $npm = $_POST['npm'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $kelas = $_POST['kelas'];
  $jurusan = $_POST['jurusan'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  $id_npm  = query("SELECT * FROM tbl_mahasiswa WHERE npm='$npm'")[0];

  // Cek apakah user ingin mengubah fotonya atau tidak
  // Jika tidak ada foto
  if (empty($foto)) {
    $query = "UPDATE tbl_mahasiswa,tbl_login SET tbl_mahasiswa.nama='$nama', tbl_mahasiswa.alamat='$alamat', tbl_mahasiswa.kelas='$kelas', tbl_mahasiswa.jurusan='$jurusan', tbl_mahasiswa.email='$email', tbl_login.username='$email', tbl_login.password='$password' WHERE tbl_mahasiswa.email=tbl_login.username AND npm='$npm'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
  } else { //jika ada foto
    // Cek apakah file foto sebelumnya ada di folder images
    if (file_exists("assets/img/profile/" . $id_npm['foto'])) {
      // Jika foto ada
      if ($id_npm['foto'] != "sttgarut.png") {
        unlink("assets/img/profile/" . $id_npm['foto']); // Hapus file foto sebelumnya yang ada di folder images
      }
    }

    // ganti nama
    $extension = end(explode(".", $foto));
    $tempdir = "assets/img/profile/";
    $namaBaru = "foto" . "_" . $npm . "." . $extension;
    rename($tempdir . $gambar, $tempdir . $namaBaru);

    $query = "UPDATE tbl_mahasiswa,tbl_login SET tbl_mahasiswa.nama='$nama', tbl_mahasiswa.alamat='$alamat', tbl_mahasiswa.kelas='$kelas', tbl_mahasiswa.jurusan='$jurusan', tbl_mahasiswa.email='$email', tbl_mahasiswa.foto='$namaBaru', tbl_login.username='$email', tbl_login.password='$password' WHERE tbl_mahasiswa.email=tbl_login.username AND npm='$npm'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
  }
}

function upload()
{
  global $conn;
  $npm = $_SESSION['npm'];
  $waktu_upload = date('F j, Y');

  $folderUpload = "uploads/$npm";

  # periksa apakah folder tersedia
  if (!is_dir($folderUpload)) {
    # jika tidak maka folder harus dibuat terlebih dahulu
    mkdir($folderUpload, 0777, $rekursif = true);
  }

  $jumlahFile = count($_FILES['file']['name']);

  for ($i = 0; $i < $jumlahFile; $i++) {
    $uploadFile = $_FILES['file'];
    $namaFile = $_FILES['file']['name'][$i];
    $lokasiTmp = $_FILES['file']['tmp_name'][$i];
    $size = $_FILES['file']['size'][$i];

    $extractFile = pathinfo($uploadFile['name'][$i]);

    $sameName = 0;
    $handle = opendir($folderUpload);
    while (false !== ($file = readdir($handle))) {
      if (strpos($file, $extractFile['filename']) !== false)
        $sameName++;
    }

    $type = $extractFile['extension'];
    $newName = empty($sameName) ? $extractFile['basename'] : $extractFile['filename'] . '(' . $sameName . ').' . $extractFile['extension'];

    $lokasiBaru = "{$folderUpload}/{$newName}";
    if ($prosesUpload = move_uploaded_file($lokasiTmp, $lokasiBaru)) {
      $insertfile = mysqli_query($conn, "INSERT INTO tbl_file SET nama_file='$newName', ukuran_file='$size', tipe_file='$type', id_pemilik_file='$npm', waktu_upload='$waktu_upload'");
    }
  }
}

function searchFiles($keyword)
{
  $query = "SELECT * FROM tbl_mahasiswa WHERE nama LIKE '%$keyword%' OR npm LIKE '%$keyword%' OR kelas LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
  return query($query);

  // $query = "SELECT * FROM tbl_file WHERE nama_file LIKE '%$keyword%' OR tipe_file LIKE '%$keyword%' OR ukuran_file LIKE '%$keyword%' OR waktu_upload LIKE '%$keyword%'";
}
