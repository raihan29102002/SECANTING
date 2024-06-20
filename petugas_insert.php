<?php
include("sess_check.php");
include("dist/config/koneksi.php");
include_once("function.php");

// Pastikan form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nama = $_POST['nama_petugas'];

	// Validasi dan sanitasi input pengguna untuk mencegah SQL injection
	$nama_petugas = mysqli_real_escape_string($conn, $nama);

	// Periksa apakah record sudah ada
	$sqlcek = "SELECT * FROM master_petugas WHERE nama_petugas='$nama_petugas'";
	$resscek = mysqli_query($conn, $sqlcek);

	if (mysqli_num_rows($resscek) < 1) {
		// Masukkan record baru
		$sql = "INSERT INTO master_petugas (nama_petugas) VALUES ('$nama_petugas')";
		$ress = mysqli_query($conn, $sql);

		if ($ress) {
			// Record berhasil dimasukkan
			header("location: petugas.php?act=add&msg=success");
			exit();
		} else {
			// Tangani kesalahan pada saat memasukkan record
			if (mysqli_errno($conn) == 1062) {
				// Error code 1062: Duplicate entry
				header("location: petugas.php?act=add&msg=double");
				exit();
			} else {
				echo "Error: " . mysqli_error($conn);
			}
		}
	} else {
		// Record sudah ada
		header("location: petugas.php?act=add&msg=double");
		exit();
	}

	// Kode tambahan untuk proses edit jika diperlukan
	if (isset($_POST['edit'])) {
		echo "Proses Edit Data";
		exit();
	}
} else {
	// Tangani kasus di mana form tidak disubmit
	echo "Form tidak disubmit";
}
