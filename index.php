<?php
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['code'] : NULL;
if (!empty($username)) {
    header('location:dashboard.php');
}
if (isset($_POST['submit'])) {

  $conn = new Survey();
  $username = $_POST['username'];
  $pass = $_POST['password'];
  $unioncode = $_POST['unioncode'];
  $check = $conn->login($username,$pass,$unioncode);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ADMIN - Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="extra.css">

</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="bangla h4 text-gray-900 mb-4">লগইন</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control bangla"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="ইউসারনেম">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control bangla"
                                                id="exampleInputPassword" placeholder="পাসওয়ার্ড">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="unioncode" class="form-control bangla"
                                                id="exampleInputPassword" placeholder="ইউনিয়ন কোড">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="প্রবেশ করুন"
                                                class="btn btn-primary btn-block bangla">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>

</html>