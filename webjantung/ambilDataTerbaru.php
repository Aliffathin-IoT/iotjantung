<?php
// Koneksi ke database MySQL
$servername = "localhost";
$username = "root";  // Default user di XAMPP
$password = "";  // Default password di XAMPP
$dbname = "health_data";  // Nama database yang sudah dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data terbaru dari database
$sql = "SELECT heartRate, spo2, timestamp FROM health_data ORDER BY id DESC LIMIT 10"; // Mengambil 10 data terbaru
$result = $conn->query($sql);

// Memastikan ada data yang ditemukan
$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row; // Menyimpan data ke array
    }
}

// Mengembalikan data dalam format JSON
echo json_encode($data);

// Menutup koneksi
$conn->close();
?>
