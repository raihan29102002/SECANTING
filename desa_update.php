<?php
include("sess_check.php");
include_once("function.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['perbarui'], $_POST['kecamatan'], $_POST['desa'], $_POST['id_desa'])) {
    $desa = $_POST['desa'];
    $kecamatan = $_POST['kecamatan'];
    $id_desa = $_POST['id_desa'];

    // Lakukan pembaruan data desa
    $sql_update = "UPDATE master_desa SET desa=?, kecamatan=? WHERE id_desa=?";
    $stmt_update = mysqli_prepare($conn, $sql_update);

    // Periksa apakah prepare statement berhasil
    if ($stmt_update) {
        mysqli_stmt_bind_param($stmt_update, "sssi", $desa, $kecamatan, $id_desa);   // 'sssi' untuk string, string, string, dan integer
        $result_update = mysqli_stmt_execute($stmt_update);

        if ($result_update) {
            header("Location: master_desa.php?act=update&msg=success");
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