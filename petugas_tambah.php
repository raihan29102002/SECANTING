<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "Data Petugas";
$menuparent = "master";
include("layout_top.php");
?>
<script type="text/javascript">
	function checkNppAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'id_petugas=' + $("#petugas").val(), // Perbaikan di sini
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}

	function autoFillIdPetugas() {
		// Logika untuk memberikan nilai otomatis ke id_petugas
	}

	function checkidpetugasAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'id_petugas=' + $("#id_petugas").val(), // Perbaikan di sini
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
				<h1 class="page-header">Data petugas</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" action="petugas_insert.php" method="POST" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Nama petugas</h3>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Nama petugas</label>
							<div class="col-sm-4">
								<input type="text" name="nama_petugas" class="form-control" placeholder="Nama petugas" required>
							</div>
						</div>
						<div class="panel-footer">
							<div class="form-group">
								<label class="control-label col-sm-3"></label>
								<div class="col-sm-4 text-right">
									<button type="submit" name="simpan" action="petugas.php" class="btn btn-primary">Tambah</button>
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
		autoFillIdPetugas();
	});

	function checkidpetugasAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_nppavailability.php",
			data: 'id_petugas=' + $("#id_petugas").val(),
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