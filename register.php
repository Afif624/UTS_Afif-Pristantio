<?php 
 
require 'connect.php';
 
error_reporting(0);
session_start();
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
 
    if ($password == $cpassword) {
        $sql1 = "SELECT * FROM users WHERE username='$username'";
        $result1 = mysqli_query($mysqli, $sql1);
        if (!$result1->num_rows > 0) {
            $sql2 = "SELECT * FROM users WHERE email='$email'";
            $result2 = mysqli_query($mysqli, $sql2);
            if (!$result2->num_rows > 0) {
                $sql3 = "INSERT INTO users (username, email, password)
                        VALUES ('$username', '$email', '$password')";
                $result3 = mysqli_query($mysqli, $sql3);
                if ($result3) {
                    echo "<script>alert('Selamat, Registrasi berhasil!');
                        window.location.href = 'login.php';
                            </script>";
                } else {
                    echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                }
            } else {
                echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Username Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Dan Confirm Password Tidak Sama')</script>";
    }
}
 
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register-Poliklinik</title>
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
                    <a class="nav-link text-center" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="dokter.php">Dokter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="pasien.php">Pasien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="periksa.php">Periksa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center active disabled" aria-current="page" href="#">Register</a>
                </li>
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

    <div class="container mb-3" style="max-width: 50vw;">
        <h2 class="text-center mt-5 mb-4" id="header">Selamat Datang di Halaman Register</h2>
        <form class="form-floating" action="" method="POST" name="myForm">
            <div class="form-floating mb-3">
                <input id="floatingInput" type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input id="floatingInput" type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input id="floatingInput" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="floatingInput">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input id="floatingInput" type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Ulang Password" required>
                <label for="floatingInput">Ulang Password</label>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Register Now</button> 
            </div>
            <h5 class="text-center">Anda sudah punya akun? Silahkan Ke <a href="login.php">Login</a></h5>
        </form>
    </div>

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