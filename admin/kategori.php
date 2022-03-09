<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
?>

<div class="page-header">
    <h2>Data Kategori</h2>
</div>
<a class="btn btn-primary" style="margin-bottom: 10px" href="?hal=tambah_kategori">Tambah Kategori</a>
<table class="table table-border table-hovered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php
            $semua_data = []; // default
            $tampil = mysqli_query($koneksi,"SELECT * FROM kategori");
            $no = 1;
            while($kategori = mysqli_fetch_assoc($tampil)) :
                $semua_data[] = $kategori; // masukkan ke array kosong
            endwhile;
            foreach ($semua_data as $key => $value) :
        ?>
        <tr>
            <td width='40px' align='center'><?= $no++ ?></td>
            <td><?= $value['nama_kategori']; ?></td>
            <td>
                <a href="?hal=hapus_kategori&id=<?=$value['id_kategori']?>" class="btn btn-danger fa fa-trash"
                onclick="return confirm('Anda yakin ingin menghapus?')"></a>
            </td>
        </tr>
        <?php endforeach; ?>
</table>