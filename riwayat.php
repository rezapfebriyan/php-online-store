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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Riwayat Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="riwayat">
    <div class="container">
        <div class="page-header">
            <h2>Riwayat Pembelian</h2>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Opsi</th>
            </tr>

            <?php
            $id_pelanggan = $_SESSION['user']['id_pelanggan'];

            $pelanggan = mysqli_query($koneksi,"SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan' ");
            $no = 1;
            while($data = mysqli_fetch_array($pelanggan)) :
            ?>
            <tr>
                <td width='40px' align='center'><?= $no++;?></td>
                <td><?= $data['tanggal_beli'];?></td>
                <td>
                    <?= $data['status_beli'];?> <br>
                    <?php
                        if (!empty($data['resi'])) : ?>
                        Resi : <?= $data['resi'];?>
                    <?php endif; ?>
                </td>
                <td><?= rupiah($data['total_beli']);?></td>
                <td>
                    <a href="nota.php?id=<?=$data['id_pembelian'];?>" class="btn btn-default">Nota</a>
                <!-- kalo belum bayar, yg tampil pembayaran. kalo udah bayar, yg tampil lihat bayar -->
                    <?php if($data['status_beli'] == "Belum Bayar") : ?>
                    <a href="pembayaran.php?id=<?=$data['id_pembelian'];?>" class="btn btn-primary">Bayar</a>
                    <?php else : ?>
                    <a href="bukti_bayar.php?id=<?=$data['id_pembelian'];?>" class="btn btn-success">Lihat Bukti</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

    </div>
</section>