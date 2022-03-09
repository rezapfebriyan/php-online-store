<?php
session_start();
include 'admin/konek.php';
include 'admin/function.php';
if (!isset($_SESSION['user'])) {
    echo "<script>
            alert('Silahkan login terlebih dahulu');
            document.location='login.php';
        </script>";
} else {
    if (empty($_SESSION['keranjang']) || !isset($_SESSION['keranjang'])) {
        echo "<script>
                alert('Belum ada barang di keranjang, silahkan belanja terlebih dahulu');
                document.location='index.php';
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <script src="admin/assets/js/jquery.min.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="konten">
        <div class="container">
            <div class="page-header">
                <h3>Keranjang Belanja</h3>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
                <?php 
                $no = 1;
                $total_berat = 0;
                $total = 0;
                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                    <?php
                    $tampil_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id_produk' ");
                    $data_produk = mysqli_fetch_assoc($tampil_produk);
                    $sub_harga = $data_produk['harga_produk'] * $jumlah;
                    $sub_berat = $data_produk['berat'] * $jumlah;

                    $total_berat += $sub_berat;
                    ?>
                    <tr>
                        <td width='40px' align='center'><?= $no++ ?></td>
                        <td><?= $data_produk['nama_produk']; ?></td>
                        <td><?= rupiah($data_produk['harga_produk']); ?></td>
                        <td><?= $jumlah; ?></td>
                        <td><?= rupiah($sub_harga); ?></td>
                    </tr>
                    <?php $total += $sub_harga; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" align="center"><b>Total Belanja</b></td>
                    <td><b><?= rupiah($total) ?></b></td>
                </tr>

            </table>

            <form method="POST">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control" type="text" value="<?= $_SESSION['user']['nama_pelanggan'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control" type="text" value="<?= $_SESSION['user']['telepon'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Pengiriman</label>
                    <textarea class="form-control" name="alamat" placeholder="masukan alamat pengiriman secara lengkap" autofocus></textarea>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select name="namaProvinsi" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Distrik</label>
                            <select name="namaDistrik" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Ekspedisi</label>
                            <select name="namaEkspedisi" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Ongkos Kirim</label>
                            <select name="namaPaket" class="form-control">

                            </select>
                        </div>
                    </div>
                </div>
                <input type="text" name="total_berat" value="<?= $total_berat ?>">
                <input type="text" name="provinsi">
                <input type="text" name="distrik">
                <input type="text" name="tipe">
                <input type="text" name="kodepos">
                <input type="text" name="ekspedisi">
                <input type="text" name="paket">
                <input type="text" name="ongkir">
                <input type="text" name="estimasi">
                <button class="btn btn-primary" name="checkout">Checkout</button>
            </form>

            <?php
            if (isset($_POST['checkout'])) {

                // buat variabel untuk nyimpan data yg mau dimasukan ke tbl pembelian
                $id_pelanggan = $_SESSION['user']['id_pelanggan'];
                $tanggal = date('Y-m-d');
                $alamat = $_POST['alamat'];
                $total_berat = $_POST['total_berat'];
                $provinsi = $_POST['provinsi'];
                $distrik = $_POST['distrik'];
                $tipe = $_POST['tipe'];
                $kodepos = $_POST['kodepos'];
                $ekspedisi = $_POST['ekspedisi'];
                $paket = $_POST['paket'];
                $ongkir = $_POST['ongkir'];
                $estimasi = $_POST['estimasi'];

                $total_beli = $total += $ongkir;

                // masukan ke tbl pembelian
                $tambah = mysqli_query($koneksi, "INSERT INTO pembelian VALUES
                            (null,
                            '$id_pelanggan',
                            '$tanggal',
                            '$total_beli',
                            '$alamat',
                            'Belum Bayar',
                            '',
                            '$total_berat',
                            '$provinsi',
                            '$distrik',
                            '$tipe',
                            '$kodepos',
                            '$ekspedisi',
                            '$paket',
                            '$ongkir',
                            '$estimasi'
                            )");

                // memasukan ke tbl pembelian_produk

                // 1. ambil id_pembelian yg barusan dimasukan ke tbl pembelian
                $id_pembelian = $koneksi->insert_id;

                // lakukan looping untuk ambil id_produk yg mau dimasukan ke tbl 
                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {

                    # untuk mencegah perubahan harga pada produk setelah kita bayar
                    # data nama, harga & berat yg di tbl produk kita ambil
                    # jadi pas admin merubah harga setelah kita bayar, di nota tetap ...
                    # ... memakai data produk sebelum dirubah

                    // ambil data produk (nama, harga, berat) berdasarkan id
                    $produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id_produk' ");
                    $produk_Id = mysqli_fetch_assoc($produk);
                    $nama = $produk_Id['nama_produk'];
                    $harga = $produk_Id['harga_produk'];
                    $berat = $produk_Id['berat'];

                    $sub_berat = $produk_Id['berat'] * $jumlah;
                    $total_pembelian = $produk_Id['harga_produk'] * $jumlah;

                    // masukan ke tbl pembelian_produk
                    $tambah_beli_produk = mysqli_query($koneksi, "INSERT INTO pembelian_produk VALUES (null,'$id_pembelian','$id_produk','$jumlah','$nama','$harga','$berat','$sub_berat','$total_pembelian')");

                    // mengurangi stok ketika barang dibeli
                    $edit = mysqli_query($koneksi, "UPDATE produk SET stok_produk=stok_produk - $jumlah WHERE id_produk='$id_produk' ");
                }

                if ($tambah_beli_produk) {
                    echo "<script>
                            alert('Proses checkout anda telah sukses');
                            document.location='nota.php?id=$id_pembelian';
                        </script>";
                } else {
                    echo mysqli_error($koneksi);
                }

                // mengkosongkan keranjang setelah berhasil chechout
                unset($_SESSION['keranjang']);
            }
            ?>

        </div>
    </section>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'post',
                url: 'provinsi.php',
                success: function(hasilProvinsi) {
                    $("select[name = namaProvinsi]").html(hasilProvinsi);
                }
            });
            $("select[name = namaProvinsi]").on("change", function() {
                // option yg dipilih, ambil isi atribut id_provinsinya dan simpan ke var
                var provinsiTerpilih = $("option:selected", this).attr("id_provinsi");
                // dapatkan data distrik dari id_provinsi tadi
                // kirimkan (melalui method post) 
                // data yg dikirimkan = provinsiTerpilih
                $.ajax({
                    type: 'post',
                    url: 'distrik.php',
                    data: 'id_provinsi=' + provinsiTerpilih,
                    success: function(hasilDistrik) {
                        $("select[name = namaDistrik]").html(hasilDistrik); // pilih label namaDistrik, lalu tampilkan 
                    }
                });
            });

            $.ajax({
                type: 'post',
                url: 'ekspedisi.php',
                success: function(hasilEkspedisi) {
                    $("select[name = namaEkspedisi]").html(hasilEkspedisi);
                }
            });

            // UNTUK MENDAPATKAN DATA PAKET, BUTUH TUJUAN DISTRIK, TOTAL BERAT dan EKSPEDISI
            $("select[name = namaEkspedisi]").on("change", function() {
                // pilih label namaEkspedisi, ambil value ekspedisinya dan simpan ke var
                var ekspedisiTerpilih = $("select[name = namaEkspedisi]").val();

                // dapatkan data distrik dari id_provinsi tadi
                // kirimkan (melalui method post) atribut id_provinsi yg isinya $idProvinsiTerpilih
                var distrikTerpilih = $("option:selected", "select[name = namaDistrik]").attr("id_distrik"); // option yang dipilih dari select namaDistrik, lalu ambil isi atribut id_distrik

                // mendapatkan total berat
                // ambil inputan total_berat
                var totalBerat = $("input[name = total_berat]").val();

                $.ajax({
                    type: 'post',
                    url: 'paket.php',
                    data: 'ekspedisiTerpilih=' + ekspedisiTerpilih + '&distrik=' + distrikTerpilih + '&berat=' + totalBerat,
                    success: function(hasilPaket) {
                        $("select[name = namaPaket]").html(hasilPaket);

                        // cari inputan ekspedisi, valuenya isi dgn var ekspedisiTerpilih
                        $("input[name = ekspedisi]").val(ekspedisiTerpilih);
                    }
                });
            });
            $("select[name = namaDistrik]").on("change", function() {
                var provinsi = $("option:selected", this).attr("namaprovinsi");
                var distrik = $("option:selected", this).attr("namadistrik");
                var tipe = $("option:selected", this).attr("tipedistrik");
                var kodepos = $("option:selected", this).attr("kodepos");

                // cari inputan provinsi, valuenya isi var provinsi dst...
                $("input[name = provinsi]").val(provinsi);
                $("input[name = distrik]").val(distrik);
                $("input[name = tipe]").val(tipe);
                $("input[name = kodepos]").val(kodepos);
            });

            $("select[name = namaPaket]").on("change", function() {
                var paket = $("option:selected", this).attr("paket");
                var ongkir = $("option:selected", this).attr("ongkir");
                var estimasi = $("option:selected", this).attr("estimasi");

                $("input[name = paket]").val(paket);
                $("input[name = ongkir]").val(ongkir);
                $("input[name = estimasi]").val(estimasi);
            })
        });
    </script>

    <!-- print_r($_SESSION['user']); -->