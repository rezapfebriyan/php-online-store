<?php
session_start();
include 'admin/konek.php';
include 'admin/function.php';
if(!isset($_SESSION['user'])){
	echo "<script>
            alert('Silahkan login terlebih dahulu');
            document.location='login.php';
        </script>";
    }

$id_pembelian = $_GET['id'];

// tampilkan tbl pembayaran dan pembelian
$tampil = mysqli_query($koneksi,"SELECT * FROM pembayaran LEFT JOIN pembelian
                                        ON pembayaran.id_pembelian=pembelian.id_pembelian
                                        WHERE pembelian.id_pembelian = '$id_pembelian' ");
$data_bayar = mysqli_fetch_array($tampil);

if (empty($data_bayar)) {
    echo "<script>
            alert('Belum ada pembayaran');
            document.location='riwayat.php';
        </script>";
    exit();
}

$user_bukti = $data_bayar['id_pelanggan'];
$user_login = $_SESSION['user']['id_pelanggan'];

if ($user_login !== $user_bukti) {
    echo "<script>
            alert('Anda tidak dapat mengakses halaman ini');
            document.location='riwayat.php';
        </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Bukti Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <div class="page-header">
        <h2>Bukti Pembayaran</h2>
    </div>
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td><?= $data_bayar['nama']; ?></td>
                </tr>
                <tr>
                    <th>BANK</th>
                    <td><?= $data_bayar['bank']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?= $data_bayar['tanggal']; ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td><?= rupiah($data_bayar['jumlah']); ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <img src="struk/<?= $data_bayar['bukti']?>" class="img-responsive">
        </div>
    </div>
</div>