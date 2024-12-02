<!-- menampilkan data seluruh transaksi laundry -->
<div class ="page-content-wrapper">
  <div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="#">Laundry</a></li>
                      <li class="breadcrumb-item active">Data Transaksi Laundry</li>
                  </ol>
              </div>
              <h4 class="page-title">Data Transaksi Laundry</h4>
          </div>
      </div>
  </div>

    <div class="row">
      <div class="col-12">
        <div class="card m-b-30">
          <div class="card-body">
          <div class="table-responsive">
            <h4 class="mt-0 header-title">
              <!-- untuk menambah data baru -->
              <a href="?page=laundry&aksi=tambah" class="btn btn-primary" style="background-image: linear-gradient(to bottom right, #E8C3FD, #86C5FC);"><i class="fa fa-plus"></i> Tambah Transaksi Laundry</a>
            </h4>
            <h4 class="mt-0 header-title">
              <!-- button menampilkan data yang sudah lunas -->
              <a href="?page=laundry&aksi=laundrylunas" class="btn btn-success" style="background-image: linear-gradient(to bottom right, #B7EEB2, #2CA21C);">Status Lunas</a>
              <!-- button untuk menampilkan data yang belum lunas -->
              <a href="?page=laundry&aksi=laundrybelumlunas" class="btn btn-danger" style="background-image: linear-gradient(to bottom right, #FEC194,#FF0061);">Status Belum Lunas</a>
            </h4>
            <!-- tabel untuk menampilkan data -->
            <table id="datatable" class="table table-bordered">
              <thead>
                <tr>
                  <!-- header tabel -->
                  <th>#</th>
                  <th>ID</th>
                  <th>Pelanggan</th>
                  <th>Jenis Layanan</th>
                  <th>Tgl. Terima</th>
                  <th>Tgl. Selesai</th>
                  <th>Status</th>
                  <th>Status Baju</th>
                  <th>Total Bayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              // menampilkan data transaksi laundry di dalam tabel 
              $query = "SELECT * FROM `tb_laundry` INNER JOIN `tb_pelanggan` ON `tb_laundry`.`pelangganid` = `tb_pelanggan`.`pelangganid` INNER JOIN `tb_users` ON `tb_users`.`userid` = `tb_laundry`.`userid` INNER JOIN `tb_jenis` ON `tb_jenis`.`kd_jenis` = `tb_laundry`.`kd_jenis` ORDER BY `tb_laundry`.`id_laundry` DESC";
              $result = mysqli_query($conn, $query); ?>
              <?php $i = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $row['id_laundry']; ?></td>
                  <td><?= $row['pelanggannama']; ?></td>
                  <td><?= $row['jenis_laundry']; ?></td>
                  <td><?= $row['tgl_terima']; ?></td>
                  <td><?= $row['tgl_selesai']; ?></td>
                  <!-- menampilkan status lunas/belum lunas -->
                  <td><?= ($row['status_pembayaran'] == 1) ? '<nav class="badge badge-success" style="background-image: linear-gradient(to bottom right, #B7EEB2, #2CA21C);">Lunas</nav>' : '<nav class="badge badge-danger" style="background-image: linear-gradient(to bottom right, #FEC194,#FF0061);">Belum lunas</nav>'; ?></td>
                  <td>

                    <!-- menampilkan status dimabil/belum diambil -->
                    <!-- jika belum diambil, maka statusnya bisa diupdate menjadi sudah diambi; -->
                    <?php if($row['status_pengambilan'] == 0) { ?>
                      <a href="?page=laundry&aksi=diambil&id=<?= $row['id_laundry']; ?>" style="background-image: linear-gradient(to bottom right, #FDEB82, #F78FAD);" class="btn btn-warning <?= ($row['status_pembayaran'] == 0) ? 'disabled' : ''; ?>" onclick="return confirm('Apakah anda yakin Baju sudah diambil?');">Belum Diambil</i></a>
                    
                    <!-- jika sudah diambil, maka status didisable/tidak dapat diupdate -->
                    <?php }elseif($row['status_pengambilan'] == 1){ ?>
                      <a href="#" class="btn btn-warning disabled" style="background-image: linear-gradient(to bottom right, #FDEB82, #F78FAD);">Sudah diambil</i></a>
                    <?php } ?>

                  </td>
                  <td>Rp. <?= number_format($row['totalbayar']); ?></td>
                  <td>
                    <!-- jika sudah lunas, akan muncul button untuk cetak invoice dan button detail -->
                    <?php if($row['status_pembayaran'] == 1) { ?>
                      
                      <a href="?page=laundry&aksi=detail&id=<?= $row['id_laundry']; ?>" class="btn btn-primary mb-2" style="background-image: linear-gradient(to bottom right, #74DCC4, #4597E9);"><i class="fa fa-eye"></i> Detail</a>

                      <a href="page/cetak_transaksi.php?id=<?= $row['id_laundry']; ?>" class="btn btn-success" target="_blank" style="background-image: linear-gradient(to bottom right, #5C6BF1, #C000FF);"><i class="fa fa-download"> Cetak</i></></a>

                    <!-- jika status pembayaran = 0, maka hanya bisa menampilkan tombol detail, lunasi transaksi, hapus transaksi -->
                    <?php }elseif($row['status_pembayaran'] == 0){ ?>

                      <a href="?page=laundry&aksi=detail&id=<?= $row['id_laundry']; ?>" class="btn btn-primary mb-2"><i class="fa fa-eye"></i> Detail</a>
                      <!-- button untuk update status pembayaran -->
                      <a href="?page=laundry&aksi=lunasi&id=<?= $row['id_laundry']; ?>" class="btn btn-success mb-2" onclick="return confirm('Apakah anda yakin transaksi laundry sudah lunas ?');" style="background-image: linear-gradient(to bottom right, #B7EEB2, #2CA21C);"><i class="fa fa-money"></i> Lunasi</a>
                      <a href="?page=laundry&aksi=hapus&id=<?= $row['id_laundry']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus ?');" style="background-image: linear-gradient(to bottom right, #FEC194,#FF0061);"><i class="fa fa-trash-o"></i> Hapus</a>
                    
                    <?php } ?>
                  </td>
                </tr>
              <?php $i++; ?>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
