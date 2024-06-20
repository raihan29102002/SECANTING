<?php
include("sess_check.php");
include_once("function.php");

// Validasi ID Notaris
if (isset($_GET['id'])) {
	$id_notaris = $_GET['id'];

	// Fetch existing data for the specified ID
	$sql_fetch = "SELECT * FROM master_notaris WHERE id_notaris=?";
	$stmt_fetch = mysqli_prepare($conn, $sql_fetch);
	mysqli_stmt_bind_param($stmt_fetch, "i", $id_notaris);
	mysqli_stmt_execute($stmt_fetch);
	$result_fetch = mysqli_stmt_get_result($stmt_fetch);

	// Check if data exists for the specified ID
	if ($row = mysqli_fetch_assoc($result_fetch)) {
		// Assign data to $data array for use in the form
		$data = $row;

		// deskripsi halaman
		$pagedesc = "Edit Notaris";
		$menuparent = "master";
		include("layout_top.php");
?>

		<!-- top of file -->

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Data Notaris</h1>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="notaris_update.php" method="POST" enctype="multipart/form-data">
							<!-- Tambahkan input hidden untuk menyimpan nilai id_notaris -->
							<input type="hidden" name="id_notaris" value="<?php echo $data['id_notaris']; ?>">

							<div class="panel panel-default">
								<div class="panel-heading">
									<h3>Edit Data</h3>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">Nama Notaris</label>
										<div class="col-sm-4">
											<input type="text" name="nama_notaris" class="form-control" placeholder="Notaris" value="<?php echo $data['nama_notaris'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">NIK Notaris</label>
										<div class="col-sm-4">
											<input type="text" name="nik_notaris" class="form-control" placeholder="NIK Notaris" value="<?php echo $data['nik_notaris'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Pekerjaan Notaris</label>
										<div class="col-sm-4">
											<input type="text" name="pekerjaan_notaris" class="form-control" placeholder="Pekerjaan Notaris" value="<?php echo $data['pekerjaan_notaris'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Alamat Notaris</label>
										<div class="col-sm-4">
											<input type="text" name="alamat_notaris" class="form-control" placeholder="Alamat Notaris" value="<?php echo $data['alamat_notaris'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Tempat, Tanggal Lahir Notaris</label>
										<div class="col-sm-4">
											<input type="text" name="ttl_notaris" class="form-control" placeholder="TTL Notaris" value="<?php echo $data['ttl_notaris'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">No HP Notaris</label>
										<div class="col-sm-4">
											<input type="text" name="hp_notaris" class="form-control" placeholder="No HP Notaris" value="<?php echo $data['hp_notaris'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Email Notaris</label>
										<div class="col-sm-4">
											<input type="text" name="email_notaris" class="form-control" placeholder="Email Notaris" value="<?php echo $data['email_notaris'] ?>" required>
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
		echo "Data dengan ID Notaris tersebut tidak ditemukan.";
	}
} else {
	// Tangani jika ID Notaris tidak diberikan
	echo "ID Notaris tidak valid atau tidak diberikan.";
}

?>