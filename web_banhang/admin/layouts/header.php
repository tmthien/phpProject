<?php
    session_start();
    require_once($baseUrl.'../utils/utility.php');
    require_once($baseUrl.'../database/dbhelper.php');

    $user = getUserToken();
    if($user == null) {
        header('Location: '.$baseUrl.'authen/login.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> <?=$title?> </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="<?=$baseUrl?>../assets/css/bootstrap.css" rel="stylesheet" />
        <!-- <link href="../../assets/js/bootstrap.js" rel="stylesheet" /> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?=$baseUrl?>">Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>       
            <div style="width: 100%; text-align: end;">
                <a class="navbar-brand" style="padding: 0 4px; margin-right:32px;" href="<?=$baseUrl?>authen/logout.php">Logout</a>
            </div>
           
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="<?=$baseUrl?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?=$baseUrl?>category">
                                <div class="sb-nav-link-icon"><i class="far fa-list-alt"></i></div>
                                Danh mục sản phẩm
                            </a>
                            <a class="nav-link" href="<?=$baseUrl?>product">
                                <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                                Quản lý sản phẩm
                            </a>
                            <a class="nav-link" href="<?=$baseUrl?>order">
                                <div class="sb-nav-link-icon"><i class="fas fa-luggage-cart"></i></div>
                                Quản lý đơn hàng
                            </a>
                            <a class="nav-link" href="<?=$baseUrl?>feedback">
                                <div class="sb-nav-link-icon"><i class="fas fa-sms"></i></div>
                                Quản lý phản hồi
                            </a>
                            <a class="nav-link" href="<?=$baseUrl?>user">
                                <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                                Quản lý người dùng  
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                
                
