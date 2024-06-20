<?php
// Include koneksi ke database
require_once('dist/config/koneksi.php');

// Periksa apakah ada permintaan POST yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kecamatan_id'])) {
    $kecamatanId = $_POST['kecamatan_id'];

    // Lakukan query untuk mendapatkan daftar desa berdasarkan kecamatan yang dipilih
    $sql = "SELECT id_desa, nama_desa FROM desa WHERE id_kecamatan = $kecamatanId";
    $result = $conn->query($sql);

    // Buat opsi desa berdasarkan hasil query
    $options = '<option value="" disabled selected>Pilih desa</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['id_desa'] . "'>" . $row['nama_desa'] . "</option>";
    }

    // Keluarkan opsi desa sebagai respons dari permintaan AJAX
    echo $options;
} else {
    // Jika tidak ada permintaan POST atau ID kecamatan tidak tersedia, kembalikan pesan error
    echo 'Terjadi kesalahan dalam memproses permintaan.';
}

// Tutup koneksi ke database
$conn->close();
?>
