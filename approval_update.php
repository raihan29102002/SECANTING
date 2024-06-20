<?php
ob_start();
include("sess_check.php");
include_once("function.php");
include("dist/config/koneksi.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $aksi = $_POST['aksi'];
    $nama = $_POST['nama'];
    $keterangan_decline = $_POST['keterangan_decline'];
    $emailPenerima = $_POST['email']; // Ambil alamat email dari data pengajuan

    // Proses pengiriman email berdasarkan nilai aksi
    if ($aksi == 1) {
        $subject = 'NOTIFIKASI PERMOHONAN CEK PLOT KANTOR PERTANAHAN KABUPATEN SRAGEN';
        $message = 'Kepada Yth. ' . $nama . '<br>di tempat.<br><br>' .
            'Bersamaan dengan ini, kami memberitahukan bahwa permohonan Anda telah <strong>LOLOS VALIDASI</strong> terkait permohonan CEK PLOT bidang tanah, selanjutnya diharapkan Anda menunggu hingga proses pemetaan telah selesai dilaksanakan.<br>' .
            'Atas perhatian Bapak/Ibu kami ucapkan terima kasih.<br><br>' .
            '<table border=0>' .
            '<tr><th style="background-color:#af3e3e; color:#fff;">Mohon jangan membalas melalui e-mail ini karena tidak akan kami tanggapi.</th></tr>' .
            '</table>' .
            '<hr>' .
            'Salam Hormat,<br>' .
            'Seksi Survei dan Pemetaan<br><br>' .
            '<strong>KANTOR PERTANAHAN KABUPATEN SRAGEN</strong>';

    } elseif ($aksi == 2) {
        $subject = 'NOTIFIKASI PERMOHONAN CEK PLOT KANTOR PERTANAHAN KABUPATEN SRAGEN';
        $message = 'Kepada Yth. ' . $nama . '<br>di tempat.<br><br>' .
            'Bersamaan dengan ini, kami memberitahukan bahwa permohonan Anda ' . ' <strong style="background-color:#af3e3e; color:#fff;">TIDAK LOLOS VALIDASI</strong>. karena <br>' .
            '<strong style="background-color:#af3e3e; color:#fff;">'.$keterangan_decline. ' </strong>. <br>'.
            '<strong> Mohon mengajukan permohonan ulang!</strong>. <br>'.
            'Atas perhatian Bapak/Ibu kami ucapkan terima kasih.<br><br>' .
            '<table border=0>' .
            '<tr><th style="background-color:#af3e3e; color:#fff;">Mohon jangan membalas melalui e-mail ini karena tidak akan kami tanggapi.</th></tr>' .
            '</table>' .
            '<hr>' .
            'Salam Hormat,<br>' .
            'Seksi Survei dan Pemetaan<br><br>' .
            '<strong>KANTOR PERTANAHAN KABUPATEN SRAGEN</strong>';
    } else {
        // Jika aksi tidak valid
        echo 'Pilih aksi yang valid.';
        exit;
    }

    // Pengaturan pengiriman email menggunakan PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug  = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'cek-plot-sragen.com';                             // ip lokal zimbra agar tidak terblokir DMZ
        $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
        $mail->Username   = 'no-reply@cek-plot-sragen.com';      //SMTP username
        $mail->Password   = 'kantahsragen2024';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Menggunakan STARTTLS untuk Gmail
        $mail->Port = 465;                                              // Menggunakan port 587 untuk STARTTLS
        $mail->SMTPDebug = 2;


        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('no-reply@cek-plot-sragen.com', 'ATR/BPN Kabupaten Sragen');
        $mail->addAddress($emailPenerima);                              // Menggunakan alamat email dari data pengajuan
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);  // Set format email ke HTML

        $mail->send();
        echo 'Email berhasil dikirim.';
    } catch (Exception $e) {
        echo 'Gagal mengirim email. Error: ' . $mail->ErrorInfo;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging: Cek nilai dari $_POST
    $no = $_POST['no'];
    $aksi = $_POST['aksi'];
    $petugas_pemetaan = $_POST['petugas_pemetaan'];
    $reject = isset($_POST['reject']) ? $_POST['reject'] : '';

    if ($aksi == "2") {
        $stt = "Declined";
        $Sql = "UPDATE pengajuan SET
                status_pengajuan='" . $stt . "',
                keterangan_decline='" . $reject . "',
                petugas_pemetaan=NULL
                WHERE id_pengajuan='" . $no . "'";
        $ress = mysqli_query($conn, $Sql);

        // Debugging: Cek hasil query
        if ($ress) {
            echo "Query berhasil dijalankan. Status Pengajuan diubah menjadi Declined.";
        } else {
            echo "Query gagal dijalankan. Error: " . mysqli_error($conn);
        }

        header("location: app_wait.php?act=update&msg=success");
    } elseif ($aksi == "1") {
        $stt = "Approved";
        $Sql = "UPDATE pengajuan SET
                status_pengajuan='" . $stt . "',
                keterangan_decline=NULL,
                petugas_pemetaan='" . $petugas_pemetaan ."'
                WHERE id_pengajuan='" . $no . "'";
        $ress = mysqli_query($conn, $Sql);

        // Debugging: Cek hasil query
        if ($ress) {
            echo "Query berhasil dijalankan. Status Pengajuan diubah menjadi Approved.";
        } else {
            echo "Query gagal dijalankan. Error: " . mysqli_error($conn);
        }

        header("location: app_wait.php?act=update&msg=success");
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request method.";
}