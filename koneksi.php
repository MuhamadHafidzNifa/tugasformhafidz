<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'admin';

$koneksi = mysqli_connect("localhost","root","","admin");

if ($koneksi) {
    //echo "database terkoneksi cuy";
}
// Check connection
if (mysqli_connect_errno()){
    //echo "Koneksi database gagal jir :" . mysqli_connect_error();
}

    mysqli_select_db($koneksi, $db);
?>