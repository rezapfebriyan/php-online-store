<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
?>

<div class="page-header">
    <h2>Data Pelanggan</h2>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tampil = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        $no = 1;
        while ($data = mysqli_fetch_array($tampil)) :
        ?>
            <tr>
                <td width='40px' align='center'><?= $no++ ?></td>
                <td><?= $data['nama_pelanggan']; ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['telepon'] ?></td>
                <td>
                    <a href="?hal=hapus_pelanggan&id=<?= $data['id_pelanggan'] ?>" class="btn btn-danger fa fa-trash sm" onclick="return confirm('Anda yakin ingin menghapus?')"></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>