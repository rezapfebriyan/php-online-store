<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}

$semua_kategori = []; // default
$tampil = mysqli_query($koneksi, "SELECT * FROM kategori");
while ($kategori = mysqli_fetch_assoc($tampil)) :
    $semua_kategori[] = $kategori; // masukkan ke array kosong
endwhile;
?>

<div class="page-header">
    <h2>Tambah Produk</h2>
</div>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="id_kategori" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($semua_kategori as $key => $value) : ?>
                <option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="masukan nama" required>
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" name="harga" placeholder="masukan harga" required>
    </div>
    <div class="form-group">
        <label>Berat (gram)</label>
        <input type="text" class="form-control" name="berat" placeholder="masukan berat" required>
    </div>
    <div class="form-group">
        <label>Foto</label>
        <div class="letak-input" style="margin-bottom: 10px;">
            <input type="file" name="foto[]" required>
        </div>
        <span class="btn btn-primary btn-tambah">
            <i class="fa fa-plus"></i>
        </span>
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="5" placeholder="masukan deskripsi produk" required></textarea>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok" placeholder="masukan jumlah persediaan" required>
    </div>
    <button class="btn btn-success" name="simpan">Tambah</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $berat = htmlspecialchars($_POST['berat']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $stok = htmlspecialchars($_POST['stok']);
    $namesFoto = $_FILES['foto']['name'];
    $locationsFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($locationsFoto[0], "../img/" . $namesFoto[0]);
    $tambah = mysqli_query($koneksi, "INSERT INTO produk VALUES
                            (null,
                            '$_POST[id_kategori]',
                            '$nama',
                            '$harga',
                            '$berat',
                            '$namesFoto[0]',
                            '$deskripsi',
                            '$stok')
                            ");

    if (!$tambah) {
        echo mysqli_error($koneksi);
    }
    // id_produk yg baru masuk ke tbl produk       
    $id_produk = $koneksi->insert_id;

    foreach ($namesFoto as $key => $names_sub) {
        $location_sub_foto = $locationsFoto[$key];

        move_uploaded_file($location_sub_foto, "../img/" . $names_sub);

        $tambah_sub_foto = mysqli_query($koneksi, "INSERT INTO produk_foto VALUES
                            (null, '$id_produk', '$names_sub')");
    }
    if ($tambah_sub_foto) {
        echo "<script>
                alert('Produk terbaru berhasil ditambahkan');
                document.location='?hal=produk';
            </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}
?>

<script>
    $(document).ready(function() {
        $(".btn-tambah").on("click", function() {
            $(".letak-input").append("<input type='file' class='form-control' name='foto[]'>");
        })
    })
</script>