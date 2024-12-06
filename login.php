<?php include 'koneksi.php'; session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKK 2024 | Website Galery Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-login">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-5">
               <div class="card text-white p-5">
                <div class="card-body">
                    <h4 class="card-title">Halaman Login</h4>
                    <p class="card-title">Login Akun</p>
                    <?php
                     //ambil data yang di kirim kan oleh <form> dengan method post
                     $submit=@$_POST['submit']; // @ tsb untuk menutupi teks eror
                     if ($submit=='Login'){
                        $username=$_POST['Username'];
                        $password=md5($_POST['Password']);
                        // cek apakah username dan password yang di <input> ada dalam database
                        $sql=mysqli_query($conn, "SELECT * FROM user WHERE Username='$username' AND Password='$password'");
                        $cek=mysqli_num_rows($sql);
                        if ($cek!=0) { // tanda "!=" artinya tidak sama ...
                            // ambil data dari database untuk membuat session
                            $sesi=mysqli_fetch_array($sql);
                            echo 'Login Berhasil!!!';
                            $_SESSION['username']=$sesi['Username'];
                            $_SESSION['userid']=$sesi['UserID'];
                            $_SESSION['email']=$sesi['Email'];
                            $_SESSION['namalengkap']=$sesi['NamaLengkap'];
                            echo '<meta http-equiv="refresh" content="0.8; url=./">';
                        }else {
                            echo 'Login Gagal!!';
                            echo '<meta http-equiv="refresh" content="0.8; url=login.php">';
                        }
                     }

                    ?>
                    <form action="login.php" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="Username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="Password" required>
                </div>
                <input type="submit" value="Login" class="btn-danger my-3" name="submit">
                <p>Belum Punya Akun? <a href="daftar.php" class="link-danger">Daftar Sekarang</a></p>
               </form>
                </div>
               </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>