<?php 

include_once('connect.php');

error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['save'])){
    $idPeriksa = $_POST['idPeriksa'];
    $idObat = $_POST['idObat'];
    if (!empty($idPeriksa)){
        if (!empty($idObat)){
            $queriduplikat = mysqli_query($mysqli, "SELECT * FROM detailtransaksi 
                WHERE id_periksa=$idPeriksa");
            if ($queriduplikat->num_rows > 0){
                echo "<script>alert('Maaf Data Detail itu sudah ada!')</script>";
            } else{
                foreach ($idObat as $obatId) {
                    $queri2 = mysqli_query($mysqli, "INSERT INTO 
                        detailtransaksi(id_periksa,id_obat) VALUES(
                            '$idPeriksa','$obatId')");
                }
                echo "<script>alert('Selamat, Anda berhasil menambah data Detail!');
                    window.location.href = 'detail.php';
                        </script>";
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
        $queri3 = mysqli_query($mysqli, "DELETE FROM detailtransaksi 
            WHERE id_periksa='$id'");
        echo "<script>alert('Selamat, Anda berhasil menghapus data Detail!');
            window.location.href = 'detail.php';
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail-Poliklinik</title>
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
                    <a class="nav-link text-center" href="obat.php">Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="periksa.php">Periksa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center active disabled" aria-current="page" href="#">Detail</a>
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
            Selamat Menikmati di Halaman Detail Pemeriksaan<?php if (isset($_SESSION['username'])){?>,
                <?php echo $_SESSION['username'] ?>
            <?php } ?></h2>
        <h4 class="text-center mb-4" id="header">Form Detail Pemeriksaan</h4>
        <form class="form-floating" method="POST" action="" name="myForm">
            <div class="form-floating mb-3">
                <select class="form-control" id="idPeriksaSelect" name="idPeriksa">
                    <?php 
                    $select='';
                    $queriPeriksa=mysqli_query($mysqli, 
                        "SELECT periksa.*, pasien.nama as pasien, dokter.nama as dokter 
                        FROM dokter 
                        JOIN periksa ON dokter.id = periksa.id_dokter 
                        JOIN pasien ON pasien.id = periksa.id_pasien
                        ORDER BY pasien.nama ASC");
                    while ($rowPeriksa=mysqli_fetch_array($queriPeriksa)){
                        $select = ($rowPeriksa['pasien'] == $pasien) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $rowPeriksa['id'] ?>" 
                            data-dokter="<?php echo $rowPeriksa['dokter'] ?>" 
                            data-tanggal="<?php echo $rowPeriksa['tgl_periksa'] ?>"
                            data-catatan="<?php echo $rowPeriksa['catatan'] ?>"
                            data-biaya="<?php echo $rowPeriksa['biaya_periksa'] ?>" <?php echo $select?>>
                            <?php echo $rowPeriksa['pasien'] ?>
                        </option>
                    <?php }?>
                </select>
                <label for="floatingInput">Nama Pasien</label>
            </div>
            <div id="div">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="namadokter" value="<?php echo $dokter?>" readonly>
                    <label for="namadokter">Nama Dokter</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tanggal" value="<?php echo $tgl_periksa?>" readonly>
                    <label for="namadokter">Tanggal Periksa</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="catatan" value="<?php echo $catatan?>" readonly>
                    <label for="namadokter">Catatan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="biaya" value="<?php echo $biaya_periksa?>" readonly>
                    <label for="namadokter">Biaya Periksa</label>
                </div>
            </div>
            <div class="form-floating mb-3">
                <select class="form-control" id="floatingInput" name="idObat[]">
                    <?php 
                    $select='';
                    $queriObat=mysqli_query($mysqli, "SELECT * FROM obat ORDER BY namaobat ASC");
                    while ($rowObat=mysqli_fetch_array($queriObat)){
                        $select = (in_array($rowObat['namaobat'], (array)$obat)) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $rowObat['id'] ?>" <?php echo $select?>>
                            <?php echo $rowObat['namaobat']?>
                        </option>
                    <?php }?>
                </select>
                <label for="floatingInput">Nama Obat</label>
            </div>
            <button type="button" class="btn btn-secondary" onclick="addDrugInput()">Tambah Obat</button>
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="save">Simpan</button>
        </form>

        <h4 class="text-center mb-4">Tabel Detail Pemeriksaan</h4>
        <?php 
        $i = 1;
        $queri4 = mysqli_query($mysqli, 
            "SELECT periksa.*, pasien.nama as pasien, dokter.nama as dokter, GROUP_CONCAT(obat.namaobat) as obat, GROUP_CONCAT(obat.harga) as harga
            FROM dokter
            JOIN periksa ON dokter.id = periksa.id_dokter
            JOIN pasien ON pasien.id = periksa.id_pasien
            JOIN detailtransaksi ON periksa.id = detailtransaksi.id_periksa
            JOIN obat ON obat.id = detailtransaksi.id_obat
            GROUP BY periksa.id
            ORDER BY periksa.tgl_periksa DESC");
        if ($queri4->num_rows > 0) {?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Pasien</th>
                        <th scope="col" class="text-center">Dokter</th>
                        <th scope="col" class="text-center">Tanggal Periksa</th>
                        <th scope="col" class="text-center">Catatan</th>
                        <th scope="col" class="text-center">Obat</th>
                        <th scope="col" class="text-center">Total Biaya</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($row4 = mysqli_fetch_array($queri4)) {
                        $total = $row4['biaya_periksa'] + array_sum(explode(',', $row4['harga']));
                        $obatList = array_unique(explode(',', $row4['obat']));?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo $i++ ?></th>
                            <td class="text-center"><?php echo $row4['pasien'] ?></td>
                            <td class="text-center"><?php echo $row4['dokter'] ?></td>
                            <td class="text-center"><?php echo $row4['tgl_periksa'] ?></td>
                            <td class="text-center"><?php echo $row4['catatan'] ?></td>
                            <td class="text-center">
                                <?php foreach ($obatList as $obat) {
                                    echo " " . $obat . "<br>";
                                } ?>
                            </td>
                            <td class="text-center"><?php echo $total ?></td>
                            <!-- Add a button to trigger the print function -->
                            <td class="text-center">
                                <button class="btn btn-info rounded-pill px-3" onclick="printRow(<?php echo $row4['id']; ?>)">Print</button>
                                <a class="btn btn-danger rounded-pill px-3" href="detail.php?id=<?php echo $row4['id']?>&aksi=hapus">Hapus</a>
                            </td>

                            <!-- Add a modal for displaying the print content -->
                            <div class="modal fade" id="printModal<?php echo $row4['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="printModalLabel">Print Preview</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Content to be printed -->
                                            <h4>Detail Pemeriksaan</h4>
                                            <p>Pasien: <?php echo $row4['pasien']; ?></p>
                                            <p>Dokter: <?php echo $row4['dokter']; ?></p>
                                            <!-- Add more details as needed -->

                                            <!-- Print button inside the modal -->
                                            <button class="btn btn-info" onclick="printContent('printContent<?php echo $row4['id']; ?>')">Print</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add a hidden div to store the content to be printed -->
                            <div id="printContent<?php echo $row4['id']; ?>" style="display: none;">
                                <h4>Detail Pemeriksaan</h4>
                                <p>Pasien: <?php echo $row4['pasien']; ?></p>
                                <p>Dokter: <?php echo $row4['dokter']; ?></p>
                                <!-- Add more details as needed -->
                            </div>

                            <!-- JavaScript function for printing content -->
                            <script>
                                function printContent(elementId) {
                                    var printContent = document.getElementById(elementId).innerHTML;
                                    var originalContent = document.body.innerHTML;

                                    document.body.innerHTML = printContent;
                                    window.print();

                                    document.body.innerHTML = originalContent;
                                }

                                // JavaScript function for printing from selected row
                                function printRow(rowId) {
                                    var modalId = 'printModal' + rowId;
                                    $('#' + modalId).modal('show');
                                }
                            </script>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php 
        } else {?>
            <h5 class="text-center mb-4"> Tabel Detail Pemeriksaan Masih Kosong, Silahkan Isi Terlebih Dahulu</h5>
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
    <script>
        document.getElementById('idPeriksaSelect').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];

            var datadokter = selectedOption.getAttribute('data-dokter');
            var datatanggal = selectedOption.getAttribute('data-tanggal');
            var datacatatan = selectedOption.getAttribute('data-catatan');
            var databiaya = selectedOption.getAttribute('data-biaya');

            var div = document.getElementById('div');
            var namadokterInput = document.getElementById('namadokter');
            var tanggalInput = document.getElementById('tanggal');
            var catatanInput = document.getElementById('catatan');
            var biayaInput = document.getElementById('biaya');

            if (datadokter) {
                namadokterInput.value = datadokter;
                tanggalInput.value = datatanggal;
                catatanInput.value = datacatatan;
                biayaInput.value = databiaya;
                div.style.display = 'block';
            } else {
                div.style.display = 'none';
            }
        });
    </script>
    <script>
        function addDrugInput() {
            var selectContainer = document.getElementById('floatingInput');
            var newSelect = selectContainer.cloneNode(true);
            newSelect.selectedIndex = 0;  // Reset selection for the new input

            // Append the new drug input to the form
            selectContainer.parentNode.appendChild(newSelect);
        }
    </script>
</body>
</html>