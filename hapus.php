<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['level'] != 1) {
    header("location:login.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = mysqli_query($koneksi, "DELETE FROM user_detail WHERE id=$id");
    
    if ($delete) {
        header("location:home.php");
    } else {
        echo "Hapus user gagal";
    }
} else {
    header("location:home.php");
}
?>