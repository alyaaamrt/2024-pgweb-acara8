<?php
// hapus.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kecamatan = $_POST['kecamatan']; // Mengambil nilai kecamatan dari form

    // Pengaturan koneksi MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pgweb_acara8"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the delete query based on kecamatan
    $stmt = $conn->prepare("DELETE FROM penduduk WHERE kecamatan = ?");
    $stmt->bind_param("s", $kecamatan); // 's' untuk string

    if ($stmt->execute()) {
        // Redirect back to the previous page after deletion
        header("Location: /pgweb/acara8/latihan3/index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
