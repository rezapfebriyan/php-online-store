<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}

$hapus = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

if ($hapus) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location='?hal=pelanggan';
        </script>";
}
