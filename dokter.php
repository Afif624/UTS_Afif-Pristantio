<?php 

include_once('connect.php');

error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['save'])){
    $nama_baru = $_POST['newNama'];
    $alamat_baru = $_POST['newAlamat'];
    $no_hp_baru = $_POST['newNoHP'];
    if (!empty($nama_baru)){
        if (!empty($alamat_baru)){
            if (!empty($no_hp_baru)){
                if (!empty($_POST['id'])){
                    $id_baru = $_POST['id'];
                    $queri3 = mysqli_query($mysqli, "UPDATE dokter SET 
                        nama='$nama_baru',
                        alamat='$alamat_baru',
                        no_hp='$no_hp_baru' WHERE id='$id_baru'");
                    echo "<script>alert('Selamat, Anda berhasil merubah data Dokter!');
                        window.location.href = 'dokter.php';
                            </script>";
                } else {
                    $queri4 = mysqli_query($mysqli, "INSERT INTO 
                        dokter(nama,alamat,no_hp) VALUES(
                            '$nama_baru','$alamat_baru','$no_hp_baru')");
                    echo "<script>alert('Selamat, Anda berhasil menambah data Dokter!');
                        window.location.href = 'dokter.php';
                            </script>";
                }
            } else{
                echo "<script>alert('Silakan lengkapi bagian No HP!')</script>";
            }
        } else{
            echo "<script>alert('Silakan lengkapi bagian Alamat!')</script>";
        } 
    } else{
        echo "<script>alert('Silakan lengkapi bagian Nama!')</script>";
    }      
}

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    $id = $_GET['id'];
    if ($aksi == 'hapus') {
        $result = mysqli_query($mysqli, "SELECT * FROM periksa 
            WHERE id_dokter = $id");
        if ($result && $result->fetch_row()[0] > 0) {
            echo "<script>alert('Tidak dapat menghapus Data Dokter ini karena digunakan Di Tabel Periksa.');</script>";
        } else {
            $queri5 = mysqli_query($mysqli, "DELETE FROM dokter 
                WHERE id='$id'");
            echo "<script>alert('Selamat, Anda berhasil menghapus data Dokter!');
                window.location.href = 'dokter.php';
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
    <title>Dokter-Poliklinik</title>
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
                    <a class="nav-link text-center active disabled" aria-current="page" href="#">Dokter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="pasien.php">Pasien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="periksa.php">Periksa</a>
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
        <h4 class="text-center mb-4" id="header">Form Dokter</h4>
        <form class="form-floating" method="POST" action="" name="myForm">
            <?php 
            $nama = '';
            $alamat = '';
            $no_hp = '';
            if (isset($_GET['id'])){
                $id=$_GET['id'];
                $queri1 = mysqli_query($mysqli, 
                    "SELECT * FROM dokter WHERE id='$id'");
                while ($row1 = mysqli_fetch_array($queri1)){
                    $nama = $row1['nama'];
                    $alamat = $row1['alamat'];
                    $no_hp = $row1['no_hp'];
                }?>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <?php 
            }?>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="newNama" 
                    placeholder="Nama Dokter" value="<?php echo $nama ?>">
                <label for="floatingInput">Nama Dokter</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="newAlamat" 
                    placeholder="Alamat Dokter" value="<?php echo $alamat ?>">
                <label for="floatingInput">Alamat Dokter</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="newNoHP" 
                    placeholder="No HP Dokter" value="<?php echo $no_hp ?>">
                <label for="floatingInput">No HP Dokter</label>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="save">Simpan</button>
        </form>

        <h4 class="text-center mb-4">Tabel Dokter</h4>
        <?php 
        $i= 1;
        $queri2 = mysqli_query($mysqli, "SELECT * FROM dokter");
        if ($queri2->num_rows > 0){?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Alamat</th>
                        <th scope="col" class="text-center">No HP</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row2 = mysqli_fetch_array($queri2)){?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo $i++ ?></th>
                            <td class="text-center"><?php echo $row2['nama'] ?></td>
                            <td class="text-center"><?php echo $row2['alamat'] ?></td>
                            <td class="text-center"><?php echo $row2['no_hp'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-info rounded-pill px-3" 
                                    href="dokter.php?id=<?php echo $row2['id'] ?>">Ubah</a>
                                <a class="btn btn-danger rounded-pill px-3" 
                                    href="dokter.php?id=<?php echo $row2['id']?>
                                        &aksi=hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php 
        } else{?>
            <h5 class="text-center mb-4"> Tabel Dokter Masih Kosong, Silahkan Isi Terlebih Dahulu</h5>
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