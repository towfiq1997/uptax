<?php
   include 'inc/Functions.php';
   $union_add = new Survey();
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $thana = $_POST['thana'];
  $zilla = $_POST['district'];
  $ucode = $_POST['u_code'];
  $pcode = $_POST['p_code'];
  $post_office_name = $_POST['post_name'];
  $adminname = $_POST['adminname'];
  $adminusername = $_POST['adminusername'];
  $adminpassword = $_POST['adminpassword'];
  $filename = rand(1000,10000)."-".$_FILES['logo']['name'];
  $tmp_name = $_FILES['logo']['tmp_name'];
  $new_finale_name = strtolower($filename);
  $finale_file = str_replace(' ','-',$new_finale_name);
  if(move_uploaded_file($tmp_name,"uploads/".$finale_file)){
      
  }
  $sql = "INSERT INTO union_info(name,thana,zilla,post_office_name,union_code,postal_code,logo,adminname,adminemail,adminpassword) VALUES('$name','$thana','$zilla','$post_office_name','$ucode','$pcode','$finale_file','$adminname','$adminusername','$adminpassword')";
      if($union_add->con->query($sql)=== TRUE){
         echo "added succesfully"; 
      }
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
    <title>Installer</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div style="min-height:100vh" width="70%" class="d-flex align-items-center row justify-content-center">

            <div class="col-md-8">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Union Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="inputEmail3"
                                placeholder="Add Union Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Union Code</label>
                        <div class="col-sm-10">
                            <input type="text" name="u_code" class="form-control" id="inputEmail3"
                                placeholder="Add Union Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Union Logo</label>
                        <div class="col-sm-10">
                            <input type="file" name="logo" class="form-control" id="inputEmail3"
                                placeholder="Add Union Logo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Thana</label>
                        <div class="col-sm-10">
                            <input name="thana" type="text" class="form-control" id="inputEmail3"
                                placeholder="Add Thana">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">District</label>
                        <div class="col-sm-10">
                            <input name="district" type="text" class="form-control" id="inputEmail3"
                                placeholder="Add District">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Post Office Name</label>
                        <div class="col-sm-10">
                            <input name="post_name" type="text" class="form-control" id="inputEmail3"
                                placeholder="Add Post Office Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Postal Code</label>
                        <div class="col-sm-10">
                            <input name="p_code" type="text" class="form-control" id="inputEmail3"
                                placeholder="Add Postal Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Thana</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Add Union Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Thana</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Add Union Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Admin Name</label>
                        <div class="col-sm-10">
                            <input name="adminname" type="text" class="form-control" id="inputEmail3"
                                placeholder="Add Admin Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Admin Username</label>
                        <div class="col-sm-10">
                            <input name="adminusername" type="text" class="form-control" id="inputEmail3"
                                name="adminusername" placeholder="Add Username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Admin Password</label>
                        <div class="col-sm-10">
                            <input name="adminpassword" type="password" class="form-control" id="inputPassword3"
                                name="adminpassword" placeholder="Add Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </form>
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