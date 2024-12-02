<?php
    session_start();
    // jika tidak login, kembali ke index.php (halaman login)
    if(!isset($_SESSION['level']) ) { header('location:login.php'); }
?>

<!-- dashboard -->
<div class="page-content-wrapper">
<div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="index.php">Laundry</a></li>
                      <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
              </div>
              <h4 class="page-title">Dashboard</h4>
          </div>
          <div class="row">
          <!-- Column -->
            
          <!-- card untuk menampilkan banyak pelanggan -->
          <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="card m-b-30" style="background-color: blanchedalmond;">
                  <div class="card-body">
                      <div class="d-flex flex-row">
                          <div class="col-3 align-self-center">
                              <div class="round">
                                  <i class="mdi mdi-account-multiple-plus"></i>
                              </div>
                          </div>
                          <div class="col-8 text-center align-self-center">
                              <div class="m-l-1 ">
                                 <!-- jumlah data pelanggan -->
                                  <h5 class="mt-0 round-inner"><?= $jmlDataPelanggan; ?></h5>
                                  <p class="mb-0 text-muted">Data Pelanggan</p>
                              </div>
                              <!-- jika button more info dilik, akan pindah ke page data pelanggan -->
                              <a href="?page=pelanggan" style="background-color: slateblue;" class="btn btn-primary mt-1">More Info</a>
                          </div>
                          <div class="col-10"></div>                             
                      </div>
                  </div>
              </div>
          </div>

        <!-- jika levelnya admin, maka yang akan ditampilkan di dashboard : -->
        <?php if($_SESSION['level'] == 'admin') : ?>

          <!-- card untuk data user -->
          <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="card m-b-30" style="background-color: blanchedalmond;">
                  <div class="card-body">
                      <div class="d-flex flex-row">
                          <div class="col-3 align-self-center">
                              <div class="round">
                                  <i class="mdi mdi-account-multiple-plus"></i>
                              </div>
                          </div>
                          <div class="col-8 text-center align-self-center">
                              <div class="m-l-1 ">
                                  <h5 class="mt-0 round-inner"><?= $jmlDataUser; ?></h5> 
                                   <!-- jumlah data user -->
                                  <p class="mb-0 text-muted">Data User</p>
                              </div>
                              <!-- jika button more info dilik, akan pindah ke page data user -->
                              <a href="?page=users" style="background-color: slateblue;" class="btn btn-primary mt-1">More Info</a>
                          </div>
                          <div class="col-10"></div>                             
                      </div>
                  </div>
              </div>
          </div>

        <?php endif; ?>

          <!-- card untuk data transaksi -->
          <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="card m-b-30" style="background-color: blanchedalmond;">
                  <div class="card-body">
                      <div class="d-flex flex-row">
                          <div class="col-3 align-self-center">
                              <div class="round ">
                                  <i class="mdi mdi-basket"></i>
                              </div>
                          </div>
                          <div class="col-8 align-self-center text-center">
                              <div class="m-l-10 ">
                                  <h5 class="mt-0 round-inner"><?= $jmllaundry; ?></h5>
                                   <!-- jumlah transaksi laundry -->
                                  <p class="mb-0 text-muted">Transaksi Laundry</p>
                              </div>
                              <!-- jika button more info dilik, akan pindah ke page laundry -->
                              <a href="?page=laundry" style="background-color: slateblue;" class="btn btn-primary mt-1">More Info</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- card untuk data pengeluaran -->
          <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="card m-b-30" style="background-color: blanchedalmond;">
                  <div class="card-body">
                      <div class="d-flex flex-row">
                          <div class="col-3 align-self-center">
                              <div class="round">
                                  <i class="mdi mdi-cash-multiple"></i>
                              </div>
                          </div>
                          <div class="col-8 align-self-center text-center">
                              <div class="m-l-10">
                                  <h5 class="mt-0 round-inner"><?= $jmlpengeluaran; ?></h5>
                                   <!-- jumlah data pengeluaran -->
                                  <p class="mb-0 text-muted">Data Pengeluaran</p>
                              </div>
                              <!-- jika button more info dilik, akan pindah ke page pengeluaran -->
                              <a href="?page=pengeluaran" style="background-color: slateblue;" class="btn btn-primary mt-1">More Info</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div> 

         <!-- card untuk menampilkan data user yang sedang log in -->
         <div class="card mb-3" style="max-width: 520px; background-color: blanchedalmond;">
            <div class="row g-0">
                <div class="col-md-4">
                
                <!-- jika user memiliki foto, maka foto ditampilkan -->
                <?php if($tampilusers['userfoto'] !== "") { ?>
                    <img src="fotouser/<?= $tampilusers['userfoto']; ?>" class="img-fluid rounded-start" alt="..." style="width: 500px;">
                <!-- jika tidak -->
                <?php }else{ ?>
                    <img src="fotouser/default.svg" class="img-fluid rounded-start" alt="...">
                <?php } ?>

                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h6 class="card-title">Akun Yang Sedang Login</h6>
                    <p class="card-text">
                         <!-- data akun yang sedang login di ambil dari index.php 5.bagian ambil username dan password -->
                        <b>Username : </b><?= $tampilusers['username'] ?><br>
                        <b>Nama :</b> <?= $tampilusers['nama'] ?><br>
                        <b>Jabatan :</b> <?= $tampilusers['level'] ?>
                    </p>
                    <p class="card-text"><small class="text-muted">Tanggal & jam login : <?= $_SESSION['tgllogin']; ?></small></p>
                </div>
                </div>
            </div>
            </div>
      </div>
  </div>
  </div>
</div>