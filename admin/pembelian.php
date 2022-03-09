<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
include 'function.php'; ?>

<div class="page-header">
    <h2>Data Pembelian</h2>
</div>
<table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th>Status Pembelian</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    <?php 
        $tampil = mysqli_query($koneksi,"SELECT * FROM pembelian JOIN pelanggan ON 
                                            pembelian.id_pelanggan=pelanggan.id_pelanggan");
        $no = 1;
        while($data = mysqli_fetch_array($tampil)) :
    ?>
        <tr>
            <td width='40px' align='center'><?= $no++ ?></td>
            <td><?= $data['nama_pelanggan']; ?></td>
            <td><?= date("d F Y", strtotime($data['tanggal_beli'])) ?></td>
            <td><?= $data['status_beli']; ?></td>
            <td><?= rupiah($data['total_beli']); ?></td>
            <td>
                <a href="?hal=detail&id=<?=$data['id_pembelian'];?>" class="btn btn-default"
                >Detail</a>

                <?php if ($data['status_beli'] !== 'Belum Bayar') : ?>
                    <a class="btn btn-success" href="?hal=pembayaran&id=<?= $data['id_pembelian']; ?>">Lihat Bukti</a>
                <?php endif; ?>

            </td>
        </tr>
        <?php endwhile; ?>
</table>