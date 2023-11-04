<?php 
 
require 'connect.php';

error_reporting(0);
session_start();
 
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql1 = "SELECT * FROM users WHERE email='$email'";
    $result1 = mysqli_query($mysqli, $sql1);
    if ($result1->num_rows > 0) {
        $sql2 = "SELECT * FROM users WHERE password='$password'";
        $result2 = mysqli_query($mysqli, $sql2);
        if ($result2->num_rows > 0) {
            $row = mysqli_fetch_assoc($result2);
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("Location: index.php");
        } else {
            echo "<script>alert('Password Anda salah. Silahkan coba lagi!')</script>";
        }
    } else {
        echo "<script>alert('Email Anda salah. Silahkan coba lagi!')</script>";
    }
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Poliklinik</title>
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
                    <a class="nav-link text-center active disabled" aria-current="page" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="register.php">Register</a>
                </li>
            </ul>
            <button class="btn btn-lg dark-mode-toggle" id="darkModeToggle">
                <i class="fas fa-sun"></i>
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </nav>

    <div class="container mt-5 mb-3" style="max-width: 50vw;">
        <form class="form-floating" action="" method="POST" name="myForm">
            <h2 class="text-center">Login</h2>
            <div class="form-floating mb-3">
                <input id="floatingInput" type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input id="floatingInput" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="floatingInput">Password</label>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Login Now</button>
            </div>
            <h5 class="text-center">Anda belum punya akun? Silahkan Ke <a href="register.php">Register</a></h5>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>