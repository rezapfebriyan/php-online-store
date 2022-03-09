<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
include 'function.php';
?>
<div class="page-header">
    <h2>Edit Produk</h2>
</div>

<?php
$tampil = mysqli_query($koneksi, "SELECT * FROM produk LEFT JOIN kategori ON 
                                                produk.id_kategori=kategori.id_kategori 
                                                WHERE id_produk='$_GET[id]'");
$data = mysqli_fetch_array($tampil);
if($data) {
    $fotoLama = $data['foto_produk']; // foto_produk taruh di $fotoLama
}

if(isset($_POST['edit'])) {

    if($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama; // kalo gak milih, maka ambil file sebelumnya
      } else { // selain itu, jika milih file baru
        $foto = upload(); // maka upload file barunya
      }
        $edit = mysqli_query($koneksi, "UPDATE produk SET
                                                id_kategori='$_POST[id_kategori]',
                                                nama_produk='$_POST[nama]',
                                                harga_produk='$_POST[harga]',
                                                berat='$_POST[berat]',
                                                foto_produk='$foto',
                                                deskripsi='$_POST[deskripsi]',
                                                stok_produk='$_POST[stok]'
                                                WHERE
                                                id_produk='$_GET[id]'
                                                ");
        if($edit) { 
            echo "<script>
                    alert('Data berhasil diedit');
                    document.location='?hal=produk';
                  </script>";
      } else {
        echo "<script>
                alert('Data gagal diedit');
            </script>";
      }
}
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kategori</label> 
        <select class="form-control" name="id_kategori" required>
            <option value="">Pilih kategori produk</option>
            <?php
                $tampil_kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY
                    nama_kategori ASC");
                while ($kategori = mysqli_fetch_assoc($tampil_kategori)) {
                    echo "<option value='$kategori[id_kategori]'> $kategori[nama_kategori] </option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" value="<?= $data['nama_produk']?>">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" name="harga" value="<?= $data['harga_produk']?>">
    </div>
    <div class="form-group">
        <label>Berat (gram)</label>
        <input type="text" class="form-control" name="berat" value="<?= $data['berat']?>">
    </div>
    <div class="form-group">
        <img src="../img/<?= $data['foto_produk']; ?>" width="250">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="5"><?= $data['deskripsi']?></textarea>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="numb" class="form-control" name="stok" value="<?= $data['stok_produk']?>">
    </div>
    <button class="btn btn-success" name="edit">Simpan</button>
</form>

