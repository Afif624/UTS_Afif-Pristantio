<?php 

include_once('connect.php');

error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['save'])){
    $namaobat_baru = $_POST['newNamaObat'];
    $kemasan_baru = $_POST['newKemasan'];
    $harga_baru = $_POST['newHarga'];
    if (!empty($namaobat_baru)){
        if (!empty($kemasan_baru)){
            if (!empty($harga_baru)){
                $queriduplikat = mysqli_query($mysqli, "SELECT * FROM obat WHERE namaobat='$namaobat_baru'");
                if ($queriduplikat->num_rows > 0){
                    echo "<script>alert('Maaf Data Obat itu sudah ada!')</script>";
                } else{
                    if (!empty($_POST['id'])){
                        $id_baru = $_POST['id'];
                        $queri3 = mysqli_query($mysqli, "UPDATE obat SET 
                            namaobat='$namaobat_baru',
                            kemasan='$kemasan_baru',
                            harga='$harga_baru' WHERE id='$id_baru'");
                        echo "<script>alert('Selamat, Anda berhasil merubah data Obat!');
                            window.location.href = 'obat.php';
                                </script>";
                    } else {
                        $queri4 = mysqli_query($mysqli, "INSERT INTO 
                            obat(namaobat,kemasan,harga) VALUES(
                                '$namaobat_baru','$kemasan_baru','$harga_baru')");
                        echo "<script>alert('Selamat, Anda berhasil menambah data Obat!');
                            window.location.href = 'obat.php';
                                </script>";
                    }
                }
            } else{
                echo "<script>alert('Silakan lengkapi bagian Harga!')</script>";
            }
        } else{
            echo "<script>alert('Silakan lengkapi bagian Kemasan!')</script>";
        } 
    } else{
        echo "<script>alert('Silakan lengkapi bagian Nama Obat!')</script>";
    }      
}

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    $id = $_GET['id'];
    if ($aksi == 'hapus') {
        $result = mysqli_query($mysqli, "SELECT * FROM detailtransaksi 
            WHERE id_obat = $id");
        if ($result && $result->fetch_row()[0] > 0) {
            echo "<script>alert('Tidak dapat menghapus Data Obat ini karena digunakan Di Tabel Detail Transaksi Pemeriksaan.');</script>";
        } else {
            $queri5 = mysqli_query($mysqli, "DELETE FROM obat
                WHERE id='$id'");
            echo "<script>alert('Selamat, Anda berhasil menghapus data Obat!');
                window.location.href = 'obat.php';
                    </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obat-Poliklinik</title>
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
                    <a class="nav-link text-center active disabled" aria-current="page" href="#">Obat</a>
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

    <div class="container">
        <h2 class="text-center mt-5" id="header">
            Selamat Menikmati di Halaman Obat<?php if (isset($_SESSION['username'])){?>,
                <?php echo $_SESSION['username'] ?>
            <?php } ?></h2>
        <h4 class="text-center mt-4 mb-4">Form Obat</h4>
        <form class="form-floating" method="POST" action="" name="myForm">
            <?php 
            $namaobat = '';
            $kemasan = '';
            $harga = '';
            if (isset($_GET['id'])){
                $id=$_GET['id'];
                $queri1 = mysqli_query($mysqli, 
                    "SELECT * FROM Obat WHERE id='$id'");
                while ($row1 = mysqli_fetch_array($queri1)){
                    $namaobat = $row1['namaobat'];
                    $kemasan = $row1['kemasan'];
                    $harga = $row1['harga'];
                }?>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <?php 
            }?>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="newNamaObat" 
                    placeholder="Nama Obat" value="<?php echo $namaobat ?>">
                <label for="floatingInput">Nama Obat</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="newKemasan" 
                    placeholder="Kemasan" value="<?php echo $kemasan ?>">
                <label for="floatingInput">Kemasan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="newHarga" 
                    placeholder="Harga" value="<?php echo $harga ?>">
                <label for="floatingInput">Harga</label>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="save">Simpan</button>
        </form>
        
        <h4 class="text-center mb-4">Tabel Obat</h4>
        <?php
        $i= 1;
        $queri2 = mysqli_query($mysqli, "SELECT * FROM Obat ORDER BY namaobat ASC");
        if ($queri2->num_rows > 0){?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Kemasan</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row2 = mysqli_fetch_array($queri2)){?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo $i++ ?></th>
                            <td class="text-center"><?php echo $row2['namaobat'] ?></td>
                            <td class="text-center"><?php echo $row2['kemasan'] ?></td>
                            <td class="text-center"><?php echo $row2['harga'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-info rounded-pill px-3" 
                                    href="obat.php?id=<?php echo $row2['id'] ?>">Ubah</a>
                                <a class="btn btn-danger rounded-pill px-3" 
                                    href="obat.php?id=<?php echo $row2['id']?>
                                        &aksi=hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php 
        } else{?>
            <h5 class="text-center mb-4"> Tabel Obat Masih Kosong, Silahkan Isi Terlebih Dahulu</h5>
        <?php
        }
        ?>
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