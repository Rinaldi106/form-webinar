<?php
// Membuat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "dbwebinar");

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Menerima data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Mempersiapkan statement untuk memeriksa username dan password
$query = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = mysqli_prepare($koneksi, $query);

// Mengikat parameter ke statement
mysqli_stmt_bind_param($stmt, "ss", $username, $password);

// Menjalankan statement
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Memeriksa apakah ada hasil yang cocok
if (mysqli_num_rows($result) > 0) {
    // Login berhasil
    header("Location: index.php"); // Mengarahkan ke halaman dashboard
} else {
    // Login gagal
    echo "<script>alert('Username atau password salah!'); window.location='login.html';</script>";
}

// Menutup statement dan koneksi
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
