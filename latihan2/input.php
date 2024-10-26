<?php
// Ambil data dari form
$kecamatan = $_POST['kecamatan'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Validasi input
if (!is_numeric($luas) || $luas <= 0 || !is_numeric($jumlah_penduduk) || $jumlah_penduduk < 0) {
    die("Data input tidak valid.");
}

// Pengaturan koneksi MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_acara8"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Siapkan dan eksekusi query untuk memasukkan data
$stmt = $conn->prepare("INSERT INTO penduduk (kecamatan, latitude, longitude, luas, jumlah_penduduk) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $kecamatan, $latitude, $longitude, $luas, $jumlah_penduduk);

// Eksekusi query dan cek hasilnya
if ($stmt->execute()) {
    echo "Data baru berhasil ditambahkan";
} else {
    echo "Error: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();

// Opsional: redirect setelah submit
// header("Location: index.html");
// exit;
?>
