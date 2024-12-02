<!-- menampilkan data jenis laundry -->
<div class ="page-content-wrapper">
  <div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="#">Laundry</a></li>
                      <li class="breadcrumb-item active">Data Jenis Laundry</li>
                  </ol>
              </div>
              <h4 class="page-title">Data Jenis Laundry</h4>
          </div>
      </div>
  </div>

    <div class="row">
      <div class="col-12">
        <div class="card m-b-30">
          <div class="card-body">
          <div class="table-responsive">
            <h4 class="mt-0 header-title">
              <!--terdapat klik tambah data  -->
              <a href="?page=jenis&aksi=tambah" class="btn btn-primary" style="background-image: linear-gradient(to bottom right, #E8C3FD, #86C5FC);"><i class="fa fa-plus"></i> Tambah data</a>
            </h4>
            <table id="datatable" class="table table-bordered">
              <thead>
                <tr>
                <!--header tampilan tabel  -->
                  <th>#</th>
                  <th>Jenis Layanan Laundry</th>
                  <th>Lama Proses</th>
                  <th>Tarif per Kg</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              // menampilkan data jenis laundry ke dalam header             
              $result = mysqli_query($conn, "SELECT * FROM tb_jenis"); 
              ?>
              <?php $i = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $row['jenis_laundry']; ?></td>
                  <td><?= $row['lama_proses']; ?> Hari</td>
                  <td>Rp. <?= number_format($row['tarif']); ?></td>
                  <td>
                    <!-- terdapat tombol ubah/ aksi dan hapus-->
                    <a href="?page=jenis&aksi=ubah&id=<?= $row['kd_jenis']; ?>" class="btn btn-warning mb-2" style="background-image: linear-gradient(to bottom right, #FDEB82, #F78FAD);"><i class="fa fa-tags"></i></a>
                    <br>
                    <a href="?page=jenis&aksi=hapus&id=<?= $row['kd_jenis']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus ?');" style="background-image: linear-gradient(to bottom right, #FEC194,#FF0061);"><i class="fa fa-trash-o"></i></a>
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
