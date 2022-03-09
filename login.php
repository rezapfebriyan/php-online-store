<?php
include 'admin/konek.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Login</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>Login Pelanggan</strong>
                </div>
                <div class="panel-body">
                    <?php
                    if(isset($_POST['login'])) {
                        $user = $_POST['email'];
                        $pass = $_POST['pass'];
                        $login = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE email = '$user' AND pass_pelanggan = '$pass'");
                        $jumlah_user = mysqli_num_rows($login);
                        $data = mysqli_fetch_assoc($login);

                        // kalo data ditemukan
                        if($jumlah_user > 0) {
                            session_start();
                            $_SESSION['user'] = $data;

                            if (isset($_SESSION['keranjang']) || !empty($_SESSION['keranjang'])) {
                                header("Location: checkout.php"); 
                            } else {
                                header("Location: index.php"); 
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Email dan password tidak valid</div>';
                        }
                    }
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pass" required>
                        </div>
                        <button class="btn btn-primary" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>