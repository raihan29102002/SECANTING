<?php
include("sess_check.php");
include_once("function.php");

if (isset($_GET['id'])) {
	$id_desa = mysqli_real_escape_string($conn, $_GET['id']);

	// Lakukan penghapusan data dari database
	$sql_delete = "DELETE FROM master_desa WHERE id_desa='$id_desa'";
	$result_delete = mysqli_query($conn, $sql_delete);

	if ($result_delete) {
		header("location: master_desa.php?act=delete&msg=success");
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
} else {
	echo "ID desa tidak valid.";
}