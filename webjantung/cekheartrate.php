<?php
// Koneksi ke database
$konek = mysqli_connect("localhost", "root", "", "dbjantung");

// Periksa koneksi
if (!$konek) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Baca isi tabel tbjantung
$sql = mysqli_query($konek, "SELECT * FROM tbjantung");

// Periksa apakah query berhasil
if (!$sql) {
    die("Query gagal: " . mysqli_error($konek));
}

// Ambil data detak jantung
$detak = mysqli_fetch_array($sql);

if ($detak) {
    $heartRate = $detak["Heart Rate"]; // Ganti sesuai nama kolom dalam tabel Anda
    echo "Heart Rate: " . $heartRate . " bpm";
} else {
    echo "Data tidak tersedia.";
}

// Tutup koneksi
mysqli_close($konek);
?>
