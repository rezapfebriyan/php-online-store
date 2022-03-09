<?php include 'konek.php'?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barkah Store - Login Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <br /><br />
                <h2>Barkah Store</h2>
                <br/>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>Login Admin</strong>  
                    </div>
                    <div class="panel-body">
                        <?php
                            if(isset($_POST['login'])) {
                                $user = $_POST['user'];
                                $pass = $_POST['pass'];
                                $login = mysqli_query($koneksi,"SELECT * FROM admin WHERE username = '$user' AND password = '$pass'");
                                $jumlah_admin = mysqli_num_rows($login);
                                $data = mysqli_fetch_array($login);

                                // kalo data ditemukan
                                if($jumlah_admin > 0) {
                                    session_start();
                                    $_SESSION['admin'] = true;
                                    $_SESSION['id'] = $data['id_admin'];
                                    $_SESSION['username'] = $data['username'];
                                    header("Location: index.php"); 
                                } else {
                                    echo '<div class="alert alert-danger text-center" role="alert">Username dan password tidak valid</div>';
                                }
                            }
                        ?>
                        <form role="form" method="POST">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                    <input type="text" class="form-control" name="user" placeholder="masukan username" required autofocus/>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" name="pass"  placeholder="masukan password" required/>
                                </div>
                            <button class="btn btn-primary" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
