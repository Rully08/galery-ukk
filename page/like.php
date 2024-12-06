<?php
// cek apakah foto dengan di detail.php sudah dilike oleh user yang login
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$_GET[id]' AND UserID='$_SESSION[userid]'"));
if ($cek==0) {
    // ambil data yang dikirim melalui url
    $foto_id=@$_GET['id'];
    $user_id=@$_SESSION['userid'];
    $tanggal=date('Y-m-d');
    $like=mysqli_query($conn, "INSERT INTO likefoto VALUES('','$foto_id','$user_id','$tanggal')");
    header("location: ?url=detail&&id=$foto_id");
}else{
    // jika user sudah menglike foto
    $foto_id=@$_GET['id'];
    $user_id=@$_SESSION['userid'];
    $dislike=mysqli_query($conn, "DELETE FROM likefoto WHERE FotoID='$foto_id' AND UserID='$user_id'");
    header("location: ?url=detail&&id=$foto_id");
}
?>