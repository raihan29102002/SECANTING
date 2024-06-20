<?php
include("sess_check.php");
include_once("function.php");

// deskripsi halaman
$pagedesc = "Data Petugas";
include("layout_top.php");
include("dist/function/format_tanggal.php");

?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Petugas</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="petugas_tambah.php" class="btn btn-primary">Tambah</a>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover" id="tabel-data">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th width="10%">Nama Petugas Pemetaan</th>
									<th width="5%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$sql = "SELECT * FROM master_petugas ORDER BY id_petugas ASC";
								$ress = mysqli_query($conn, $sql);
								while ($data = mysqli_fetch_array($ress)) {
									echo '<tr>';
									echo '<td class="text-center">' . $i . '</td>';
									echo '<td class="text-center">' . $data['nama_petugas'] . '</td>';
									echo '<td class="text-center">';
									echo '<button class="btn btn-primary btn-xs" onclick="editPetugas(' . $data['id_petugas'] . ')">Edit</button>&nbsp;';
									echo '<button class="btn btn-danger btn-xs" onclick="deletePetugas(' . $data['id_petugas'] . ')">Hapus</button>';
									echo '</td>';
									echo '</tr>';
									$i++;
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						<button type="button" name="edit" class="btn btn-primary" id="btnEdit" style="display:none;">Edit</button>
					</div>
				</div><!-- /.panel -->
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<!-- bottom of file -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [{
				"orderable": false,
				"targets": [1]
			}]
		});

		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>

<script>
	function editPetugas(idPetugas) {
		window.location.href = 'petugas_edit.php?id=' + idPetugas;
	}

	function deletePetugas(idPetugas) {
		window.location.href = 'petugas_hapus.php?id=' + idPetugas;
	}
</script>
<script>
	function setEditPetugasMode(idPetugas, namaPetugas) {
		$("#id_petugas").val(idPetugas);
		$("#nama_petugas").val(namaPetugas);

		// Sembunyikan tombol Simpan, tampilkan tombol Edit
		$("#btnSimpan").hide();
		$("#btnEdit").show();
	}

	function cancelEditPetugasMode() {
		// Bersihkan formulir dan kembalikan ke mode tambah
		$("#id_petugas").val('');
		$("#nama_petugas").val('');

		// Tampilkan tombol Simpan, sembunyikan tombol Edit
		$("#btnSimpan").show();
		$("#btnEdit").hide();
	}
</script>
<script>
	function deletePetugas(idPetugas) {
		var confirmation = confirm("Apakah Anda yakin ingin menghapus petugas ini?");

		if (confirmation) {
			window.location.href = 'petugas_hapus.php?id=' + idPetugas;
		}
	}
</script>


<?php
include("layout_bottom.php");
?>