<?php
// check_qr_exists.php

include("sess_check.php");
include_once("function.php");

$id_pengajuan = $_POST['id_pengajuan'];
$file_path = 'qr/kode-qr' . $id_pengajuan . '.png';

if (file_exists($file_path)) {
    echo "exists";
} else {
    echo "not_exists";
}
