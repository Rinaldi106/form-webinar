<?php
include 'connect.php'; // Pastikan file connect.php sudah benar dan terkoneksi dengan database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data peserta berdasarkan ID
    $query = "DELETE FROM registrasi_webinar WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='peserta.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location.href='peserta.php';</script>";
    }
} else {
    // Redirect kembali ke halaman peserta jika tidak ada ID yang diberikan
    header('Location: peserta.php');
}
?>
