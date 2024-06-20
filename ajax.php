<?php
// Include your database connection here
require_once('dist/config/koneksi.php');

if(isset($_POST['kecamatan'])) {
    $kecamatanId = $_POST['kecamatan'];
    
    // Query to fetch villages based on selected district
    $sql_desa = "SELECT id_desa, desa FROM master_desa WHERE kecamatan = '$kecamatanId'";
    $result_desa = $conn->query($sql_desa);
    
    if ($result_desa->num_rows > 0) {
        while ($row_desa = $result_desa->fetch_assoc()) {
            echo "<option value='" . $row_desa['id_desa'] . "'>" . $row_desa['desa'] . "</option>";
        }
    } else {
        echo "<option value=''>Tidak ada desa yang tersedia</option>";
    }
}