<?php
include_once("function.php");
require_once('dist/config/koneksi.php');

// Fungsi untuk menghitung umur berdasarkan tanggal lahir
function hitungUmur($tanggalLahir) {
    $tanggalLahir = new DateTime($tanggalLahir);
    $tanggalSekarang = new DateTime();
    $umur = $tanggalSekarang->diff($tanggalLahir);
    return $umur->y;
}

$id_notaris = $_GET['id_notaris'];

// Query untuk mendapatkan detail notaris
$query = "SELECT nama_notaris, nik_notaris, ttl_notaris, pekerjaan_notaris, alamat_notaris, hp_notaris, email_notaris, bulan_lahir FROM master_notaris WHERE id_notaris = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_notaris);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    // Tambahkan perhitungan umur ke dalam data
    $data['umur'] = hitungUmur($data['bulan_lahir']);
}

// Kembalikan hasil dalam format JSON
echo json_encode($data);

// Tutup koneksi
$stmt->close();
$conn->close();