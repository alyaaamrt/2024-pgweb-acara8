<?php
// Pengaturan koneksi MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_acara8"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil semua data dari tabel 'penduduk'
$sql = "SELECT * FROM penduduk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Membuat tabel HTML untuk menampilkan data
    echo "<table border='1px'>
    <tr>
        <th>Kecamatan</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Luas</th>
        <th>Jumlah Penduduk</th>
        <th>Aksi</th> <!-- Kolom untuk aksi hapus -->
    </tr>";
    
    // Menampilkan setiap baris data
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["kecamatan"] . "</td>
        <td>" . $row["latitude"] . "</td>
        <td>" . $row["longitude"] . "</td>
        <td>" . $row["luas"] . "</td>
        <td align='right'>" . $row["jumlah_penduduk"] . "</td>
        <td>
            <!-- Form untuk menghapus data berdasarkan kecamatan -->
            <form action='/pgweb/acara8/latihan3/hapus.php' method='post' style='display:inline;'>
                <input type='hidden' name='kecamatan' value='" . $row["kecamatan"] . "'> <!-- Menggunakan kecamatan sebagai pengenal unik -->
                <input type='submit' value='Hapus' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\");'>
            </form>
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada hasil";
}

// Tutup koneksi
$conn->close();
?>
