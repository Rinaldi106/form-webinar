<?php
// Membuat koneksi ke database
$koneksi = mysqli_connect("127.0.0.1", "root", "", "dbwebinar");

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Menerima data dari form
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$nomor_npwp = $_POST['nomor_npwp'];
$nomor_whatsapp = $_POST['nomor_whatsapp'];
$nomor_rekening = $_POST['nomor_rekening'];
$bank = $_POST['bank'];

// Query untuk memasukkan data ke dalam tabel narasumber
$query = "INSERT INTO narasumber (nama, nik, nomor_npwp, nomor_whatsapp, nomor_rekening, bank) VALUES (?, ?, ?, ?, ?, ?)";

// Menyiapkan pernyataan
$stmt = mysqli_prepare($koneksi, $query);

// Mengikat parameter ke pernyataan
mysqli_stmt_bind_param($stmt, "ssssss", $nama, $nik, $nomor_npwp, $nomor_whatsapp, $nomor_rekening, $bank);

// Menjalankan pernyataan
if (mysqli_stmt_execute($stmt)) {
    header("Location: narasumber.php"); // Redirect ke halaman narasumber.php
    exit();
} else {
    echo "Kesalahan saat menambahkan data: " . mysqli_error($koneksi);
}

// Menutup pernyataan
mysqli_stmt_close($stmt);

// Menutup koneksi
mysqli_close($koneksi);
?>
