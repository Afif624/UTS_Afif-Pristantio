<?php 

include_once('connect.php');

error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['save'])){
    $idPasien = $_POST['idPasien'];
    $idDokter = $_POST['idDokter'];
    $tanggal = $_POST['tanggal'];
    $catatan = $_POST['catatan'];
    $obat = $_POST['obat'];
    if (!empty($idPasien)){
        if (!empty($idDokter)){
            if (!empty($tanggal)){
                if (!empty($catatan)){
                    if (!empty($obat)){
                        if (!empty($_POST['id'])){
                            $id_baru = $_POST['id'];
                            $queri1 = mysqli_query($mysqli, "UPDATE periksa SET 
                                id_pasien='$idPasien',
                                id_dokter='$idDokter',
                                tgl_periksa='$tanggal', 
                                catatan='$catatan',
                                obat='$obat' WHERE id='$id_baru'");
                            echo "<script>alert('Selamat, Anda berhasil merubah data Periksa!');
                                window.location.href = 'periksa.php';
                                    </script>";
                        } else {
                            $queri2 = mysqli_query($mysqli, "INSERT INTO 
                                periksa(id_pasien,id_dokter,tgl_periksa,catatan,obat) VALUES(
                                    '$idPasien','$idDokter','$tanggal','$catatan','$obat')");
                            echo "<script>alert('Selamat, Anda berhasil menghapus data Periksa!');
                                window.location.href = 'periksa.php';
                                    </script>";
                        }
                    } else{
                        echo "<script>alert('Silakan lengkapi Obat!')</script>";
                    }
                } else{
                    echo "<script>alert('Silakan lengkapi Catatan!')</script>";
                }
            } else{
                echo "<script>alert('Silakan lengkapi Tanggal Pemeriksaan!')</script>";
            }
        } else{
            echo "<script>alert('Silakan oilih data Dokter!')</script>";
        } 
    } else{
        echo "<script>alert('Silakan pilih data Pasien!')</script>";
    }      
}

if (isset($_GET['aksi'])){
    $aksi=$_GET['aksi'];
    $id=$_GET['id'];
    if ($aksi == 'hapus'){
        $queri3 = mysqli_query($mysqli, "DELETE FROM periksa 
            WHERE id='$id'");
        echo "<script>alert('Selamat, Anda berhasil menghapus data Periksa!');
            window.location.href = 'periksa.php';
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa-Poliklinik</title>
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
                    <a class="nav-link text-center active disabled" aria-current="page" href="#">Periksa</a>
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
        <h4 class="text-center mb-4" id="header">Form Pemeriksaan</h4>
        <form class="form-floating" method="POST" action="" name="myForm">
            <div class="form-floating mb-3">
                <select class="form-control" id="floatingInput" name="idPasien">
                    <?php 
                    $select='';
                    $queripasien=mysqli_query($mysqli, "SELECT * FROM pasien");
                    while ($rowpasien=mysqli_fetch_array($queripasien)){
                        if($rowpasien['id'] == $idPasien){
                            $select = 'selected=="selected"';
                        } else{
                            $select='';
                        }?>
                        <option value="<?php echo $rowpasien['id'] ?>" <?php echo $select?>>
                            <?php echo $rowpasien['nama']?>
                        </option>
                    <?php }?>
                </select>
                <label for="floatingInput">Nama Pasien</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-control" id="floatingInput" name="idDokter">
                    <?php 
                    $select='';
                    $queridokter=mysqli_query($mysqli, "SELECT * FROM dokter");
                    while ($rowdokter=mysqli_fetch_array($queridokter)){
                        if($rowdokter['id'] == $idDokter){
                            $select = 'selected=="selected"';
                        } else{
                            $select='';
                        }?>
                        <option value="<?php echo $rowdokter['id'] ?>" <?php echo $select?>>
                            <?php echo $rowdokter['nama']?>
                        </option>
                    <?php }?>
                </select>
                <label for="floatingInput">Nama Dokter</label>
            </div>
            <?php 
            $tgl_periksa = '';
            $catatan = '';
            if (isset($_GET['id'])){
                $id=$_GET['id'];
                $queri = mysqli_query($mysqli, 
                    "SELECT * FROM periksa WHERE id='$id'");
                while ($row = mysqli_fetch_array($queri)){
                    $tgl_periksa = $row['tgl_periksa'];
                    $catatan = $row['catatan'];
                }?>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <?php 
            }?>
            <div class="form-floating mb-3">
                <input type="datetime-local" class="form-control" id="floatingInput" name="tanggal" 
                    placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa ?>">
                <label for="floatingInput">Tanggal Periksa</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="catatan" 
                    placeholder="Catatan" value="<?php echo $catatan ?>">
                <label for="floatingInput">Catatan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="obat" 
                    placeholder="Obat" value="<?php echo $obat ?>">
                <label for="floatingInput">Obat</label>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="save">Simpan</button>
        </form>

        <h4 class="text-center mb-4">Tabel Pemeriksaan</h4>
        <?php 
        $i= 1;
        $queriperiksa = mysqli_query($mysqli, 
            "SELECT periksa.*,pasien.nama as pasien,dokter.nama as dokter 
            FROM periksa LEFT JOIN pasien on(periksa.id_pasien=pasien.id)
            LEFT JOIN dokter on(periksa.id_dokter=dokter.id)
            ORDER BY periksa.tgl_periksa DESC");
        if ($queriperiksa->num_rows > 0){?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Pasien</th>
                        <th scope="col" class="text-center">Dokter</th>
                        <th scope="col" class="text-center">Tanggal Periksa</th>
                        <th scope="col" class="text-center">Catatan</th>
                        <th scope="col" class="text-center">Obat</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    while ($rowperiksa = mysqli_fetch_array($queriperiksa)){?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo $i++ ?></th>
                            <td class="text-center"><?php echo $rowperiksa['pasien'] ?></td>
                            <td class="text-center"><?php echo $rowperiksa['dokter'] ?></td>
                            <td class="text-center"><?php echo $rowperiksa['tgl_periksa'] ?></td>
                            <td class="text-center"><?php echo $rowperiksa['catatan'] ?></td>
                            <td class="text-center"><?php echo $rowperiksa['obat'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-info rounded-pill px-3" 
                                    href="periksa.php?id=<?php echo $rowperiksa['id'] ?>">Ubah</a>
                                <a class="btn btn-danger rounded-pill px-3" 
                                    href="periksa.php?id=<?php echo $rowperiksa['id']?>
                                        &aksi=hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php 
        } else{?>
            <h5 class="text-center mb-4"> Tabel Pemeriksaan Masih Kosong, Silahkan Isi Terlebih Dahulu</h5>
        <?php
        }
        ?>
    </div>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>