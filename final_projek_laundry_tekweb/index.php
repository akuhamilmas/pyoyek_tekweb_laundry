
<?php
    session_start();
    // jika tidak login, kembali ke index.php (halaman login)
    if(!isset($_SESSION['level']) ) { header('location:login.php'); }
?>
<?php 

//1. memulai session
session_start();

// 2.menghilangkan undifine error index
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// 3.membuat keamanan, jika belum login maka kembali ke login.php
if (!isset($_SESSION['login'])) {
  header('location: login.php');
}

//4. menyertakan koneksi.php
include "connections/koneksi.php";

// 5.menampilkan data user yang sedang login, ini terdapat di menu dashboard
$id = $_SESSION['userid'];
$users = mysqli_query($conn, "SELECT * FROM tb_users WHERE userid = '$id'");
$tampilusers = mysqli_fetch_assoc($users);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"
    />
    <?php if($_SESSION['level'] == 'admin') : ?>
      <title>Admin Bubble Laundry</title>
        <?php endif; ?>
    <title>Admin Bubble Laundry</title>
    
    <?php
    // ini untuk memanggil libary libary 
    require_once("libary/libindex.php")
    ?>
  </head>

  <body class="fixed-left">
    <div id="wrapper">
      <!-- membuat menu di kiri layar -->
      <div class="left side-menu" style="background-color: #FFFFDD;">
        <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
          <i class="ion-close"></i>
        </button>

        <!-- LOGO -->
        <div class="topbar-left">
          <div class="text-center">
            <a href="index.php"><img src="assets/images/logobaru.png" width="160px"></a>
          </div>
        </div>

        <div class="sidebar-inner slimscrollleft">

          <!-- memasukkan menu.php -->
          <?php include "connections/menu.php"; ?>

          <div class="clearfix"></div>
        </div>
      </div>

      <div class="content-page background">
        <div class="content">
          <!-- Top Bar Start -->
          <div class="topbar">
            <nav class="navbar-custom" style="background-color: pink;">
              <ul class="list-inline float-right mb-0">
                <li class="list-inline-item dropdown notification-list">
                  <a
                    class="
                      nav-link
                      dropdown-toggle
                      arrow-none
                      waves-effect
                      nav-user
                    "
                    data-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-haspopup="false"
                    aria-expanded="false"
                  >

                  <!-- jika foto profile ada nampilin gambar jika ngga ada maka akan nampilin bunder default-->
                  <?php if(!empty($tampilusers['userfoto'])) { ?>
                    <img
                      src="fotouser/<?= $tampilusers['userfoto']; ?>";
                      alt="user"
                      class="rounded-circle"
                    />
                  <?php }else{ ?>
                    <img
                      src="fotouser/default.svg";
                      alt="user"
                      class="rounded-circle"
                    />
                  <?php } ?>

                  </a>
                  <div
                    class="dropdown-menu dropdown-menu-right profile-dropdown"
                  >
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                      <h5>Welcome <?= $tampilusers['username']; ?></h5>
                    </div>
                    
                    <a class="dropdown-item" href="?page=profile&id=<?= $_SESSION['userid']; ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i>Profile</a>
                    
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah anda ingin logout ?');"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                  </div>
                </li>
              </ul>

              <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                  <button
                    class="
                      button-menu-mobile
                      open-left
                      waves-light waves-effect
                    "
                  >
                    <i class="mdi mdi-menu"></i>
                  </button>
                </li>
              </ul>

              <div class="clearfix"></div>
            </nav>
          </div>
          <!-- Top Bar End -->

        <!-- memasukkan konten-->
        <?php include "connections/konten.php"; ?>
       
        <!-- Page content Wrapper -->
        </div>
        <!-- content -->

        <!-- <footer class="footer">
          ©
          <?= date('Y'); ?>
          <?php 
          echo var_dump($id);
          ?>
          Bubble Laundry.
        </footer> -->
      </div>
      <!-- End Right content here -->
    </div>
  </body>
</html>
