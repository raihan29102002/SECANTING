<?php
include("sess_check.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pengajuan = $_POST['id_pengajuan'];
    $status_pengajuan = $_POST['status_pengajuan'];

    // Update status_pengajuan di database
    $sql = "UPDATE pengajuan SET status_pengajuan = ? WHERE id_pengajuan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status_pengajuan, $id_pengajuan);

    if ($stmt->execute()) {
        echo "Status berhasil diperbarui";
    } else {
        echo "Gagal memperbarui status: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
