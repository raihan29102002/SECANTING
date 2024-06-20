<?php
include("sess_check.php");
include("dist/config/koneksi.php");
include_once("function.php");

// Pastikan form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_notaris'];
    $nik = $_POST['nik_notaris'];
    $pekerjaan = $_POST['pekerjaan_notaris'];
    $alamat = $_POST['alamat_notaris'];
    $ttl = $_POST['ttl_notaris'];
    $hp = $_POST['hp_notaris'];
    $email = $_POST['email_notaris'];

    // Validasi dan sanitasi input pengguna untuk mencegah SQL injection
    $nama_notaris = mysqli_real_escape_string($conn, $nama);
    $nik_notaris = mysqli_real_escape_string($conn, $nik);
    $pekerjaan_notaris = mysqli_real_escape_string($conn, $pekerjaan);
    $alamat_notaris = mysqli_real_escape_string($conn, $alamat);
    $ttl_notaris = mysqli_real_escape_string($conn, $ttl);
    $hp_notaris = mysqli_real_escape_string($conn, $hp);
    $email_notaris = mysqli_real_escape_string($conn, $email);

    // Periksa apakah record sudah ada
    $sqlcek = "SELECT * FROM master_notaris WHERE nama_notaris='$nama_notaris'";
    $resscek = mysqli_query($conn, $sqlcek);

    if (mysqli_num_rows($resscek) < 1) {
        // Masukkan record baru
        $sql = "INSERT INTO master_notaris (nama_notaris, nik_notaris, pekerjaan_notaris, alamat_notaris, ttl_notaris, hp_notaris, email_notaris) VALUES ('$nama_notaris', '$nik_notaris', '$pekerjaan_notaris', '$alamat_notaris', '$ttl_notaris', '$hp_notaris', '$email_notaris')";
        $ress = mysqli_query($conn, $sql);

        if ($ress) {
            // Record berhasil dimasukkan
            header("location: notaris.php?act=add&msg=success");
            exit();
        } else {
            // Tangani kesalahan pada saat memasukkan record
            if (mysqli_errno($conn) == 1062) {
                // Error code 1062: Duplicate entry
                header("location: notaris.php?act=add&msg=double");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        // Record sudah ada
        header("location: notaris.php?act=add&msg=double");
        exit();
    }

    // Kode tambahan untuk proses edit jika diperlukan
    if (isset($_POST['edit'])) {
        echo "Proses Edit Data";
        exit();
    }
} else {
    // Tangani kasus di mana form tidak disubmit
    echo "Form tidak disubmit";
}
