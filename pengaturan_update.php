<?php
session_start();
include("sess_check.php");
include_once("function.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Database connection parameters
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pertanahan";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	// Menutup koneksi
	$conn->close();
}

include("dist/config/koneksi.php");

// query database memperbarui data pada database
if (isset($_POST['perbarui'])) {
	$id_admin = $_POST['id_admin'];
	$password_old = $_POST['password_old'];
	$password_old2 = $_POST['password_old2'];
	$password_new = $_POST['password_new'];
	$password_new2 = $_POST['password_new2'];

	// Memeriksa apakah password lama cocok dengan yang ada di database menggunakan password_verify
	$sql_check_password = "SELECT password FROM admin WHERE id_admin='" . $id_admin . "'";
	$result_check_password = mysqli_query($conn, $sql_check_password);

	if ($result_check_password) {
		$row = mysqli_fetch_assoc($result_check_password);
		$hashed_password = $row['password'];

		if (password_verify($password_old, $hashed_password)) {
			// Password lama cocok
			if ($password_new == $password_new2) {
				$hashed_new_password = password_hash($password_new, PASSWORD_BCRYPT);

				$sql_update_password = "UPDATE admin SET password='" . $hashed_new_password . "' WHERE id_admin='" . $id_admin . "'";
				$result_update_password = mysqli_query($conn, $sql_update_password);

				if ($result_update_password) {
					// Password berhasil diubah
					header("location: pengaturan.php?act=update&msg=pwd_scc");
					exit(); // Menambahkan exit() agar skrip berhenti setelah melakukan redirect
				} else {
					// Ada kesalahan dalam query SQL
					header("location: pengaturan.php?act=update&msg=error&details=" . mysqli_error($conn));
					exit(); // Menambahkan exit() agar skrip berhenti setelah melakukan redirect
				}
			} else {
				// Password baru tidak cocok
				header("location: pengaturan.php?act=update&msg=pwd_err_2");
			}
		} else {
			// Password lama tidak cocok
			header("location: pengaturan.php?act=update&msg=pwd_err_1");
		}
	} else {
		// Kesalahan saat menjalankan query
		header("location: pengaturan.php?act=update&msg=query_error&details=" . mysqli_error($conn));
		exit(); // Menambahkan exit() agar skrip berhenti setelah melakukan redirect
	}
}
