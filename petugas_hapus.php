<?php
include("sess_check.php");
include_once("function.php");

if (isset($_GET['id'])) {
	$id_petugas = mysqli_real_escape_string($conn, $_GET['id']);

	// Lakukan penghapusan data dari database
	$sql_delete = "DELETE FROM master_petugas WHERE id_petugas='$id_petugas'";
	$result_delete = mysqli_query($conn, $sql_delete);

	if ($result_delete) {
		header("location: petugas.php?act=delete&msg=success");
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
} else {
	echo "ID petugas tidak valid.";
}
