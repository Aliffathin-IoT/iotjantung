<?php
// Koneksi ke database
$konek = mysqli_connect("localhost", "root", "", "dbjantung");
if (!$konek) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Baca isi tabel tbjantung
$sql = mysqli_query($konek, "SELECT * FROM tbjantung");
if (!$sql) {
    die("Query gagal: " . mysqli_error($konek));
}

// Ambil data detak jantung
$detak = mysqli_fetch_array($sql);
if ($detak) {
    $BPM = $detak["BPM"];
    echo $BPM;
} else {
    echo "Data tidak tersedia.";
}

// Tutup koneksi
mysqli_close($konek);
?>
