<?php
include("sess_check.php");
include_once("function.php");

// Validasi ID petugas
if (isset($_GET['id'])) {
	$id_petugas = $_GET['id'];

	// Fetch existing data for the specified ID
	$sql_fetch = "SELECT id_petugas, nama_petugas FROM master_petugas WHERE id_petugas=?";
	$stmt_fetch = mysqli_prepare($conn, $sql_fetch);
	mysqli_stmt_bind_param($stmt_fetch, "i", $id_petugas);
	mysqli_stmt_execute($stmt_fetch);
	$result_fetch = mysqli_stmt_get_result($stmt_fetch);

	// Check if data exists for the specified ID
	if ($row = mysqli_fetch_assoc($result_fetch)) {
		// Assign data to $data array for use in the form
		$data = $row;

		// deskripsi halaman
		$pagedesc = "Edit petugas";
		$menuparent = "master";
		include("layout_top.php");
?>

		<!-- top of file -->

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Data petugas</h1>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="petugas_update.php" method="POST" enctype="multipart/form-data">
							<!-- Tambahkan input hidden untuk menyimpan nilai id_petugas -->
							<input type="hidden" name="id_petugas" value="<?php echo $data['id_petugas']; ?>">

							<div class="panel panel-default">
								<div class="panel-heading">
									<h3>Edit Data</h3>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">Nama petugas</label>
										<div class="col-sm-4">
											<input type="text" name="nama_petugas" class="form-control" placeholder="petugas" value="<?php echo $data['nama_petugas'] ?>" required>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<div class="form-group">
										<label class="control-label col-sm-3"></label>
										<div class="col-sm-4 text-right">
											<button type="submit" name="perbarui" class="btn btn-primary">Update</button>
										</div>
									</div>
								</div>
							</div><!-- /.panel -->
						</form>

					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div><!-- /#page-wrapper -->

		<!-- bottom of file -->
<?php
		include("layout_bottom.php");
	} else {
		// Handle the case where no data is found for the specified ID
		echo "Data dengan ID petugas tersebut tidak ditemukan.";
	}
} else {
	// Tangani jika ID petugas tidak diberikan
	echo "ID petugas tidak valid atau tidak diberikan.";
}

?>