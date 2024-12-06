<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKK 2024 | Website Galery Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-daftar">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-5">
               <div class="card text-white p-5">
                <div class="card-body">
                    <h4 class="card-title">Halaman Daftar</h4>
                    <p class="card-title">Daftar Akun</p>
                    <font color="red">
                    <?php
                        $submit=@$_POST['submit'];
                        if($submit=='Daftar'){
                            $username=@$_POST['Username'];
                            $password=md5(@$_POST['Password']);
                            $email=@$_POST['Email'];
                            $nama_lengkap=@$_POST['NamaLengkap'];
                            $alamat=@$_POST['Alamat'];
                            //mengecek apakah user mendaftar menggunakan data yang sudah ada atau belum
                            $cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE Username='$username' OR Email='$email'"));
                            if($cek==0){ // tanda "==" artinya sama dengan ...
                                mysqli_query($conn, "insert into user values('','$username','$password','$email','$nama_lengkap','$alamat')");
                                echo '<script> alert("account berhasil dibuat"); </script>';
                                echo '<meta http-equiv="refresh" content="0.1; url=login.php">';
                            }
                            else{
                                echo '<script> alert("Maaf account sudah terdaftar"); </script>';
                                // echo 'Maaf account sudah terdaftar';
                                // echo '<meta http-equiv="refresh" content="2.0; url=daftar.php">';
                            }
                        }
                        ?>
                        </font>
                   <form action="daftar.php" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="Username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="Password" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="Email" class="form-control" name="Email" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="NamaLengkap" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="Alamat" required>
                </div>
                <input type="submit" value="Daftar" class="btn-danger my-3" name="submit">
                <p>Sudah Sunya Akun? <a href="login.php" class="link-danger">Login Sekarang</a></p>
               </form>
                </div>
               </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>