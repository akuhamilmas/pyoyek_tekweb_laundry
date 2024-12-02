<!-- ini bagian menampilkan dat user-->
<div class ="page-content-wrapper">
  <div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="#">Laundry</a></li>
                      <li class="breadcrumb-item active">Data Users</li>
                  </ol>
              </div>
              <h4 class="page-title">Data Users</h4>
          </div>
      </div>
  </div>

    <div class="row">
      <div class="col-12">
        <div class="card m-b-30">
          <div class="card-body">
          <div class="table-responsive">
            <h4 class="mt-0 header-title">
            <!--ini terdapat aksi melakukan penambahan data-->
              <a href="?page=users&aksi=tambah" class="btn btn-primary" style="background-image: linear-gradient(to bottom right, #E8C3FD, #86C5FC);"><i class="fa fa-plus"></i> Tambah data</a>
            </h4>
            <table id="datatable" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Jen. Kel</th>
                  <th>Alamat</th>
                  <th>No. Telp</th>
                  <th>Jabatan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              // menampilkan data users              
              $result = mysqli_query($conn, "SELECT * FROM tb_users ORDER BY userid DESC"); ?>
              <?php $i = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <th>
                    <?php if ($row['userfoto'] != NULL && $row['userfoto'] != "") { ?>
                      <a href="fotouser/<?= $row['userfoto']; ?>" target="_blank"><img src="fotouser/<?= $row['userfoto']; ?>" style="width: 120px;"></a>
                    <?php } ?>
                  </th>
                  <td><?= $row['username']; ?></td>
                  <td><?= $row['nama']; ?></td>
                  <td><?= $row['jk']; ?></td>
                  <td><?= $row['alamat']; ?></td>
                  <td><?= $row['usertelp']; ?></td>
                  <!-- di bawah ini pemecah dimana jika level nya admin maka akan menuju tampilan admin jika tidak akan beralih ke tampilan kasir-->
                  <td><?= ($row['level'] == 'admin') ? 'Admin' : 'Kasir'; ?></td>
                  <td>
                    <!-- ini bagian untuk ikon upload foto, ubah data, delete data-->
                    <a href="?page=users&aksi=foto&id=<?= $row['userid']; ?>" class="btn btn-primary mb-2" style="background-image: linear-gradient(to bottom right, #74DCC4, #4597E9);"><i class="fa fa-image"></i></a>
                    <br>
                    <a href="?page=users&aksi=ubah&id=<?= $row['userid']; ?>" class="btn btn-warning mb-2" style="background-image: linear-gradient(to bottom right, #FDEB82, #F78FAD);"><i class="fa fa-tags"></i></a>
                    <br>
                    <a href="?page=users&aksi=hapus&id=<?= $row['userid']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus ?');" style="background-image: linear-gradient(to bottom right, #FEC194,#FF0061);"><i class="fa fa-trash-o"></i></a>
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
      <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end page title end breadcrumb -->
  </div>
  <!-- container -->
</div>
