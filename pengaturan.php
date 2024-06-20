<?php
include("sess_check.php");
include_once("function.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Database connection parameters
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "approval";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	// Menutup koneksi
	$conn->close();
}

// query database mencari data pengguna
$sql = "SELECT * FROM admin WHERE id_admin ='" . $sess_admid . "'";
$ress = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($ress);

// deskripsi halaman
$pagedesc = "Pengaturan";
include("layout_top.php");
?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pengaturan Akun</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" action="pengaturan_update.php" method="POST">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Edit Password</h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="control-label col-sm-3">Password Lama</label>
								<div class="col-sm-4">
									<input type="password" name="password_old" class="form-control" placeholder="Password Lama" required>
									<input type="hidden" name="password_old2" value="<?php echo $data['password'] ?>">
									<input type="hidden" name="id_admin" value="<?php echo $data['id_admin'] ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Password Baru</label>
								<div class="col-sm-4">
									<input type="password" name="password_new" class="form-control" placeholder="Password Baru" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Ulangi Password Baru</label>
								<div class="col-sm-4">
									<input type="password" name="password_new2" class="form-control" placeholder="Ulangi Password Baru" required>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="form-group">
								<label class="control-label col-sm-3"></label>
								<div class="col-sm-4 text-right">
									<button type="submit" name="perbarui" class="btn btn-primary">Simpan Perubahan</button>
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
?>