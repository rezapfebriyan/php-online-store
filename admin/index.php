<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
include 'konek.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barkah Store</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Barkah Store</a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/find_user.png" class="user-image img-responsive" />
                    </li>

                    <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li><a href="index.php?hal=kategori"><i class="fa fa-cube"></i>Kategori</a></li>
                    <li><a href="index.php?hal=produk"><i class="fa fa-tags"></i>Produk</a></li>
                    <li><a href="index.php?hal=pembelian"><i class="fa fa-shopping-cart"></i>Pembelian</a></li>
                    <li><a href="index.php?hal=laporan_pembelian"><i class="fa fa-file"></i>Laporan</a></li>
                    <li><a href="index.php?hal=pelanggan"><i class="fa fa-user"></i>Pelanggan</a></li>
                    <li><a href="index.php?hal=logout" onclick="return confirm('Anda yakin ingin keluar?')"><i class="fa fa-sign-out"></i>Logout</a></li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <?php
                if (isset($_GET['hal'])) {
                    if ($_GET['hal'] == "produk") {
                        include 'produk.php';
                    } elseif ($_GET['hal'] == "pembelian") {
                        include 'pembelian.php';
                    } elseif ($_GET['hal'] == "pelanggan") {
                        include 'pelanggan.php';
                    } elseif ($_GET['hal'] == "hapus_pelanggan") {
                        include 'hapus_pelanggan.php';
                    } elseif ($_GET['hal'] == "detail") {
                        include 'detail.php';
                    } elseif ($_GET['hal'] == "tambah_produk") {
                        include 'tambah_produk.php';
                    } elseif ($_GET['hal'] == "hapus_produk") {
                        include 'hapus_produk.php';
                    } elseif ($_GET['hal'] == "edit_produk") {
                        include 'edit_produk.php';
                    } elseif ($_GET['hal'] == "logout") {
                        include 'logout.php';
                    } elseif ($_GET['hal'] == "pembayaran") {
                        include 'pembayaran.php';
                    } elseif ($_GET['hal'] == "laporan_pembelian") {
                        include 'laporan_pembelian.php';
                    } elseif ($_GET['hal'] == "kategori") {
                        include 'kategori.php';
                    } elseif ($_GET['hal'] == "tambah_kategori") {
                        include 'tambah_kategori.php';
                    } elseif ($_GET['hal'] == "hapus_kategori") {
                        include 'hapus_kategori.php';
                    } elseif ($_GET['hal'] == "detail_produk") {
                        include 'detail_produk.php';
                    }
                } else {
                    include 'home.php';
                }
                ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>

</html>