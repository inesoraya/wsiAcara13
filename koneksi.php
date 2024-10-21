<?php
$server     = "localhost";
$username   = "root";
$password   = "";
$db         = "db";
$koneksi = mysqli_connect ($server, $username, $password, $db);

//cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi gagal : ".mysqli_connect_error();
}
?>