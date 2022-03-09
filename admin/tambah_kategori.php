<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
?>

<div class="page-header">
    <h2>Tambah Kategori</h2>
</div>

<form method="post">
    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" class="form-control" name="nama" placeholder="masukan nama kategori" required>
    </div>
    <button class="btn btn-success" name="simpan">Tambah</button>
</form>

<?php
if (isset($_POST['simpan'])) {

    $nama = htmlspecialchars($_POST['nama']);
    $tambah = mysqli_query($koneksi, "INSERT INTO kategori VALUES
                            (null,
                            '$nama')
                            ");
    
    if ($tambah) {
        echo "<script>
                alert('Kategori berhasil ditambahkan');
                document.location='?hal=kategori';
            </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}
?>