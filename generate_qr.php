<?php
include("sess_check.php");
include_once("function.php");
include "phpqrcode/qrlib.php";

if (isset($_POST['id_pengajuan'])) {

    $id_pengajuan = $_POST['id_pengajuan'];
    
    $sql_select_coords = "SELECT koordinat_x, koordinat_y FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
    $result_select_coords = mysqli_query($conn, $sql_select_coords);
    
    if ($result_select_coords && mysqli_num_rows($result_select_coords) > 0) {
        $coords = mysqli_fetch_assoc($result_select_coords);
        $latitude = htmlspecialchars($coords['koordinat_x']);
        $longitude = htmlspecialchars($coords['koordinat_y']);
        
        if (is_numeric($latitude) && is_numeric($longitude)) {
            // Membentuk URL Google Maps dari koordinat
            $googleMapsUrl = "https://www.google.com/maps?q={$latitude},{$longitude}";
            
            /*create folder*/
            $tempdir = "qr/";
            if (!file_exists($tempdir)) mkdir($tempdir, 0777);
            $file_name = "kode-qr". $id_pengajuan . ".png";    
            $file_path = $tempdir . $file_name;
            
            QRcode::png($googleMapsUrl, $file_path, "H", 6, 4);
            
            echo $file_path;
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}