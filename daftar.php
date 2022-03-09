<?php
session_start();
include 'admin/konek.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Daftar</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'navbar.php'; ?>    
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php
            if(isset($_POST['daftar'])) {

                $nama = htmlspecialchars($_POST['nama']);
                $password = htmlspecialchars($_POST['password']);
                $email = $_POST['email'];
                $alamat = htmlspecialchars($_POST['alamat']);
                $no_hp = htmlspecialchars($_POST['no_hp']);

                // cek email sudah ada atau belum
                $tampil_email = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email = '$email' ");
                $cek_email = mysqli_num_rows($tampil_email);

                if ($cek_email == 1) {
                    echo '<div class="alert alert-danger" role="alert">Pendaftaran <strong>gagal</strong>, email yang anda masukan sudah terdaftar</div>';
                } else {
                    $tambah = mysqli_query($koneksi,"INSERT INTO pelanggan VALUES
                                            (null,
                                            '$email',
                                            '$password',
                                            '$nama',
                                            '$no_hp',
                                            '$alamat')
                                            ");
                    if($tambah) {
                        echo "<script>
                                alert('Pendaftaran berhasil, silahkan login');
                                document.location='masuk.php';
                            </script>";
                    }
                }
            }
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar</h3>
                </div>
                <div class="panel-body">

                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="nama" placeholder="masukan nama" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="password" placeholder="masukan password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="email" placeholder="masukan email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-7">
                                <textarea name="alamat" class="form-control" rows="5" placeholder="masukan alamat lengkap" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Ponsel</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="no_hp" placeholder="masukan nomor ponsel" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button class="btn btn-success" name="daftar">Daftar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>      
    </div>
</div>

</body>
</html>