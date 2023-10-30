<?php 
$dbHost = 'localhost';
$dbName = 'poliklinik';
$dbUsername = 'root';
$dbPassword = '';

$mysqli = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);
if (!$mysqli) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
?>