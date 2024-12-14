<?php
// Mengatur header agar data ditampilkan dalam format HTML
header('Content-Type: text/html; charset=utf-8');

// Konfigurasi koneksi ke database MySQL
$servername = "localhost";
$username = "root";    // Default username untuk XAMPP
$password = "";        // Default password untuk XAMPP
$dbname = "dbjantung"; // Nama database yang akan digunakan

// Membuat koneksi ke database
$conn = new mysqli($localhost,$root,$,$dbjantung);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari tabel tbjantung
$sql = "SELECT * FROM tbjantung ORDER BY timestamp DESC"; // Urutkan berdasarkan waktu terbaru
$result = $conn->query($sql);

// Memeriksa apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Menampilkan data dalam bentuk tabel HTML
    echo "<h1>Data Jantung</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Heart Rate</th><th>SPO2</th><th>Timestamp</th></tr>";
    
    // Menampilkan setiap baris data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['heart_Rate'] . "</td>
                <td>" . $row['spo2'] . "</td>
                <td>" . $row['timestamp'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data yang ditemukan.";
}

// Menutup koneksi
$conn->close();
?>
