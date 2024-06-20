<?php
include("sess_check.php");
include_once("function.php");

if(isset($_POST['id_pengajuan'])) {
    $id_pengajuan = $_POST['id_pengajuan'];
    
    // Mulai transaksi
    mysqli_begin_transaction($conn);

    // Query untuk mengambil nama file yang terkait dengan pengajuan
    $sql_select_files = "SELECT scan, ss_gmap FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
    $result_select_files = mysqli_query($conn, $sql_select_files);
    
    if ($result_select_files && mysqli_num_rows($result_select_files) > 0) {
        $files = mysqli_fetch_assoc($result_select_files);
        
        // Hapus data dari tabel pengajuan
        $sql_delete_pengajuan = "DELETE FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
        $result_delete_pengajuan = mysqli_query($conn, $sql_delete_pengajuan);
        
        $sql_delete_kuasa = "DELETE FROM data_kuasa WHERE id_kuasa IN (SELECT id_kuasa FROM pengajuan WHERE id_pengajuan = '$id_pengajuan')";
        $result_delete_kuasa = mysqli_query($conn, $sql_delete_kuasa);

        if ($result_delete_pengajuan && $result_delete_kuasa) {
            // Hapus file dari direktori server
            $files_deleted = true;
            
            foreach ($files as $file_column => $file_name) {
                if ($file_name) {
                    $file_path = "";
                    switch ($file_column) {
                        case 'scan':
                            $file_path = "scan/" . $file_name;
                            break;
                        case 'ss_gmap':
                            $file_path = "ss_gmap/" . $file_name;
                            break;
                    }
                    
                    if ($file_path && file_exists($file_path)) {
                        if (!unlink($file_path)) {
                            $files_deleted = false;
                            break;
                        }
                    }
                }
            }
            
            if ($files_deleted) {
                // Commit transaksi jika semua operasi berhasil
                mysqli_commit($conn);
                echo "Data dan file berhasil dihapus";
            } else {
                // Rollback transaksi jika penghapusan file gagal
                mysqli_rollback($conn);
                echo "Gagal menghapus file";
            }
        } else {
            // Rollback transaksi jika ada yang gagal
            mysqli_rollback($conn);
            echo "Gagal menghapus data: " . mysqli_error($conn);
        }
    } else {
        // Rollback transaksi jika pengambilan file gagal
        mysqli_rollback($conn);
        echo "Gagal mengambil data file: " . mysqli_error($conn);
    }
} else {
    // ID pengajuan tidak ditemukan dalam permintaan POST
    echo "ID pengajuan tidak ditemukan";
}
?>