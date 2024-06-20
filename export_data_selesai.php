<?php
// export_data.php
include("sess_check.php");
include_once("function.php");
include('vendor/autoload.php'); // Load PHPspreadsheet library
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$selectedYear = mysqli_real_escape_string($conn, $_POST['selectYear']);
$sqlExport = "SELECT pengajuan.*, master_notaris.nama_notaris, master_desa.desa, data_kuasa.* FROM pengajuan INNER JOIN master_notaris ON pengajuan.id_notaris = master_notaris.id_notaris INNER JOIN master_desa ON pengajuan.id_desa = master_desa.id_desa LEFT JOIN data_kuasa ON pengajuan.id_kuasa = data_kuasa.id_kuasa WHERE pengajuan.status_pengajuan = 'Selesai' and pengajuan.tahun_pengajuan = '{$selectedYear}' ORDER BY pengajuan.id_pengajuan ASC";
$resultExport = mysqli_query($conn, $sqlExport);

// Handling jika tidak ada data ditemukan
if (mysqli_num_rows($resultExport) > 0) {
    // Kode ekspor data tetap sama
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $spreadsheet->getDefaultStyle()
                ->getFont()
                ->setName('Times New Roman')
                ->setSize(12);
    
    $spreadsheet->getActiveSheet()
        ->setCellValue('C1',"DATA PENGAJUAN PLOTING TANAH");
    $spreadsheet->getActiveSheet()
        ->setCellValue('C3',"Kantah Kab. Sragen");

    $spreadsheet->getActiveSheet()->mergeCells("C1:K1");
    $spreadsheet->getActiveSheet()->mergeCells("C3:AAC3");
    $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('C1')->getFont()->setName('Times New Roman')->setSize(14)->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('C3')->getFont()->setName('Times New Roman')->setSize(12)->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('C:AAC')->getFont()->setName('Times New Roman')->setSize(12);
    
    $spreadsheet->getActiveSheet()->getStyle('C5:AAC5')->getFont()->setName('Times New Roman')->setBold(true);
    // $spreadsheet->getActiveSheet()->getStyle('B3:G3')->applyFromArray($tableHead);
    

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('C')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('D')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('E')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('F')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('G')
                ->setAutoSize(true);

    $spreadsheet->getActiveSheet()
                ->getColumnDimension('H')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('I')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('J')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('K')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('L')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('M')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('N')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('O')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('P')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('Q')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('R')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('S')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('T')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('U')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('V')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('W')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('X')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('Y')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('Z')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('AA')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('AB')
                ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
                ->getColumnDimension('AC')
                ->setAutoSize(true);

    // Tambahkan header kolom
    $sheet->setCellValue('C5', 'No');
    $sheet->setCellValue('D5', 'Notaris/PPAT');
    $sheet->setCellValue('E5', 'NAMA');
    $sheet->setCellValue('F5', 'NO_KTP');
    $sheet->setCellValue('G5', 'TTL');
    $sheet->setCellValue('H5', 'UMUR');
    $sheet->setCellValue('I5', 'PEKERJAAN');
    $sheet->setCellValue('J5', 'ALAMAT_RUMAH');
    $sheet->setCellValue('K5', 'BERTINDAK_SELAKU');
    $sheet->setCellValue('L5', 'NAMA_PEMBERI_KUASA');
    $sheet->setCellValue('M5', 'NO_KTP_PEMBERI_KUASA');
    $sheet->setCellValue('N5', 'TTL_PEMBERI_KUASA');
    $sheet->setCellValue('O5', 'UMUR_PEMBERI_KUASA');
    $sheet->setCellValue('P5', 'PEKERJAAN_PEMBERI_KUASA');
    $sheet->setCellValue('Q5', 'ALAMAT_RUMAH_PEMBERI_KUASA');
    $sheet->setCellValue('R5', 'KECAMATAN');
    $sheet->setCellValue('S5', 'DESA/KEL');
    $sheet->setCellValue('T5', 'JALAN');
    $sheet->setCellValue('U5', 'HAK');
    $sheet->setCellValue('V5', 'NO_HAK');
    $sheet->setCellValue('W5', 'NO_SU');
    $sheet->setCellValue('X5', 'NIB');
    $sheet->setCellValue('Y5', 'LUAS_TANAH');
    $sheet->setCellValue('Z5', 'X');
    $sheet->setCellValue('AA5', 'Y');
    $sheet->setCellValue('AB5', 'PENGGUNAAN');
    $sheet->setCellValue('AC5', 'NO_HP');

    $row = 6;
    $i = 1;
    while ($dataExport = mysqli_fetch_assoc($resultExport)) {
        $sheet->setCellValue('C' . $row, $i);
        $sheet->setCellValue('D' . $row, $dataExport['nama_notaris']);
        $sheet->setCellValue('E' . $row, $dataExport['nama']);
        $sheet->setCellValue('F' . $row, $dataExport['no_ktp']);
        $sheet->setCellValue('G' . $row, $dataExport['tanggal_lahir']);
        $sheet->setCellValue('H' . $row, $dataExport['umur']);
        $sheet->setCellValue('I' . $row, $dataExport['pekerjaan']);
        $sheet->setCellValue('J' . $row, $dataExport['alamat_rumah']);
        $sheet->setCellValue('K' . $row, $dataExport['selaku']);
        $sheet->setCellValue('L' . $row, $dataExport['nama_kuasa']);
        $sheet->setCellValue('M' . $row, $dataExport['no_ktpk']);
        $sheet->setCellValue('N' . $row, $dataExport['ttl_kuasa']);
        $sheet->setCellValue('O' . $row, $dataExport['umur_kuasa']);
        $sheet->setCellValue('P' . $row, $dataExport['pekerjaan_kuasa']);
        $sheet->setCellValue('Q' . $row, $dataExport['alamat_kuasa']);
        $sheet->setCellValue('R' . $row, $dataExport['kecamatan']);
        $sheet->setCellValue('S' . $row, $dataExport['desa']);
        $sheet->setCellValue('T' . $row, $dataExport['lokasi_tanah']);
        $sheet->setCellValue('U' . $row, $dataExport['jenis_hak']);
        $sheet->setCellValue('V' . $row, $dataExport['no_hak']);
        $sheet->setCellValue('W' . $row, $dataExport['no_su']);
        $sheet->setCellValue('X' . $row, $dataExport['nib']);
        $sheet->setCellValue('Y' . $row, $dataExport['luas']);
        $sheet->setCellValue('Z' . $row, $dataExport['koordinat_x']);
        $sheet->setCellValue('AA' . $row, $dataExport['koordinat_y']);
        $sheet->setCellValue('AB' . $row, $dataExport['penggunaan']);
        $sheet->setCellValue('AC' . $row, $dataExport['no_hp']);
    
        $row++;
        $i++;
    }
    
    $pathDir = '/exports/';
    $fullPathDir = dirname(__FILE__).$pathDir;
    $filename = 'Export_Data_Selesai_' . $selectedYear .'.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'. $pathDir  .$filename . '"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save($fullPathDir.$filename);
    echo baseUrl($pathDir.$filename);
    exit;
} else {
    echo "Tidak ada data yang ditemukan untuk Data yang dipilih.";
}