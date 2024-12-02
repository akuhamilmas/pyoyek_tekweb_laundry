<?php

// jika tombol tambah ditekan
if (isset($_POST['tambah'])) {
  // mengambil input user
  $idlaundry = $_POST['id_laundry'];
  $pelangganid = htmlentities(strip_tags(trim($_POST["pelangganid"])));
  $userid = htmlentities(strip_tags(trim($_POST["userid"])));
  $jenis = htmlentities(strip_tags(trim($_POST["id_jenis"])));
  $tarif = htmlentities(strip_tags(trim($_POST["tarif"])));
  $tgl_selesai = htmlentities(strip_tags(trim($_POST["tgl_selesai"])));
  $jml_kilo = htmlentities(strip_tags(trim($_POST["jml_kilo"])));
  $totalbayar = htmlentities(strip_tags(trim($_POST["totalbayar"])));
  $catatan = htmlentities(strip_tags(trim($_POST["catatan"])));
  $status = htmlentities(strip_tags(trim($_POST["status"]))); // status pembayaran
  $status_pengambilan = 0;
  $tgl_terima = date('Y-m-d');
  $ket_laporan = 1;
  $pesan_error = "";

  // input ke tb transaksi di database
  $query = "INSERT INTO `tb_laundry` (`id_laundry`, `pelangganid`, `userid`, `kd_jenis`, `tgl_terima`, `tgl_selesai`, `jml_kilo`, `catatan`, `totalbayar`, `status_pembayaran`,`status_pengambilan`) VALUES ('$idlaundry', '$pelangganid', '$userid', '$jenis', '$tgl_terima', '$tgl_selesai', '$jml_kilo', '$catatan', '$totalbayar', '$status','$status_pengambilan')";
  $result = mysqli_query($conn, $query);

  // jika sudah lunas, maka input data transaksi ke tb_laporan
  if ($status == 1) {
    mysqli_query($conn, "INSERT INTO `tb_laporan` (`id_laporan`, `tgl_laporan`, `ket_laporan`, `catatan`, `id_laundry`, `pemasukan`) VALUES ('', '$tgl_terima', '$ket_laporan', '$catatan', '$idlaundry', '$totalbayar')");
  }
  
  // pesan jika transaksi laundry berhasil/gagal disimpan
  if ($result) {
    echo "
      <script>
        alert('Transaksi $idlaundry berhasil ditambahkan');
        window.location.href = '?page=laundry';
      </script>
    ";
  }else{
    $pesan_error .= "Data gagal disimpan !";
  }

}else{
  $pesan_error = "";
  $pelangganid = "";
  $jenis = "";
  $tarif = "";
  $tgl_selesai = "";
  $jml_kilo = "";
  $totalbayar = "";
  $catatan = "";
  $status = "";
}

?>

<div class="page-content-wrapper">
<div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                    <!-- jika tulisan laundry diklik, maka akan pindah ke index.php  -->
                      <li class="breadcrumb-item"><a href="index.php">Laundry</a></li>
                      <li class="breadcrumb-item active">Data Transaksi Laundry</li>
                      <li class="breadcrumb-item active">Tambah</li>
                  </ol>
              </div>
              <h4 class="page-title">Tambah Transaksi Laundry</h4>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-12">

      <?php if ($pesan_error !== "") : ?>
        <div class="alert alert-danger" role="alert">
          <?= $pesan_error; ?>
        </div>
      <?php endif; ?>

          <!-- card untuk tambah data transaksi -->
          <form action="" method="post">
          <div class="card m-b-100">
            <div class="card-body">
            <!-- mengambil id dari user yang menginputkan transaksi secara hidden -->
            <input type="hidden" name="userid" value=<?= $_SESSION['userid']; ?>>

            <?php 
            // mencari id_laundry secara otomatis
            $q = mysqli_query($conn, "SELECT MAX(RIGHT(id_laundry,4)) AS kd_max FROM tb_laundry");
            $jml = mysqli_num_rows($q);
            $kd = "";
            if ($jml > 0) {
              while ($result = mysqli_fetch_assoc($q)) {
                $tmp = ((int)$result['kd_max']) + 1;
                $kd = sprintf("%04s", $tmp);
              }
            } else {
              $kd = "0001";
            }
            $id_laundry = 'LD-' . $kd;
            ?>
            <!-- menginputkan id laundry yang telah digenerate secara hidden -->
            <input type="hidden" name="id_laundry" value="<?= $id_laundry; ?>">
            
            <!-- input nama pelanggan dari data pelanggan yang sudah ada-->
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                <div class="col-sm-10">
                  <select name="pelangganid" class="select2 form-control">
                  <?php
                  // query di bawah ini untuk menampilkan selectoption atau combo box milik pelanggan
                    $query2 = mysqli_query($conn, "SELECT * FROM tb_pelanggan");
                    while ($pelanggan = mysqli_fetch_assoc($query2)) :
                    if ($pelanggan['pelangganid'] == $pelangganid) { ?>
                      <option value="<?= $pelanggan['pelangganid']; ?>" selected><?= $pelanggan['pelanggannama']; ?></option>
                    <?php }else{ ?>
                      <option value="<?= $pelanggan['pelangganid']; ?>"><?= $pelanggan['pelanggannama']; ?></option>
                    <?php } ?>
                    <?php endwhile; ?>
                  </select>
                </div>
              </div>        
                      <!-- menampilkan pilihan jenis laundry dari database jenis laundry -->
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Laundry</label>
                <div class="col-sm-10">
                  <!-- jenis() => function javascript -->
                  <!-- onchange => jika dipilih maka fungsi jenis dijalankan -->
                  <select class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" name="id_jenis" id="id_jenis" onchange="jenis();">
                  <option>--Pilih jenis---</option>
                  <?php 
                  // di bawah ini untuk memanggil data yang terdapat di data jenis laundry
                  $query = mysqli_query($conn, "SELECT * FROM tb_jenis");
                  while ($result = mysqli_fetch_assoc($query)) :
                  if ($result['kd_jenis'] == $jenis) { ?>
                    <option value="<?= $result['kd_jenis']; ?>" selected><?= $result['jenis_laundry']; ?></option>
                  <?php }else{ ?>
                    <option value="<?= $result['kd_jenis']; ?>"><?= $result['jenis_laundry']; ?></option>
                  <?php } ?>
                  <?php endwhile; ?>
                  </select>
                </div>
              </div>
              <!-- di bawah ini menampilkan tarif-->
              <!-- tarif dibuat read only dan terisi otomatis -->
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Tarif (Hari)</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="tarif" name="tarif" value="<?= $tarif; ?>" required readonly/>
                </div>
              </div>
              <!-- di bawah ini membuat menampilkan data selesai-->
              <!-- tanggal selesai dibuat read only dan terisi otomatis -->
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Tgl. Selesai</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="tgl_selesai" name="tgl_selesai" value="<?= $tgl_selesai; ?>" required readonly />
                </div>
              </div>
              <!-- di bawah ini membuat inputan jumlah kilo laundry-->
              <div class="form-group row">
                <label for="example-number-input" class="col-sm-2 col-form-label">Jumlah (Kg)</label>
                <div class="col-sm-10">
                  <!-- onkeyup, ketika berat sudah diinput, otomatis menghitung total bayar dan ditampilkan -->
                  <input class="form-control" type="number" id="jml_kilo" name="jml_kilo" value="<?= $jml_kilo; ?>" onkeyup="sum();" required/>
                </div>
              </div>
              <!-- di bawah ini membuat tampilan total bayar yang dapat dari tarif*kilo-->
              <!-- total bayar dibuat read only dan terisi otomatis -->
              <div class="form-group row">
                <label for="example-number-input" class="col-sm-2 col-form-label">Total Bayar</label>
                <div class="col-sm-10">
                  <input class="form-control"type="number" value="<?= $totalbayar; ?>" id="totalbayar" name="totalbayar" readonly required/>
                </div>
              </div>
                  <!-- di bawah ini membuat input untuk catatan-->
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Catatan</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="example-text-input" name="catatan" cols="20" rows="5" placeholder="Masukkan catatan" required><?= $catatan; ?></textarea>
                </div>
              </div>
              <!-- di bawah ini untuk input status pembayaran -->
              <!-- menampilkan pilihan lunas/belum lunas -->
              <!-- kalau lunas valuenya di database = 1, kalau belum lunas = 2 -->
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select name="status" class="select2 form-control">
                    <?php if($status == 1) { ?>
                      <option value=1 selected>Lunas</option>
                      <option value=0>Belum lunas</option>
                    <?php }elseif($status == 2) { ?>
                      <option value=1>Lunas</option>
                      <option value=0 selected>Belum lunas</option>
                    <?php }else{ ?>
                      <option value=0>Belum lunas</option>
                      <option value=1>Lunas</option>
                    <?php } ?>
                  </select>
                </div>
              </div> 
              <!-- jika button tambah diklik -->
              <button type="submit" name="tambah" class="btn btn-primary tambah" onclick="return confirm('Apakah data yang anda masukkan sudah benar ?');">Tambah</button>
              <!-- jika tombol kembali diklik, akan ke page pelanggan -->
              <a href="?page=pelanggan" class="btn btn-warning">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<br>
<?php
    // ini untuk memanggil libary libary  
    require_once("libary/liblaundry.php")
    ?>