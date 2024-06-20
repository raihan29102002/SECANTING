<?php
include("sess_check.php");
include_once("function.php");
$pagedesc ="Master desa";
include("layout_top.php");
include("dist/function/format_tanggal.php");
$id = $sess_admid;
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data desa</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="desa_tambah.php" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="panel-body">
                        <?php
						// Query
						$sql = "SELECT * FROM master_desa ORDER BY id_desa DESC";
						$Qry = mysqli_query($conn, $sql);

						// Periksa apakah query berhasil dieksekusi
						if ($Qry) {
						?>
                        <table class="table table-striped table-bordered table-hover" id="tabel-data">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Nama desa</th>
                                    <th width="15%">Kecamatan</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$i = 1;
									while ($data = mysqli_fetch_assoc($Qry)) { {
											echo '<tr>';
											echo '<td class="text-center">' . $i . '</td>';
											echo '<td class="text-center">' . $data['desa'] . '</td>';
											echo '<td class="text-center">' .  $data['kecamatan'] . '</a></td>';
											echo '<td class="text-center">';
											echo '<button class="btn btn-primary btn-xs" onclick="editDesa(' . $data['id_desa'] . ')">Edit</button>&nbsp;';
											echo '<button class="btn btn-danger btn-xs" onclick="deleteDesa(' . $data['id_desa'] . ')">Hapus</button>';
											echo '</td>';
											echo '</tr>';
											$i++;
										}
									}
									?>
                            </tbody>
                        </table>
                        <?php
						} else {
							// Tambahkan penanganan kesalahan sesuai kebutuhan
							echo "Query failed: " . mysqli_error($conn);
						}
						?>

                        <!-- Large modal -->
                        <div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Sedang memproses…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
function editDesa(idDesa) {
    window.location.href = 'desa_edit.php?id=' + idDesa;
}

function deleteDesa(idDesa) {
    window.location.href = 'desa_hapus.php?id=' + idDesa;
}
</script>
<script>
function setEditDesaMode(idDesa, namaDesa, Kecamatan) {
    $("#id_desa").val(idDesa);
    $("#desa").val(namaDesa);
    $("#kecamatan").val(Kecamatan);

    // Sembunyikan tombol Simpan, tampilkan tombol Edit
    $("#btnSimpan").hide();
    $("#btnEdit").show();
}

function cancelEditDesaMode() {
    // Bersihkan formulir dan kembalikan ke mode tambah
    $("#id_desa").val('');
    $("#desa").val('');
    $("#kecamatan").val('');

    // Tampilkan tombol Simpan, sembunyikan tombol Edit
    $("#btnSimpan").show();
    $("#btnEdit").hide();
}
</script>
<script>
function deleteDesa(idDesa) {
    var confirmation = confirm("Apakah Anda yakin ingin menghapus Desa ini?");

    if (confirmation) {
        window.location.href = 'desa_hapus.php?id=' + idDesa;
    }
}
</script>

<?php
include("layout_bottom.php");
?>