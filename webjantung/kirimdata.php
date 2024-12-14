<?php
// Mengatur header agar data ditampilkan dalam format JSON
header('Content-Type: application/json');

// Konfigurasi koneksi ke database MySQL
$servername = "localhost";  // Nama server database
$username = "root";         // Default username untuk XAMPP
$password = "";             // Default password untuk XAMPP
$dbname = "dbjantung";      // Nama database yang akan digunakan

// Membuat koneksi ke database
$conn = new mysqli($'localhost', $'root', $'', $'dbjantung');

// Memeriksa koneksi
if ($conn->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Connection failed: ' . $conn->connect_error
    ]));
}

// Mengecek apakah parameter heartRate dan Spo2 ada dalam URL
if (isset($_GET['heartRate']) && isset($_GET['spo2'])) {
    // Mengambil nilai heartRate dan Spo2 dari URL
    $heartRate = $_GET['heartRate'];
    $spo2 = $_GET['spo2'];

    // Menyaring input untuk mencegah SQL injection (gunakan prepared statement)
    $heartRate = $conn->real_escape_string($heartRate);
    $spo2 = $conn->real_escape_string($spo2);

    // Query untuk menyimpan data ke tabel tbjantung
    $sql = "INSERT INTO tbjantung (heart_Rate, spo2) VALUES ('$heartRate', '$spo2')";

    if ($conn->query($sql) === TRUE) {
        // Menampilkan respons sukses dalam format JSON
        echo json_encode([
            'status' => 'success',
            'heartRate' => $heartRate,
            'spo2' => $spo2,
            'message' => 'Data saved to database successfully'
        ]);
    } else {
        // Jika terjadi error saat menyimpan data
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $conn->error
        ]);
    }
} else {
    // Jika parameter tidak ada, mengirimkan respons error
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid parameters'
    ]);
}

// Menutup koneksi
$conn->close();
?>
