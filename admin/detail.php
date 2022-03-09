<?php
//session_start();
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}

include 'function.php'; 
?>

<div class="page-header">
    <h2>Detail Pembelian</h2>
</div>
<?php 
        $tampil = mysqli_query($koneksi,"SELECT * FROM pembelian JOIN pelanggan
                                        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
                                        WHERE pembelian.id_pembelian='$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
    
?>

<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>
            Total : <?= rupiah($data['total_beli']); ?><br>
        </strong>
        <p>
            Tanggal : <?= $data['tanggal_beli']; ?> <br>
            Status : <?= $data['status_beli']; ?>
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?= $data['nama_pelanggan']; ?></strong><br>
        <p>
            <?= $data['telepon']; ?> <br>
            <?= $data['email']; ?> 
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong>Tujuan : <?= $data['tipe']." ".$data['distrik']; ?></strong> <br>
        <p>
            Ongkos Kirim : <?= rupiah($data['ongkir']); ?><br>
            Ekspedisi : <?= $data['ekspedisi']." | ".$data['paket']." | ".$data['estimasi']." hari"; ?><br>
            Alamat : <?= $data['alamat_pengiriman']; ?>
        </p>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $tampil = mysqli_query($koneksi,"SELECT * FROM pembelian_produk JOIN produk
                                        ON pembelian_produk.id_produk=produk.id_produk
                                        WHERE pembelian_produk.id_pembelian='$_GET[id]' ");
        $no = 1;
        while($data = mysqli_fetch_array($tampil)) :
    ?>
        <tr>
            <td width='40px' align='center'><?= $no++ ?></td>
            <td><?= $data['nama_produk']; ?></td>
            <td><?= rupiah($data['harga_produk']); ?></td>
            <td><?= $data['jumlah']; ?></td>
            <td>
                <?php 
                    $subtotal =  $data['harga_produk'] * $data['jumlah'];
                    echo rupiah($subtotal);
                ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
