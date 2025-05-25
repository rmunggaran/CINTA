<?php
session_start();
require("../config/database.php");
require("../config/function.php");
require("../config/functions.crud.php");

if (isset($_SESSION['id_daftar'])) {
  $siswa = fetch($koneksi, 'daftar', ['id_daftar' => $_SESSION['id_daftar']]);
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PPDB | <?= $setting['nama_sekolah'] ?></title>

    <link rel="shortcut icon" href="../<?= $setting['logo'] ?>" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.css" />
    <link rel="stylesheet" href="../dist/css/costum.css" />
    <link rel="stylesheet" href="../assets/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="../assets/modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="../assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/user.css">

    <script src="../assets/modules/jquery.min.js"></script>
    <script src="../assets/modules/izitoast/js/iziToast.min.js"></script>
    <script src="../assets/modules/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/modules/cleave-js/dist/cleave.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"></script>

    <style>
      .modal-backdrop {
        position: inherit;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 900;
        background-color: #000;
      }
    </style>
  </head>

  <body>
    <div id="app">
      <div class="chating" style="z-index: 99999; width: 50px; padding: 15px; bottom: 0; position: fixed;">
        <a href="https://api.whatsapp.com/send?phone=+62<?= $setting['nolivechat'] ?>&text=<?= $setting['livechat'] ?>">
          <img src="../assets/img/whatsapp.png" width="150">
        </a>
      </div>

      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
          <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
          </form>
          <ul class="navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block"><?= $siswa['nama'] ?></div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="logout.php" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>

        <div class="main-sidebar sidebar-style-2">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand bg-info">
              <img src="../<?= $setting['logo_ppdb'] ?>" width="80" alt="PPDB">&nbsp;
            </div>
            <div class="menu-header">
              <ul>
                <li><a style="color:white" href="." class="btn-logout"><span class="fa fa-home "></span><br>Home</a></li>
                <li><a style="color:white" class="btn-logout" href="?pg=dataku"><span class="fa fa-user-cog "></span><br>Profil</a></li>
                <li><a style="color:white" href="logout.php" class="btn-logout"><span class="fa fa-sign-out-alt"></span><br>Keluar</a></li>
              </ul>
            </div>
            <div class="sidebar-brand sidebar-brand-sm"><a href="#">SM</a></div>
            <?php include "menu.php" ?>
          </aside>
        </div>

        <div class="main-content">
          <section class="section">
            <?php include "content.php"; ?>
          </section>
        </div>

        <footer class="main-footer">
          <div class="footer-left">
            Copyright &copy; <?= date('Y') ?> PPDB
            <div class="bullet"></div> <?= $setting['nama_sekolah'] ?>
          </div>
          <div class="footer-right">
            <a href="https://<?= $setting['web'] ?>">V.1.1</a>
          </div>
        </footer>
      </div>
    </div>

    <!-- General JS Scripts -->
    <script src="../assets/modules/popper.js"></script>
    <script src="../assets/modules/tooltip.js"></script>
    <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../assets/modules/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../assets/modules/datatables/datatables.min.js"></script>
    <script src="../assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="../assets/modules/jquery-ui/jquery-ui.min.js"></script>
    <script src="../assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="../assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../assets/modules/summernote/summernote-bs4.js"></script>

    <!-- Page Specific JS File -->
    <script src="../assets/js/page/modules-datatables.js"></script>
    <script src="../assets/js/page/index-0.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Live Timestamp -->
    <script>
      $(function() {
        setInterval(timestamp, 1000);
      });

      function timestamp() {
        $.ajax({
          url: 'waktu.php',
          success: function(data) {
            $('#timestamp').html(data);
          },
        });
      }
    </script>
  </body>

  </html>

<?php
} else {
  include "login.php";
}
?>