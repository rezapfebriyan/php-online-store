<nav class="navbar navbar-inverse">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>
            <?php if (isset($_SESSION['user'])) : ?>
                <li><a href="riwayat.php">Riwayat Pembelian</a></li>
                <li><a href="logout.php" onclick="return confirm('Anda yakin ingin keluar?')">Logout</a></li>
            <?php else : ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="daftar.php">Daftar</a></li>
            <?php endif; ?>
            <li><a href="checkout.php">Checkout</a></li>
        </ul>

        <form method="GET" action="cari.php" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="cari" placeholder="Cari Produk">
            <button class="btn btn-primary">Cari</button>
        </form>
    </div>
</nav>