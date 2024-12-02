<?php
$masuk = 0;
$keluar = 0;
$total = 0;

// menampilkan laporan berdasarkan range tanggal
if (isset($_POST['cari'])) {
  // menampilkan data transaksi
  $tglAwal = $_POST['tanggalawal'];
  $tglAkhir = $_POST['tanggalakhir'];
  $query = "SELECT * FROM tb_laporan WHERE tgl_laporan BETWEEN '$tglAwal' AND '$tglAkhir'";
  $result = mysqli_query($conn, $query); 
} else {
  // menampilkan data transaksi
  $query = "SELECT * FROM `tb_laporan`";
  $result = mysqli_query($conn, $query); 
}
?>


<!-- menampilkan data laporan -->
<div class ="page-content-wrapper">
  <div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="#">Laundry</a></li>
                      <li class="breadcrumb-item active">Data Laporan</li>
                  </ol>
              </div>
              <!-- <h4 class="page-title">Data Laporan Pemasukan dan Pengeluaran</h4> -->
          </div>
      </div>
  </div>

    <div class="row">
      <div class="col-12">
        <div class="card m-b-30">
          <div class="card-body">

          <!-- inputan untuk tanggal -->
          <form class="form-inline mr-auto w-100 navbar-search" action="" method="POST">
            <div class="input-group">
              <label for="" class="form-control-label">Tanggal Awal</label>
                <input type="date" class="form-control bg-light border-0 small ml-3 mr-3" name="tanggalawal" id="tanggalawal" required>
              
              <label for="" class="form-control-label">Tanggal Akhir</label>
                <input type="date" class="form-control bg-light border-0 small ml-3" name="tanggalakhir" id="tanggalakhir" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="cari">
                        <i class="fa fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
          </form>

            <div class="table-responsive">
            <h4 class="mt-0 header-title" style="text-align: right;">
              <a href="" class="btn btn-primary" style="background-image: linear-gradient(to bottom right, #5C6BF1, #C000FF);" onclick="printContent('laporan');">Cetak Laporan</a>
            </h4>
            <div class="" id="laporan">
            
            <h4 class="mt-0 header-title" style="text-align: center;">Data Laporan Pemasukan dan Pengeluaran</h4>
          <!-- di bawah ini untuk menampilkan laporan -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Catatan</th>
                  <th>Pemasukan</th>
                  <th>Pengeluaran</th>
                  <!-- <th>Aksi</th> -->
                </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $row['tgl_laporan']; ?></td>
                  <td><?= ($row['ket_laporan'] == 1 ? 'Pemasukan' : 'Pengeluaran'); ?></td>
                  <td><?= $row['catatan']; ?></td>
                  <td>Rp. <?= number_format($row['pemasukan']); ?></td>
                  <td>Rp. <?= number_format($row['pengeluaran']); ?></td>
                  <!-- <td>
                    // jika id tidak kosong akan menampilkan id laundry
                    <?php if(!empty($row['id_laundry'])) { ?>
                      <a href="?page=laundry&aksi=detail&id=<?= $row['id_laundry']; ?>" class="btn btn-primary mb-2"><i class="fa fa-eye"></i></a>
                    <?php }elseif(!empty($row['id_pengeluaran'])) { ?> //jika id pengeluaran tidak kosong maka akan menampilkan id pengeluaran
                      <a href="?page=pengeluaran&aksi=detail&id=<?= $row['id_pengeluaran']; ?>" class="btn btn-primary mb-2"><i class="fa fa-eye"></i></a>
                    <?php } ?>
                  </td> -->
                </tr>
                  <!-- menghitung pemasukan dan pengeluaran -->     
              <?php
                $masuk = $masuk+$row['pemasukan'];
                $keluar = $keluar+$row['pengeluaran'];
                $total = $masuk - $keluar;

                $i++;
                endwhile;
              ?>
              </tbody>
              <tbody>
              <tr>
                <!--di bawh ini untuk menampilkan data pemasukan dan pengeluaran -->
                 <th colspan="4" style="text-align: center;">Total Pemasukan dan Pembayaran</th>
                 <td>Rp. <?= number_format($masuk); ?></td>
                 <td colspan="2">Rp. <?= number_format($keluar); ?></td>
               </tr>
              </tbody>
              <tbody>
                <tr>
                  <th colspan="4" style="text-align: center;">Saldo Akhir</th>
                  <td colspan="3">Rp. <?= number_format($total); ?></td>
                </tr>
              </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end page title end breadcrumb -->
  </div>
  <!-- container -->
</div>