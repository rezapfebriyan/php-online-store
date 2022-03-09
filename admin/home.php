<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
?>
<h1>Selamat Datang Administrator</h1>
<h4>Silahkan kelola data sebaik-baiknya</h4>
