<?php 

// ambil id transaksi yang dipilih
$id = $_GET['id'];

// ubah status pengambilan baju, jadi yang berawal nilai nya 0 atau belum di ambil maka ketika kita klik akan berubah mejadi 1
$result = mysqli_query($conn, "UPDATE tb_laundry SET `status_pengambilan` = 1 WHERE id_laundry = '$id'");

if ($result) {
  echo "
  <script>
    alert('Baju milik ID transaksi $id telah diambil');
    window.location.href = '?page=laundry';
  </script>
";
}
?>