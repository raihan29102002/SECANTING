<?php
define('APP_ENV', 'development');
define('APP_URL', 'https://cek-plot-sragen.com');
define('APP_TITLE', 'Sistem Elektronik Cek Tanah dan Plotting');

function baseUrl($path = '')
{
    if (APP_ENV !== 'production') {
        $base_url = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] .
            str_replace(
                basename($_SERVER['SCRIPT_NAME']),
                "",
                $_SERVER['SCRIPT_NAME']
            );
    } else {
        $base_url = APP_URL;
    }
    
    $base_url .= ($path != '' ? $path : '');
    return $base_url;
}
function create_validasi($judul,$isi_pesan,$header=null){
	//buat validation session
	$_SESSION['validation-title'] = $judul;
	$_SESSION['validation-isi'] = $isi_pesan;

	//parameter header diisi apabila ingin meredirect ke suatu halaman
	if(!is_null($header)){
		header("location:".$header);
		exit();
	}
}


function echo_validasi(){
	//mengecek apakah session validasi ada atau tidak
	if(isset($_SESSION['validation-title']) && isset($_SESSION['validation-isi'])){
		$judul_alert = $_SESSION['validation-title'];
		$isi_alert = $_SESSION['validation-isi'];
		//setelah disimpan ke variabel, session langsung dihapus agar tidak kedobelan di halaman selanjutnya
		unset($_SESSION['validation-title']);
		unset($_SESSION['validation-isi']);

		echo 'alertify.alert("<b>'.$judul_alert.'</b>", "'.$isi_alert.'")';
	}
}