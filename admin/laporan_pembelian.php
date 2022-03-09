<?php
//session_start();
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
include 'function.php';

$tglMulai ='...'; // default kalo belum input form
$tglSampai = '...';
$semua_data = []; // kalo gak dpt data, maka yg ditampilin array kosong
$status = "";
if (isset($_POST['kirim'])) {
    $tglMulai = $_POST['tgl_mulai'];
    $tglSampai = $_POST['tgl_sampai'];
    $status = $_POST['status'];
    // menampilkan laporan yg isinya gabungan dari tbl pembelian dan tbl pelanggan 
    // (relasinya dari id.pelanggan) yg tanggal nya diambil dari inputan form
    $tampil = mysqli_query($koneksi,"SELECT * FROM pembelian LEFT JOIN pelanggan ON 
                                            pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE
                                            status_beli = '$status' AND tanggal_beli BETWEEN '$tglMulai' AND '$tglSampai' ");
    while($data = mysqli_fetch_array($tampil)) {
    $semua_data[] = $data; // memasukan $data ke array yg kosong
    }
    // echo "<pre>";
    // print_r($semua_data);
    // echo "</pre>";
}
?>

<div class="page-header">
    <h2>Laporan Pembelian dari <?= date("d F Y", strtotime($tglMulai)) ?> - <?= date("d F Y", strtotime($tglSampai)) ?></h2>
</div>

<form method="POST">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Mulai Tanggal</label>
                <input type="date" class="form-control" name="tgl_mulai" value="<?= $tglMulai ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Sampai Tanggal</label>
                <input type="date" class="form-control" name="tgl_sampai" value="<?= $tglSampai ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Pilih Status</option>
                    <option value="Barang Sudah Sampai" <?= $status == "Barang Sudah Sampai"?"selected":""?> >Barang Sudah Sampai</option>
                    <option value="Barang dikirim" <?= $status == "Barang dikirim"?"selected":""?> >Barang dikirim</option>
                    <option value="Sudah Mengirim Pembayaran" <?= $status == "Sudah Mengirim Pembayaran"?"selected":""?> >Sudah Mengirim Pembayaran</option>
                    <option value="Lunas" <?= $status == "Lunas"?"selected":""?> >Lunas</option>
                    <option value="Belum Bayar" <?= $status == "Belum Bayar"?"selected":""?> >Belum Bayar</option>
                    <option value="DIBATALKAN" <?= $status == "DIBATALKAN"?"selected":""?> >DIBATALKAN</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label><br>
            <button class="btn btn-primary" name="kirim">Lihat</button>
        </div>
    </div>
</form>

<table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Pembelian</th>
            <th>Jumlah Pembelian</th>
            <th>Status Pembelian</th>
        </tr>
    <?php 
        $total = 0;
        $no = 1;
        // perulangan terhadap array
        foreach ($semua_data as $key => $value) : ?>
        <tr>
            <td width='40px' align='center'> <?= $no++ ?></td>
            <td><?= $value['nama_pelanggan']; ?></td>
            <td><?= date("d F Y", strtotime($value['tanggal_beli'])) ?></td>
            <td><?= rupiah($value['total_beli']); ?></td>
            <td><?= $value['status_beli']; ?></td>
        </tr>
        <?php $total += $value['total_beli']?>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" align="center"><b>Total Pembelian</b></td>
            <td><b><?= rupiah($total) ?></b></td>
        </tr>
</table>