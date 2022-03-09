<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}

$hapus = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$_GET[id]'");

if ($hapus) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location='?hal=kategori';
        </script>";
}
