<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Poliklinik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body data-bs-theme="light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand d-none d-lg-block" href="#">Poliklinik</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navbarTogglerDemo01">
                <li class="nav-item">
                    <a class="nav-link text-center active disabled" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="dokter.php">Dokter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="pasien.php">Pasien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="obat.php">Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="periksa.php">Periksa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="detail.php">Detail</a>
                </li>
                <?php if (!isset($_SESSION['username'])){?>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="register.php">Register</a>
                    </li>
                <?php } else {?>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="logout.php">Logout</a>
                    </li>
                <?php } ?>
            </ul>
            <button class="btn btn-lg dark-mode-toggle" id="darkModeToggle">
                <i class="fas fa-sun"></i>
                <i class="fas fa-moon"></i>
            </button>
            <button class="btn btn-lg btn-scroll-to-top" id="scrollToTopButton">
                <i class="fas fa-arrow-up"></i>
            </button>
        </div>
    </nav>

    <main role="main" class="container">
        <h2 class="text-center mt-5" id="header">
            Selamat Datang di Sistem Informasi Poliklinik<?php if (isset($_SESSION['username'])){?>,
                <?php echo $_SESSION['username'] ?>
            <?php } else{?>, Silahkan <a href="login.php">Login</a> dahulu<?php }?></h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="img/Dokter.png" class="card-img-top" alt="Image 1" style="height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">Halaman Dokter</h5>
                        <p class="card-text">Halaman Dokter adalah tempat di mana Anda dapat menemukan informasi dan profil lengkap tentang para dokter yang bekerja di praktik medis</p>
                        <div class="button-group">
                            <a href="?page=dokter" class="btn btn-primary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Tampilkan</a>
                            <a href="dokter.php" class="btn btn-secondary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Kunjungi</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="img/Pasien.png" class="card-img-top" alt="Image 2" style="height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">Halaman Pasien</h5>
                        <p class="card-text">Halaman Pasien adalah tempat di mana Anda dapat menemukan informasi dan profil lengkap tentang para pasien yang pernah berobat medis.</p>
                        <div class="button-group">
                            <a href="?page=pasien" class="btn btn-primary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Tampilkan</a>
                            <a href="pasien.php" class="btn btn-secondary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Kunjungi</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="img/Obat.png" class="card-img-top" alt="Image 2" style="height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">Halaman Obat</h5>
                        <p class="card-text">Halaman Obat adalah tempat di mana Anda dapat menemukan informasi dari obat-obatan yang digunakan dalam pemeriksaan medis oleh pasien.</p>
                        <div class="button-group">
                            <a href="?page=obat" class="btn btn-primary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Tampilkan</a>
                            <a href="obat.php" class="btn btn-secondary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Kunjungi</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="img/Periksa.png" class="card-img-top" alt="Image 3" style="height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">Halaman Periksa</h5>
                        <p class="card-text">Halaman Periksa adalah pusat informasi tentang prosedur pemeriksaan medis dan tes kesehatan dari para pasien dan dokter yang melayani.</p>
                        <div class="button-group">
                            <a href="?page=periksa" class="btn btn-primary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Tampilkan</a>
                            <a href="periksa.php" class="btn btn-secondary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Kunjungi</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="img/Detail.png" class="card-img-top" alt="Image 2" style="height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">Halaman Detail</h5>
                        <p class="card-text">Halaman Detail adalah tempat di mana Anda dapat menemukan informasi administrasi terkait pemeriksaan yang terjadi dengan pasien</p>
                        <div class="button-group">
                            <a href="?page=detail" class="btn btn-primary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Tampilkan</a>
                            <a href="detail.php" class="btn btn-secondary <?php if (!isset($_SESSION['username'])){?>disabled<?php }?>">Kunjungi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        if (isset($_SESSION['username'])){
            if (isset($_GET['page'])){ ?>
                <h2><?php echo ucwords($_GET['page']) ?></h2>
                <?php 
                ob_start(); 
                include($_GET['page'] . ".php");

                $pageContent = ob_get_clean(); 
                $pageContentWithoutNavbar = preg_replace('/<nav class="navbar.*<\/nav>/s', '', $pageContent);
            
                echo '<div style="pointer-events: none; border: 5px solid;margin-bottom: 20px">' . $pageContentWithoutNavbar . '</div>';
            } 
        }
        ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script>
    $(document).ready(function () {
        var tinggiHeader = $('#header').outerHeight();
        function isHeaderVisible() {
            var jendelaAtas = $(window).scrollTop();
            return jendelaAtas > tinggiHeader;
        }
        function toggleScrollToTopButton() {
            if (isHeaderVisible()) {
                $('#scrollToTopButton').fadeIn();
            } else {
                $('#scrollToTopButton').fadeOut();
            }
        }

        $(window).on('scroll resize', toggleScrollToTopButton);
        toggleScrollToTopButton();
        
        $('#scrollToTopButton').click(function () {
            $('html, body').animate({ scrollTop: 0 }, 800);
            return false;
        });
    });
    </script>
</body>
</html>
