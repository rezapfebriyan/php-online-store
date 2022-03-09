<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}

include 'function.php'; 
include 'konek.php';

$id_pembelian = $_GET['id'];

$tampil = mysqli_query($koneksi,"SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian' ");
$data = mysqli_fetch_array($tampil);
?>

<div class="page-header">
    <h2>Data pembayaran</h2>
</div>

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?= $data['nama'];?></td>
            </tr>
            <tr>
                <th>BANK</th>
                <td><?= $data['bank'];?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td><?= rupiah($data['jumlah']);?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= date("d F Y", strtotime($data['tanggal'])) ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../struk/<?= $data['bukti']?>" class="img-responsive">
    </div>
</div>

<form method="POST">
    <div class="form-group">
        <label>No. Resi Pengiriman</label>
        <input type="numb" class="form-control" name="resi" placeholder="masukan nomor resi">
    </div>
    <div class="form-group">
        <select class="form-control" name="status">
            <option value="">Pilih Status</option>
            <option value="Lunas">Lunas</option>
            <option value="Barang dikirim">Barang Dikirim</option>
            <option value="Pembelian dibatalkan">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php // edit resi
if(isset($_POST['proses'])) {

    $resi = htmlspecialchars($_POST['resi']);
    $status = $_POST['status'];
    $edit = mysqli_query($koneksi,"UPDATE pembelian SET resi = '$resi', status_beli = '$status' WHERE id_pembelian = '$id_pembelian' ");

    if($edit) {
        echo "<script>
                alert('Data pembelian berhasil diupdate');
                document.location='?hal=pembelian';
            </script>";
    }
}