<?php
// Detail koneksi database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbwebinar";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari formulir
$nama_lengkap = $_POST['nama_lengkap'];
$nomor_wa = $_POST['nomor_wa'];
$email = $_POST['email'];
$norek = $_POST['norek'];
$bank = $_POST['bank'];
$usia = $_POST['usia'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$pendidikan = $_POST['pendidikan'];
$status = $_POST['status'];
$alamat_rumah = $_POST['alamat_rumah'];
$kecamatan = $_POST['kecamatan'];
$kab_kota = $_POST['kab_kota'];
$provinsi = $_POST['provinsi'];
$kode_pos = $_POST['kode_pos'];

// Menyiapkan pernyataan SQL
$sql = "INSERT INTO registrasi_webinar (nama_lengkap, nomor_wa, email, norek, bank, usia, jenis_kelamin, pendidikan, status, alamat_rumah, kecamatan, kab_kota, provinsi, kode_pos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Menyiapkan pernyataan
$stmt = $conn->prepare($sql);

// Mengikat data formulir ke pernyataan yang disiapkan
$stmt->bind_param("ssssssssssssss", $nama_lengkap, $nomor_wa, $email, $norek, $bank, $usia, $jenis_kelamin, $pendidikan, $status, $alamat_rumah, $kecamatan, $kab_kota, $provinsi, $kode_pos);

// Menjalankan pernyataan
if ($stmt->execute()) {
    header("Location: peserta.php"); // Redirect ke halaman peserta.php
    exit();
} else {
    echo "Kesalahan: " . $stmt->error;
}

// Menutup pernyataan
$stmt->close();

// Menutup koneksi
$conn->close();
?>
