<?php
session_start();
include 'admin/konek.php';
include 'admin/function.php';

// jika tidak ada user yg login
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>
            alert('Silahkan login terlebih dahulu');
            document.location='login.php';
          </script>";
    }

$id_pembelian = $_GET['id']; // variabel user yg beli
$tampil = mysqli_query($koneksi,"SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian' ");
$data_beli = mysqli_fetch_array($tampil);

$idPembeli = $data_beli['id_pelanggan']; // id user yg beli
$id_loginPembeli = $_SESSION['user']['id_pelanggan']; // id user yg login

if ($idPembeli !== $id_loginPembeli) {
    echo "<script>
            alert('Anda tidak dapat mengakses halaman ini');
            document.location='riwayat.php';
        </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="riwayat">
    <div class="container">
        <div class="page-header">
            <h2>Konfirmasi Pembayaran</h2>
            <p><i>kirimkan bukti pembayaran anda disini</i></p>
        </div>
        <div class="alert alert-info">
            <p>Jumlah yang harus anda bayar <strong><?= rupiah($data_beli['total_beli']); ?></strong></p>
        </div>
        <?php
            if(isset($_POST['kirim'])) {
                $foto_bukti = upload_bukti();
                $nama = htmlspecialchars($_POST['nama']);
                $bank = htmlspecialchars($_POST['bank']);
                $jumlah = $data_beli['total_beli'];
                $tanggal = date('Y-m-d');

                mysqli_query($koneksi,"INSERT INTO pembayaran VALUES
                                                (null,
                                                '$id_pembelian',
                                                '$nama',
                                                '$bank',
                                                '$jumlah',
                                                '$tanggal',
                                                '$foto_bukti'
                                                )");
                
                // ubah status_beli menjadi lunas
                $edit = mysqli_query($koneksi,"UPDATE pembelian SET status_beli='Lunas' WHERE id_pembelian='$id_pembelian' ");

                if ($edit) {
                    echo "<script>
                        alert('Transaksi Anda Berhasil');
                        document.location='riwayat.php';
                    </script>";
                } else {
                    echo '<div class="alert alert-danger text-center" role="alert">Maaf, transaksi anda <strong>gagal</strong>. Periksa kembali data yang anda inputkan</div>';
                }
            }
        ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Pengirim</label>
                <input type="text" class="form-control" name="nama" placeholder="masukan nama" required autofocus>
            </div>
            <div class="form-group">
                <label>BANK</label>
                <input type="text" class="form-control" name="bank" placeholder="masukan bank" required>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="text" class="form-control" name="jumlah" value="<?= rupiah($data_beli['total_beli'])?>" readonly>
            </div>
            <div class="form-group">
                <label>Foto Bukti</label>
                <input type="file" class="form-control" name="foto_bukti" required>
                <p class="text-danger">ukuran file minimal 5 MB</p>
            </div>
            <button class="btn btn-primary" name="kirim">Kirim</button>
        </form>
    </div>
</section>