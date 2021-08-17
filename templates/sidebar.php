<?php

// cek upload file
if (isset($_POST["upload"])) {

    // cek apakah data berhasil di tambahkan atau tidak
    if (upload($_POST) > 0) {
        echo "
    <script>
      alert('data gagal ditambahkan!');
      document.href = 'myfiles.php';
    </script>
  ";
    } else {
        echo "
      <script>
        alert('data berhasil ditambahkan!');
        document.href = 'myfiles.php';
      </script>
    ";
    }
}

?>

<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="index.php">
        <img src="assets/img/logo/logo-vertical-light-background.svg" alt="." draggable="FALSE">
      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="fas fa-home text-primary"></i>
              <span class="nav-link-text">Home</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="profil.php">
              <i class="ni ni-single-02 text-yellow"></i>
              <span class="nav-link-text">Profil</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="myfiles.php">
              <i class="ni ni-folder-17 text-orange"></i>
              <span class="nav-link-text">My Files</span>
            </a>
          </li>
          <?php
          if ($_SESSION['role'] == '1') { ?>
            <li class="nav-item">
              <a class="nav-link" href="tabel_user.php">
                <i class="fas fa-users text-info"></i>
                <span class="nav-link-text">Data Users</span>
              </a>
            </li>
          <?php } else {
          }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="trash.php">
              <i class="fas fa-trash-restore-alt"></i>
              <span class="nav-link-text">Trash</span>
            </a>
          </li>
        </ul>
        <!-- Menu Upload -->

        <!-- Divider -->
        <hr class="my-3">
        <!-- End Divider -->

        <!-- Heading -->
        <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">Upload</span>
        </h6>
        <!-- Emd Heading -->

        <!-- Menu Upload -->
        <form action="" method="post" enctype="multipart/form-data">
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="" target="" onclick="uploadFileAll()">
                <i class="ni ni-cloud-upload-96"></i>
                <span class="nav-link-text">Upload File</span>
                <input type="file" name="file[]" id="fileAll" class="custom-file-input" onchange="submitForm()" multiple>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" target="" onclick="uploadFileDoc()">
                <i class="fas fa-file-word"></i>
                <span class="nav-link-text">Upload Dokumen</span>
                <input type="file" name="file[]" id="fileDoc" class="custom-file-input" onchange="submitForm()" multiple accept=".doc,.docx,.pdf,.csv.,xlsx.,ppt">
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" target="" onclick="uploadFileAudio()">
                <i class="fas fa-music"></i>
                <span class="nav-link-text">Upload Musik</span>
                <input type="file" name="file[]" id="fileAudio" class="custom-file-input" onchange="submitForm()" multiple accept="audio/*">
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" target="" onclick="uploadFileImage()">
                <i class="far fa-image"></i>
                <span class="nav-link-text">Upload Foto</span>
              </a>
              <input type="file" name="file[]" id="fileImage" class="custom-file-input" onchange="submitForm()" multiple accept="image/*">
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" target="" onclick="uploadFileVideo()">
                <i class="fas fa-film"></i>
                <span class="nav-link-text">Upload Video</span>
              </a>
              <input type="file" name="file[]" id="fileVideo" class="custom-file-input" onchange="submitForm()" multiple accept="video/*">
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" target="" onclick="uploadFileArchive()">
                <i class="fas fa-archive"></i>
                <span class="nav-link-text">Upload File Archive</span>
                <input type="file" name="file[]" id="fileArchive" class="custom-file-input" onchange="submitForm()" multiple accept=".zip,.rar,.7zip">
              </a>
            </li>
          </ul>
          <button type="submit" name="upload" id="submit" class="custom-button-submit">Submit</button>
        </form>
        <!-- End Menu upload -->
      </div>
    </div>
  </div>
</nav>