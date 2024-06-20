<?php
// memulai session
session_start();
// memanggil file koneksi
include("dist/config/koneksi.php");

// mengecek apakah tombol login sudah di tekan atau belum
if (isset($_POST['login'])) {
	// mengecek apakah username dan password sudah di isi atau belum
	if (empty($_POST['username']) || empty($_POST['password'])) {
		// mengarahkan ke halaman logn.php
		header("location: login_admin.php?err=iempty");
	} else {
		// membaca nilai variabel username dan password
		$username = $_POST['username'];
		$password = $_POST['password'];
		$akses = $_POST['akses'];
		// mencegah sql injection
		$username = htmlentities(trim(strip_tags($username)));

		// memeriksa username di tabel admin
		$sql = "SELECT * FROM admin WHERE user='" . $username . "'";
		$ress = mysqli_query($conn, $sql);

		if ($ress) {
			$dataku = mysqli_fetch_assoc($ress);
			
			// memeriksa apakah password cocok menggunakan password_verify
			if (password_verify($password, $dataku['password'])) {
				// membuat variabel session
				$_SESSION['admin'] = strtolower($dataku['id_admin']);
				// mengarahkan ke halaman indeks.php
				header("location: index.php?login=success");
			} else {
				header("location: /admin/login?err=not_found");
			}
		} else {
			// Kesalahan saat menjalankan query
			header("location: /admin/login?err=query_error");
		}
	}
}