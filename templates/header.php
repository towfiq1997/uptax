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
                        <a class="collapse-item bangla" href="./change_confirm">অর্থবছর পরিবর্তন</a>
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