<?php
include("sess_check.php");
include_once("function.php");

if (isset($_GET['id'])) {
	$id_notaris = mysqli_real_escape_string($conn, $_GET['id']);

	// Lakukan penghapusan data dari database
	$sql_delete = "DELETE FROM master_notaris WHERE id_notaris='$id_notaris'";
	$result_delete = mysqli_query($conn, $sql_delete);

	if ($result_delete) {
		header("location: notaris.php?act=delete&msg=success");
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
} else {
	echo "ID notaris tidak valid.";
}
