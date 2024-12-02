<?php
    session_start();
    // jika tidak login, kembali ke index.php (halaman login)
    if(!isset($_SESSION['level']) ) { header('location:login.php'); }
?>

<!-- ini merupakan code untuk logout  -->
<?php

session_start();
// menghapus session
session_unset();
session_destroy();

echo "
<script>
  alert('Logout berhasil');
  window.location.href = 'login.php';
</script>
";

?>
