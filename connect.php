<?php
$koneksi = mysqli_connect("127.0.0.1","root","","dbwebinar");

//cek koneksi
if(mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_errno();
}
?>