<?php
// Detail koneksi database (ganti dengan kredensial Anda yang sebenarnya)
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

// Validasi data dari formulir
$tanggal_kegiatan = isset($_POST['tanggal_kegiatan']) ? trim($_POST['tanggal_kegiatan']) : null;
$nama_lengkap = isset($_POST['nama_lengkap']) ? trim($_POST['nama_lengkap']) : null;
$nomor_wa = isset($_POST['nomor_wa']) ? trim($_POST['nomor_wa']) : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$norek = isset($_POST['norek']) ? trim($_POST['norek']) : null;
$bank = isset($_POST['bank']) ? trim($_POST['bank']) : null;
$usia = isset($_POST['usia']) ? trim($_POST['usia']) : null;
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? trim($_POST['jenis_kelamin']) : null;
$pendidikan = isset($_POST['pendidikan']) ? trim($_POST['pendidikan']) : null;
$status = isset($_POST['status']) ? trim($_POST['status']) : null;
$alamat_rumah = isset($_POST['alamat_rumah']) ? trim($_POST['alamat_rumah']) : null;
$kecamatan = isset($_POST['kecamatan']) ? trim($_POST['kecamatan']) : null;
$kab_kota = isset($_POST['kab/kota']) ? trim($_POST['kab/kota']) : null;
$provinsi = isset($_POST['provinsi']) ? trim($_POST['provinsi']) : null;
$kode_pos = isset($_POST['kode_pos']) ? trim($_POST['kode_pos']) : null;
$kode_akses = isset($_POST['kode_akses']) ? trim($_POST['kode_akses']) : null;

// Cek apakah kode akses valid
$cek_kode_sql = "SELECT * FROM kode_akses WHERE kode = ?";
$cek_kode_stmt = $conn->prepare($cek_kode_sql);
$cek_kode_stmt->bind_param("s", $kode_akses);
$cek_kode_stmt->execute();
$cek_kode_result = $cek_kode_stmt->get_result();
if ($cek_kode_result->num_rows == 0) {
    // Kode akses tidak valid
    echo "Kode akses tidak valid.";
    $cek_kode_stmt->close();
    $conn->close();
    exit();
}
$cek_kode_stmt->close();

// Cek apakah data sudah ada di database
$cek_sql = "SELECT * FROM registrasi_webinar WHERE nama_lengkap = ? OR email = ? OR norek = ? OR nomor_wa = ?";
$cek_stmt = $conn->prepare($cek_sql);
$cek_stmt->bind_param("ssss", $nama_lengkap, $email, $norek, $nomor_wa);
$cek_stmt->execute();
$cek_result = $cek_stmt->get_result();
if ($cek_result->num_rows > 0) {
    header("Location: penolakan.php"); // Redirect ke halaman penolakan.php
    $cek_stmt->close();
    $conn->close();
    exit();
}
$cek_stmt->close();

// Cek apakah ada field yang kosong
if ($tanggal_kegiatan &&$nama_lengkap && $nomor_wa && $email && $norek && $bank && $usia && $jenis_kelamin && $pendidikan && $status && $alamat_rumah && $kecamatan && $kab_kota && $provinsi && $kode_pos) {
    // Menyiapkan pernyataan SQL
    $sql = "INSERT INTO registrasi_webinar (tanggal_kegiatan,nama_lengkap, nomor_wa, email, norek, bank, usia, jenis_kelamin, pendidikan, status, alamat_rumah, kecamatan, kab_kota, provinsi, kode_pos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Menyiapkan pernyataan
    $stmt = $conn->prepare($sql);
    
    // Mengikat data formulir ke pernyataan yang disiapkan
    $stmt->bind_param("sssssssssssssss", $tanggal_kegiatan, $nama_lengkap, $nomor_wa, $email, $norek, $bank, $usia, $jenis_kelamin, $pendidikan, $status, $alamat_rumah, $kecamatan, $kab_kota, $provinsi, $kode_pos);
    
    // Menjalankan pernyataan
    if ($stmt->execute()) {
        header("Location: success.php"); // Redirect ke halaman success.php
        exit();
    } else {
        echo "Kesalahan: " . $stmt->error;
    }
    
    // Menutup pernyataan
    $stmt->close();
} else {
    echo "Semua field harus diisi!";
}

// Menutup koneksi
$conn->close();
?>
