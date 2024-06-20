<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "Data Karyawan";
$menuparent = "master";
include("layout_top.php");
?>
<script type="text/javascript">
	function checkNppAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'id_notaris=' + $("#notaris").val(), // Perbaikan di sini
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}

	function autoFillIdNotaris() {
		// Logika untuk memberikan nilai otomatis ke id_notaris
	}

	function checkidnotarisAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'id_notaris=' + $("#id_notaris").val(), // Perbaikan di sini
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data notaris</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" action="notaris_insert.php" method="POST" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Nama notaris</h3>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Nama notaris</label>
							<div class="col-sm-4">
								<input type="text" name="nama_notaris" class="form-control" placeholder="Nama notaris" required>
							</div>
						</div>
    					<div class="form-group">
    						<label class="control-label col-sm-3">NIK Notaris</label>
    						<div class="col-sm-4">
    							<input type="text" name="nik_notaris" class="form-control" placeholder="NIK Notaris" required>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="control-label col-sm-3">Pekerjaan Notaris</label>
    						<div class="col-sm-4">
    							<input type="text" name="pekerjaan_notaris" class="form-control" placeholder="Pekerjaan Notaris" required>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="control-label col-sm-3">Alamat Notaris</label>
    						<div class="col-sm-4">
    							<input type="text" name="alamat_notaris" class="form-control" placeholder="Alamat Notaris" required>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="control-label col-sm-3">Tempat, Tanggal Lahir Notaris</label>
    						<div class="col-sm-4">
    							<input type="text" name="ttl_notaris" class="form-control" placeholder="TTL Notaris" required>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="control-label col-sm-3">No HP Notaris</label>
    						<div class="col-sm-4">
    							<input type="text" name="hp_notaris" class="form-control" placeholder="No HP Notaris" required>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="control-label col-sm-3">Email Notaris</label>
    						<div class="col-sm-4">
    							<input type="text" name="email_notaris" class="form-control" placeholder="Email Notaris" required>
    						</div>
    					</div>
						<div class="panel-footer">
							<div class="form-group">
								<label class="control-label col-sm-3"></label>
								<div class="col-sm-4 text-right">
									<button type="submit" name="simpan" action="notaris.php" class="btn btn-primary">Tambah</button>
								</div>
							</div>
						</div>
					</div>
			</div><!-- /.panel -->
			</form>
		</div>
	</div>
</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->

<script>
	$(document).ready(function() {
		autoFillIdNotaris();
	});

	function checkidnotarisAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_nppavailability.php",
			data: 'id_notaris=' + $("#id_notaris").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>


<?php
include("layout_bottom.php");
?>