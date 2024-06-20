<?php
include("sess_check.php");
include_once("function.php");
$baseDir = 'qr/';

if (isset($_GET['id_pengajuan'])) {
    $id_pengajuan = $_GET['id_pengajuan'];
    $fileName = "kode-qr{$id_pengajuan}.png";
    $filePath = $baseDir . $fileName;

    if (file_exists($filePath) && strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) === 'png') {
        $fileSize = filesize($filePath);

        header('Content-Description: File Transfer');
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $fileSize);

        ob_clean();
        flush();
        readfile($filePath);
        exit;
    } else {
        echo "File not found or not a PNG file.";
    }
} else {
    echo "No ID specified.";
}
?>
