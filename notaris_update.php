<?php
include("sess_check.php");
include_once("function.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['perbarui'], $_POST['nama_notaris'], $_POST['id_notaris'], $_POST['nik_notaris'], $_POST['pekerjaan_notaris'], $_POST['alamat_notaris'], $_POST['ttl_notaris'], $_POST['hp_notaris'], $_POST['email_notaris'])) {
    $nama_notaris = $_POST['nama_notaris'];
    $id_notaris = $_POST['id_notaris'];
    $nik_notaris = $_POST['nik_notaris'];
    $pekerjaan_notaris = $_POST['pekerjaan_notaris'];
    $alamat_notaris = $_POST['alamat_notaris'];
    $ttl_notaris = $_POST['ttl_notaris'];
    $hp_notaris = $_POST['hp_notaris'];
    $email_notaris = $_POST['email_notaris'];

    // Lakukan pembaruan data notaris
    $sql_update = "UPDATE master_notaris SET nama_notaris=?, nik_notaris=?, pekerjaan_notaris=?, alamat_notaris=?, ttl_notaris=?, hp_notaris=?, email_notaris=? WHERE id_notaris=?";
    $stmt_update = mysqli_prepare($conn, $sql_update);

    // Periksa apakah prepare statement berhasil
    if ($stmt_update) {
        mysqli_stmt_bind_param($stmt_update, "sssssssi", $nama_notaris, $nik_notaris, $pekerjaan_notaris, $alamat_notaris, $ttl_notaris, $hp_notaris, $email_notaris, $id_notaris); // 'sssssssi' untuk string, string, string, string, string, string, string, integer
        $result_update = mysqli_stmt_execute($stmt_update);
        if ($result_update) {
            header("Location: notaris.php?act=update&msg=success");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Hapus prepared statement setelah digunakan
        mysqli_stmt_close($stmt_update);
    } else {
        echo "Prepare statement failed: " . mysqli_error($conn);
    }
} else {
    echo "Data yang dibutuhkan tidak lengkap.";
}
