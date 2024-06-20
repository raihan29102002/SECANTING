<?php
// Memeriksa sesi dan memuat fungsi yang diperlukan
include("sess_check.php");
include_once("function.php");
include('vendor/autoload.php'); // Memuat library PHPspreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Memeriksa apakah id_pengajuan dikirimkan melalui POST
if (isset($_POST['id_pengajuan'])) {
    // Mendapatkan id_pengajuan dari POST
    // $id_pengajuan = $_POST['no'];
    
    $id_pengajuan = $_POST['id_pengajuan'];
    
    //echo 'ID Pengajuan = '. $id_pengajuan .' ';

    // Membuat kueri SQL untuk mendapatkan data berdasarkan id_pengajuan
    $sql = "SELECT pengajuan.*, master_notaris.nama_notaris, master_desa.desa, data_kuasa.* FROM pengajuan INNER JOIN master_notaris ON pengajuan.id_notaris = master_notaris.id_notaris INNER JOIN master_desa ON pengajuan.id_desa = master_desa.id_desa LEFT JOIN data_kuasa ON pengajuan.id_kuasa = data_kuasa.id_kuasa WHERE pengajuan.id_pengajuan = " . $id_pengajuan . " AND (pengajuan.id_kuasa IS NULL OR pengajuan.id_kuasa > 0)";

    // Menjalankan kueri SQL
    $Qry = mysqli_query($conn, $sql);
    
    //echo "<pre>";
    //print_r($Qry);
    //echo "</pre>";

    // Memeriksa apakah ada data yang ditemukan
    if ($Qry && mysqli_num_rows($Qry) > 0) {
        // Inisialisasi objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Konfigurasi style default untuk sel-sel
        $spreadsheet->getDefaultStyle()
                    ->getFont()
                    ->setName('Times New Roman')
                    ->setSize(12);

        // Mengatur alignment untuk kolom tertentu
        $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Mengatur otomatis lebar kolom
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->getColumnDimension('T')->setAutoSize(true);
        $sheet->getColumnDimension('U')->setAutoSize(true);
        $sheet->getColumnDimension('V')->setAutoSize(true);
        $sheet->getColumnDimension('W')->setAutoSize(true);
        $sheet->getColumnDimension('X')->setAutoSize(true);
        $sheet->getColumnDimension('Y')->setAutoSize(true);
        $sheet->getColumnDimension('Z')->setAutoSize(true);
        $sheet->getColumnDimension('AA')->setAutoSize(true);
        // ... (sama seperti untuk kolom lainnya)

        // Menambahkan header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Notaris/PPAT');
        $sheet->setCellValue('C1', 'NAMA');
        $sheet->setCellValue('D1', 'NO_KTP');
        $sheet->setCellValue('E1', 'TTL');
        $sheet->setCellValue('F1', 'UMUR');
        $sheet->setCellValue('G1', 'PEKERJAAN');
        $sheet->setCellValue('H1', 'ALAMAT_RUMAH');
        $sheet->setCellValue('I1', 'BERTINDAK_SELAKU');
        $sheet->setCellValue('J1', 'NAMA_PEMBERI_KUASA');
        $sheet->setCellValue('K1', 'NO_KTP_PEMBERI_KUASA');
        $sheet->setCellValue('L1', 'TTL_PEMBERI_KUASA');
        $sheet->setCellValue('M1', 'UMUR_PEMBERI_KUASA');
        $sheet->setCellValue('N1', 'PEKERJAAN_PEMBERI_KUASA');
        $sheet->setCellValue('O1', 'ALAMAT_RUMAH_PEMBERI_KUASA');
        $sheet->setCellValue('P1', 'KECAMATAN');
        $sheet->setCellValue('Q1', 'DESA/KEL');
        $sheet->setCellValue('R1', 'JALAN');
        $sheet->setCellValue('S1', 'HAK');
        $sheet->setCellValue('T1', 'NO_HAK');
        $sheet->setCellValue('U1', 'NO_SU');
        $sheet->setCellValue('V1', 'NIB');
        $sheet->setCellValue('W1', 'LUAS_TANAH');
        $sheet->setCellValue('X1', 'X');
        $sheet->setCellValue('Y1', 'Y');
        $sheet->setCellValue('Z1', 'PENGGUNAAN');
        $sheet->setCellValue('AA1', 'NO_HP');
        // ... (sama seperti untuk kolom lainnya)

        // Mengatur nomor baris awal
        $row = 2;
        $i = 1;

        // Mengambil data dari hasil kueri dan menulisnya ke dalam sel-sel spreadsheet
        while ($dataExport = mysqli_fetch_assoc($Qry)) {
            $sheet->setCellValue('A' . $row, $i);
            $sheet->setCellValue('B' . $row, $dataExport['nama_notaris']);
            $sheet->setCellValue('C' . $row, $dataExport['nama']);
            $sheet->setCellValue('D' . $row, $dataExport['no_ktp']);
            $sheet->setCellValue('E' . $row, $dataExport['tanggal_lahir']);
            $sheet->setCellValue('F' . $row, $dataExport['umur']);
            $sheet->setCellValue('G' . $row, $dataExport['pekerjaan']);
            $sheet->setCellValue('H' . $row, $dataExport['alamat_rumah']);
            $sheet->setCellValue('I' . $row, $dataExport['selaku']);
            $sheet->setCellValue('J' . $row, $dataExport['nama_kuasa']);
            $sheet->setCellValue('K' . $row, $dataExport['no_ktpk']);
            $sheet->setCellValue('L' . $row, $dataExport['ttl_kuasa']);
            $sheet->setCellValue('M' . $row, $dataExport['umur_kuasa']);
            $sheet->setCellValue('N' . $row, $dataExport['pekerjaan_kuasa']);
            $sheet->setCellValue('O' . $row, $dataExport['alamat_kuasa']);
            $sheet->setCellValue('P' . $row, $dataExport['kecamatan']);
            $sheet->setCellValue('Q' . $row, $dataExport['desa']);
            $sheet->setCellValue('R' . $row, $dataExport['lokasi_tanah']);
            $sheet->setCellValue('S' . $row, $dataExport['jenis_hak']);
            $sheet->setCellValue('T' . $row, $dataExport['no_hak']);
            $sheet->setCellValue('U' . $row, $dataExport['no_su']);
            $sheet->setCellValue('V' . $row, $dataExport['nib']);
            $sheet->setCellValue('W' . $row, $dataExport['luas']);
            $sheet->setCellValue('X' . $row, $dataExport['koordinat_x']);
            $sheet->setCellValue('Y' . $row, $dataExport['koordinat_y']);
            $sheet->setCellValue('Z' . $row, $dataExport['penggunaan']);
            $sheet->setCellValue('AA' . $row, $dataExport['no_hp']);
    
        $row++;
        $i++;
        }

        // Menyimpan file Excel
        $pathDir = '/exports/';
        $fullPathDir = dirname(__FILE__).$pathDir;
        $filename = 'Export_Data_' . $id_pengajuan . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $pathDir .$filename . '"');
        header('Cache-Control: max-age=0');

        // Membuat writer dan menyimpan file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($fullPathDir.$filename);
        echo baseUrl($pathDir.$filename);
        exit;
    } else {
        // Menampilkan pesan jika tidak ada data ditemukan
        echo "Tidak ada data untuk Id Pengajuan yang dipilih.";
    }
} else {
    // Menampilkan pesan jika id_pengajuan tidak ditemukan dalam permintaan
    echo "ID Pengajuan tidak ditemukan dalam permintaan.";
}