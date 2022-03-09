<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
include 'function.php'; ?>

<div class="page-header">
    <h2>Data Produk</h2>
</div>
<a class="btn btn-primary" style="margin-bottom: 10px" href="?hal=tambah_produk">Tambah Produk</a>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Kategori</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Berat</th>
        <th>Foto</th>
        <th>Jumlah</th>
        <th>Aksi</th>
    </tr>
    <?php
    // menampilkan gabungan dari tbl produk dan tbl kategori (relasinya dari id.kategori)
    $tampil = mysqli_query($koneksi, "SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori");
    $no = 1;
    while ($data = mysqli_fetch_array($tampil)) :
    ?>
        <tr>
            <td width='20px' align='center'><?= $no++ ?></td>
            <td><?= $data['nama_kategori'] ?></td>
            <td><?= $data['nama_produk'] ?></td>
            <td><?= rupiah($data['harga_produk']) ?></td>
            <td width='40'><?= $data['berat'] ?> g</td>
            <td><img src="../img/<?= $data['foto_produk'] ?>" width="200"></td>
            <td width='45' align="center"><?= $data['stok_produk'] ?></td>
            <td>
                <a href="?hal=detail_produk&id=<?= $data['id_produk'] ?>" class="btn btn-default fa fa-eye"></a>
                <a href="?hal=edit_produk&id=<?= $data['id_produk'] ?>" class="btn btn-warning fa fa-edit sm"></a>
                <a href="?hal=hapus_produk&id=<?= $data['id_produk'] ?>" class="btn btn-danger fa fa-trash sm" onclick="return confirm('Anda yakin ingin menghapus?')"></a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>