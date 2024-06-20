<?php
include("sess_check.php");
include_once("function.php");

// deskripsi halaman
$pagedesc = "Data Karyawan";
include("layout_top.php");
include("dist/function/format_tanggal.php");

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
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="notaris_tambah.php" class="btn btn-primary">Tambah</a>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover" id="tabel-data">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th width="10%">Nama Notaris</th>
									<th width="10%">No KTP</th>
									<th width="15%">Pekerjaan</th>
									<th width="10%">Alamat Notaris</th>
									<th width="10%">Tempat, Tanggal Lahir</th>
									<th width="10%">No HP</th>
									<th width="10%">Email</th>
									<th width="5%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$sql = "SELECT * FROM master_notaris ORDER BY id_notaris ASC";
								$ress = mysqli_query($conn, $sql);
								while ($data = mysqli_fetch_array($ress)) {
									echo '<tr>';
									echo '<td class="text-center">' . $i . '</td>';
									echo '<td class="text-center">' . $data['nama_notaris'] . '</td>';
									echo '<td class="text-center">' . $data['nik_notaris'] . '</td>';
									echo '<td class="text-center">' . $data['pekerjaan_notaris'] . '</td>';
									echo '<td class="text-center">' . $data['alamat_notaris'] . '</td>';
									echo '<td class="text-center">' . $data['ttl_notaris'] . '</td>';
									echo '<td class="text-center">' . $data['hp_notaris'] . '</td>';
									echo '<td class="text-center">' . $data['email_notaris'] . '</td>';
									echo '<td class="text-center">';
									echo '<button class="btn btn-primary btn-xs" onclick="editNotaris(' . $data['id_notaris'] . ')">Edit</button>&nbsp;';
									echo '<div style="margin-top: 5px">';
									echo '<button class="btn btn-danger btn-xs" onclick="deleteNotaris(' . $data['id_notaris'] . ')">Hapus</button>';
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
					<!-- Large modal -->
					<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-body">
									<p>One fine body…</p>
								</div>
							</div>
						</div>
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
	function editNotaris(idNotaris) {
		window.location.href = 'notaris_edit.php?id=' + idNotaris;
	}

	function deleteNotaris(idNotaris) {
		window.location.href = 'notaris_hapus.php?id=' + idNotaris;
	}
</script>
<script>
	function setEditNotarisMode(idNotaris, namaNotaris) {
		$("#id_notaris").val(idNotaris);
		$("#nama_notaris").val(namaNotaris);

		// Sembunyikan tombol Simpan, tampilkan tombol Edit
		$("#btnSimpan").hide();
		$("#btnEdit").show();
	}

	function cancelEditNotarisMode() {
		// Bersihkan formulir dan kembalikan ke mode tambah
		$("#id_notaris").val('');
		$("#nama_notaris").val('');

		// Tampilkan tombol Simpan, sembunyikan tombol Edit
		$("#btnSimpan").show();
		$("#btnEdit").hide();
	}
</script>
<script>
	function deleteNotaris(idNotaris) {
		var confirmation = confirm("Apakah Anda yakin ingin menghapus Notaris ini?");

		if (confirmation) {
			window.location.href = 'notaris_hapus.php?id=' + idNotaris;
		}
	}
</script>


<?php
include("layout_bottom.php");
?>