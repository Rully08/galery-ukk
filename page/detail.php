<?php
    // Periksa apakah user_id ada dalam sesi
    $user_id = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

    $details = mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.UserID=user.UserID WHERE foto.FotoID='$_GET[id]'");
    $data = mysqli_fetch_array($details);
    $likes = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$_GET[id]'"));
    $cek = ($user_id !== null) ? mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$_GET[id]' AND UserID='$user_id'")) : 0;
?>
<div class="container">
    <div class="row">
       <div class="col-6">
            <div class="card">
                <img src="uploads/<?= $data['NamaFile'] ?>" alt="<?= $data['JudulFoto'] ?>" class="object-fit-cover">
                <div class="card-body">
                    <h3 class="card-title mb-0"><?= $data['JudulFoto'] ?> <a href="<?php if(isset($_SESSION['userid'])) {echo '?url=like&&id='.$data['FotoID'].'';}else {echo 'login.php';} ?>" class="btn btn-sm <?php if($cek==0){echo "text-secondary";}else{echo "text-danger";} ?>"><i class="fa-solid fa-fw fa-heart"></i> <?= $likes ?> </a></h3>
                    <small class="text-muted mb-3">by: <?= $data['Username'] ?>, <?= $data['TanggalUnggah'] ?></small>
                    <p><?= $data['DeskripsiFoto'] ?></p>
                    <?php 
                    // ambil data komentar
                    $submit=@$_POST['submit'];
                    if ($submit=='Kirim') {
                        $komentar=@$_POST['komentar'];
                        $foto_id=@$_POST['foto_id'];
                        $user_id=@$_SESSION['userid'];
                        $tanggal=date('Y-m-d');
                        $komentar=mysqli_query($conn, "INSERT INTO komentarfoto VALUES('', '$foto_id', '$user_id', '$komentar', '$tanggal')");
                        header("Location: ?url=detail&&id=$foto_id");
                    }
                    ?>
                    <form action="?url=detail" method="post">
                        <div class="form-group d-flex flex-grow">
                            <input type="hidden" name="foto_id" value="<?= $data['FotoID'] ?>">
                            <a href="?url=home" class="btn btn-primary">Kembali</a>
                            <?php if(isset($_SESSION['userid'])): ?>
                            <input type="text" name="komentar" class="form-control" placeholder="Masukan Komentar...">
                            <input type="submit" value="Kirim" name="submit" class="btn btn-primary">
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
       </div>
       <div class="col-6">
        <?php 
        $komen=mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.UserID=user.UserID INNER JOIN foto ON komentarfoto.FotoID=foto.FotoID WHERE komentarfoto.FotoID='$_GET[id]'");
        foreach($komen as $komens):
        ?>
        <p class="mb-0 fw-bold"><?= $komens['Username'] ?></p>
        <p class="mb-1"><?= $komens['IsiKomentar'] ?></p>
        <p class="text-muted small mb-0"><?= $komens['TanggalKomentar'] ?></p>
        <hr>
        <?php endforeach; ?>
       </div>
    </div>
</div>