<?php
include "koneksi.php";

if (isset($_GET['ID'])){
    //ambil id dari sring
$ID= $_GET['ID'];

//buat query hapus
$query = mysqli_query($koneksi, "DELETE FROM product WHERE ID='$ID'");

//apakah query hapus berhasil?
if ($query) {
    header('Location: dashboard.php');
} else{
    die ("gagal menghapus..");
}
}
?>