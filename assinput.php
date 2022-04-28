<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
//include 'templates/header.php';
   $message = isset($_GET['message'])?$_GET['message']:NULL;
   $status = isset($_GET['status'])?$_GET['status']:NULL;
   $add_data = new Survey();
if(isset($_POST['submittt'])){
    $uni_code = $_SESSION['u_code'];
    $ward = $_POST['ward_no'];
    $holding = $_POST['holding_no'];
    $name = $_POST['owner_name'];
    $father_name = $_POST['f_name'];
    $mobile = $_POST['mobile_no'];
    $nid = $_POST['nid_no'];
    
    $filename = rand(1000,10000)."-".$_FILES['profile_photo']['name'];
    $tmp_name = $_FILES['profile_photo']['tmp_name'];
    $new_finale_name = strtolower($filename);
    $finale_file = str_replace(' ','-',$new_finale_name);

    $filename2 = rand(1000,10000)."-".$_FILES['nid_photo']['name'];
    $tmp_name2 = $_FILES['nid_photo']['tmp_name'];
    $new_finale_name2 = strtolower($filename2);
    $finale_file2 = str_replace(' ','-',$new_finale_name2);
    $total_land = $_POST['total_land'];
    $occupation = $_POST['occupation'];
    $proverty_line = $_POST['p_line'];
    $price_of_house = $_POST['price_of_house'];
    $tax = $add_data->english_convertor($_POST['tax']);
    $due_tax = $add_data->english_convertor($_POST['p_due']);
    $type_of_house = $_POST['type_of_house'];

    if(move_uploaded_file($tmp_name,"uploads/".$finale_file)){
           if(move_uploaded_file($tmp_name2,"uploads/".$finale_file2)){
                
           }
     }
     $sql = "INSERT INTO assesment_input(ward_no,holding_no,owner_name,father_name,occupation,type_of_house,total_land,nid,proverty_line,price_of_house,mobile_no,imopsed_tax,previous_due,fiscal_year,profile_pic,nid_photo,union_code) VALUES('$ward','$holding','$name','$father_name','$occupation','$type_of_house','$total_land','$nid','$proverty_line','$price_of_house','$mobile','$tax','$due_tax','22','$finale_file','$finale_file2','$uni_code')";
     $insertdata = $add_data->insertd($sql);
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
    <title>Jccci Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="extra.css">
</head>

<body id="page-top">
    <div class="overlay">
        <div class="loader"></div>
    </div>
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
                <div class="sidebar-brand-text mx-3 bangla">হোমপেইজ</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                    aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="fa fa-info-circle"></i>
                    <span class="bangla">তথ্য ইনপুট</span>
                </a>
                <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header bangla">তথ্য</h6>
                        <a class="collapse-item bangla" href="./assinput">তথ্য সংযোজন</a>
                        <a class="collapse-item bangla" href="./assview">তথ্য ভিউ/হালনাগাদ</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span class="bangla">ট্যাক্স</span>
                </a>
                <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header bangla">ট্যাক্স</h6>
                        <a class="collapse-item bangla" href="./taxinput">ট্যাক্স সংযোজন</a>
                        <a class="collapse-item bangla" href="./taxview">ট্যাক্স রশিদ</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm2"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span class="bangla">সেটিংস</span>
                </a>
                <div id="collapseForm2" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header bangla">সেটিংস</h6>
                        <a class="collapse-item bangla" href="./backup">ব্যাকআপ/ডাওনলোড</a>
                        <a class="collapse-item bangla" href="./view_m">পুনরুদ্ধার</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm3"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span class="bangla">অর্থবছর</span>
                </a>
                <div id="collapseForm3" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header bangla">অর্থবছর</h6>
                        <a class="collapse-item bangla" href="./year_change">অর্থবছর পরিবর্তন</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h6 style="color:white" class="bangla"><?php echo $_SESSION['unionname']; ?></h6>
                    <ul class="navbar-nav ml-auto">
                        <li class="bangla"><a style="text-decoration:none;z-index:99;color:white"
                                href="logout">লগআউট</a></li>
                        <!-- <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="logout.php" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="ml-2  d-lg-inline text-black small bangla">লগআউট</span>
                            </a>
                        </li> -->
                    </ul>
                </nav>
                <div class="container-fluid" id="container-wrapper">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800 bangla">তথ্য সংযোজন</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item bangla"><a href="./">হোমপেইজ</a></li>
                                    <li class="breadcrumb-item active bangla" aria-current="page">তথ্য সংযোজন</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <?php
                            if($status=="error"){
                                echo '<div class="alert alert-danger bangla" role="alert">
  তথ্য সংযুক্ত হয়নি !
</div>';
                            }else if($status=="success"){
               echo '<div class="alert alert-success" role="alert">
  তথ্য সফল ভাবে সংযুক্ত হয়েছে
</div>';
                            }
                            ?>
                            <p id="getunicode" data-lastid=<?php echo $_SESSION['code']; ?>></p>
                            <form id="assesmentForm" method="POST" class="bangla" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">ওয়ার্ড নং
                                        </label>
                                        <input value="78" name="ward_no" type="text" class="form-control" id="ward"
                                            placeholder="ওয়ার্ড নং">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">হোল্ডিং নং</label>
                                        <input value="78" name="holding_no" type="text" class="form-control"
                                            id="holding" placeholder="হোল্ডিং নং">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">মালিকের নাম</label>
                                        <input value="owner" name="owner_name" type="text" class="form-control"
                                            id="ownername" placeholder="মালিকের নাম">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">পিতার নাম</label>
                                        <input value="father" name="f_name" type="text" class="form-control" id="fname"
                                            placeholder="পিতার নাম">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">মাতার নাম
                                        </label>
                                        <input value="mother" name="m_name" type="text" class="form-control" id="mname"
                                            placeholder="মাতার নাম">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">গ্রাম
                                        </label>
                                        <input value="mother" name="village" type="text" class="form-control"
                                            id="village" placeholder="গ্রাম">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">মালিকের ছবি</label>
                                        <input name="profile_photo" type="file" class="form-control" id="profilephoto"
                                            placeholder="মালিকের নাম">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">এন আই ডি ছবি</label>
                                        <input name="nid_photo" type="file" class="form-control" id="nidphoto"
                                            placeholder="পিতার নাম">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">এন আই ডি
                                        </label>
                                        <input value="23243" name="nid_no" type="text" class="form-control" id="nid"
                                            placeholder="এন আই ডি">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">মোবাইল নং</label>
                                        <input value="01819" name="mobile_no" type="text" class="form-control"
                                            id="mobile" placeholder="মোবাইল নং">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">পেশা</label>
                                        <select name="occupation" class="form-control" id="occupation">
                                            <option value="mojor">মজুর</option>
                                            <option value="chakuri">চাকুরী</option>
                                            <option value="probasi">প্রবাসী</option>
                                            <option value="krisi">কৃষি</option>
                                            <option value="bebsa">ব্যবসা</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">বাড়ির ধরন
                                        </label>
                                        <select name="type_of_house" class="form-control" id="type">
                                            <option value="paka">পাকা</option>
                                            <option value="semi-paka">সেমি পাকা</option>
                                            <option value="kacha">কাচা</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">বাড়ির মূল্য
                                        </label>
                                        <input value="0909" name="price_of_house" type="text" class="form-control"
                                            id="price" placeholder="বাড়ির মূল্য">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">ধার্যকৃত ট্যাক্স</label>
                                        <input value="500" name="tax" type="text" class="form-control" id="tax"
                                            placeholder="ধার্যকৃত ট্যাক্স">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">বকেয়া ট্যাক্স</label>
                                        <input name="p_due" type="text" class="form-control" id="due"
                                            placeholder="বকেয়া ট্যাক্স">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">দারিদ্র সীমা</label>
                                        <select name="p_line" class="form-control" id="line">
                                            <option value="uchoo">উচ্চ</option>
                                            <option value="moddo">মধ্য</option>
                                            <option value="nimno">নিম্ন</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">জমির পরিমাণ</label>
                                        <input value="78" name="total_land" type="text" class="form-control" id="land"
                                            placeholder="জমির পরিমাণ">
                                    </div>
                                </div>
                                <div id="family_input">
                                    <div id="fam_container" class="f_input_container">
                                        <div class="d-flex justify-content-center align-items-center mb-3">
                                            <input type="text" name="" placeholder="নাম">
                                            <select name="p_line" id="exampleFormControlSelect1">
                                                <option value="student">ছাত্র/ছাত্রি</option>
                                                <option value="chakuri">চাকুরি</option>
                                                <option value="others">অন্যন্য</option>
                                            </select>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class=" m-3 d-flex justify-content-center align-items-center">
                                        <button type="button" id="addmore" class="btn btn-success">এড ফ্যামিলি
                                            মেম্বার</button>
                                        <button type="button" id="f_sub" class="btn btn-success"> মেম্বার</button>
                                    </div>
                                </div>
                                <input id="f_subbbb" role="button" type="submit" name="submit" class="btn btn-primary"
                                    value="Submit">
                            </form>
                            <script src="js/ass.js" defer></script>
                        </div>
                        <?php include 'templates/footer.php'; ?>