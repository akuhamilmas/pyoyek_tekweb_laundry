<!-- login di gunakan bagai template login id password -->
<?php 

//1. memulai session
session_start();

//2. memanggil koneksi
include "connections/koneksi.php";

// 5.jika tombol login ditekan
if (isset($_POST['login'])) {
  $pesan_error = "";
  //username password di ambil dari input user name dan password di bawah
  $username = htmlentities(strip_tags(trim($_POST["username"])));;
  $pass = htmlentities(strip_tags(trim($_POST["password"])));
    // 6.trus ini cek apakah user lebih dari 0 atau ada di dalam data base maka akan lanjut ke stepp selanjutnya
    // jika tidak akan muncul  pesan error
  $login = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");
  $cekUser = mysqli_num_rows($login);
  if ($cekUser > 0) {
    $row = mysqli_fetch_assoc($login);
    if (password_verify($pass, $row['userpass'])) {
        // 7.ini mengambil data dari username
      $_SESSION['username'] = $username;
      $_SESSION['userid'] = $row['userid'];
      $_SESSION['level'] = $row['level'];
      $_SESSION['tgllogin'] = date('Y-m-d H:i:s');
      $_SESSION['login'] = true;
      // 8.kemudian jika berhasil langsung beralih halaman ke index.php
      echo "
      <script>
        alert('Login berhasil');
        window.location.href = 'index.php';
      </script>
      ";
      
    }else{
      $pesan_error .= "Username / Password anda salah";
    }
  }else{
    $pesan_error .= "Username / Password anda salah";
  }
}else{
  $pesan_error = "";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <link rel="shortcut icon" href="assets/images/logobaru.png" type="image/png"/>
        <title>Login Berbaju Laundry</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <style>
        .accountbg {
            background-image: url('assets/images/bgbaru.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .login-heading {
            font-family: 'Roboto', sans-serif;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-top: 0;
            margin-bottom: 15px;
        }
    </style>

    <body class="fixed-left">
        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mt-0 m-b-15">
                        <a href="login.php"><img src="assets/images/logobaru.png" width="300px"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="login-heading text-center mt-0 m-b-15">Login Bubble Laundry</h4>
                        <!-- 3.ini pesan jika pesan nya tidak kosong maka akan menampilkan notif error -->
                        <?php if(!$pesan_error == "") : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $pesan_error; ?>
                            </div>
                        <?php endif; ?>
                            <!--4. ini merupakan untuk input username dan password -->
                        <form class="form-horizontal m-t-20" action="" method="POST">
                            
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="text" required placeholder="Username" name="username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" required placeholder="Password" name="password">
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit" name="login">Log In</button>
                                </div>
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>